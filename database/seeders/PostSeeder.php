<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        $posts = [
            [
                'title' => 'React.js ile Modern Web Uygulaması Geliştirme',
                'content' => 'React.js kullanarak modern ve responsive web uygulamaları geliştirme konusunda deneyimlerimi paylaşmak istiyorum. Hook\'lar, Context API ve performans optimizasyonu gibi konularda detaylı bilgiler...',
                'type' => 'article',
                'likes_count' => 45,
                'comments_count' => 12,
                'views_count' => 234,
                'is_featured' => true,
            ],
            [
                'title' => 'E-ticaret Sitesi Tasarımı - 5000₺ Bütçe',
                'content' => 'Modern ve kullanıcı dostu bir e-ticaret sitesi tasarımına ihtiyacım var. Responsive tasarım, ödeme entegrasyonu ve admin paneli dahil. Proje süresi 3 hafta.',
                'type' => 'project',
                'budget' => 5000.00,
                'likes_count' => 23,
                'comments_count' => 8,
                'views_count' => 156,
                'is_featured' => false,
            ],
            [
                'title' => 'Freelancer Olarak İlk Yılımda Öğrendiklerim',
                'content' => 'Freelancer olarak çalışmaya başladığımdan bu yana geçen bir yıl içinde edindiğim deneyimleri ve öğrendiklerimi sizlerle paylaşmak istiyorum. Müşteri ilişkileri, proje yönetimi ve fiyatlandırma konularında...',
                'type' => 'discussion',
                'likes_count' => 67,
                'comments_count' => 24,
                'views_count' => 445,
                'is_featured' => true,
            ],
            [
                'title' => 'Logo Tasarımı İçin Hangi Yazılımı Tercih Ediyorsunuz?',
                'content' => 'Logo tasarımı yaparken hangi yazılımları kullanıyorsunuz? Adobe Illustrator, Figma, Sketch veya başka alternatifler? Avantaj ve dezavantajlarını tartışalım.',
                'type' => 'poll',
                'likes_count' => 34,
                'comments_count' => 18,
                'views_count' => 289,
                'is_featured' => false,
            ],
            [
                'title' => 'Mobil Uygulama Geliştirme - Flutter vs React Native',
                'content' => 'Cross-platform mobil uygulama geliştirme için Flutter ve React Native arasında kararsız kalıyorum. Her ikisini de deneyimleyen arkadaşların görüşlerini almak istiyorum.',
                'type' => 'discussion',
                'likes_count' => 52,
                'comments_count' => 31,
                'views_count' => 378,
                'is_featured' => false,
            ],
            [
                'title' => 'WordPress Tema Özelleştirmesi - 2500₺',
                'content' => 'Mevcut WordPress temamızı özelleştirmek istiyoruz. Renk şeması değişikliği, yeni bölümler eklenmesi ve performans optimizasyonu gerekiyor.',
                'type' => 'project',
                'budget' => 2500.00,
                'likes_count' => 19,
                'comments_count' => 6,
                'views_count' => 123,
                'is_featured' => false,
            ],
            [
                'title' => 'UI/UX Tasarım Trendleri 2024',
                'content' => '2024 yılında öne çıkan UI/UX tasarım trendlerini inceledim. Minimalizm, dark mode, micro-interactions ve accessibility konularında güncel yaklaşımlar...',
                'type' => 'article',
                'likes_count' => 89,
                'comments_count' => 15,
                'views_count' => 567,
                'is_featured' => true,
            ],
            [
                'title' => 'Freelancer Topluluğu Discord Sunucusu',
                'content' => 'Freelancer arkadaşlarla bir araya gelebileceğimiz Discord sunucusu oluşturduk. Proje paylaşımları, networking ve yardımlaşma için herkesi bekliyoruz!',
                'type' => 'post',
                'likes_count' => 76,
                'comments_count' => 22,
                'views_count' => 334,
                'is_featured' => false,
            ],
            [
                'title' => 'Python ile Veri Analizi Projesi - 3500₺',
                'content' => 'E-ticaret verilerinin analizi için Python kullanarak dashboard oluşturulması gerekiyor. Pandas, Matplotlib ve Streamlit kullanılacak.',
                'type' => 'project',
                'budget' => 3500.00,
                'likes_count' => 28,
                'comments_count' => 9,
                'views_count' => 187,
                'is_featured' => false,
            ],
            [
                'title' => 'Grafik Tasarım Portfolyosu Nasıl Hazırlanır?',
                'content' => 'Grafik tasarımcılar için etkili bir portfolyo hazırlama rehberi. Hangi projeleri dahil etmeli, nasıl sunmalı ve dikkat edilmesi gereken noktalar...',
                'type' => 'article',
                'likes_count' => 43,
                'comments_count' => 11,
                'views_count' => 298,
                'is_featured' => false,
            ],
            [
                'title' => 'Blockchain Tabanlı Uygulama Geliştirme',
                'content' => 'DeFi protokolü için blockchain tabanlı uygulama geliştirme projesi. Solidity, Web3.js ve React kullanılacak. Deneyimli geliştiriciler arıyoruz.',
                'type' => 'project',
                'budget' => 8000.00,
                'likes_count' => 35,
                'comments_count' => 14,
                'views_count' => 245,
                'is_featured' => true,
            ],
            [
                'title' => 'Freelancer Vergi Rehberi 2024',
                'content' => 'Freelancer olarak çalışırken vergi yükümlülüklerinizi nasıl yerine getirirsiniz? 2024 yılı için güncel vergi rehberi ve önemli değişiklikler...',
                'type' => 'article',
                'likes_count' => 92,
                'comments_count' => 28,
                'views_count' => 623,
                'is_featured' => true,
            ],
        ];

        $typeMap = [
            'post' => 1,
            'service' => 2,
            'auction' => 3,
            'poll' => 4,
            'portfolio' => 5,
            'article' => 6,
            'question' => 7
        ];

        foreach ($posts as $postData) {
            $title = $postData['title'];
            $slug = \Str::slug($title) . '-' . \Str::random(6);
            
            Post::create([
                'uuid' => \Str::uuid(),
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,
                'post_type' => $typeMap[$postData['type']] ?? 1,
                'title' => $title,
                'slug' => $slug,
                'content' => $postData['content'],
                'excerpt' => \Str::limit($postData['content'], 200),
                'status' => 1, // active
                'likes_count' => $postData['likes_count'],
                'comments_count' => $postData['comments_count'],
                'views_count' => $postData['views_count'],
                'is_featured' => $postData['is_featured'],
                'published_at' => now()->subDays(rand(1, 30)),
                'created_at' => now()->subDays(rand(1, 30)),
                'updated_at' => now()->subDays(rand(1, 30)),
            ]);
        }
    }
}