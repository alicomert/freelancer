<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update existing educations with sort_order based on their ID
        DB::statement('
            UPDATE user_educations 
            SET sort_order = (
                SELECT ROW_NUMBER() OVER (PARTITION BY user_id ORDER BY id ASC)
                FROM (SELECT id, user_id FROM user_educations) AS sub
                WHERE sub.id = user_educations.id
            )
            WHERE sort_order = 0 OR sort_order IS NULL
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Reset sort_order to 0 for all records
        DB::table('user_educations')->update(['sort_order' => 0]);
    }
};
