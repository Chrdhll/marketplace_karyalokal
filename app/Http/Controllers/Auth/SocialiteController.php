<?php

// app/Http/Controllers/Auth/SocialiteController.php
namespace App\Http\Controllers\Auth;


use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash; 
use Illuminate\Support\Facades\Log;   
use Illuminate\Support\Str; 
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

            // Langkah 1: Cari user berdasarkan EMAIL, bukan google_id
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Cukup update google_id-nya jika masih kosong, lalu simpan.
                // Tidak ada update password atau data lain yang berisiko.
                if (!$user->google_id) {
                    $user->google_id = $googleUser->getId();
                    $user->save();
                }

                // Langkah 2B: Jika user BELUM ADA
            } else {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'role' => 'client', // Role default untuk pendaftar baru via Google
                    'email_verified_at' => now(),
                    'password' => Hash::make(Str::random(24))
                ]);
            }

            // Langkah 3: Login-kan user dan arahkan ke dashboard
            Auth::login($user);
            return redirect()->intended('/');
        } catch (\Exception $e) {
            // Jika ada error, catat errornya (opsional) dan redirect
            Log::error($e->getMessage());
            return redirect('/login')->with('error', 'Login dengan Google gagal, silakan coba lagi.');
        }
    }
}
