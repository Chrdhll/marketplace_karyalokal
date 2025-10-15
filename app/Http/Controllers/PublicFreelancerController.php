<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // <-- Jangan lupa import DB

class PublicFreelancerController extends Controller
{
    /**
     * Menampilkan halaman profil publik untuk satu freelancer.
     */
    public function show(User $user)
    {
        // Keamanan: Pastikan yang diakses adalah freelancer yang sudah approved.
        if (!$user->freelancerProfile || $user->freelancerProfile->profile_status !== 'approved') {
            abort(404);
        }

        // Ambil semua gigs milik user ini, dengan paginasi
       $gigs = $user->gigs()->latest()->paginate(5);

        // Ambil 4 gigs terpopuler milik user ini (untuk sidebar)
        $popularGigs = $user->gigs()->orderBy('review_count', 'desc')->take(4)->get();
        
        // Ambil daftar kategori unik yang ditawarkan oleh user ini (untuk sidebar)
        $categories = $user->gigs()
            ->join('categories', 'gigs.category_id', '=', 'categories.id')
            ->select('categories.name', 'categories.slug', DB::raw('count(*) as total'))
            ->groupBy('categories.id', 'categories.name', 'categories.slug')
            ->orderBy('total', 'desc')
            ->get();

        // Kirim semua data yang dibutuhkan ke view
        return view('public.freelancer.show', compact('user', 'gigs', 'popularGigs', 'categories'));
    }
}