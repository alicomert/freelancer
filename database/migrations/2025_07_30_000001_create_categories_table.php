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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('slug', 120)->unique();
            $table->text('description')->nullable();
            $table->string('icon', 50)->nullable(); // icon class name
            $table->string('color', 7)->nullable(); // hex color
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->enum('type', ['service', 'auction', 'portfolio', 'community', 'project'])->default('service');
            $table->integer('sort_order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['parent_id', 'is_active']);
            $table->index(['type', 'is_active']);
            $table->index(['sort_order']);
        });
        
        // Add foreign key constraint after table creation
        Schema::table('categories', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('categories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};