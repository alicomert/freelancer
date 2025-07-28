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
        Schema::table('categories', function (Blueprint $table) {
            $table->enum('category_type', ['general', 'service', 'auction', 'portfolio'])
                  ->default('general')
                  ->after('sort_order')
                  ->comment('Kategori tipi: general=genel postlar, service=hizmetler, auction=açık artırma, portfolio=portföy');
            
            // Index for better performance
            $table->index(['category_type', 'is_active']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->dropIndex(['category_type', 'is_active']);
            $table->dropColumn('category_type');
        });
    }
};