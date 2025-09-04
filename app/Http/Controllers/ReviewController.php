<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, Order $order)
    {
        // Keamanan
        if ($order->client_id !== Auth::id() || $order->status !== 'completed' || $order->review) {
            abort(403);
        }

        $validated = $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:2000',
        ]);

        Review::create([
            'order_id' => $order->id,
            'gig_id' => $order->gig_id,
            'client_id' => $order->client_id,
            'freelancer_id' => $order->freelancer_id,
            'rating' => $validated['rating'],
            'comment' => $validated['comment'],
        ]);

        return back()->with('success', 'Terima kasih atas ulasan Anda!');
    }
}
