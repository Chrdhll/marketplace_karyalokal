<?php

namespace App\Observers;

use App\Models\Review;

class ReviewObserver
{
    public function created(Review $review)
    {
        $gig = $review->gig;
        $freelancer = $review->freelancer;

        // Ambil profil freelancer yang terkait
        $profile = $freelancer->freelancerProfile;

        // Update statistik di tabel Gigs (ini tidak berubah)
        $gig->rating_average = $gig->reviews()->avg('rating');
        $gig->review_count = $gig->reviews()->count();
        $gig->save();

        // Update statistik di tabel freelancer_profiles
        if ($profile) {
            $profile->rating_average = $freelancer->reviewsReceived()->avg('rating');
            $profile->review_count = $freelancer->reviewsReceived()->count();
            $profile->save();
        }
    }
}
