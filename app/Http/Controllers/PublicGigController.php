<?php

namespace App\Http\Controllers;

use App\Models\Gig;
use Illuminate\Http\Request;

class PublicGigController extends Controller
{
    public function show(Gig $gig)
    {
        if ($gig->user->role !== 'freelancer' || $gig->user->profile_status !== 'approved') {
            abort(404);
        }

        $reviews = $gig->reviews()->latest()->paginate(5);

        return view('public.gigs.show', compact('gig','reviews'));
    }
}
