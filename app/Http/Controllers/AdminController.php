<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // === DASHBOARD ===
    public function dashboard()
    {
        $stats = [
            'total_products' => Product::count(),
            'total_orders' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'total_revenue' => Order::where('status', 'completed')->sum('total'),
            'active_products' => Product::where('is_active', true)->count(),
            'today_orders' => Order::whereDate('created_at', today())->count(),
            'new_customers' => User::where('role', 'user')->whereDate('created_at', today())->count(),
            'low_stock' => Product::where('stock', '<', 10)->where('stock', '>', 0)->count(),
            'out_of_stock' => Product::where('stock', 0)->count(),
        ];
        
        $recent_orders = Order::with('user')->latest()->take(10)->get();
        
        return view('admin.dashboard', compact('stats', 'recent_orders'));
    }
    
    // === PRODUCTS ===
    public function products()
    {
        $products = Product::latest()->get(); // GET bukan PAGINATE
        return view('admin.products.index', compact('products'));
    }
    
    public function createProduct()
    {
        return view('admin.products.create');
    }
    
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:t-shirt,shirt,jacket',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'nullable|boolean'
        ]);
        
        // Generate slug
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
        
        // Handle image upload ke PUBLIC/IMG/
        $imageName = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $slug . '.' . $image->getClientOriginalExtension();
            
            // Simpan ke public/img/
            $image->move(public_path('img'), $imageName);
        }
        
        // Create product
        Product::create([
            'name' => $request->name,
            'slug' => $slug,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'image' => $imageName, // Contoh: "1703267898_test-product.jpg"
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);
        
        return redirect()->route('admin.products')->with('success', 'Product created successfully!');
    }
    
    public function editProduct($id)
    {
        $product = Product::findOrFail($id);
        return view('admin.products.edit', compact('product'));
    }
    
    public function updateProduct(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'category' => 'required|in:t-shirt,shirt,jacket',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'is_active' => 'nullable|boolean'
        ]);
        
        $data = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'is_active' => $request->has('is_active') ? 1 : 0
        ];
        
        // Update image jika ada
        if ($request->hasFile('image')) {
            // Delete old image dari public/img/
            if ($product->image && file_exists(public_path('img/' . $product->image))) {
                unlink(public_path('img/' . $product->image));
            }
            
            // Upload new image
            $image = $request->file('image');
            $imageName = time() . '_' . $product->slug . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('img'), $imageName);
            
            $data['image'] = $imageName;
        }
        
        $product->update($data);
        
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
    
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // Delete image dari public/img/
        if ($product->image && file_exists(public_path('img/' . $product->image))) {
            unlink(public_path('img/' . $product->image));
        }
        
        $product->delete();
        
        return redirect()->route('admin.products')->with('success', 'Product deleted successfully!');
    }
    
    // === ORDERS ===
    public function orders()
    {
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    
    public function showOrder($id)
    {
        $order = Order::with(['items.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    
    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        
        return back()->with('success', 'Order status updated!');
    }
    
    // === CUSTOMERS ===
    public function customers()
    {
        $customers = User::where('role', 'user')->latest()->paginate(10);
        return view('admin.customers.index', compact('customers'));
    }
}