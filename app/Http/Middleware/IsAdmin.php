<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini di-import
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 1. Cek apakah user sudah login DAN rolenya adalah '1' (Admin)
        if (Auth::check() && Auth::user()->role == 1) {
            // 2. Jika ya, izinkan user melanjutkan ke request berikutnya (halaman admin)
            return $next($request);
        }

        // 3. Jika tidak (user biasa atau tamu), tendang mereka ke homepage
        return redirect()->route('home');
    }
}
