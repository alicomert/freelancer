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
        Schema::create('user_educations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('institution_name', 200);
            $table->string('degree', 100)->nullable(); // Lisans, Yüksek Lisans, Doktora, etc.
            $table->string('field_of_study', 150)->nullable(); // Bilgisayar Mühendisliği, etc.
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->boolean('is_current')->default(false); // Hala devam ediyor mu?
            $table->decimal('gpa', 3, 2)->nullable(); // Grade Point Average
            $table->text('description')->nullable(); // Ek açıklamalar
            $table->string('location', 100)->nullable(); // Şehir, Ülke
            $table->json('activities')->nullable(); // Kulüpler, aktiviteler, etc.
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->index(['user_id', 'sort_order']);
            $table->index(['user_id', 'is_current']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_educations');
    }
};