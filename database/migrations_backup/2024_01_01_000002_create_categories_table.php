<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 100);
            $table->text('description')->nullable();
            $table->string('icon', 50)->nullable();
            $table->string('color', 7)->default('#3b82f6');
            $table->boolean('is_active')->default(true);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['is_active', 'sort_order']);
            $table->enum('category_type', ['general', 'service', 'auction', 'portfolio', 'project'])
                  ->default('general')
                  ->comment('Kategori tipi: general=genel postlar, service=hizmetler, auction=açık artırma, portfolio=portföy, project=proje');
            $table->unique(['slug', 'category_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};