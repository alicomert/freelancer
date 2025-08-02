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
        Schema::create('post_auctions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts_optimized')->onDelete('cascade');
            $table->decimal('starting_price', 10, 2);
            $table->decimal('current_price', 10, 2)->nullable();
            $table->decimal('reserve_price', 10, 2)->nullable(); // minimum kabul edilebilir fiyat
            $table->integer('duration_days'); // müzayede süresi
            $table->timestamp('ends_at');
            $table->json('requirements')->nullable(); // proje gereksinimleri
            $table->json('skills_required')->nullable(); // gerekli yetenekler
            $table->integer('bids_count')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['post_id', 'is_active']);
            $table->index(['ends_at', 'is_active']);
            $table->index(['current_price', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_auctions');
    }
};