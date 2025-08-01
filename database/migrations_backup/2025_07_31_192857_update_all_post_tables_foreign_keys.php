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
        // post_services tablosunu güncelle
        Schema::table('post_services', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
        });

        // post_auctions tablosunu güncelle
        Schema::table('post_auctions', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
        });

        // post_polls tablosunu güncelle
        Schema::table('post_polls', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // post_services tablosunu geri al
        Schema::table('post_services', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        // post_auctions tablosunu geri al
        Schema::table('post_auctions', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });

        // post_polls tablosunu geri al
        Schema::table('post_polls', function (Blueprint $table) {
            $table->dropForeign(['post_id']);
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
        });
    }
};
