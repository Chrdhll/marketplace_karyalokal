<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckCanOrder
{
    // app/Http/Middleware/CheckCanOrder.php
    public function handle(Request $request, Closure $next): Response
    {
        // Izinkan akses jika user sudah login DAN rolenya BUKAN 'admin'
        if (Auth::check() && Auth::user()->role !== 'admin') {
            return $next($request);
        }
        // Jika admin atau belum login, tendang
        return redirect('/')->with('error', 'Anda tidak memiliki izin untuk membuat pesanan.');
    }
}
