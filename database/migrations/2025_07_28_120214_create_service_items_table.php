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
        Schema::create('service_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_service_id');
            $table->string('title'); // Zorunlu başlık
            $table->text('description')->nullable(); // İsteğe bağlı açıklama
            $table->decimal('price', 10, 2); // Item fiyatı
            
            // Teslimat süresi
            $table->enum('delivery_time_type', ['fixed', 'range'])->default('fixed');
            $table->enum('delivery_time_unit', ['hour', 'day', 'week'])->default('day');
            $table->unsignedInteger('delivery_time_min')->nullable();
            $table->unsignedInteger('delivery_time_max')->nullable();
            
            // Satış tipi
            $table->enum('sale_type', ['internal', 'external'])->default('internal');
            $table->string('external_url')->nullable(); // Dış link
            
            // Diğer özellikler
            $table->boolean('auto_delivery')->default(false);
            $table->boolean('is_active')->default(true);
            $table->unsignedInteger('sort_order')->default(0); // Sıralama
            $table->json('features')->nullable(); // Özellikler listesi
            $table->text('requirements')->nullable(); // Gereksinimler
            
            $table->timestamps();
            
            $table->foreign('post_service_id')->references('id')->on('post_services')->onDelete('cascade');
            $table->index(['post_service_id', 'is_active']);
            $table->index(['price', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_items');
    }
};
