<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminController;

// ===========================================
// 1. ROUTE HOME & PUBLIC PAGES
// ===========================================

// Home page (dashboard utama)
Route::get('/', function() {
    return view('dashboard'); // Menggunakan dashboard.blade.php yang sudah ada
})->name('home');

// Dashboard page (alias home)
Route::get('/dashboard', function() {
    return view('dashboard');
})->name('dashboard');

// Halaman produk kategori (gunakan yang sudah ada)
Route::get('/t-shirt', function() {
    return view('t-shirt');
})->name('t-shirt');

Route::get('/shirt', function() {
    return view('shirt');
})->name('shirt');

Route::get('/jacket-sweater', function() {
    return view('jacket-sweater');
})->name('jacket-sweater');

// Halaman bantuan & kontak (gunakan yang sudah ada)
Route::get('/contact-us', function() {
    return view('contact-us');
})->name('contact-us');

Route::get('/help', function() {
    return view('help');
})->name('help');

// Halaman khusus login user (sementara redirect)
Route::get('/order-status', function() {
    if (!session()->has('is_logged_in')) {
        return redirect()->route('login')
            ->with('info', 'Silakan login untuk melihat status order');
    }
    return view('order-status');
})->name('order-status');

Route::get('/cart', function() {
    if (!session()->has('is_logged_in')) {
        return redirect()->route('login')
            ->with('info', 'Silakan login untuk mengakses cart');
    }
    return view('cart');
})->name('cart');

// ===========================================
// 2. ROUTE AUTH (LOGIN/REGISTER/LOGOUT)
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
// 3. ROUTE ADMIN (HANYA UNTUK ADMIN)
// ===========================================

// Group untuk admin routes
Route::prefix('admin')->group(function () {
    // Dashboard admin
    Route::get('/dashboard', function() {
        if (!session()->has('is_logged_in') || session('user_role') != 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }
        return view('admin.beranda_admin'); // Menggunakan yang sudah ada
    })->name('admin.dashboard');
    
    // Produk admin
    Route::get('/products', function() {
        if (!session()->has('is_logged_in') || session('user_role') != 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }
        return view('admin.produk_admin'); // Menggunakan yang sudah ada
    })->name('admin.products');
    
    Route::get('/products/create', function() {
        if (!session()->has('is_logged_in') || session('user_role') != 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }
        return view('admin.tambah_produk'); // Menggunakan yang sudah ada
    })->name('admin.products.create');
    
    Route::get('/products/{id}/edit', function($id) {
        if (!session()->has('is_logged_in') || session('user_role') != 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }
        return view('admin.edit_produk', ['id' => $id]); // Menggunakan yang sudah ada
    })->name('admin.products.edit');
    
    // Pesanan admin
    Route::get('/orders', function() {
        if (!session()->has('is_logged_in') || session('user_role') != 'admin') {
            return redirect()->route('login')->with('error', 'Akses ditolak!');
        }
        return view('admin.pesanan_admin'); // Menggunakan yang sudah ada
    })->name('admin.orders');
});

// ===========================================
// 4. ROUTE USER (HANYA UNTUK YANG LOGIN)
// ===========================================

// Profile user
Route::get('/profile', function() {
    if (!session()->has('is_logged_in')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }
    // Buat file baru: resources/views/user/profile.blade.php
    return view('user.profile');
})->name('profile');

// My orders user
Route::get('/my-orders', function() {
    if (!session()->has('is_logged_in')) {
        return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu');
    }
    // Buat file baru: resources/views/user/orders.blade.php
    return view('user.orders');
})->name('my-orders');