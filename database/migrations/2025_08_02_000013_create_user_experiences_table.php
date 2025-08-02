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
        Schema::create('user_experiences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('company_name', 200);
            $table->string('position', 150);
            $table->text('description')->nullable();
            $table->date('start_date');
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false); // Hala çalışıyor mu?
            $table->string('location', 100)->nullable(); // Şehir, Ülke
            $table->enum('employment_type', ['full_time', 'part_time', 'contract', 'freelance', 'internship'])->default('full_time');
            $table->json('skills_used')->nullable(); // Bu işte kullanılan beceriler
            $table->json('achievements')->nullable(); // Başarılar, projeler
            $table->string('company_website')->nullable();
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['user_id', 'sort_order']);
            $table->index(['user_id', 'is_current']);
            $table->index(['employment_type']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_experiences');
    }
};