<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'icon'];

    // Satu kategori bisa memiliki banyak Gigs
    public function gigs()
    {
        return $this->hasMany(Gig::class);
    }
}
