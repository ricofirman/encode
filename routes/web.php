<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

// ===========================================
// ROUTE UNTUK HALAMAN
// ===========================================

// 1. Halaman Login (tampilkan form)
Route::get('/login', [AuthController::class, 'showLoginPage']);

// 2. Halaman Register (tampilkan form)
Route::get('/register', [AuthController::class, 'showRegisterPage']);

// 3. Halaman Dashboard User
Route::get('/dashboard', [AuthController::class, 'showUserDashboard']);

// 4. Halaman Dashboard Admin
Route::get('/admin/dashboard', [AuthController::class, 'showAdminDashboard']);

// 5. Halaman Logout
Route::get('/logout', [AuthController::class, 'processLogout']);

// ===========================================
// ROUTE UNTUK PROSES FORM (POST)
// ===========================================

// 6. Proses Login (terima data dari form)
Route::post('/login', [AuthController::class, 'processLogin']);

// 7. Proses Register (terima data dari form)
Route::post('/register', [AuthController::class, 'processRegister']);

// ===========================================
// ROUTE HOME (redirect ke login)
// ===========================================
Route::get('/', function () {
    return redirect('/login');
});



// ====== PUBLIC ROUTES ======
Route::get('/', function() {
    return view('home'); // Public homepage
});

Route::get('/products', function() {
    return view('products.public'); // Public product list
});

Route::get('/product/{id}', function($id) {
    return view('products.detail', ['id' => $id]);
});

// ====== AUTH ROUTES ======
Route::get('/login', [AuthController::class, 'showLoginPage']);
Route::post('/login', [AuthController::class, 'processLogin']);
Route::get('/register', [AuthController::class, 'showRegisterPage']);
Route::post('/register', [AuthController::class, 'processRegister']);
Route::get('/logout', [AuthController::class, 'processLogout']);

// ====== PROTECTED ROUTES ======
