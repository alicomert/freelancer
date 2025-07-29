<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class ProjectCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $projectCategories = [
            // 1. Grafik & Tasarım
            [
                'name' => 'Grafik & Tasarım',
                'description' => 'Görsel tasarım ve grafik çalışmaları',
                'icon' => 'palette',
                'color' => '#e83e8c',
                'is_parent' => true
            ],
            [
                'name' => 'Marka & Kimlik Tasarımı',
                'description' => 'Logo, Kartvizit, Kurumsal Kimlik',
                'icon' => 'award',
                'color' => '#e83e8c',
                'parent_name' => 'Grafik & Tasarım'
            ],
            [
                'name' => 'Basılı Materyal',
                'description' => 'Broşür, Katalog, Davetiye',
                'icon' => 'printer',
                'color' => '#e83e8c',
                'parent_name' => 'Grafik & Tasarım'
            ],
            [
                'name' => 'Dijital Tasarım',
                'description' => 'UI/UX, Sosyal Medya, Banner/Reklam',
                'icon' => 'monitor',
                'color' => '#e83e8c',
                'parent_name' => 'Grafik & Tasarım'
            ],
            [
                'name' => 'İllüstrasyon & Çizim',
                'description' => 'Karikatür, Karakalem, Oyun Sanatı',
                'icon' => 'edit-3',
                'color' => '#e83e8c',
                'parent_name' => 'Grafik & Tasarım'
            ],
            [
                'name' => 'Fotoğraf & Görsel Düzenleme',
                'description' => 'Fotoğraf İşleme, Retouch',
                'icon' => 'camera',
                'color' => '#e83e8c',
                'parent_name' => 'Grafik & Tasarım'
            ],
            [
                'name' => 'Diğer Tasarım',
                'description' => 'Diğer tasarım hizmetleri',
                'icon' => 'more-horizontal',
                'color' => '#e83e8c',
                'parent_name' => 'Grafik & Tasarım'
            ],

            // 2. İnternet Reklamcılığı
            [
                'name' => 'İnternet Reklamcılığı',
                'description' => 'Dijital pazarlama ve reklam hizmetleri',
                'icon' => 'trending-up',
                'color' => '#17a2b8',
                'is_parent' => true
            ],
            [
                'name' => 'SEO & Analitik',
                'description' => 'Arama Motoru Optimizasyonu, Web Analytics',
                'icon' => 'search',
                'color' => '#17a2b8',
                'parent_name' => 'İnternet Reklamcılığı'
            ],
            [
                'name' => 'Sosyal Medya & Influencer',
                'description' => 'Yönetim, Kampanya',
                'icon' => 'share-2',
                'color' => '#17a2b8',
                'parent_name' => 'İnternet Reklamcılığı'
            ],
            [
                'name' => 'Reklam Yönetimi',
                'description' => 'Display, Mobil Reklam',
                'icon' => 'target',
                'color' => '#17a2b8',
                'parent_name' => 'İnternet Reklamcılığı'
            ],
            [
                'name' => 'Pazarlama Stratejisi',
                'description' => 'Genel Danışmanlık, Diğer',
                'icon' => 'compass',
                'color' => '#17a2b8',
                'parent_name' => 'İnternet Reklamcılığı'
            ],

            // 3. Yazı & Çeviri
            [
                'name' => 'Yazı & Çeviri',
                'description' => 'İçerik yazarlığı ve çeviri hizmetleri',
                'icon' => 'edit',
                'color' => '#6610f2',
                'is_parent' => true
            ],
            [
                'name' => 'İçerik Yazarlığı',
                'description' => 'Web, Senaryo, Yaratıcı Metin',
                'icon' => 'file-text',
                'color' => '#6610f2',
                'parent_name' => 'Yazı & Çeviri'
            ],
            [
                'name' => 'Çeviri & Düzenleme',
                'description' => 'Çeviri, Redaksiyon',
                'icon' => 'globe',
                'color' => '#6610f2',
                'parent_name' => 'Yazı & Çeviri'
            ],
            [
                'name' => 'Pazarlama Metinleri',
                'description' => 'Basın Bülteni, Marka Slogan',
                'icon' => 'megaphone',
                'color' => '#6610f2',
                'parent_name' => 'Yazı & Çeviri'
            ],
            [
                'name' => 'Profesyonel Belgeler',
                'description' => 'CV, Ön Yazı',
                'icon' => 'briefcase',
                'color' => '#6610f2',
                'parent_name' => 'Yazı & Çeviri'
            ],
            [
                'name' => 'Diğer Yazı & Çeviri',
                'description' => 'Diğer yazı ve çeviri hizmetleri',
                'icon' => 'more-horizontal',
                'color' => '#6610f2',
                'parent_name' => 'Yazı & Çeviri'
            ],

            // 4. Video & Animasyon
            [
                'name' => 'Video & Animasyon',
                'description' => 'Video prodüksiyon ve animasyon hizmetleri',
                'icon' => 'video',
                'color' => '#fd7e14',
                'is_parent' => true
            ],
            [
                'name' => 'Prodüksiyon & Çekim',
                'description' => 'Video Çekim, Prodüksiyon',
                'icon' => 'camera',
                'color' => '#fd7e14',
                'parent_name' => 'Video & Animasyon'
            ],
            [
                'name' => 'Kurgu & Post‑Prodüksiyon',
                'description' => 'Montaj, Color Grading',
                'icon' => 'film',
                'color' => '#fd7e14',
                'parent_name' => 'Video & Animasyon'
            ],
            [
                'name' => 'Animasyon & Hareketli Grafik',
                'description' => '2D/3D, Introlar',
                'icon' => 'zap',
                'color' => '#fd7e14',
                'parent_name' => 'Video & Animasyon'
            ],
            [
                'name' => 'Reklam & Tanıtım Videoları',
                'description' => 'Reklam ve tanıtım videoları',
                'icon' => 'play-circle',
                'color' => '#fd7e14',
                'parent_name' => 'Video & Animasyon'
            ],
            [
                'name' => 'Özel Gün & İçerik Videoları',
                'description' => 'Özel gün ve içerik videoları',
                'icon' => 'heart',
                'color' => '#fd7e14',
                'parent_name' => 'Video & Animasyon'
            ],
            [
                'name' => 'Diğer Video',
                'description' => 'Diğer video hizmetleri',
                'icon' => 'more-horizontal',
                'color' => '#fd7e14',
                'parent_name' => 'Video & Animasyon'
            ],

            // 5. Ses & Müzik
            [
                'name' => 'Ses & Müzik',
                'description' => 'Ses prodüksiyon ve müzik hizmetleri',
                'icon' => 'music',
                'color' => '#20c997',
                'is_parent' => true
            ],
            [
                'name' => 'Ses Prodüksiyon',
                'description' => 'Jingle, Mix & Mastering',
                'icon' => 'mic',
                'color' => '#20c997',
                'parent_name' => 'Ses & Müzik'
            ],
            [
                'name' => 'Seslendirme & Podcast',
                'description' => 'Seslendirme ve podcast hizmetleri',
                'icon' => 'radio',
                'color' => '#20c997',
                'parent_name' => 'Ses & Müzik'
            ],
            [
                'name' => 'Beste & Müzik Yazarlığı',
                'description' => 'Beste ve müzik yazarlığı',
                'icon' => 'music',
                'color' => '#20c997',
                'parent_name' => 'Ses & Müzik'
            ],
            [
                'name' => 'Diğer Ses & Müzik',
                'description' => 'Diğer ses ve müzik hizmetleri',
                'icon' => 'more-horizontal',
                'color' => '#20c997',
                'parent_name' => 'Ses & Müzik'
            ],

            // 6. Yazılım & Teknoloji
            [
                'name' => 'Yazılım & Teknoloji',
                'description' => 'Yazılım geliştirme ve teknoloji hizmetleri',
                'icon' => 'code',
                'color' => '#28a745',
                'is_parent' => true
            ],
            [
                'name' => 'Web & Mobil Geliştirme',
                'description' => 'Web Yazılım, CMS/WordPress, Mobil Uygulama',
                'icon' => 'smartphone',
                'color' => '#28a745',
                'parent_name' => 'Yazılım & Teknoloji'
            ],
            [
                'name' => 'E‑ticaret & Oyun',
                'description' => 'Online Mağaza, Oyun Geliştirme',
                'icon' => 'shopping-cart',
                'color' => '#28a745',
                'parent_name' => 'Yazılım & Teknoloji'
            ],
            [
                'name' => 'Altyapı & Barındırma',
                'description' => 'Server Kurulum, Domain/Hosting',
                'icon' => 'server',
                'color' => '#28a745',
                'parent_name' => 'Yazılım & Teknoloji'
            ],
            [
                'name' => 'Veri & Test',
                'description' => 'Data Analizi, Kullanıcı Testleri',
                'icon' => 'database',
                'color' => '#28a745',
                'parent_name' => 'Yazılım & Teknoloji'
            ],
            [
                'name' => 'Destek & Eğitim',
                'description' => 'Teknik Destek, Dersler/Q&A',
                'icon' => 'help-circle',
                'color' => '#28a745',
                'parent_name' => 'Yazılım & Teknoloji'
            ],
            [
                'name' => 'Diğer Teknoloji',
                'description' => 'Diğer teknoloji hizmetleri',
                'icon' => 'more-horizontal',
                'color' => '#28a745',
                'parent_name' => 'Yazılım & Teknoloji'
            ],

            // 7. İş & Yönetim
            [
                'name' => 'İş & Yönetim',
                'description' => 'İş danışmanlığı ve yönetim hizmetleri',
                'icon' => 'briefcase',
                'color' => '#6f42c1',
                'is_parent' => true
            ],
            [
                'name' => 'Danışmanlık & Strateji',
                'description' => 'Marka, İş Geliştirme',
                'icon' => 'compass',
                'color' => '#6f42c1',
                'parent_name' => 'İş & Yönetim'
            ],
            [
                'name' => 'İdari & Ofis Desteği',
                'description' => 'Sanal Asistan, Veri Girişi, Excel',
                'icon' => 'file-text',
                'color' => '#6f42c1',
                'parent_name' => 'İş & Yönetim'
            ],
            [
                'name' => 'Pazarlama & Satış',
                'description' => 'Pazar Araştırma, Müşteri Bulma',
                'icon' => 'trending-up',
                'color' => '#6f42c1',
                'parent_name' => 'İş & Yönetim'
            ],
            [
                'name' => 'Diğer İş & Yönetim',
                'description' => 'Diğer iş ve yönetim hizmetleri',
                'icon' => 'more-horizontal',
                'color' => '#6f42c1',
                'parent_name' => 'İş & Yönetim'
            ]
        ];

        foreach ($projectCategories as $index => $categoryData) {
            $slug = Str::slug($categoryData['name']);
            
            // Kategori zaten var mı kontrol et
            $existingCategory = Category::where('slug', $slug)->first();
            
            if (!$existingCategory) {
                Category::create([
                    'name' => $categoryData['name'],
                    'slug' => $slug,
                    'description' => $categoryData['description'],
                    'icon' => $categoryData['icon'],
                    'color' => $categoryData['color'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'category_type' => 'project'
                ]);
                
                echo "Proje kategorisi eklendi: " . $categoryData['name'] . "\n";
            } else {
                echo "Kategori zaten mevcut: " . $categoryData['name'] . "\n";
            }
        }
    }
}
