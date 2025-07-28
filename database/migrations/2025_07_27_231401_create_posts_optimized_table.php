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
        Schema::create('posts_optimized', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid')->unique();
            $table->unsignedBigInteger('user_id')->index();
            $table->tinyInteger('post_type')->default(1)->index(); // 1=normal, 2=service, 3=auction, 4=poll, 5=portfolio, 6=project
            $table->string('title', 255)->index();
            $table->string('slug', 300)->unique();
            $table->text('content');
            $table->string('excerpt', 500)->nullable();
            $table->unsignedBigInteger('category_id')->index();
            $table->tinyInteger('status')->default(1)->index(); // 1=published, 0=draft, 2=archived
            $table->timestamp('published_at')->nullable()->index();
            $table->unsignedInteger('views_count')->default(0)->index();
            $table->unsignedInteger('likes_count')->default(0)->index();
            $table->unsignedInteger('comments_count')->default(0)->index();
            $table->unsignedInteger('shares_count')->default(0);
            $table->decimal('rating', 3, 2)->default(0)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->boolean('is_pinned')->default(false)->index();
            $table->json('meta_data')->nullable(); // Ek veriler için
            $table->timestamps();
            $table->softDeletes();
            
            // Foreign keys
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            
            // Composite indexes for performance
            $table->index(['status', 'published_at']);
            $table->index(['post_type', 'status']);
            $table->index(['user_id', 'status']);
            $table->index(['category_id', 'status']);
            $table->index(['is_featured', 'published_at']);
            $table->index(['views_count', 'published_at']);
            $table->index(['likes_count', 'published_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts_optimized');
    }
};
