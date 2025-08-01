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
        Schema::create('post_polls', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->unique();
            $table->string('question');
            $table->json('options'); // Anket seçenekleri
            $table->json('votes')->nullable(); // Her seçenek için oy sayıları
            $table->boolean('multiple_choice')->default(false);
            $table->boolean('anonymous_voting')->default(true);
            $table->datetime('expires_at')->nullable();
            $table->integer('total_votes')->default(0);
            $table->timestamps();

            // İndeksler
            $table->index('post_id');
            $table->index('expires_at');
            $table->index('total_votes');

            // Foreign key
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_polls');
    }
};