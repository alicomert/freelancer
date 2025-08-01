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
        // Tags tablosunu oluştur
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique();
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#3B82F6'); // Hex color
            $table->string('icon', 50)->nullable();
            $table->boolean('is_featured')->default(false);
            $table->unsignedInteger('usage_count')->default(0);
            $table->unsignedBigInteger('category_id')->nullable();
            $table->timestamps();
            
            // İndeksler
            $table->index(['is_featured', 'usage_count']);
            $table->index('category_id');
            $table->index('usage_count');
            
            // Foreign key
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });

        // Post-Tag pivot tablosunu oluştur
        Schema::create('post_tags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();
            
            // Unique constraint - aynı post'a aynı tag birden fazla kez eklenemez
            $table->unique(['post_id', 'tag_id']);
            
            // İndeksler
            $table->index('post_id');
            $table->index('tag_id');
            
            // Foreign keys
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('tags');
    }
};
