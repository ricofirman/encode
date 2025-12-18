<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;

class CheckAuth
{
        public function handle($request, Closure $next, $role = null)
    {
        // Cek jika user belum login
        if (!Session::has('is_logged_in')) {
            return $next($request);
        }
        
        // Cek role jika diperlukan
        if ($role && Session::get('user_role') != $role) {
            return redirect('/dashboard')->with('error', 'Akses ditolak!');
        }
        
        return $next($request);
        
    }
}
