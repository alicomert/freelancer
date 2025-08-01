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
        Schema::table('post_portfolios', function (Blueprint $table) {
            // Gereksiz alanları kaldır
            $table->dropColumn([
                'project_duration',
                'project_budget', 
                'github_url',
                'challenges_faced',
                'solutions_provided',
                'results_achieved',
                'client_testimonial',
                'project_images',
                'project_files',
                'is_featured_work',
                'display_order'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_portfolios', function (Blueprint $table) {
            // Alanları geri ekle
            $table->integer('project_duration')->nullable();
            $table->decimal('project_budget', 10, 2)->nullable();
            $table->string('github_url')->nullable();
            $table->text('challenges_faced')->nullable();
            $table->text('solutions_provided')->nullable();
            $table->text('results_achieved')->nullable();
            $table->text('client_testimonial')->nullable();
            $table->json('project_images')->nullable();
            $table->json('project_files')->nullable();
            $table->boolean('is_featured_work')->default(false);
            $table->integer('display_order')->default(0);
            
            // İndeksleri geri ekle
            $table->index(['is_featured_work', 'completion_date']);
            $table->index('display_order');
        });
    }
};
