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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->unique()->index();
            $table->string('slug', 100)->unique()->index();
            $table->text('description')->nullable();
            $table->string('color', 7)->default('#007bff'); // Hex renk kodu
            $table->unsignedInteger('usage_count')->default(0)->index();
            $table->boolean('is_trending')->default(false)->index();
            $table->timestamps();
            
            $table->index(['usage_count', 'is_trending']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};
