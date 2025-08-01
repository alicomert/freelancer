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
        Schema::dropIfExists('comments');
        Schema::dropIfExists('contracts');
        Schema::dropIfExists('follows');
        Schema::dropIfExists('job_batches');
        Schema::dropIfExists('likes');
        Schema::dropIfExists('post_buyer_requests');
        Schema::dropIfExists('post_job_postings');
        Schema::dropIfExists('post_likes');
        Schema::dropIfExists('post_tags');
        Schema::dropIfExists('posts_optimized');
        Schema::dropIfExists('proposals');
        Schema::dropIfExists('reviews');
        Schema::dropIfExists('services');
        Schema::dropIfExists('site_settings');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('user_blocks');
        Schema::dropIfExists('user_educations');
        Schema::dropIfExists('user_follows');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Bu migration geri alınamaz
    }
};
