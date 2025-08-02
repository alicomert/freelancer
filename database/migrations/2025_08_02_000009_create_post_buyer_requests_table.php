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
            $table->foreignId('post_id')->constrained('posts_optimized')->onDelete('cascade');
            $table->decimal('min_budget', 10, 2)->nullable();
            $table->decimal('max_budget', 10, 2)->nullable();
            $table->enum('budget_type', ['fixed', 'hourly'])->default('fixed');
            $table->integer('estimated_duration_days')->nullable();
            $table->enum('experience_level', ['beginner', 'intermediate', 'expert'])->default('intermediate');
            $table->json('required_skills')->nullable(); // JSON array of required skills
            $table->text('deliverables')->nullable(); // What the buyer expects to receive
            $table->boolean('is_urgent')->default(false);
            $table->date('deadline')->nullable();
            $table->enum('project_type', ['one_time', 'ongoing'])->default('one_time');
            $table->text('additional_requirements')->nullable();
            $table->timestamps();
            
            $table->index(['min_budget', 'max_budget']);
            $table->index(['budget_type', 'experience_level']);
            $table->index(['is_urgent', 'deadline']);
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