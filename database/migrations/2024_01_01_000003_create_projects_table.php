<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained();
            $table->string('title', 200);
            $table->string('slug')->unique();
            $table->text('description');
            $table->json('requirements')->nullable(); // JSON field for requirements
            $table->decimal('budget_min', 10, 2)->nullable();
            $table->decimal('budget_max', 10, 2)->nullable();
            $table->enum('budget_type', ['fixed', 'hourly'])->default('fixed');
            $table->enum('duration', ['1-3_days', '1_week', '2_weeks', '1_month', '2-3_months', '3+_months']);
            $table->enum('experience_level', ['beginner', 'intermediate', 'expert']);
            $table->enum('status', ['draft', 'active', 'in_progress', 'completed', 'cancelled'])->default('draft');
            $table->timestamp('deadline')->nullable();
            $table->integer('proposals_count')->default(0);
            $table->integer('views_count')->default(0);
            $table->json('skills')->nullable(); // JSON array of required skills
            $table->json('attachments')->nullable(); // JSON array of file paths
            $table->boolean('is_featured')->default(false);
            $table->timestamp('featured_until')->nullable();
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['status', 'is_featured', 'created_at']);
            $table->index(['category_id', 'status']);
            $table->index(['budget_min', 'budget_max']);
            $table->index('deadline');
            $table->fullText(['title', 'description']); // For search
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};