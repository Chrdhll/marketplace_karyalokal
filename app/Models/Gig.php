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
        'review_count',
        'slug',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }


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

    // Setiap Gig dimiliki oleh satu Kategori
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Satu Gig bisa di-wishlist oleh banyak User
    public function wishlistedByUsers()
    {
        return $this->belongsToMany(User::class, 'gig_user');
    }
}
