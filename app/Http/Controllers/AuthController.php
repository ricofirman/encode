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
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email dan password harus diisi!'
                ], 422);
            }
            return back()->with('error', 'Email dan password harus diisi!');
        }
        
        // Cari user di database
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
        
        if ($request->ajax() || $request->wantsJson()) {
            return response()->json([
                'success' => true,
                'message' => 'Login berhasil!',
                'redirect' => '/'
            ]);
        }
        
        return redirect('/')->with('success', 'Login berhasil!');
    }
    
    /**
     * Tampilkan halaman register
     */
    public function showRegisterPage()
    {
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
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Semua field harus diisi!'
                ], 422);
            }
            return back()->with('error', 'Semua field harus diisi!');
        }
        
        if ($password !== $confirm_password) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password tidak sama!'
                ], 422);
            }
            return back()->with('error', 'Password tidak sama!');
        }
        
        if (strlen($password) < 6) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Password minimal 6 karakter!'
                ], 422);
            }
            return back()->with('error', 'Password minimal 6 karakter!');
        }
        
        // Cek email sudah terdaftar di database
        if (User::where('email', $email)->exists()) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Email sudah terdaftar!'
                ], 422);
            }
            return back()->with('error', 'Email sudah terdaftar!');
        }
        
        // Buat user baru dengan fungsi create (CRUD)
        try {
            User::create([
                'name' => $name,
                'email' => $email,
                'password' => Hash::make($password),
                'role' => 'user',
            ]);
            
            // Untuk AJAX request
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Registrasi berhasil! Silakan login.'
                ]);
            }
            
            // Untuk normal request
            return redirect('/login')->with('success', 'Registrasi berhasil! Silakan login.');
            
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan: ' . $e->getMessage()
                ], 500);
            }
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