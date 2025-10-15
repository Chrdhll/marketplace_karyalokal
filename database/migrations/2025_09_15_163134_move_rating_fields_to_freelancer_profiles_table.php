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
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->decimal('rating_average', 2, 1)->nullable()->after('keahlian');
            $table->unsignedInteger('review_count')->default(0)->after('rating_average');
        });

        // Hapus kolom lama dari tabel users
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['rating_average', 'review_count']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('freelancer_profiles', function (Blueprint $table) {
            $table->dropColumn(['rating_average', 'review_count']);
        });
        Schema::table('users', function (Blueprint $table) {
            $table->decimal('rating_average', 2, 1)->nullable();
            $table->unsignedInteger('review_count')->default(0);
        });
    }
};
