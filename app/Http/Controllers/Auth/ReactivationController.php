<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReactivationController extends Controller
{
    public function showNotice(Request $request)
    {
        $email = session('email') ?? $request->query('email');
       if (!$email) {
        return redirect('/login');
        }
    return view('auth.reactivate', ['email' => $email]);
    }

    public function reactivate(Request $request)
    {
        $user = User::withTrashed()->where('email', $request->email)->first();

        if ($user && $user->trashed()) {
            $user->restore();
            Auth::login($user);
            return redirect()->route('index')->with('success', 'Selamat datang kembali! Akun Anda telah berhasil dipulihkan.');
        }

        return redirect('/login')->with('error', 'Gagal memulihkan akun.');
    }
}