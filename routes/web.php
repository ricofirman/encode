<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;

// ===========================================
// 1. PUBLIC PAGES
// ===========================================

// admin
route::get('/admin', function() {
    return view('admin.index');
})->name('admin');



// Home page
Route::get('/', function() {
    return view('dashboard');
})->name('home');


// Contact page
Route::get('/contact', function() {
    return view('pages.contact');
})->name('contact');

// Help page
Route::get('/help', function() {
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
// 3. PROTECTED PAGES (Hanya untuk login)
// ===========================================

// Cart page
Route::get('/cart', function() {
    if (!session()->has('is_logged_in')) {
        return redirect()->route('login')
            ->with('info', 'Please login to view your cart');
    }
    return view('pages.cart');
})->name('cart');

// Order status page
Route::get('/order-status', function() {
    if (!session()->has('is_logged_in')) {
        return redirect()->route('login')
            ->with('info', 'Please login to view order status');
    }
    return view('pages.order-status');
})->name('order-status');




// MIDTRANS CEKIDOT CELO JANGAN DIPINDAH !!!!!!!!!
use App\Http\Controllers\CheckoutController;
Route::post('/checkout/token', [CheckoutController::class, 'token'])->name('checkout.token');




// ===========================================
// 4. REDIRECT OLD URLS (Backward compatibility)
// ===========================================

Route::get('/dashboard', function() {
    return redirect('/');
});

Route::get('/t-shirt', function() {
    return redirect()->route('products')->with('info', 'All T-Shirts are in Products page');
});

Route::get('/shirt', function() {
    return redirect()->route('products')->with('info', 'All Shirts are in Products page');
});

Route::get('/jacket-sweater', function() {
    return redirect()->route('products')->with('info', 'All Jackets are in Products page');
});

// ===========================================
// 5. ADMIN ROUTES (Tetap sama)
// ===========================================


// Product Routes
Route::get('/products', [ProductController::class, 'index'])->name('products');
Route::get('/product/{slug}', [ProductController::class, 'show'])->name('products.show');

// web.php - PERBAIKI INI:

// Cart Routes
// Cart Routes
Route::get('/cart', [CartController::class, 'index'])->name('cart');
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::put('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');