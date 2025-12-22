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
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
        'is_active' => 'nullable|boolean'
    ]);
    
    $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
    
    // SIMPLE UPLOAD - PASTI BERHASIL
    $imageName = 'default_product.png';
    
    if ($request->hasFile('image')) {
        $image = $request->file('image');
        
        // Nama file: slug_timestamp.random.extension
        $timestamp = time();
        $random = rand(100, 999);
        $extension = $image->getClientOriginalExtension();
        $imageName = "{$slug}_{$timestamp}_{$random}.{$extension}";
        
        // Coba upload
        try {
            $image->move(public_path('img'), $imageName);
        } catch (\Exception $e) {
            // Jika gagal, pakai nama default
            $imageName = 'default_product.png';
        }
    }
    
    // CREATE PRODUCT
    Product::create([
        'name' => $request->name,
        'slug' => $slug,
        'description' => $request->description,
        'price' => $request->price,
        'stock' => $request->stock,
        'category' => $request->category,
        'image' => $imageName,
        'is_active' => $request->has('is_active') ? 1 : 0
    ]);
    
    return redirect()->route('admin.products')->with('success', 'Product created successfully!');
}

    // === EDIT PRODUCT ===
    // Di AdminController, editProduct method
    // === EDIT PRODUCT ===
    public function editProduct($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('admin.products.edit', compact('product'));
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('admin.products')
                ->with('error', 'Product not found! It may have been deleted.');
        }
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:10240',
            'is_active' => 'nullable|boolean'
        ]);
        
        $updateData = [
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'is_active' => $request->has('is_active') ? 1 : 0,
            'image' => $product->image // Default: gambar lama
        ];
        
        // Handle gambar jika diupload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            
            // Generate nama file baru
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $request->name)));
            $imageName = $slug . '_' . time() . '.' . $image->getClientOriginalExtension();
            
            // Upload gambar baru
            $image->move(public_path('img'), $imageName);
            $updateData['image'] = $imageName;
        }
        
        // Update database
        $product->update($updateData);
        
        return redirect()->route('admin.products')->with('success', 'Product updated successfully!');
    }
    public function deleteProduct($id)
    {
        $product = Product::findOrFail($id);
        
        // OPTIONAL: Hapus image (jika mau)
        // if ($product->image && file_exists(public_path('img/' . $product->image))) {
        //     unlink(public_path('img/' . $product->image));
        // }
        
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