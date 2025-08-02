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
        Schema::create('post_portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts_optimized')->onDelete('cascade');
            $table->string('project_title', 255);
            $table->text('project_description');
            $table->string('project_url')->nullable(); // canlı proje linki
            $table->string('github_url')->nullable(); // github linki
            $table->json('technologies_used')->nullable(); // kullanılan teknolojiler
            $table->json('gallery')->nullable(); // proje görselleri
            $table->date('completion_date')->nullable();
            $table->enum('project_type', ['web', 'mobile', 'desktop', 'design', 'other'])->default('web');
            $table->timestamps();
            
            $table->index(['post_id']);
            $table->index(['project_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_portfolios');
    }
};