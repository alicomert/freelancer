<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * 
     * Alıcı İsteği (Buyer Request) için optimize edilmiş tablo yapısı
     * 50 milyon+ veri için tasarlanmış, posts_optimized tablosuna bağlı
     */
    public function up(): void
    {
        Schema::create('post_buyer_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained('posts_optimized')->onDelete('cascade');
            
            // İş Türü (Job Type) - Süre Bazlı / Proje Bazlı
            $table->enum('job_type', ['time_based', 'project_based'])->default('time_based')->index();
            
            // Çalışma Süresi (Work Duration) - Süre Bazlı için
            $table->enum('work_duration_type', ['hourly', 'daily'])->nullable()->index();
            
            // Teslim Süresi (Delivery Time) - Proje Bazlı için
            $table->enum('delivery_time', [
                'few_days',
                'one_week',
                'one_month',
                'one_to_three_months',
                'more_than_three_months'
            ])->nullable()->index();
            
            // Bütçe Aralığı
            $table->decimal('budget_min', 15, 2)->nullable();
            $table->decimal('budget_max', 15, 2)->nullable();
            $table->string('currency', 3)->default('TRY');
            
            // Gerekli Beceriler
            $table->json('required_skills')->nullable();
            
            // Deneyim Seviyesi
            $table->enum('experience_level', ['beginner', 'intermediate', 'expert'])->nullable();
            
            // Konum (opsiyonel)
            $table->string('location', 255)->nullable();
            
            // Ek meta veriler
            $table->json('meta_data')->nullable();
            
            // Durum ve takip
            $table->tinyInteger('status')->default(1)->comment('1:active, 2:completed, 3:cancelled, 4:expired')->index();
            
            // Tarih alanları
            $table->timestamp('deadline')->nullable();
            $table->timestamps();
            
            // Performans indeksleri
            $table->index(['post_id', 'job_type']);
            $table->index(['job_type', 'status']);
            $table->index(['budget_min', 'budget_max']);
            $table->index(['deadline', 'status']);
            $table->index(['created_at', 'status']);
            
            // Tekrarlama önleyici kısıtlama
            $table->unique('post_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_buyer_requests');
    }
};
