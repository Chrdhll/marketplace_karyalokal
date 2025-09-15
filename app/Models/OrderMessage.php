<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderMessage extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'user_id', 'message'];

    // Setiap pesan dimiliki oleh satu User (pengirim)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Setiap pesan masuk dalam satu Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
