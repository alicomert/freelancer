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
        Schema::create('post_buyer_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->unique();
            $table->string('project_title');
            $table->text('project_description');
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->enum('budget_type', ['fixed', 'hourly'])->default('fixed');
            $table->integer('duration_days')->nullable();
            $table->enum('experience_level', ['beginner', 'intermediate', 'expert'])->default('intermediate');
            $table->json('required_skills')->nullable();
            $table->json('attachments')->nullable();
            $table->date('deadline')->nullable();
            $table->integer('proposals_count')->default(0);
            $table->boolean('is_urgent')->default(false);
            $table->timestamps();

            // İndeksler
            $table->index('post_id');
            $table->index('budget_type');
            $table->index('experience_level');
            $table->index('deadline');
            $table->index('is_urgent');

            // Foreign key
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_buyer_requests');
    }
};