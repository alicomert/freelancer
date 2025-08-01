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
        Schema::create('poll_votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('poll_id')->index();
            $table->unsignedBigInteger('option_id')->index();
            $table->unsignedBigInteger('user_id')->nullable()->index(); // Anonim oylar için null olabilir
            $table->string('ip_address', 45)->nullable(); // IPv6 desteği için 45 karakter
            $table->string('user_agent')->nullable();
            $table->timestamps();
            
            $table->foreign('poll_id')->references('id')->on('post_polls')->onDelete('cascade');
            $table->foreign('option_id')->references('id')->on('poll_options')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            
            // Aynı kullanıcının aynı ankette birden fazla oy vermesini önle (çoklu seçim değilse)
            $table->index(['poll_id', 'user_id']);
            $table->index(['poll_id', 'ip_address']);
            $table->index(['option_id', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poll_votes');
    }
};
