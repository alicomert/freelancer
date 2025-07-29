<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use Illuminate\Support\Str;

class PortfolioFreelanceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Grafik & Tasarım',
                'icon' => 'fas fa-palette',
                'color' => '#e74c3c',
                'subcategories' => [
                    'Marka & Kimlik Tasarımı (Logo, Kartvizit, Kurumsal Kimlik)',
                    'Basılı Materyal (Broşür, Katalog, Davetiye)',
                    'Dijital Tasarım (UI/UX, Sosyal Medya, Banner/Reklam)',
                    'İllüstrasyon & Çizim (Karikatür, Karakalem, Oyun Sanatı)',
                    'Fotoğraf & Görsel Düzenleme (Fotoğraf İşleme, Retouch)',
                    'Diğer Tasarım'
                ]
            ],
            [
                'name' => 'İnternet Reklamcılığı',
                'icon' => 'fas fa-bullhorn',
                'color' => '#3498db',
                'subcategories' => [
                    'SEO & Analitik (Arama Motoru Optimizasyonu, Web Analytics)',
                    'Sosyal Medya & Influencer (Yönetim, Kampanya)',
                    'Reklam Yönetimi (Display, Mobil Reklam)',
                    'Pazarlama Stratejisi (Genel Danışmanlık, Diğer)'
                ]
            ],
            [
                'name' => 'Yazı & Çeviri',
                'icon' => 'fas fa-pen',
                'color' => '#9b59b6',
                'subcategories' => [
                    'İçerik Yazarlığı (Web, Senaryo, Yaratıcı Metin)',
                    'Çeviri & Düzenleme (Çeviri, Redaksiyon)',
                    'Pazarlama Metinleri (Basın Bülteni, Marka Slogan)',
                    'Profesyonel Belgeler (CV, Ön Yazı)',
                    'Diğer Yazı & Çeviri'
                ]
            ],
            [
                'name' => 'Video & Animasyon',
                'icon' => 'fas fa-video',
                'color' => '#e67e22',
                'subcategories' => [
                    'Prodüksiyon & Çekim (Video Çekim, Prodüksiyon)',
                    'Kurgu & Post‑Prodüksiyon (Montaj, Color Grading)',
                    'Animasyon & Hareketli Grafik (2D/3D, Introlar)',
                    'Reklam & Tanıtım Videoları',
                    'Özel Gün & İçerik Videoları',
                    'Diğer Video'
                ]
            ],
            [
                'name' => 'Ses & Müzik',
                'icon' => 'fas fa-music',
                'color' => '#1abc9c',
                'subcategories' => [
                    'Ses Prodüksiyon (Jingle, Mix & Mastering)',
                    'Seslendirme & Podcast',
                    'Beste & Müzik Yazarlığı',
                    'Diğer Ses & Müzik'
                ]
            ],
            [
                'name' => 'Yazılım & Teknoloji',
                'icon' => 'fas fa-code',
                'color' => '#2ecc71',
                'subcategories' => [
                    'Web & Mobil Geliştirme (Web Yazılım, CMS/WordPress, Mobil Uygulama)',
                    'E‑ticaret & Oyun (Online Mağaza, Oyun Geliştirme)',
                    'Altyapı & Barındırma (Server Kurulum, Domain/Hosting)',
                    'Veri & Test (Data Analizi, Kullanıcı Testleri)',
                    'Destek & Eğitim (Teknik Destek, Dersler/Q&A)',
                    'Diğer Teknoloji'
                ]
            ],
            [
                'name' => 'İş & Yönetim',
                'icon' => 'fas fa-briefcase',
                'color' => '#34495e',
                'subcategories' => [
                    'Danışmanlık & Strateji (Marka, İş Geliştirme)',
                    'İdari & Ofis Desteği (Sanal Asistan, Veri Girişi, Excel)',
                    'Pazarlama & Satış (Pazar Araştırma, Müşteri Bulma)',
                    'Diğer İş & Yönetim'
                ]
            ]
        ];

        foreach ($categories as $index => $categoryData) {
            // Ana kategoriyi kontrol et veya oluştur
            $slug = Str::slug($categoryData['name']);
            $parentCategory = Category::where('slug', $slug)->first();

            if (!$parentCategory) {
                $parentCategory = Category::create([
                    'name' => $categoryData['name'],
                    'slug' => $slug,
                    'description' => $categoryData['name'] . ' kategorisi',
                    'icon' => $categoryData['icon'],
                    'color' => $categoryData['color'],
                    'is_active' => true,
                    'sort_order' => $index + 1,
                    'category_type' => 'portfolio',
                    'parent_id' => null,
                ]);
            } else {
                // Mevcut kategoriyi güncelle
                $parentCategory->update([
                    'category_type' => 'portfolio',
                    'parent_id' => null,
                ]);
            }

            // Alt kategorileri kontrol et ve oluştur
            foreach ($categoryData['subcategories'] as $subIndex => $subcategoryName) {
                $subSlug = Str::slug($subcategoryName);
                $existingSubcategory = Category::where('slug', $subSlug)->first();

                if (!$existingSubcategory) {
                    Category::create([
                        'name' => $subcategoryName,
                        'slug' => $subSlug,
                        'description' => $subcategoryName . ' alt kategorisi',
                        'icon' => 'fas fa-tag',
                        'color' => '#95a5a6',
                        'is_active' => true,
                        'sort_order' => $subIndex + 1,
                        'category_type' => 'portfolio',
                        'parent_id' => $parentCategory->id,
                    ]);
                } else {
                    // Mevcut alt kategoriyi güncelle
                    $existingSubcategory->update([
                        'category_type' => 'portfolio',
                        'parent_id' => $parentCategory->id,
                    ]);
                }
            }
        }
    }
}
