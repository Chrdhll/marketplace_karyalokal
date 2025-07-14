<?php

// app/Http/Controllers/Auth/SocialiteController.php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialiteController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Buka file: app/Http/Controllers/Auth/SocialiteController.php

    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            // Cari user berdasarkan google_id. Jika tidak ada, buat instance baru (tapi jangan simpan dulu).
            $user = User::firstOrNew(['google_id' => $googleUser->getId()]);

            // Isi atau update data user
            $user->name = $googleUser->getName();
            $user->email = $googleUser->getEmail();

            // Jika ini user baru, set role default.
            if (!$user->exists) {
                $user->role = 'client';
            }

            // Kunci utamanya di sini:
            // Jika email user ini belum terverifikasi, langsung verifikasi sekarang.
            if (!$user->email_verified_at) {
                $user->email_verified_at = now();
            }

            // Simpan semua perubahan (baik untuk user baru maupun lama) ke database.
            $user->save();

            // Login-kan user.
            Auth::login($user);

            return redirect('/dashboard');
        } catch (\Exception $e) {
            // Jika ada error lain, redirect ke login
            return redirect('/login')->with('error', 'Login dengan Google gagal, silakan coba lagi.');
        }
    }
}
