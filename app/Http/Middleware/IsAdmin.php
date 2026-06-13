<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        // Pastikan user sudah login sama memiliki role admin
        if (Auth::check() && Auth::user()->role === 'admin') {
            return $next($request); // Silakan lewat
        }

        // Jika bukan admin, kick ke dashboard
        return redirect()->route('dashboard')->with('error', 'Akses ditolak! Anda tidak memiliki izin untuk masuk ke area Administrator.');
    }
}
