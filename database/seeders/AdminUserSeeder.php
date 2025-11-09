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
            'username' => 'admin',
            'email' => 'admin@karyalokal.com',
            'email_verified_at' => now(),
            'password' => Hash::make('12345'),
            'role' => 'admin',
        ]);



        User::create([
            'name' => 'Rizky Pratama',
            'username' => 'rizky',
            'email' => 'rizkypratama@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'client',
        ]);

        User::create([
            'name' => 'Nadia Salsabila',
            'username' => 'nadia_s',
            'email' => 'nadiasalsabila@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'client',
        ]);

        User::create([
            'name' => 'Arif Wijaya',
            'username' => 'arif wijaya',
            'email' => 'arifwijaya@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password123'),
            'role' => 'client',
        ]);
    }
}
