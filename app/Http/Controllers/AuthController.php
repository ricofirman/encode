<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;

class AuthController extends Controller
{
    /**
     * Tampilkan halaman login
     */
    public function showLoginPage()
    {
        // Jika sudah login, redirect ke home
        if (Session::has('is_logged_in')) {
            return redirect('/');
        }
        
        return view('auth.login');
    }
    
    /**
     * Proses login user
     */
    public function processLogin(Request $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');
        
        // Validasi input
        if (empty($email) || empty($password)) {
            // Jika AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email dan password harus diisi!'
                ], 422);
            }
            return back()->with('error', 'Email dan password harus diisi!');
        }
        
        // Cari user dengan Model
        $user = User::where('email', $email)->first();
        
        // Cek jika email tidak ditemukan
        if (!$user) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email tidak ditemukan!'
                ], 401);
            }
            return back()->with('error', 'Email tidak ditemukan!');
        }
        
        // Cek password
        if (!Hash::check($password, $user->password)) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password salah!'
                ], 401);
            }
            return back()->with('error', 'Password salah!');
        }
        
        // Login berhasil
        Session::put('user_id', $user->id);
        Session::put('user_name', $user->name);
        Session::put('user_email', $user->email);
        Session::put('user_role', $user->role);
        Session::put('is_logged_in', true);
        
        // Redirect ke HOME PAGE (/) bukan dashboard
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => '/'  // Redirect ke home
            ]);
        }
        
        return redirect('/')->with('success', 'Login berhasil!');
    }
    
    /**
     * Tampilkan halaman register
     */
    public function showRegisterPage()
    {
        // Jika sudah login, redirect ke home
        if (Session::has('is_logged_in')) {
            return redirect('/');
        }
        
        return view('auth.register');
    }
    
    /**
     * Proses register user baru
     */
    public function processRegister(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $confirm_password = $request->input('password_confirmation');
        
        // Validasi
        if (empty($name) || empty($email) || empty($password)) {
            return back()->with('error', 'Semua field harus diisi!');
        }
        
        if ($password !== $confirm_password) {
            return back()->with('error', 'Password tidak sama!');
        }
        
        if (strlen($password) < 6) {
            return back()->with('error', 'Password minimal 6 karakter!');
        }
        
        // Cek email sudah terdaftar
        if (User::where('email', $email)->exists()) {
            return back()->with('error', 'Email sudah terdaftar!');
        }
        
        // Buat user baru
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'user',
            ]);
            
            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
            
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    
    /**
     * Logout user
     */
    public function processLogout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'Logout berhasil!');
    }
}