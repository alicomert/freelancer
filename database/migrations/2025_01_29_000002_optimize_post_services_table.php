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
            // Eksik alanları ekle (eğer yoksa)
            if (!Schema::hasColumn('post_services', 'price')) {
                $table->decimal('price', 10, 2)->nullable()->after('post_id');
            }
            if (!Schema::hasColumn('post_services', 'sale_type')) {
                $table->enum('sale_type', ['internal', 'external'])->default('internal')->after('auto_delivery');
            }
            if (!Schema::hasColumn('post_services', 'external_url')) {
                $table->string('external_url')->nullable()->after('sale_type');
            }
            if (!Schema::hasColumn('post_services', 'packages')) {
                $table->json('packages')->nullable()->after('external_url');
            }
            if (!Schema::hasColumn('post_services', 'requirements')) {
                $table->text('requirements')->nullable()->after('packages');
            }
            if (!Schema::hasColumn('post_services', 'features')) {
                $table->longText('features')->nullable()->after('requirements');
            }
            
            // Ana hizmet seviyesindeki gereksiz alanları kaldır (eğer varsa)
            $columnsToRemove = [
                'delivery_time_type', 
                'delivery_time_unit', 
                'delivery_time_min', 
                'delivery_time_max',
                'price_min',
                'price_max'
            ];
            
            foreach ($columnsToRemove as $column) {
                if (Schema::hasColumn('post_services', $column)) {
                    $table->dropColumn($column);
                }
            }
            
            // Performans için ek indeksler (eğer yoksa)
            try {
                $table->index(['sale_type', 'auto_delivery'], 'idx_post_services_sale_auto');
                $table->index(['post_id', 'sale_type'], 'idx_post_services_post_sale');
            } catch (\Exception $e) {
                // İndeks zaten varsa devam et
            }
            
            // JSON alanları için virtual columns (MySQL 5.7.8+)
            try {
                if (config('database.default') === 'mysql' && !Schema::hasColumn('post_services', 'packages_count')) {
                    // Packages JSON'undan paket sayısını çıkar
                    DB::statement('ALTER TABLE post_services ADD COLUMN packages_count INT GENERATED ALWAYS AS (JSON_LENGTH(packages)) VIRTUAL');
                    $table->index('packages_count');
                }
            } catch (\Exception $e) {
                // Virtual column zaten varsa devam et
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_services', function (Blueprint $table) {
            // İndeksleri kaldır
            $table->dropIndex(['sale_type', 'auto_delivery']);
            $table->dropIndex(['post_id', 'sale_type']);
            
            if (config('database.default') === 'mysql') {
                $table->dropIndex(['packages_count']);
                DB::statement('ALTER TABLE post_services DROP COLUMN packages_count');
            }
            
            // Eski alanları geri ekle
            $table->enum('delivery_time_type', ['fixed', 'range'])->default('fixed')->after('price');
            $table->enum('delivery_time_unit', ['hour', 'day', 'week'])->default('day')->after('delivery_time_type');
            $table->unsignedInteger('delivery_time_min')->nullable()->after('delivery_time_unit');
            $table->unsignedInteger('delivery_time_max')->nullable()->after('delivery_time_min');
            $table->decimal('price_min', 10, 2)->nullable()->after('price');
            $table->decimal('price_max', 10, 2)->nullable()->after('price_min');
        });
    }
};