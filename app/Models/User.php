<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Notifications\CustomVerifyEmail;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'name',
        'username',
        'email',
        'password',
        'role',
        'profile_picture_path',
        'google_id',
        'email_verified_at',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // Relasi sebagai Freelancer
    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }

    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }

    // Relasi sebagai Klien
    public function ordersAsClient()
    {
        return $this->hasMany(Order::class, 'client_id');
    }

    /**
     * Relasi untuk mengambil pesanan di mana user ini adalah FREELANCER.
     * Ini yang menyebabkan error.
     */
    public function ordersAsFreelancer()
    {
        return $this->hasMany(Order::class, 'freelancer_id');
    }

    // Relasi untuk Ulasan
    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }

    // Satu user bisa mengirim banyak pesan
    public function orderMessages()
    {
        return $this->hasMany(OrderMessage::class);
    }

    // Satu user bisa punya banyak Gigs di wishlist-nya
    public function wishlistedGigs()
    {
        return $this->belongsToMany(Gig::class, 'gig_user');
    }

    public function isApprovedFreelancer(): bool
    {
        return $this->freelancerProfile && $this->freelancerProfile->profile_status === 'approved';
    }

    public function freelancerProfile()
    {
        return $this->hasOne(FreelancerProfile::class, 'user_id');
    }

// User bisa punya banyak riwayat penarikan
public function withdrawals() { return $this->hasMany(Withdrawal::class); }
}
