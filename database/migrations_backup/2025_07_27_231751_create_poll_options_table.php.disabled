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
        Schema::create('poll_options', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_id')->index();
            $table->string('option_text');
            $table->unsignedInteger('vote_count')->default(0)->index();
            $table->unsignedInteger('order_index')->default(0); // Seçenek sırası
            $table->unsignedBigInteger('created_by_user_id')->nullable(); // Kullanıcı tarafından eklenen seçenekler için
            $table->timestamps();
            
            $table->foreign('poll_id')->references('id')->on('post_polls')->onDelete('cascade');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['poll_id', 'order_index']);
            $table->index(['vote_count', 'poll_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_options');
    }
};
