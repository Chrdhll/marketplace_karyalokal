<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'gig_id',
        'client_id',
        'freelancer_id',
        'total_price',
        'status',
        'midtrans_transaction_id',
        'delivered_file_path',
        'delivery_notes',
    ];

    public function gig()
    {
        return $this->belongsTo(Gig::class);
    }

    public function client()
    {
        return $this->belongsTo(User::class, 'client_id');
    }

    public function freelancer()
    {
        return $this->belongsTo(User::class, 'freelancer_id');
    }

    public function review()
    {
        return $this->hasOne(Review::class);
    }

    // Satu pesanan bisa punya banyak pesan
    public function messages()
    {
        return $this->hasMany(OrderMessage::class);
    }
}
