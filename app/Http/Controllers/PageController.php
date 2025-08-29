<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        // 1. Ambil 8 freelancer acak yang sudah disetujui untuk ditampilkan
        $freelancers = User::where('role', 'freelancer')
            ->where('profile_status', 'approved')
            ->inRandomOrder() // Ambil secara acak agar tampilan selalu segar
            ->take(8)         // Batasi hanya 8 freelancer
            ->get();

            // dd($freelancers); 
        // 2. Ambil beberapa ulasan terbaru untuk ditampilkan (opsional, bisa ditambahkan nanti)
        // $reviews = Review::latest()->take(5)->get();

        return view('dashboard', [
            'freelancers' => $freelancers,
            // 'reviews' => $reviews,
        ]);
    }

    public function blog()
    {
        return view('client.blog');
    }

    public function singleProduct()
    {
        return view('client.single-product');
    }

    public function checkout()
    {
        return view('client.checkout');
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
