<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null');
            $table->string('title', 300)->nullable(); // For question/discussion posts
            $table->text('content');
            $table->enum('type', ['post', 'question', 'discussion', 'showcase', 'article', 'project', 'poll'])->default('post');
            $table->string('image')->nullable(); // Featured image
            $table->decimal('budget', 10, 2)->nullable(); // For project posts
            $table->json('media')->nullable(); // Images, videos etc.
            $table->json('tags')->nullable(); // Hashtags
            $table->json('meta_data')->nullable(); // Additional metadata
            $table->integer('likes_count')->default(0);
            $table->integer('comments_count')->default(0);
            $table->integer('shares_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->boolean('is_pinned')->default(false);
            $table->boolean('is_featured')->default(false);
            $table->enum('status', ['active', 'hidden', 'deleted', 'published', 'draft'])->default('active');
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['status', 'is_featured', 'created_at']);
            $table->index(['user_id', 'status']);
            $table->index(['category_id', 'type']);
            $table->index(['likes_count', 'comments_count']);
            $table->fullText(['title', 'content']); // For search
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};