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
            
            // Kapsamlı kategori seeder'ları
            CategorySeeder::class,           // Temel kategoriler (10 adet)
            ServiceCategorySeeder::class,    // Hizmet kategorileri (10 adet)
            ProjectCategorySeeder::class,    // Proje kategorileri (90+ adet)
            ForumCategorySeeder::class,      // Forum kategorileri (20 adet)
            PortfolioFreelanceCategorySeeder::class, // Portfolio kategorileri
            
            UserSkillSeeder::class,
            PostSeeder::class,
            UpdatePostsSeoMetaSeeder::class,
            SiteSettingSeeder::class,
        ]);

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
