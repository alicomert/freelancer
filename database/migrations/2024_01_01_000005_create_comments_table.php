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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('post_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->text('content');
            $table->integer('likes_count')->default(0);
            $table->boolean('is_approved')->default(true);
            $table->timestamps();
            $table->softDeletes();

            // İndeksler
            $table->index(['post_id', 'created_at']);
            $table->index(['user_id', 'created_at']);
            $table->index(['parent_id']);
            $table->index(['is_approved', 'created_at']);
        });

        // Self-referencing foreign key'i ayrı olarak ekle
        Schema::table('comments', function (Blueprint $table) {
            $table->foreign('parent_id')->references('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};