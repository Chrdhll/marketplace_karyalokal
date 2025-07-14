<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gig extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'price',
        'category_id',
        'user_id',
        'cover_image_path',
        'estimated_time',
        'rating_average',
        'review_count'
    ];

     public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    
}
