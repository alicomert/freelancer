<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;
use App\Models\Category;
use Illuminate\Support\Str;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $categories = Category::all();

        if ($users->isEmpty() || $categories->isEmpty()) {
            $this->command->warn('Users veya Categories tablosu boş. Önce UserSeeder ve CategorySeeder çalıştırın.');
            return;
        }

        $projects = [
            [
                'title' => 'E-ticaret Web Sitesi Geliştirilmesi',
                'description' => 'Modern ve responsive bir e-ticaret sitesi geliştirmek istiyoruz. Laravel backend, React frontend kullanılacak. Ödeme entegrasyonu, admin paneli ve mobil uyumlu tasarım gerekli.',
                'budget_min' => 15000,
                'budget_max' => 25000,
                'deadline' => now()->addDays(45),
                'skills' => ['Laravel', 'React', 'MySQL', 'Payment Integration', 'Responsive Design'],
                'status' => 'active',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'web-gelistirme')->first()?->id ?? 1,
            ],
            [
                'title' => 'Mobil Uygulama UI/UX Tasarımı',
                'description' => 'Fitness uygulaması için modern ve kullanıcı dostu arayüz tasarımı. Figma\'da tasarım, prototip ve kullanıcı deneyimi optimizasyonu.',
                'budget_min' => 8000,
                'budget_max' => 12000,
                'deadline' => now()->addDays(30),
                'skills' => ['Figma', 'UI/UX Design', 'Mobile Design', 'Prototyping'],
                'status' => 'active',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'grafik-tasarim')->first()?->id ?? 2,
            ],
            [
                'title' => 'React Native Mobil Uygulama',
                'description' => 'Sosyal medya uygulaması geliştirilmesi. Real-time messaging, fotoğraf paylaşımı, kullanıcı profilleri ve bildirim sistemi.',
                'budget_min' => 20000,
                'budget_max' => 35000,
                'deadline' => now()->addDays(60),
                'skills' => ['React Native', 'Firebase', 'Real-time', 'Push Notifications'],
                'status' => 'active',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'mobil-uygulama')->first()?->id ?? 3,
            ],
            [
                'title' => 'Kurumsal Logo ve Kimlik Tasarımı',
                'description' => 'Teknoloji şirketi için profesyonel logo, kartvizit, antetli kağıt ve kurumsal kimlik tasarımı. Modern ve minimal yaklaşım.',
                'budget_min' => 3000,
                'budget_max' => 5000,
                'deadline' => now()->addDays(20),
                'skills' => ['Logo Design', 'Brand Identity', 'Adobe Illustrator', 'Corporate Design'],
                'status' => 'active',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'grafik-tasarim')->first()?->id ?? 2,
            ],
            [
                'title' => 'WordPress Blog Sitesi',
                'description' => 'Kişisel blog sitesi için WordPress teması özelleştirmesi. SEO optimizasyonu, hız optimizasyonu ve responsive tasarım.',
                'budget_min' => 4000,
                'budget_max' => 7000,
                'deadline' => now()->addDays(25),
                'skills' => ['WordPress', 'PHP', 'SEO', 'Page Speed Optimization'],
                'status' => 'active',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'web-gelistirme')->first()?->id ?? 1,
            ],
            [
                'title' => 'İçerik Yazarlığı - Blog Makaleleri',
                'description' => 'Teknoloji blogu için haftalık 3 makale yazımı. SEO uyumlu, özgün içerik üretimi. Minimum 1000 kelime.',
                'budget_min' => 2000,
                'budget_max' => 3000,
                'deadline' => now()->addDays(30),
                'skills' => ['Content Writing', 'SEO Writing', 'Technology', 'Blog Writing'],
                'status' => 'active',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'icerik-yazarligi')->first()?->id ?? 4,
            ],
            [
                'title' => 'API Geliştirme ve Entegrasyon',
                'description' => 'Mevcut sisteme üçüncü parti API entegrasyonları. Payment gateway, SMS servisi ve email marketing entegrasyonu.',
                'budget_min' => 10000,
                'budget_max' => 15000,
                'deadline' => now()->addDays(35),
                'skills' => ['API Development', 'Laravel', 'Third-party Integration', 'Payment Gateway'],
                'status' => 'active',
                'is_featured' => true,
                'category_id' => $categories->where('slug', 'web-gelistirme')->first()?->id ?? 1,
            ],
            [
                'title' => 'Video Düzenleme ve Montaj',
                'description' => 'YouTube kanalı için haftalık video düzenleme. Intro/outro ekleme, ses düzenleme, renk düzeltme ve efekt ekleme.',
                'budget_min' => 1500,
                'budget_max' => 2500,
                'deadline' => now()->addDays(15),
                'skills' => ['Video Editing', 'Adobe Premiere', 'After Effects', 'Color Grading'],
                'status' => 'active',
                'is_featured' => false,
                'category_id' => $categories->where('slug', 'video-animasyon')->first()?->id ?? 5,
            ],
        ];

        foreach ($projects as $index => $projectData) {
            $projectData['user_id'] = $users->random()->id;
            $projectData['slug'] = Str::slug($projectData['title']) . '-' . time() . '-' . $index;
            $projectData['views_count'] = rand(10, 500);
            $projectData['proposals_count'] = rand(0, 15);
            
            Project::create($projectData);
        }
    }
}