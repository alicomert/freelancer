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
        Schema::table('post_services', function (Blueprint $table) {
            if (Schema::hasColumn('post_services', 'packages')) {
                $table->dropColumn('packages');
            }
            if (Schema::hasColumn('post_services', 'requirements')) {
                $table->dropColumn('requirements');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_services', function (Blueprint $table) {
            $table->json('packages')->nullable();
            $table->json('requirements')->nullable();
        });
    }
};
