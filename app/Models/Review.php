<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'client_id',
        'freelancer_id',
        'gig_id',
        'rating',
        'comment',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

}
