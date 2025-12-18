<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;      // Untuk query database
use Illuminate\Support\Facades\Hash;    // Untuk hash password
use Illuminate\Support\Facades\Session; // Untuk session

class AuthController extends Controller
{
    // ===========================================
    // 1. HALAMAN LOGIN (GET)
    // ===========================================
    public function showLoginPage()
    {
        // Cek jika user sudah login
        if (Session::has('user_id')) {
            // Jika sudah login, langsung redirect ke dashboard
            return $this->redirectToDashboard();
        }
        
        // Jika belum login, tampilkan halaman login
        return view('auth.login');
    }
    
    // ===========================================
    // 2. PROSES LOGIN (POST)
    // ===========================================
    public function processLogin(Request $request)
    {
    // 1. Ambil data dari form
    $email = $request->input('email');
    $password = $request->input('password');
    
    // 2. Cari user di database
    $user = DB::table('users')
            ->where('email', $email)
            ->first();
    
    // 3. Cek user dan password
    if (!$user) {
        return back()->with('error', 'Email tidak ditemukan!');
    }
    
    if (!Hash::check($password, $user->password)) {
        return back()->with('error', 'Password salah!');
    }
    
    // 4. Simpan session
    Session::put('user_id', $user->id);
    Session::put('user_name', $user->name);
    Session::put('user_email', $user->email);
    Session::put('user_role', $user->role);
    Session::put('is_logged_in', true);
    
    // 5. Redirect berdasarkan role
    if ($user->role == 'admin') {
        return redirect('/admin/dashboard');
    } else {
        return redirect('/dashboard');
    }
    }
    
    // ===========================================
    // 3. HALAMAN REGISTER (GET)
    // ===========================================
    public function showRegisterPage()
    {
        // Cek jika sudah login
        if (Session::has('user_id')) {
            return $this->redirectToDashboard();
        }
        
        // Tampilkan halaman register
        return view('auth.register');
    }
    
    // ===========================================
    // 4. PROSES REGISTER (POST)
    // ===========================================
   public function processRegister(Request $request)
    {
    // 1. Ambil data dari form
    $name = $request->input('name');
    $email = $request->input('email');
    $password = $request->input('password');
    $confirm_password = $request->input('password_confirmation');
    
    // 2. Validasi sederhana
    if (empty($name) || empty($email) || empty($password)) {
        return back()->with('error', 'Semua field harus diisi!');
    }
    
    if ($password !== $confirm_password) {
        return back()->with('error', 'Password tidak sama!');
    }
    
    // 3. Cek email sudah terdaftar
    $existingUser = DB::table('users')->where('email', $email)->first();
    if ($existingUser) {
        return back()->with('error', 'Email sudah terdaftar!');
    }
    
    // 4. Hash password
    $hashedPassword = Hash::make($password);
    
    // 5. Simpan ke database
    try {
        DB::table('users')->insert([
            'name' => $name,
            'email' => $email,
            'password' => $hashedPassword,
            'role' => 'user',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        
        // 6. Redirect ke login dengan pesan sukses
        return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
        
    } catch (\Exception $e) {
        // 7. Jika error, tampilkan pesan
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
    }
    
    // ===========================================
    // 5. HALAMAN DASHBOARD USER (GET)
    // ===========================================
    public function showUserDashboard()
    {
        // // Cek apakah user sudah login
        // if (!Session::has('is_logged_in')) {
        //     return redirect('/login')->with('error', 'Silakan login dulu!');
        // }
        
        // Cek apakah user adalah admin (jika admin, redirect ke admin panel)
        if (Session::get('user_role') == 'admin') {
            return redirect('/admin/dashboard');
        }
        
        // Tampilkan dashboard user
        return view('dashboard');
    }
    
    // ===========================================
    // 6. HALAMAN DASHBOARD ADMIN (GET)
    // ===========================================
    public function showAdminDashboard()
    {
        // Cek apakah user sudah login
        if (!Session::has('is_logged_in')) {
            return redirect('/login')->with('error', 'Silakan login dulu!');
        }
        
        // Cek apakah user adalah admin
        if (Session::get('user_role') != 'admin') {
            return redirect('/dashboard')->with('error', 'Hanya admin yang bisa akses!');
        }
        
        // Tampilkan dashboard admin
        return view('admin.dashboard');
    }
    
    // ===========================================
    // 7. PROSES LOGOUT (GET)
    // ===========================================
    public function processLogout()
    {
        // Hapus semua session user
        Session::flush();
        
        // Redirect ke halaman login
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
    
    // ===========================================
    // 8. FUNGSI BANTU: REDIRECT BERDASARKAN ROLE
    // ===========================================
    private function redirectToDashboard()
    {
        // Ambil role dari session
        $role = Session::get('user_role');
        
        // Redirect berdasarkan role
        if ($role == 'admin') {
            return redirect('/admin/dashboard');
        } else {
            return redirect('/dashboard');
        }
    }
}