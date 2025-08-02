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
            // Premium alanları kaldır - sanal hizmet sisteminde gerekli değil
            $table->dropColumn([
                'price_premium',
                'delivery_time_premium', 
                'revision_count_premium',
                'features_premium'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_services', function (Blueprint $table) {
            // Geri alma durumunda premium alanları tekrar ekle
            $table->decimal('price_premium', 10, 2)->nullable();
            $table->integer('delivery_time_premium')->nullable();
            $table->integer('revision_count_premium')->nullable();
            $table->json('features_premium')->nullable();
        });
    }
};