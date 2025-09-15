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
    public function toggle(Gig $gig)
    {
        // Hanya klien yang bisa punya wishlist
        if (Auth::user()->role !== 'client') {
            return back()->with('error', 'Hanya klien yang bisa menambahkan ke wishlist.');
        }

        // Perintah ajaib 'toggle' dari Laravel untuk relasi many-to-many
        Auth::user()->wishlistedGigs()->toggle($gig->id);

        return back();
    }
}
