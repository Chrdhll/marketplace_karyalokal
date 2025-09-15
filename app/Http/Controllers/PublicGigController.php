<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicGigController extends Controller
{
    public function index(Request $request)
    {
        // 1. Ambil semua kategori beserta jumlah Gigs di dalamnya
        $categories = Category::withCount(['gigs' => function ($query) {
            $query->whereHas('user', function ($q) {
                $q->where('profile_status', 'approved');
            });
        }])->get();

        // 2. Ambil kategori yang sedang aktif (jika ada)
        $activeCategory = $request->category ? Category::where('slug', $request->category)->first() : null;

        // 3. Query dasar untuk mengambil Gigs
        $gigsQuery = Gig::whereHas('user', function ($query) {
            $query->where('role', 'freelancer')->where('profile_status', 'approved');
        });

        // 4. Terapkan filter kategori jika ada
        if ($activeCategory) {
            $gigsQuery->where('category_id', $activeCategory->id);
        }

        // 5. Terapkan sorting
        switch ($request->sort) {
            case 'price_asc':
                $gigsQuery->orderBy('price', 'asc');
                break;
            case 'price_desc':
                $gigsQuery->orderBy('price', 'desc');
                break;
            default:
                $gigsQuery->latest(); // Default: terbaru
        }

        // 6. Eksekusi query dengan paginasi
        $gigs = $gigsQuery->paginate(9);

        return view('public.gigs.index', compact('gigs', 'categories', 'activeCategory'));
    }

    public function show(Gig $gig)
    {
        if ($gig->user->role !== 'freelancer' || $gig->user->profile_status !== 'approved') {
            abort(404);
        }

        $reviews = $gig->reviews()->with('client')->latest()->paginate(5);

        $canReview = false;
        $orderToReview = null;
        if (Auth::check() && Auth::user()->role == 'client') {
            // Cari pesanan yang sudah selesai TAPI belum direview oleh user ini untuk gig ini
            $orderToReview = Order::where('client_id', Auth::id())
                ->where('gig_id', $gig->id)
                ->where('status', 'completed')
                ->whereDoesntHave('review') // Cek apakah order ini belum punya review
                ->first();

            if ($orderToReview) {
                $canReview = true;
            }
        }


        return view('public.gigs.show', compact('gig', 'reviews', 'canReview', 'orderToReview'));
    }
}
