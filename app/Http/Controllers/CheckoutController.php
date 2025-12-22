<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
        
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        
        return view('pages.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $user_id = Session::get('user_id');
        $cartItems = CartItem::with('product')->where('user_id', $user_id)->get();
        
        // Validasi sederhana
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'address' => 'required',
            'payment' => 'required|in:transfer,cod'
        ]);
        
        // Hitung total
        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);
        
        // Buat order
        $order = Order::create([
            'order_number' => 'ORD-' . time() . rand(100, 999),
            'user_id' => $user_id,
            'customer_name' => $request->name,
            'customer_email' => $request->email,
            'shipping_address' => $request->address,
            'total' => $total,
            'payment_method' => $request->payment,
            'status' => 'pending',
            'payment_status' => $request->payment == 'cod' ? 'pending' : 'pending'
        ]);
        
        // Buat order items
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'product_name' => $item->product->name,
                'price' => $item->product->price,
                'quantity' => $item->quantity,
                'subtotal' => $item->product->price * $item->quantity
            ]);
            
            // Kurangi stock (optional sederhana)
            $product = $item->product;
            $product->stock -= $item->quantity;
            $product->save();
            
            // Hapus dari cart
            $item->delete();
        }
        
        // Reset cart count
        Session::put('cart_count', 0);
        
        return redirect('/order-status')->with('success', 'Order berhasil! No: ' . $order->order_number);
    }
}