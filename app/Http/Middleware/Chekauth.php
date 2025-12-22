<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CheckAuth
{
    public function handle(Request $request, Closure $next)
    {
        // URLs yang boleh diakses tanpa login
        $publicRoutes = ['/', '/login', '/register', '/products', '/product/*'];
        
        // Cek apakah route saat ini adalah public
        $currentRoute = $request->path();
        $isPublicRoute = false;
        
        foreach ($publicRoutes as $route) {
            if (str_contains($route, '*')) {
                $pattern = str_replace('*', '.*', $route);
                if (preg_match('#^' . $pattern . '$#', $currentRoute)) {
                    $isPublicRoute = true;
                    break;
                }
            } elseif ($route === $currentRoute) {
                $isPublicRoute = true;
                break;
            }
        }
        
        // Jika bukan public route DAN belum login, redirect ke login
        if (!$isPublicRoute && !Session::has('is_logged_in')) {
            // Tambahkan header untuk prevent browser cache
            $response = redirect('/login')->with('error', 'Please login first.');
            
            // HEADER UNTUK PREVENT BROWSER CACHE (PENTING!)
            return $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                           ->header('Pragma', 'no-cache')
                           ->header('Expires', '0');
        }
        
        $response = $next($request);
        
        // Tambahkan no-cache headers untuk semua protected pages
        if (!Session::has('is_logged_in')) {
            $response->header('Cache-Control', 'no-cache, no-store, must-revalidate')
                     ->header('Pragma', 'no-cache')
                     ->header('Expires', '0');
        }
        
        return $response;
    }
}