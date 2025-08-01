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
            $table->uuid('uuid')->unique(); // Public ID için
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('community_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            
            // Post Tipi - Enum yerine tinyint (daha hızlı)
            $table->tinyInteger('post_type')->default(1)->comment('1:post, 2:service, 3:auction, 4:poll, 5:portfolio, 6:article, 7:question');
            
            $table->string('title', 255)->index();
            $table->string('slug', 300)->unique()->index();
            $table->text('content');
            $table->string('excerpt', 500)->nullable(); // SEO için
            
            // Medya
            $table->string('featured_image', 500)->nullable();
            
            // Sayaçlar
            $table->integer('likes_count')->default(0)->index();
            $table->integer('comments_count')->default(0)->index();
            $table->integer('shares_count')->default(0);
            $table->integer('views_count')->default(0)->index();
            
            // Durum ve Özellikler
            $table->boolean('is_pinned')->default(false)->index();
            $table->boolean('is_featured')->default(false)->index();
            $table->tinyInteger('status')->default(1)->index()->comment('1:active, 2:draft, 3:hidden, 4:deleted, 5:pending');
            
            // SEO
            $table->string('meta_title', 255)->nullable();
            $table->string('meta_description', 500)->nullable();
            $table->json('meta_keywords')->nullable();
            
            // Zaman damgaları
            $table->timestamp('published_at')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
            
            // Performans İndeksleri
            $table->index(['status', 'is_featured', 'published_at'], 'posts_main_query');
            $table->index(['user_id', 'status', 'created_at'], 'posts_user_query');
            $table->index(['category_id', 'post_type', 'status'], 'posts_category_query');
            $table->index(['community_id', 'status', 'published_at'], 'posts_community_query');
            $table->index(['created_at', 'status'], 'posts_timeline');
            $table->index(['views_count', 'status'], 'posts_popular');
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
