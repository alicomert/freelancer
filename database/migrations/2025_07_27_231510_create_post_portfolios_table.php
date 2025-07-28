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
        Schema::create('post_portfolios', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->unique();
            $table->string('project_title');
            $table->text('project_description');
            $table->string('client_name')->nullable();
            $table->date('completion_date')->nullable()->index();
            $table->integer('project_duration')->nullable(); // Proje süresi (gün)
            $table->decimal('project_budget', 10, 2)->nullable(); // Proje bütçesi
            $table->json('technologies_used')->nullable(); // Kullanılan teknolojiler
            $table->string('project_url')->nullable();
            $table->string('github_url')->nullable();
            $table->text('challenges_faced')->nullable(); // Karşılaşılan zorluklar
            $table->text('solutions_provided')->nullable(); // Sağlanan çözümler
            $table->text('results_achieved')->nullable(); // Elde edilen sonuçlar
            $table->text('client_testimonial')->nullable(); // Müşteri referansı
            $table->json('project_images')->nullable(); // Proje görselleri
            $table->json('project_files')->nullable(); // Proje dosyaları
            $table->boolean('is_featured_work')->default(false); // Öne çıkan çalışma
            $table->integer('display_order')->default(0); // Görüntüleme sırası
            $table->timestamps();
            
            $table->foreign('post_id')->references('id')->on('posts_optimized')->onDelete('cascade');
            $table->index(['is_featured_work', 'completion_date']);
            $table->index('display_order');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_portfolios');
    }
};
