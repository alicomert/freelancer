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
            if (Schema::hasColumn('post_portfolios', 'project_title')) {
                $table->dropColumn('project_title');
            }
            if (Schema::hasColumn('post_portfolios', 'project_description')) {
                $table->dropColumn('project_description');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('post_portfolios', function (Blueprint $table) {
            $table->string('project_title', 255)->nullable();
            $table->text('project_description')->nullable();
        });
    }
};
