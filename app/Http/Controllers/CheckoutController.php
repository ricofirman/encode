<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;

class CheckoutController extends Controller
{
    public function index()
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Login dulu ya!');
        }

        $user_id = Session::get('user_id');
        $cartItems = CartItem::with('product')->where('user_id', $user_id)->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang kosong!');
        }

        // total tanpa pajak (sesuai controller asli kamu)
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('pages.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Login dulu ya!');
        }

        $user_id = Session::get('user_id');
        $cartItems = CartItem::with('product')->where('user_id', $user_id)->get();

        if ($cartItems->isEmpty()) {
            return redirect('/cart')->with('error', 'Keranjang kosong!');
        }

        /**
         * NOTE:
         * Form kamu sekarang validasi 'payment' => transfer/cod. :contentReference[oaicite:3]{index=3}
         * Aku bikin fleksibel: bisa 'midtrans' juga.
         * Kalau form kamu masih pakai 'transfer', kita treat itu sebagai midtrans online.
         */
        $request->validate([
            'name'    => 'required',
            'email'   => 'required|email',
            'address' => 'required',
            'payment' => 'required|in:transfer,cod,midtrans',
        ]);

        // Hitung subtotal + tax (biar sesuai tampilan cart kamu yg ada 10%) :contentReference[oaicite:4]{index=4}
        $subtotal = $cartItems->sum(fn($i) => $i->product->price * $i->quantity);
        $tax = $subtotal * 0.1;
        $shipping = 0;
        $grandTotal = $subtotal + $tax + $shipping;

        // Buat order
        $orderNumber = 'ORD-' . time() . rand(100, 999);

        $order = Order::create([
            'order_number'     => $orderNumber,
            'user_id'          => $user_id,

            'customer_name'    => $request->name,
            'customer_email'   => $request->email,

            // WAJIB karena kolom ini NOT NULL di DB kamu
            'shipping_name'    => $request->name,
            'shipping_address' => $request->address,

            // kalau kolom ini ada & NOT NULL, isi juga biar aman
            'shipping_city'       => $request->shipping_city ?? '-',
            'shipping_province'   => $request->shipping_province ?? '-',
            'shipping_postal_code'=> $request->shipping_postal_code ?? '-',
            'shipping_phone'      => $request->shipping_phone ?? '-',

            'subtotal'         => $subtotal,
            'tax'              => $tax,
            'shipping_cost'    => $shipping,
            'total'            => $grandTotal,

            'payment_method'   => $request->payment,
            'payment_status'   => 'pending',
            'status'           => 'pending',
        ]);


        // Buat order items (SESUAI kolom tabel order_items kamu: product_price & total_price)
        foreach ($cartItems as $item) {
            $price = $item->product->price;
            $qty = $item->quantity;

            OrderItem::create([
                'order_id'      => $order->id,
                'product_id'    => $item->product_id,
                'product_name'  => $item->product->name,
                'product_image' => $item->product->image ?? null,
                'product_price' => $price,
                'quantity'      => $qty,
                'total_price'   => $price * $qty,
            ]);

            // kurangi stock
            $product = $item->product;
            if (isset($product->stock)) {
                $product->stock = max(0, (int)$product->stock - $qty);
                $product->save();
            }

            // hapus cart item
            $item->delete();
        }

        // reset cart count session
        Session::put('cart_count', 0);

        // Kalau COD: langsung selesai
        if ($request->payment === 'cod') {
            return redirect('/order-status')->with('success', 'Order berhasil! No: ' . $order->order_number);
        }

        // === MIDTRANS SNAP (untuk transfer / midtrans) ===
        Config::$serverKey = env('MIDTRANS_SERVER_KEY');
        Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION', false);
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // item_details harus array item, minimal id, price, qty, name
        $itemDetails = [];
        foreach ($cartItems as $item) {
            $itemDetails[] = [
                'id'       => (string) $item->product->id,
                'price'    => (int) $item->product->price,
                'quantity' => (int) $item->quantity,
                'name'     => (string) $item->product->name,
            ];
        }

        // tambah tax sebagai item biar gross_amount match (optional tapi aman)
        if ($tax > 0) {
            $itemDetails[] = [
                'id'       => 'TAX',
                'price'    => (int) $tax,
                'quantity' => 1,
                'name'     => 'Tax 10%',
            ];
        }

            $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $grandTotal,
            ],
            'customer_details' => [
                'first_name' => $order->customer_name,
                'email' => $order->customer_email,
            ],
            'item_details' => $itemDetails,

            'callbacks' => [
                'finish'   => url('/order-status'),
                'unfinish' => url('/order-status'),
                'error'    => url('/order-status'),
            ],
            ];


        try {
            $snapToken = Snap::getSnapToken($params);

            // Pastikan kolom ini ada di orders (kalau belum, pakai ALTER yg aku kasih sebelumnya)
            $order->snap_token = $snapToken;
            $order->midtrans_order_id = $order->order_number;
            $order->save();

            return redirect('/pay/' . $order->order_number);
        } catch (\Exception $e) {
            Log::error('Midtrans error: ' . $e->getMessage());
            return redirect('/order-status')->with('error', 'Gagal membuat pembayaran Midtrans: ' . $e->getMessage());
        }
    }

    public function pay($order_number)
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Login dulu ya!');
        }

        $order = Order::where('order_number', $order_number)->firstOrFail();

        if (empty($order->snap_token)) {
            return redirect('/order-status')->with('error', 'Snap token tidak ditemukan untuk order ini.');
        }

        return view('pages.pay', compact('order'));
    }

    /**
     * Midtrans webhook callback (tanpa login)
     * Midtrans akan POST ke endpoint ini.
     */
    public function callback(Request $request)
    {
        // Signature check (biar gak bisa di-spoof)
        $serverKey = env('MIDTRANS_SERVER_KEY');

        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $signatureKey = $request->input('signature_key');

        $mySignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($signatureKey !== $mySignature) {
            Log::warning('Midtrans callback: invalid signature', $request->all());
            return response()->json(['message' => 'Invalid signature'], 403);
        }

        // Pakai Notification biar dapet transaction_status dll
        try {
            Config::$serverKey = $serverKey;
            Config::$isProduction = (bool) env('MIDTRANS_IS_PRODUCTION', false);
            Config::$isSanitized = true;
            Config::$is3ds = true;

            $notif = new Notification();

            $transaction = $notif->transaction_status;
            $paymentType = $notif->payment_type ?? null;
            $transactionId = $notif->transaction_id ?? null;
            $fraud = $notif->fraud_status ?? null;

            $order = Order::where('order_number', $notif->order_id)->first();

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            // Mapping status midtrans ke payment_status
            // settlement/capture = sukses
            if ($transaction === 'capture' || $transaction === 'settlement') {
                $order->payment_status = 'paid';
                $order->status = 'processing';
                $order->paid_at = now();
            } elseif ($transaction === 'pending') {
                $order->payment_status = 'pending';
            } elseif ($transaction === 'deny') {
                $order->payment_status = 'failed';
            } elseif ($transaction === 'expire') {
                $order->payment_status = 'expire';
            } elseif ($transaction === 'cancel') {
                $order->payment_status = 'cancel';
            } else {
                $order->payment_status = $transaction; // fallback
            }

            // simpan detail tambahan kalau kolomnya ada
            $order->payment_type = $paymentType;
            $order->transaction_id = $transactionId;

            $order->save();

            return response()->json(['message' => 'OK']);
        } catch (\Exception $e) {
            Log::error('Midtrans callback error: ' . $e->getMessage());
            return response()->json(['message' => 'Callback error'], 500);
        }
    }
}
