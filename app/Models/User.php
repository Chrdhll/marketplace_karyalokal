<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'google_id',
        'profile_status',
        'profile_picture_path',
        'headline',
        'bio',
        'portfolio',
        'cv_file_path',
        'location',
        'company_name',
        'rating_average',
        'review_count',
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

    // Relasi untuk Ulasan
    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'client_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'freelancer_id');
    }
}
