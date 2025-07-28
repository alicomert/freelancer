<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use App\Models\Category;
use App\Models\User;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Hizmet kategorilerini al
        $hostingCategory = Category::where('slug', 'hosting-vps')->first();
        $accountCategory = Category::where('slug', 'hesap-lisans')->first();
        $gameCategory = Category::where('slug', 'e-pin-oyun')->first();
        $scriptCategory = Category::where('slug', 'script-tema')->first();
        $socialCategory = Category::where('slug', 'sosyal-medya')->first();

        // Test kullanıcısı oluştur (eğer yoksa)
        $user = User::first() ?? User::factory()->create([
            'name' => 'Test Satıcı',
            'email' => 'test@example.com'
        ]);

        $services = [
            [
                'user_id' => $user->id,
                'category_id' => $hostingCategory?->id ?? 1,
                'title' => 'Premium VPS Hosting - 4GB RAM',
                'description' => 'Yüksek performanslı VPS hosting hizmeti. 4GB RAM, 80GB SSD, unlimited bandwidth. 99.9% uptime garantisi ile profesyonel hosting çözümü.',
                'price' => 299.00,
                'original_price' => 599.00,
                'delivery_time' => 'Anında',
                'icon' => 'fas fa-server',
                'color' => '#3b82f6',
                'is_featured' => true,
                'is_auto_delivery' => false,
                'sales_count' => 89,
                'rating' => 4.9,
                'review_count' => 127,
                'badges' => ['featured']
            ],
            [
                'user_id' => $user->id,
                'category_id' => $accountCategory?->id ?? 1,
                'title' => 'ChatGPT Plus Hesabı - 1 Aylık',
                'description' => 'Orijinal ChatGPT Plus hesabı. GPT-4 erişimi, öncelikli yanıt süresi, yeni özellikler dahil. Hesap bilgileri anında teslim edilir.',
                'price' => 89.00,
                'original_price' => null,
                'delivery_time' => 'Anında',
                'icon' => 'fas fa-key',
                'color' => '#10b981',
                'is_featured' => true,
                'is_auto_delivery' => false,
                'sales_count' => 156,
                'rating' => 4.8,
                'review_count' => 234,
                'badges' => ['featured']
            ],
            [
                'user_id' => $user->id,
                'category_id' => $gameCategory?->id ?? 1,
                'title' => 'Steam Cüzdan Kodu - 100 TL',
                'description' => 'Orijinal Steam cüzdan kodu. Anında teslimat, güvenli ödeme. Tüm Steam oyunları ve içerikleri için kullanılabilir.',
                'price' => 95.00,
                'original_price' => null,
                'delivery_time' => 'Anında',
                'icon' => 'fas fa-gamepad',
                'color' => '#8b5cf6',
                'is_featured' => false,
                'is_auto_delivery' => true,
                'sales_count' => 278,
                'rating' => 4.9,
                'review_count' => 445,
                'badges' => ['auto_delivery']
            ],
            [
                'user_id' => $user->id,
                'category_id' => $scriptCategory?->id ?? 1,
                'title' => 'WordPress E-Ticaret Teması + Kurulum',
                'description' => 'Profesyonel e-ticaret teması, kurulum ve temel konfigürasyon dahil. WooCommerce uyumlu, responsive tasarım, SEO optimizasyonu.',
                'price' => 499.00,
                'original_price' => null,
                'delivery_time' => '1-2 gün',
                'icon' => 'fas fa-code',
                'color' => '#f59e0b',
                'is_featured' => false,
                'is_auto_delivery' => false,
                'sales_count' => 45,
                'rating' => 4.7,
                'review_count' => 89,
                'badges' => ['category']
            ],
            [
                'user_id' => $user->id,
                'category_id' => $socialCategory?->id ?? 1,
                'title' => 'Instagram Hesabı - 50K Takipçi',
                'description' => 'Organik takipçili Instagram hesabı. Aktif kullanıcılar, yüksek etkileşim oranı. Lifestyle nişinde, kadın takipçi ağırlıklı.',
                'price' => 2499.00,
                'original_price' => null,
                'delivery_time' => '1-3 gün',
                'icon' => 'fab fa-instagram',
                'color' => '#ec4899',
                'is_featured' => false,
                'is_auto_delivery' => false,
                'sales_count' => 23,
                'rating' => 4.6,
                'review_count' => 67,
                'badges' => ['trend']
            ]
        ];

        foreach ($services as $serviceData) {
            Service::create($serviceData);
        }
    }
}