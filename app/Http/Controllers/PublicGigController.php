<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Gig;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicGigController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount(['gigs' => function ($query) {
            // Cari Gigs yang pemiliknya (user) memiliki profil freelancer yang sudah di-approve
            $query->whereHas('user', function ($userQuery) {
                $userQuery->whereHas('freelancerProfile', function ($profileQuery) {
                    $profileQuery->where('profile_status', 'approved');
                });
            });
        }])->get();

        // 2. Ambil kategori yang sedang aktif (jika ada)
        // $activeCategory = $request->category ? Category::where('slug', $request->category)->first() : null;
        $activeCategory = null;
        if ($request->has('category')) {
            // Hanya isi jika ada request kategori
            $activeCategory = Category::where('slug', $request->category)->first();
            // if ($activeCategory) {
            //     $gigsQuery->where('category_id', $activeCategory->id);
        }



        $gigsQuery = Gig::query()->whereHas('user', function ($userQuery) {
            $userQuery->whereHas('freelancerProfile', function ($profileQuery) {
                $profileQuery->where('profile_status', 'approved');
            });
        });


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

        if ($request->filled('q')) {
            $searchQuery = $request->q;
            $gigsQuery->where(function ($query) use ($searchQuery) {
                $query->where('title', 'like', "%{$searchQuery}%") // Cari di judul Gig
                      ->orWhere('description', 'like', "%{$searchQuery}%") // Cari di deskripsi Gig
                      ->orWhereHas('category', function ($q) use ($searchQuery) {
                          $q->where('name', 'like', "%{$searchQuery}%"); // Cari di nama Kategori
                      })
                      ->orWhereHas('user', function ($q) use ($searchQuery) {
                          $q->where('name', 'like', "%{$searchQuery}%"); // Cari di nama Freelancer
                      });
            });
        }

        // 6. Eksekusi query dengan paginasi
        $gigs = $gigsQuery->paginate(9);

        return view('public.gigs.index', compact('gigs', 'categories', 'activeCategory'));
    }

    public function show(Gig $gig)
    {
        $freelancer = $gig->user;

        if (!$freelancer->freelancerProfile || $freelancer->freelancerProfile->profile_status !== 'approved') {
            abort(404);
        }

        $reviews = $gig->reviews()->with('client')->latest()->paginate(5);

        $canReview = false;
        $orderToReview = null;
        if (Auth::check()) {
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

        $pendingOrder = null;
        if (Auth::check()) {
            $pendingOrder = Order::where('client_id', Auth::id())
                                 ->where('gig_id', $gig->id)
                                 ->where('status', 'pending')
                                 ->first();
        }

        return view('public.gigs.show', compact('gig', 'reviews', 'canReview', 'orderToReview', 'pendingOrder'));
    }
}
