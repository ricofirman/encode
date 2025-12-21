<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function token(Request $request)
    {
        $data = $request->validate([
            'payment_method' => 'required|string',
            'gross_amount' => 'required|integer|min:1',
            'items' => 'required|array|min:1',
            'items.*.id' => 'required',
            'items.*.name' => 'required|string',
            'items.*.price' => 'required|integer|min:1',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        $orderNumber = 'ENC-' . now()->format('YmdHis') . '-' . random_int(1000, 9999);

        // Simpan order dulu biar keliatan di phpMyAdmin
        $order = Order::create([
            'order_number' => $orderNumber,
            'status' => $data['payment_method'] === 'cod' ? 'paid' : 'pending',
            'total_price' => (int) $data['gross_amount'],
            'payment_method' => $data['payment_method'],
            'items' => $data['items'],
        ]);

        // Kalau COD, skip Midtrans
        if ($data['payment_method'] === 'cod') {
            return response()->json([
                'order_number' => $order->order_number,
                'payment' => 'cod',
            ]);
        }

        // Midtrans config
        \Midtrans\Config::$serverKey = config('services.midtrans.server_key');
        \Midtrans\Config::$isProduction = (bool) config('services.midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $itemDetails = array_map(function ($it) {
            return [
                'id' => (string) $it['id'],
                'price' => (int) $it['price'],
                'quantity' => (int) $it['quantity'],
                'name' => substr((string) $it['name'], 0, 50),
            ];
        }, $data['items']);

        $params = [
            'transaction_details' => [
                'order_id' => $order->order_number,
                'gross_amount' => (int) $data['gross_amount'],
            ],
            'item_details' => $itemDetails,
        ];

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $order->update(['snap_token' => $snapToken]);

        return response()->json([
            'order_number' => $order->order_number,
            'snap_token' => $snapToken,
        ]);
    }
}
