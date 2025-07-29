<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class ForumCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $forumCategories = [
            [
                'name' => 'Google ve Arama Motorları',
                'description' => 'Google, Bing, Yandex ve diğer arama motorları hakkında tartışmalar',
                'icon' => 'search',
                'color' => '#4285F4',
                'sort_order' => 1
            ],
            [
                'name' => 'Yazılım ve Geliştirici Dünyası',
                'description' => 'Yazılım geliştirme, programlama dilleri ve teknolojiler',
                'icon' => 'code',
                'color' => '#28a745',
                'sort_order' => 2
            ],
            [
                'name' => 'SEO Hizmetleri',
                'description' => 'Arama motoru optimizasyonu ve SEO stratejileri',
                'icon' => 'trending-up',
                'color' => '#17a2b8',
                'sort_order' => 3
            ],
            [
                'name' => 'Sosyal Medya',
                'description' => 'Facebook, Instagram, Twitter ve diğer sosyal medya platformları',
                'icon' => 'share-2',
                'color' => '#e83e8c',
                'sort_order' => 4
            ],
            [
                'name' => 'Soru & Cevap',
                'description' => 'Genel sorular ve cevaplar',
                'icon' => 'help-circle',
                'color' => '#6f42c1',
                'sort_order' => 5
            ],
            [
                'name' => 'E-Ticaret & Alışveriş',
                'description' => 'Online alışveriş, e-ticaret platformları ve stratejileri',
                'icon' => 'shopping-cart',
                'color' => '#fd7e14',
                'sort_order' => 6
            ],
            [
                'name' => 'Kripto Paralar',
                'description' => 'Bitcoin, Ethereum ve diğer kripto paralar',
                'icon' => 'dollar-sign',
                'color' => '#ffc107',
                'sort_order' => 7
            ],
            [
                'name' => 'Para Kazanma - İş Fikirleri & Girişimcilik',
                'description' => 'Online para kazanma yolları ve girişimcilik',
                'icon' => 'trending-up',
                'color' => '#20c997',
                'sort_order' => 8
            ],
            [
                'name' => 'İçerik & Makale Hizmetleri',
                'description' => 'İçerik yazımı, makale hizmetleri ve editörlük',
                'icon' => 'edit',
                'color' => '#6610f2',
                'sort_order' => 9
            ],
            [
                'name' => 'Domain Alım & Satım',
                'description' => 'Domain alım satım ve yatırım stratejileri',
                'icon' => 'globe',
                'color' => '#e83e8c',
                'sort_order' => 10
            ],
            [
                'name' => 'Grafik & Tasarım',
                'description' => 'Logo tasarım, grafik tasarım ve görsel içerik',
                'icon' => 'image',
                'color' => '#fd7e14',
                'sort_order' => 11
            ],
            [
                'name' => 'Sunucu & Web Hosting',
                'description' => 'Web hosting, VPS, sunucu yönetimi',
                'icon' => 'server',
                'color' => '#6c757d',
                'sort_order' => 12
            ],
            [
                'name' => 'WordPress Genel',
                'description' => 'WordPress tema, eklenti ve geliştirme',
                'icon' => 'wordpress',
                'color' => '#21759b',
                'sort_order' => 13
            ],
            [
                'name' => 'Webmaster Genel',
                'description' => 'Web yönetimi, site optimizasyonu ve webmaster araçları',
                'icon' => 'tool',
                'color' => '#495057',
                'sort_order' => 14
            ],
            [
                'name' => 'İnternet ve GSM Operatörleri - Dijital Platformlar',
                'description' => 'İnternet sağlayıcıları, GSM operatörleri ve dijital hizmetler',
                'icon' => 'wifi',
                'color' => '#007bff',
                'sort_order' => 15
            ],
            [
                'name' => 'Mobil Dünyası',
                'description' => 'Mobil uygulamalar, iOS, Android geliştirme',
                'icon' => 'smartphone',
                'color' => '#28a745',
                'sort_order' => 16
            ],
            [
                'name' => 'Genel Programlama - Yazılım',
                'description' => 'Programlama dilleri, yazılım geliştirme ve algoritma',
                'icon' => 'code',
                'color' => '#17a2b8',
                'sort_order' => 17
            ],
            [
                'name' => 'Teknoloji - Oyun - Donanım',
                'description' => 'Teknoloji haberleri, oyunlar ve donanım incelemeleri',
                'icon' => 'cpu',
                'color' => '#dc3545',
                'sort_order' => 18
            ],
            [
                'name' => 'Gündem & Off-Topic',
                'description' => 'Güncel konular ve genel sohbet',
                'icon' => 'message-circle',
                'color' => '#6c757d',
                'sort_order' => 19
            ],
            [
                'name' => 'Şikayet & Teşekkür',
                'description' => 'Şikayetler, teşekkürler ve geri bildirimler',
                'icon' => 'message-square',
                'color' => '#ffc107',
                'sort_order' => 20
            ]
        ];

        foreach ($forumCategories as $index => $categoryData) {
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
                    'sort_order' => $categoryData['sort_order'],
                    'category_type' => 'general'
                ]);
                
                echo "Forum kategorisi eklendi: " . $categoryData['name'] . "\n";
            } else {
                echo "Kategori zaten mevcut: " . $categoryData['name'] . "\n";
            }
        }
    }
}
