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
        Schema::table('service_items', function (Blueprint $table) {
            // İndirim fiyatı alanını ekle (eğer yoksa)
            if (!Schema::hasColumn('service_items', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)->nullable()->after('price');
            }
            
            // Teslimat süresi için instant seçeneği ekle
            if (Schema::hasColumn('service_items', 'delivery_time_type')) {
                $table->dropColumn(['delivery_time_type', 'delivery_time_min', 'delivery_time_max']);
            }
            
            // delivery_time_unit enum'unu güncelle
            $table->enum('delivery_time_unit', ['instant', 'hour', 'day', 'week', 'month'])->default('day')->change();
            
            // Performans için indeksler (eğer yoksa)
            try {
                $table->index(['price', 'discount_price'], 'idx_service_items_price_discount');
                $table->index(['delivery_time_unit', 'delivery_time'], 'idx_service_items_delivery');
                $table->index(['sale_type', 'is_active'], 'idx_service_items_sale_active');
                $table->index(['post_service_id', 'sort_order', 'is_active'], 'idx_service_items_service_sort');
            } catch (\Exception $e) {
                // İndeks zaten varsa devam et
            }
        });
        
        // Fiyat kontrolü için check constraint (MySQL 8.0.16+) - ayrı statement olarak
        try {
            if (config('database.default') === 'mysql' && Schema::hasColumn('service_items', 'discount_price')) {
                DB::statement('ALTER TABLE service_items ADD CONSTRAINT chk_discount_price CHECK (discount_price IS NULL OR discount_price < price)');
            }
        } catch (\Exception $e) {
            // Constraint zaten varsa devam et
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('service_items', function (Blueprint $table) {
            // İndeksleri kaldır
            $table->dropIndex(['price', 'discount_price']);
            $table->dropIndex(['delivery_time_unit', 'delivery_time']);
            $table->dropIndex(['sale_type', 'is_active']);
            $table->dropIndex(['post_service_id', 'sort_order', 'is_active']);
            
            // Alanları kaldır
            $table->dropColumn(['discount_price', 'delivery_time']);
            
            // Eski alanları geri ekle
            $table->enum('delivery_time_type', ['fixed', 'range'])->default('fixed')->after('price');
            $table->unsignedInteger('delivery_time_min')->nullable()->after('delivery_time_unit');
            $table->unsignedInteger('delivery_time_max')->nullable()->after('delivery_time_min');
            
            // Enum'u eski haline getir
            $table->enum('delivery_time_unit', ['hour', 'day', 'week'])->default('day')->change();
        });
        
        // Check constraint'i kaldır
        if (config('database.default') === 'mysql') {
            DB::statement('ALTER TABLE service_items DROP CONSTRAINT IF EXISTS chk_discount_price');
        }
    }
};