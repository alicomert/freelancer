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
        Schema::create('auction_bids', function (Blueprint $table) {
            $table->id();
            $table->foreignId('auction_id')->constrained('post_auctions')->onDelete('cascade');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->decimal('bid_amount', 10, 2);
            $table->text('proposal')->nullable(); // teklif açıklaması
            $table->integer('delivery_days')->nullable(); // teslim süresi
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            
            $table->index(['auction_id', 'bid_amount']);
            $table->index(['user_id', 'is_active']);
            $table->unique(['auction_id', 'user_id']); // bir kullanıcı bir müzayedeye sadece bir teklif verebilir
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auction_bids');
    }
};