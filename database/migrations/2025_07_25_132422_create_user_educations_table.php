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
            $table->string('education_name'); // Eğitim adı (örn: Bilgisayar Mühendisliği)
            $table->string('institution'); // Kurum/Üniversite adı
            $table->string('start_year'); // Başlangıç yılı
            $table->string('end_year')->nullable(); // Bitiş yılı (devam ediyorsa null)
            $table->string('document_link')->nullable(); // Belge linki
            $table->tinyInteger('link_access')->default(0); // 0: bekleniyor, 1: onaylandı, 2: reddedildi
            $table->timestamps(); // created_at ve updated_at (bizim kontrol için)
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
