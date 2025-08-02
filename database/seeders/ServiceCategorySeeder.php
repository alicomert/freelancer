<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class ServiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $serviceCategories = [
            [
                'name' => 'Hosting & VPS',
                'slug' => 'hosting-vps',
                'description' => 'Shared hosting, VPS, dedicated sunucu kiralama hizmetleri',
                'icon' => 'fas fa-server',
                'color' => '#3b82f6',
                'type' => 'service',
                'sort_order' => 1,
            ],
            [
                'name' => 'Hesap & Lisans',
                'slug' => 'hesap-lisans',
                'description' => 'Canva, ChatGPT, Adobe, Office, Windows lisansları',
                'icon' => 'fas fa-key',
                'color' => '#10b981',
                'type' => 'service',
                'sort_order' => 2,
            ],
            [
                'name' => 'E-Pin & Oyun',
                'slug' => 'epin-oyun',
                'description' => 'Steam, PSN, Xbox, Google Play, iTunes kredileri',
                'icon' => 'fas fa-gamepad',
                'color' => '#8b5cf6',
                'type' => 'service',
                'sort_order' => 3,
            ],
            [
                'name' => 'Script & Tema',
                'slug' => 'script-tema',
                'description' => 'WordPress, PHP, HTML temaları ve scriptleri',
                'icon' => 'fas fa-code',
                'color' => '#f59e0b',
                'type' => 'service',
                'sort_order' => 4,
            ],
            [
                'name' => 'Sosyal Medya',
                'slug' => 'sosyal-medya',
                'description' => 'Instagram, TikTok, YouTube, Facebook hesap satışları',
                'icon' => 'fab fa-instagram',
                'color' => '#ec4899',
                'type' => 'service',
                'sort_order' => 5,
            ],
            [
                'name' => 'SEO & Pazarlama',
                'slug' => 'seo-pazarlama',
                'description' => 'SEO, Google Ads, sosyal medya pazarlama hizmetleri',
                'icon' => 'fas fa-chart-line',
                'color' => '#6366f1',
                'type' => 'service',
                'sort_order' => 6,
            ],
            [
                'name' => 'Grafik & Tasarım',
                'slug' => 'grafik-tasarim',
                'description' => 'Logo, banner, kartvizit, web tasarım hizmetleri',
                'icon' => 'fas fa-palette',
                'color' => '#ef4444',
                'type' => 'service',
                'sort_order' => 7,
            ],
            [
                'name' => 'Yazılım & Geliştirme',
                'slug' => 'yazilim-gelistirme',
                'description' => 'Web sitesi, mobil uygulama, bot geliştirme',
                'icon' => 'fas fa-laptop-code',
                'color' => '#06b6d4',
                'type' => 'service',
                'sort_order' => 8,
            ],
            [
                'name' => 'İçerik & Çeviri',
                'slug' => 'icerik-ceviri',
                'description' => 'Makale yazımı, çeviri, içerik üretimi hizmetleri',
                'icon' => 'fas fa-pen-fancy',
                'color' => '#84cc16',
                'type' => 'service',
                'sort_order' => 9,
            ],
            [
                'name' => 'Müzik & Ses',
                'slug' => 'muzik-ses',
                'description' => 'Ses kayıt, müzik prodüksiyon, seslendirme hizmetleri',
                'icon' => 'fas fa-music',
                'color' => '#f97316',
                'type' => 'service',
                'sort_order' => 10,
            ],
        ];

        foreach ($serviceCategories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                $category
            );
        }
    }
}