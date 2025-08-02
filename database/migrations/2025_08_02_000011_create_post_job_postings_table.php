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
        Schema::create('post_job_postings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts_optimized')->onDelete('cascade');
            $table->string('job_title', 200);
            $table->text('job_description');
            $table->text('responsibilities')->nullable();
            $table->text('requirements')->nullable();
            $table->json('required_skills')->nullable(); // JSON array of required skills
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'freelance'])->default('freelance');
            $table->enum('experience_level', ['entry', 'mid', 'senior', 'lead'])->default('mid');
            $table->decimal('min_salary', 10, 2)->nullable();
            $table->decimal('max_salary', 10, 2)->nullable();
            $table->enum('salary_type', ['hourly', 'daily', 'weekly', 'monthly', 'yearly', 'project_based'])->default('monthly');
            $table->string('location', 200)->nullable();
            $table->boolean('is_remote')->default(false);
            $table->boolean('is_hybrid')->default(false);
            $table->text('benefits')->nullable();
            $table->date('application_deadline')->nullable();
            $table->date('start_date')->nullable();
            $table->integer('positions_available')->default(1);
            $table->enum('status', ['draft', 'active', 'paused', 'closed', 'filled'])->default('active');
            $table->timestamps();
            
            $table->index(['employment_type', 'experience_level']);
            $table->index(['min_salary', 'max_salary']);
            $table->index(['is_remote', 'location']);
            $table->index(['status', 'application_deadline']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_job_postings');
    }
};