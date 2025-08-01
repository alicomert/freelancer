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
        Schema::create('post_auctions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id')->unique();
            $table->decimal('starting_price', 10, 2)->index();
            $table->decimal('current_price', 10, 2)->default(0)->index();
            $table->decimal('reserve_price', 10, 2)->nullable();
            $table->timestamp('start_time')->nullable()->index();
            $table->timestamp('end_time')->nullable()->index();
            $table->boolean('auto_extend')->default(false); // Otomatik uzatma özelliği
            $table->enum('status', ['pending', 'active', 'ended', 'cancelled'])->default('pending')->index();
            $table->unsignedBigInteger('winner_user_id')->nullable();
            $table->unsignedInteger('bid_count')->default(0);
            $table->timestamps();
            
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
            $table->foreign('winner_user_id')->references('id')->on('users')->onDelete('set null');
            $table->index(['status', 'end_time']);
            $table->index(['current_price', 'end_time']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_auctions');
    }
};
