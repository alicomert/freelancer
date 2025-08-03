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
        Schema::table('post_portfolios', function (Blueprint $table) {
            if (Schema::hasColumn('post_portfolios', 'client_name')) {
                $table->dropColumn('client_name');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_portfolios', function (Blueprint $table) {
            $table->string('client_name')->nullable();
        });
    }
};
