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
            $table->boolean('multiple_choice')->default(false); // Çoklu seçim izni
            $table->boolean('anonymous_voting')->default(true); // Anonim oylama
            $table->timestamp('end_date')->nullable()->index(); // Anket bitiş tarihi
            $table->boolean('show_results')->default(true); // Sonuçları göster
            $table->boolean('allow_add_options')->default(false); // Kullanıcıların seçenek eklemesine izin ver
            $table->unsignedInteger('total_votes')->default(0)->index();
            $table->timestamps();
            
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
            $table->index(['end_date', 'total_votes']);
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
