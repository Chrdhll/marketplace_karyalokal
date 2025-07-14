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
        Schema::create('gigs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('service');
            $table->string('title');
            $table->text('description');
            $table->decimal('price', 10, 0);
            $table->string('cover_image_path');
            $table->string('estimated_time');
            $table->decimal('rating_average', 2, 1)->nullable(); // Misal: 4.5
            $table->unsignedInteger('review_count')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gigs');
    }
};
