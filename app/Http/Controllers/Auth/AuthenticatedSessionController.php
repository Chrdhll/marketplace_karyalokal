<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // public function store(LoginRequest $request): RedirectResponse
    // {
    //     $request->authenticate();

    //     session()->regenerate();

    //     $user = Auth::user();

    //     if ($user->role == 'admin') {
    //         return redirect('/admin'); // Arahkan admin ke panel Filament
    //     }

    //     if ($user->role == 'freelancer') {
    //         return redirect()->route('freelancer.dashboard'); // Arahkan freelancer ke dashboard baru
    //     }

    //     return redirect()->intended(route('index', absolute: false));
    // }

    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        session()->regenerate(); // <-- INI PERBAIKANNYA

        $user = Auth::user();

        if ($user->role == 'admin') {
            return redirect()->intended('/admin'); // Arahkan admin ke panel Filament
        }

        if ($user->role == 'freelancer') {
            return redirect()->intended(route('freelancer.dashboard')); // Arahkan freelancer ke dashboard baru
        }

        // Jika bukan keduanya (berarti client), arahkan ke tujuan default
        return redirect()->intended(route('index', absolute: false));
    }
    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
