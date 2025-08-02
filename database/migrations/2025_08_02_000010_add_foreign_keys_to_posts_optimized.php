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
        Schema::table('posts_optimized', function (Blueprint $table) {
            $table->foreign('community_id', 'posts_optimized_community_foreign')->references('id')->on('categories')->onDelete('set null');
            $table->foreign('category_id', 'posts_optimized_category_foreign')->references('id')->on('categories')->onDelete('set null');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->foreign('category_id', 'tags_category_foreign')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts_optimized', function (Blueprint $table) {
            $table->dropForeign('posts_optimized_community_foreign');
            $table->dropForeign('posts_optimized_category_foreign');
        });

        Schema::table('tags', function (Blueprint $table) {
            $table->dropForeign('tags_category_foreign');
        });
    }
};