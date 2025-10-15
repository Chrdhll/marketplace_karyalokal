<?php

namespace App\Http\Controllers;


use App\Models\Gig; 
use App\Models\User;
use App\Models\Review;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // 1. Ambil 8 freelancer acak yang sudah disetujui untuk ditampilkan
        $freelancers = User::where('role', 'freelancer')
           ->whereHas('freelancerProfile', function ($query) {
                       $query->where('profile_status', 'approved');
                   }) 
            ->inRandomOrder() // Ambil secara acak agar tampilan selalu segar
            ->take(8)         // Batasi hanya 8 freelancer
            ->get();

            // dd($freelancers); 
        // 2. Ambil beberapa ulasan terbaru untuk ditampilkan (opsional, bisa ditambahkan nanti)
        // $reviews = Review::latest()->take(5)->get();

         // 2. TAMBAHKAN INI: Ambil 8 gigs terbaru dari freelancer yang sudah disetujui
        $gigs = Gig::whereHas('user', function($query) {
            $query->whereHas('freelancerProfile', function ($profileQuery) {
                $profileQuery->where('profile_status', 'approved');
            });
        })->inRandomOrder()->take(9)->get();

         $reviews = Review::where('rating', '>=', 4) // Hanya ambil ulasan bintang 4 & 5
                         ->with(['client', 'gig']) // Eager loading untuk data klien & gig
                         ->inRandomOrder()
                         ->take(5)
                         ->get();


        return view('dashboard', compact('freelancers', 'gigs', 'reviews'));
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function singleProduct()
    {
        return view('client.single-product');
    }


    public function category()
    {
        return view('client.category');
    }

    public function confirmation()
    {
        return view('client.confirmation');
    }

    public function contactProccess()
    {
        return view('client.contact_proccess');
    }
}
