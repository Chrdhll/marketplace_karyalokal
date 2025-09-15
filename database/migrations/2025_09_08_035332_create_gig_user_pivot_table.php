<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gig_user', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // ID Klien
            $table->foreignId('gig_id')->constrained()->onDelete('cascade'); // ID Gig yang disukai
            $table->timestamps();

            // Pastikan satu user hanya bisa wishlist satu gig sekali
            $table->unique(['user_id', 'gig_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gig_user_pivot');
    }
};
