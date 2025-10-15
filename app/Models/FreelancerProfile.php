<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class FreelancerProfile extends Model
{
    use HasFactory;
    protected $fillable = [
        'id',
        'user_id',
        'headline',
        'bio',
        'portfolio',
        'cv_file_path',
        'location',
        'company_name',
        'keahlian',
        'profile_status',
        'rating_average',
        'review_count',
        'balance'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
