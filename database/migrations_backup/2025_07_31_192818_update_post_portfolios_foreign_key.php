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
        Schema::table('post_portfolios', function (Blueprint $table) {
            // Önce mevcut foreign key'i kaldır
            $table->dropForeign(['post_id']);
            
            // Yeni foreign key'i posts_optimized tablosuna ekle
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_portfolios', function (Blueprint $table) {
            // Foreign key'i kaldır
            $table->dropForeign(['post_id']);
            
            // Eski foreign key'i geri ekle
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
};
