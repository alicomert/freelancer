<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
        public function run(): void
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $this->call([
            UserSeeder::class,
            CategorySeeder::class,
            ForumCategorySeeder::class,
            PortfolioFreelanceCategorySeeder::class,
            ProjectCategorySeeder::class,
            ServiceCategorySeeder::class,
            ProjectSeeder::class,
            PostSeeder::class,
            SiteSettingSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
