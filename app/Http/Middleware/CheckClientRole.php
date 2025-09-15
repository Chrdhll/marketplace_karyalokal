<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckClientRole
{
    public function handle(Request $request, Closure $next): Response
    {
        if (Auth::check() && Auth::user()->role === 'client') {
            return $next($request);
        }
        return redirect('/')->with('error', 'Hanya klien yang dapat membuat pesanan.');
    }
}