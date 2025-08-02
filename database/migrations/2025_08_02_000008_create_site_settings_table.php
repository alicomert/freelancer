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
        Schema::create('site_settings', function (Blueprint $table) {
            $table->id();
            $table->string('key', 100)->unique();
            $table->text('value')->nullable();
            $table->string('type', 50)->default('text'); // text, number, boolean, json
            $table->string('group', 50)->default('general'); // ayar grubu
            $table->string('label', 200)->nullable(); // admin panelinde gösterilecek etiket
            $table->text('description')->nullable();
            $table->integer('sort_order')->default(0); // sıralama
            $table->boolean('is_public')->default(false); // frontend'de gösterilsin mi
            $table->timestamps();
            
            $table->index(['key', 'is_public']);
            $table->index(['group', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('site_settings');
    }
};