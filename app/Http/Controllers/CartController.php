<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    // Tampilkan cart
    public function index()
    {
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('info', 'Please login to view cart');
        }
        
        $user_id = Session::get('user_id');
        $cartItems = CartItem::with('product')->where('user_id', $user_id)->get();
        
        // Hitung total
        $total = 0;
        $totalItems = 0;
        foreach ($cartItems as $item) {
            $total += $item->product->price * $item->quantity;
            $totalItems += $item->quantity;
        }
        
        return view('pages.cart', [
            'cartItems' => $cartItems,
            'total' => $total,
            'totalItems' => $totalItems
        ]);
    }
    
    // Add to cart (AJAX)
    public function add(Request $request)
    {
        // Cek login
        if (!Session::has('is_logged_in')) {
            return response()->json([
                'success' => false,
                'message' => 'Please login first',
                'redirect' => '/login'
            ]);
        }
        
        $request->validate([
            'product_id' => 'required|exists:products,id'
        ]);
        
        $user_id = Session::get('user_id');
        $product_id = $request->product_id;
        
        // Cek apakah sudah ada di cart
        $cartItem = CartItem::where('user_id', $user_id)
            ->where('product_id', $product_id)
            ->first();
        
        if ($cartItem) {
            $cartItem->increment('quantity');
        } else {
            CartItem::create([
                'user_id' => $user_id,
                'product_id' => $product_id,
                'quantity' => 1
            ]);
        }
        
        // Update session cart count
        $count = CartItem::where('user_id', $user_id)->sum('quantity');
        Session::put('cart_count', $count);
        
        return response()->json([
            'success' => true,
            'message' => 'Product added to cart!',
            'count' => $count
        ]);
    }
    
    // Update quantity (AJAX)
    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1'
        ]);
        
        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity = $request->quantity;
        $cartItem->save();
        
        // Update session
        $user_id = Session::get('user_id');
        $count = CartItem::where('user_id', $user_id)->sum('quantity');
        Session::put('cart_count', $count);
        
        return response()->json(['success' => true]);
    }
    
    // Remove item
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();
        
        // Update session
        $user_id = Session::get('user_id');
        $count = CartItem::where('user_id', $user_id)->sum('quantity');
        Session::put('cart_count', $count);
        
        return response()->json(['success' => true]);
    }
}