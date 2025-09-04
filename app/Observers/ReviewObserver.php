<?php
namespace App\Observers;
use App\Models\Review;

class ReviewObserver
{
    public function created(Review $review)
    {
        $gig = $review->gig;
        $freelancer = $review->freelancer;

        // Update statistik di tabel Gigs
        $gig->rating_average = $gig->reviews()->avg('rating');
        $gig->review_count = $gig->reviews()->count();
        $gig->save();

        // Update statistik di tabel Users (Freelancer)
        $freelancer->rating_average = $freelancer->reviewsReceived()->avg('rating');
        $freelancer->review_count = $freelancer->reviewsReceived()->count();
        $freelancer->save();
    }
}