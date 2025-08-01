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
        Schema::table('post_services', function (Blueprint $table) {
            // Teslimat süresi için yeni alanlar
            $table->dropColumn('delivery_time'); // Eski delivery_time'ı kaldır
            $table->enum('delivery_time_type', ['fixed', 'range'])->default('fixed')->after('price');
            $table->enum('delivery_time_unit', ['hour', 'day', 'week'])->default('day')->after('delivery_time_type');
            $table->unsignedInteger('delivery_time_min')->nullable()->after('delivery_time_unit'); // Minimum süre
            $table->unsignedInteger('delivery_time_max')->nullable()->after('delivery_time_min'); // Maximum süre (aralık için)
            
            // Fiyat aralığı için
            $table->decimal('price_min', 10, 2)->nullable()->after('price'); // Minimum fiyat
            $table->decimal('price_max', 10, 2)->nullable()->after('price_min'); // Maximum fiyat
            
            // Satış tipi
            $table->enum('sale_type', ['internal', 'external'])->default('internal')->after('auto_delivery');
            $table->string('external_url')->nullable()->after('sale_type'); // Dış link
            
            // İndeksler
            $table->index(['price_min', 'price_max']);
            $table->index(['delivery_time_min', 'delivery_time_max']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_services', function (Blueprint $table) {
            // Yeni alanları kaldır
            $table->dropColumn([
                'delivery_time_type', 
                'delivery_time_unit', 
                'delivery_time_min', 
                'delivery_time_max',
                'price_min',
                'price_max',
                'sale_type',
                'external_url'
            ]);
            
            // Eski delivery_time'ı geri ekle
            $table->unsignedInteger('delivery_time')->nullable()->after('price');
        });
    }
};
