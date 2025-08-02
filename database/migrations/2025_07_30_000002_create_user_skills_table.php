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
        Schema::create('user_skills', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('name', 100);
            $table->enum('type', ['expertise', 'tool', 'language', 'framework'])->default('expertise');
            $table->tinyInteger('level')->nullable()->comment('1-100 arası seviye, sadece expertise için');
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['user_id', 'type']);
            $table->index(['user_id', 'sort_order']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_skills');
    }
};