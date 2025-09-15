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
        Schema::table('gigs', function (Blueprint $table) {
            // 1. Tambahkan kolom baru untuk foreign key
            $table->foreignId('category_id')
                ->nullable()
                ->after('user_id')
                ->constrained('categories')
                ->onDelete('set null');

            // 2. Hapus kolom 'service' yang lama
            $table->dropColumn('service');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('gigs', function (Blueprint $table) {
            // Jika migration di-rollback, kembalikan seperti semula
            $table->string('service');
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};
