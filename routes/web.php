<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;

// ===========================================
// 1. PUBLIC PAGES
// ===========================================

// Home page
Route::get('/', function () {
    return view('dashboard');
})->name('home');

// Products (public - semua orang bisa lihat)
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// Contact page
Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

// Help page
Route::get('/help', function () {
    return view('pages.help');
})->name('help');


// ===========================================
// 2. AUTH PAGES
// ===========================================

// Login routes
Route::get('/login', [AuthController::class, 'showLoginPage'])->name('login');
Route::post('/login', [AuthController::class, 'processLogin']);

// Register routes
Route::get('/register', [AuthController::class, 'showRegisterPage'])->name('register');
Route::post('/register', [AuthController::class, 'processRegister']);

// Logout route
Route::get('/logout', [AuthController::class, 'processLogout'])->name('logout');


// ===========================================
// 3. CUSTOMER ROUTES (Perlu login)
// ===========================================

Route::middleware('auth.session')->group(function () {

    // CART
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

    // CHECKOUT
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

    // MIDTRANS FLOW (QR / SNAP)
    // NOTE: method pay() & callback() harus kamu tambahkan di CheckoutController
    Route::get('/pay/{order_number}', [CheckoutController::class, 'pay'])->name('pay');
    Route::post('/midtrans/callback', [CheckoutController::class, 'callback'])->name('midtrans.callback');

    // ORDER STATUS
    Route::get('/order-status', function () {
        return view('pages.order-status');
    })->name('order-status');

    // MY ORDERS
    Route::get('/my-orders', function () {
        if (!class_exists('App\Models\Order')) {
            return view('pages.my-orders', ['orders' => collect()]);
        }
        $orders = \App\Models\Order::where('user_id', session('user_id'))->latest()->get();
        return view('pages.my-orders', compact('orders'));
    })->name('my.orders');

    // PROFILE
    Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
    Route::post('/profile/change-name', [ProfileController::class, 'changeName'])->name('profile.change-name');
    Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change-password');
});


// ===========================================
// 4. ADMIN ROUTES (Perlu login + admin)
// ===========================================

Route::prefix('admin')->middleware(['auth.session', 'admin'])->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Products Management
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('admin.products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('admin.products.store');
    Route::get('/products/{id}/edit', [AdminController::class, 'editProduct'])->name('admin.products.edit');
    Route::put('/products/{id}', [AdminController::class, 'updateProduct'])->name('admin.products.update');
    Route::delete('/products/{id}', [AdminController::class, 'deleteProduct'])->name('admin.products.delete');

    // Orders Management
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::get('/orders/{id}', [AdminController::class, 'showOrder'])->name('admin.orders.show');
    Route::put('/orders/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.update');

    // Customers Management
    Route::get('/customers', [AdminController::class, 'customers'])->name('admin.customers');
});


// ===========================================
// 5. REDIRECT OLD URLS (Backward compatibility)
// ===========================================

Route::get('/dashboard', function () {
    return redirect('/');
});

Route::get('/t-shirt', function () {
    return redirect()->route('products', ['category' => 't-shirt']);
});

Route::get('/shirt', function () {
    return redirect()->route('products', ['category' => 'shirt']);
});

Route::get('/jacket-sweater', function () {
    return redirect()->route('products', ['category' => 'jacket']);
});

// Admin redirect untuk user yang ketik /admin saja
Route::get('/admin', function () {
    if (session()->has('is_logged_in') && session('user_role') === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect('/')->with('error', 'Admin access only');
});


// ===========================================
// 6. OPTIONAL DEBUG ROUTES (boleh dihapus kalau udah beres)
// ===========================================

Route::get('/test-upload', function () {
    return view('test-upload');
});

Route::post('/test-upload', function (Request $request) {
    dd($request->file('test_image'));
});

// DEBUG ROUTE
Route::get('/test-update-form', function () {
    $product = \App\Models\Product::find(7);
    return view('test-update-form', compact('product'));
});

Route::post('/test-update-handler/{id}', function (Request $request, $id) {
    echo "<pre>";
    echo "=== TEST UPDATE HANDLER ===\n";
    echo "Product ID: $id\n";
    echo "Method: " . $request->method() . "\n";
    echo "Has File: " . ($request->hasFile('image') ? 'YES' : 'NO') . "\n";
    echo "Request Data:\n";
    print_r($request->all());

    $product = \App\Models\Product::find($id);
    if ($product) {
        $product->update([
            'name' => $request->name . ' [TESTED]',
            'description' => $request->description,
            'price' => $request->price,
            'stock' => $request->stock,
            'category' => $request->category,
            'is_active' => $request->has('is_active') ? 1 : 0
        ]);

        echo "\nUpdate SUCCESS!\n";
        echo "New Name: {$product->name}\n";
        echo "Updated At: {$product->updated_at}\n";
    }

    echo "</pre>";
    echo "<br><a href='/test-update-form'>Kembali</a>";
    exit;
});


// ===========================================
// 7. ERROR HANDLING (Fallback routes)
// ===========================================

Route::fallback(function () {
    return redirect('/')->with('error', 'Page not found');
});
