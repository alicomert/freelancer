<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
        public function run(): void
    {
        $categories = [
            [
                'name' => 'Web Geliştirme',
                'slug' => 'web-gelistirme',
                'description' => 'Website, web uygulaması ve e-ticaret projeleri',
                'icon' => 'fas fa-code',
                'color' => '#3b82f6',
                'sort_order' => 1
            ],
            [
                'name' => 'Mobil Uygulama',
                'slug' => 'mobil-uygulama',
                'description' => 'iOS, Android ve hibrit mobil uygulamalar',
                'icon' => 'fas fa-mobile-alt',
                'color' => '#10b981',
                'sort_order' => 2
            ],
            [
                'name' => 'Grafik Tasarım',
                'slug' => 'grafik-tasarim',
                'description' => 'Logo, afiş, broşür ve görsel tasarım işleri',
                'icon' => 'fas fa-palette',
                'color' => '#f59e0b',
                'sort_order' => 3
            ],
            [
                'name' => 'UI/UX Tasarım',
                'slug' => 'ui-ux-tasarim',
                'description' => 'Kullanıcı arayüzü ve deneyim tasarımı',
                'icon' => 'fas fa-paint-brush',
                'color' => '#8b5cf6',
                'sort_order' => 4
            ],
            [
                'name' => 'İçerik Yazımı',
                'slug' => 'icerik-yazimi',
                'description' => 'Blog yazısı, makale ve SEO içerik yazımı',
                'icon' => 'fas fa-pen',
                'color' => '#ef4444',
                'sort_order' => 5
            ],
            [
                'name' => 'Dijital Pazarlama',
                'slug' => 'dijital-pazarlama',
                'description' => 'SEO, SEM, sosyal medya pazarlama',
                'icon' => 'fas fa-chart-line',
                'color' => '#06b6d4',
                'sort_order' => 6
            ],
            [
                'name' => 'Video Düzenleme',
                'slug' => 'video-duzenleme',
                'description' => 'Video montaj, animasyon ve post-prodüksiyon',
                'icon' => 'fas fa-video',
                'color' => '#ec4899',
                'sort_order' => 7
            ],
            [
                'name' => 'Çeviri',
                'slug' => 'ceviri',
                'description' => 'Profesyonel çeviri ve lokalizasyon hizmetleri',
                'icon' => 'fas fa-language',
                'color' => '#84cc16',
                'sort_order' => 8
            ],
            [
                'name' => 'Veri Girişi',
                'slug' => 'veri-girisi',
                'description' => 'Veri girişi, araştırma ve analiz işleri',
                'icon' => 'fas fa-database',
                'color' => '#6366f1',
                'sort_order' => 9
            ],
            [
                'name' => 'Müzik & Ses',
                'slug' => 'muzik-ses',
                'description' => 'Ses kayıt, düzenleme ve müzik prodüksiyonu',
                'icon' => 'fas fa-music',
                'color' => '#f97316',
                'sort_order' => 10
            ]
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']],
                array_merge($category, [
                    'type' => 'service',
                    'is_active' => true
                ])
            );
        }
    }
}