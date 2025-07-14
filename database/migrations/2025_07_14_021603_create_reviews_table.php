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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();

            $table->foreignId('order_id')->unique()->constrained()->onDelete('cascade'); // unique() karena 1 order cuma boleh ada 1 review
            $table->foreignId('client_id')->constrained('users'); // User yang memberi review
            $table->foreignId('freelancer_id')->constrained('users'); // User yang di-review
            $table->foreignId('gig_id')->constrained(); // Gig yang di-review

            $table->unsignedTinyInteger('rating'); // Untuk bintang 1-5, lebih efisien dari integer biasa
            $table->text('comment')->nullable(); // Komentar dari klien, boleh kosong

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
