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
        Schema::create('post_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts_optimized')->onDelete('cascade');
            $table->decimal('price', 10, 2);
            $table->decimal('price_premium', 10, 2)->nullable();
            $table->integer('delivery_time'); // gün cinsinden
            $table->integer('delivery_time_premium')->nullable();
            $table->integer('revision_count')->default(1);
            $table->integer('revision_count_premium')->nullable();
            $table->json('features')->nullable(); // temel özellikler
            $table->json('features_premium')->nullable(); // premium özellikler
            $table->json('requirements')->nullable(); // müşteriden istenenler
            $table->json('gallery')->nullable(); // örnek çalışmalar
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['post_id', 'is_active']);
            $table->index(['price', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_services');
    }
};