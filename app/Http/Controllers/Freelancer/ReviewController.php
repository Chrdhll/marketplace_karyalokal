<?php
namespace App\Http\Controllers\Freelancer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        // Ambil semua ulasan yang diterima oleh freelancer
        $reviews = $user->reviewsReceived()->with('client', 'gig')->latest()->paginate(10);
        return view('freelancer.reviews.index', compact('reviews'));
    }
}