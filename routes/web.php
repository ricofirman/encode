<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ===========================================
// 1. PUBLIC PAGES
// ===========================================

// Home page
Route::get('/', function() {
    return view('dashboard');
})->name('home');

// Products page (gabung semua kategori)
Route::get('/products', function() {
    return view('pages.products');
})->name('products');

// Product detail page
Route::get('/product/{slug}', function($slug) {
    return view('pages.product-detail', ['slug' => $slug]);
})->name('product.detail');

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