<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Gig;

class SearchController extends Controller
{
    public function index(Request $request)
    {
        $query = $request->input('q');

        // Cari di tabel Gigs (berdasarkan judul atau service)
        $gigs = Gig::whereHas('user', function($q) {
            $q->where('profile_status', 'approved');
        })->where(function($q) use ($query) {
            $q->where('title', 'like', "%{$query}%")
              ->orWhere('category', 'like', "%{$query}%");
        })->get();

        // Cari di tabel Users (berdasarkan nama atau headline freelancer)
        $freelancers = User::where('role', 'freelancer')
            ->where('profile_status', 'approved')
            ->where(function($q) use ($query) {
                $q->where('name', 'like', "%{$query}%")
                  ->orWhere('headline', 'like', "%{$query}%");
            })->get();

        // Kirim hasil pencarian ke view
        return view('search-results', compact('gigs', 'freelancers', 'query'));
    }
}