<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckApprovedFreelancer
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Cek jika user sudah login, rolenya freelancer, DAN statusnya approved
         if (Auth::check() && Auth::user()->isApprovedFreelancer()) {
        return $next($request);
    }

        // Jika tidak, tendang kembali ke halaman profil dengan pesan error
        return redirect()->route('freelancer.profil.edit')
                         ->with('error', 'Profil Anda harus disetujui oleh admin sebelum dapat mengelola jasa.');
    }
}