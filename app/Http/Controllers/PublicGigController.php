<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PublicGigController extends Controller
{
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
