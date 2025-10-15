<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;

use Illuminate\Support\Str;

     
class Order extends Model
{
    use HasFactory;

    protected function orderNumber(): Attribute
    {
        return Attribute::make(
            get: fn () => 'KL-' . str_pad($this->id, 6, '0', STR_PAD_LEFT),
        );
    }
    
    protected $fillable = [
        'gig_id',
        'client_id',
        'freelancer_id',
        'total_price',
        'status',
        'midtrans_transaction_id',
        'delivered_file_path',
        'delivery_notes',
        'platform_fee', 'freelancer_earning',
        'uuid'
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

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($order) {
            $order->uuid = (string) Str::uuid();
        });
    }
}
