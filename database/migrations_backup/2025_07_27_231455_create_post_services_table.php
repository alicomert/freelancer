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
            $table->unsignedBigInteger('post_id')->unique();
            $table->decimal('price', 10, 2)->nullable()->index();
            $table->unsignedInteger('delivery_time')->nullable(); // Gün cinsinden
            $table->boolean('auto_delivery')->default(false);
            $table->json('packages')->nullable(); // Farklı paket seçenekleri
            $table->text('requirements')->nullable(); // Müşteriden istenenler
            $table->text('features')->nullable(); // Hizmet özellikleri
            $table->timestamps();
            
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->index(['price', 'delivery_time']);
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
