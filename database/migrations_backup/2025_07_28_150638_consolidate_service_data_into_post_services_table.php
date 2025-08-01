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
            // Önce gereksiz sütunları kaldır (varsa)
            if (Schema::hasColumn('post_services', 'packages')) {
                $table->dropColumn('packages');
            }
            if (Schema::hasColumn('post_services', 'requirements')) {
                $table->dropColumn('requirements');
            }

            // Gerekli sütunları ekle (yoksa)
            if (!Schema::hasColumn('post_services', 'title')) {
                $table->string('title')->after('post_id');
            }
            if (!Schema::hasColumn('post_services', 'description')) {
                $table->text('description')->nullable()->after('title');
            }
            if (!Schema::hasColumn('post_services', 'price')) {
                $table->decimal('price', 10, 2)->default(0)->after('description');
            }
            if (!Schema::hasColumn('post_services', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)->nullable()->after('price');
            }
            if (!Schema::hasColumn('post_services', 'sale_type')) {
                $table->string('sale_type')->default('internal')->after('discount_price');
            }
            if (!Schema::hasColumn('post_services', 'external_url')) {
                $table->string('external_url')->nullable()->after('sale_type');
            }
            if (!Schema::hasColumn('post_services', 'delivery_time')) {
                $table->integer('delivery_time')->nullable()->after('external_url');
            }
            if (!Schema::hasColumn('post_services', 'delivery_time_unit')) {
                $table->string('delivery_time_unit')->default('day')->after('delivery_time');
            }
            if (!Schema::hasColumn('post_services', 'auto_delivery')) {
                $table->boolean('auto_delivery')->default(false)->after('delivery_time_unit');
            }
            if (!Schema::hasColumn('post_services', 'features')) {
                $table->json('features')->nullable()->after('auto_delivery');
            }
            if (!Schema::hasColumn('post_services', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('features');
            }
            if (!Schema::hasColumn('post_services', 'sort_order')) {
                $table->integer('sort_order')->default(0)->after('is_active');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_services', function (Blueprint $table) {
            // Eklenen sütunları kaldır
            $table->dropColumn([
                'title',
                'description',
                'price',
                'discount_price',
                'sale_type',
                'external_url',
                'delivery_time',
                'delivery_time_unit',
                'auto_delivery',
                'features',
                'is_active',
                'sort_order'
            ]);

            // Eski sütunları geri ekle
            $table->json('packages')->nullable();
            $table->json('requirements')->nullable();
        });
    }
};
