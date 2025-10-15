<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistedGigs = Auth::user()->wishlistedGigs()->latest()->paginate(12);

        return view('wishlist.index', compact('wishlistedGigs'));
    }
   public function toggle(Request $request, Gig $gig)
    {
        $user = Auth::user();

        // 1. Keamanan: Pengguna tidak bisa wishlist Gigs miliknya sendiri.
        if ($gig->user_id === $user->id) {
            $errorMessage = 'Anda tidak bisa menambahkan jasa Anda sendiri ke wishlist.';
            if ($request->expectsJson()) {
                return response()->json(['message' => $errorMessage], 403);
            }
            return back()->with('error', $errorMessage);
        }

        // 2. Lakukan aksi toggle (tambah/hapus)
        $result = $user->wishlistedGigs()->toggle($gig->id);

        // 3. Siapkan pesan balasan yang dinamis
        $attached = count($result['attached']) > 0;
        $message = $attached ? 'Berhasil ditambahkan ke wishlist!' : 'Berhasil dihapus dari wishlist.';

        // 4. Kirim balasan yang sesuai
        if ($request->expectsJson()) {
            // Jika request datang dari script AJAX kita, kirim balasan JSON
            return response()->json([
                'attached' => $attached,
                'message' => $message,
            ]);
        }

        // Fallback jika JavaScript gagal, redirect dengan pesan
        return back()->with('success', $message);
    }
}
