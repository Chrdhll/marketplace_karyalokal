<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User; // <-- Import User
use Illuminate\Support\Facades\Hash; // <-- Import Hash

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'username' => 'admin', // <-- Pastikan username unik
            'email' => 'admin@karyalokal.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'), // <-- Ganti dengan password yang aman
            'role' => 'admin',
        ]);
    }
}