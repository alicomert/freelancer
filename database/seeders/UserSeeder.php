<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
        public function run(): void
    {
        DB::table('users')->truncate();
        // Test kullanıcıları oluştur
        $users = [
            [
                'first_name' => 'Ahmet',
                'last_name' => 'Yılmaz',
                'username' => 'ahmet_yilmaz',
                'email' => 'ahmet@example.com',
                'password' => Hash::make('password'),
                'title' => 'Full Stack Developer',
                'bio' => 'Laravel ve React konularında uzman, 5+ yıl deneyim.',

                'hourly_rate' => 150,
                'rating' => 4.8,
                'total_reviews' => 25,
                'completed_projects' => 45,
                'total_earned' => 125000,
                'status' => 'active',
                'is_verified' => true,
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'Zeynep',
                'last_name' => 'Kaya',
                'username' => 'zeynep_kaya',
                'email' => 'zeynep@example.com',
                'password' => Hash::make('password'),
                'title' => 'UI/UX Designer',
                'bio' => 'Modern ve kullanıcı dostu arayüz tasarımları.',
                'hourly_rate' => 120,
                'rating' => 4.9,
                'total_reviews' => 32,
                'completed_projects' => 38,
                'total_earned' => 95000,
                'status' => 'active',
                'is_verified' => true,
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'Mehmet',
                'last_name' => 'Özkan',
                'username' => 'mehmet_ozkan',
                'email' => 'mehmet@example.com',
                'password' => Hash::make('password'),
                'title' => 'Mobile App Developer',
                'bio' => 'iOS ve Android uygulama geliştirme uzmanı.',
                'hourly_rate' => 140,
                'rating' => 4.7,
                'total_reviews' => 18,
                'completed_projects' => 28,
                'total_earned' => 78000,
                'status' => 'active',
                'is_verified' => true,
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'Ayşe',
                'last_name' => 'Demir',
                'username' => 'ayse_demir',
                'email' => 'ayse@example.com',
                'password' => Hash::make('password'),
                'title' => 'Grafik Tasarımcı',
                'bio' => 'Yaratıcı ve etkileyici görsel tasarımlar.',
                'hourly_rate' => 100,
                'rating' => 4.6,
                'total_reviews' => 22,
                'completed_projects' => 35,
                'total_earned' => 65000,
                'status' => 'active',
                'is_verified' => true,
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'Can',
                'last_name' => 'Arslan',
                'username' => 'can_arslan',
                'email' => 'can@example.com',
                'password' => Hash::make('password'),
                'title' => 'DevOps Engineer',
                'bio' => 'Cloud ve deployment konularında uzman.',
                'hourly_rate' => 180,
                'rating' => 4.9,
                'total_reviews' => 15,
                'completed_projects' => 22,
                'total_earned' => 89000,
                'status' => 'active',
                'is_verified' => true,
                'email_verified_at' => now(),
            ],
            [
                'first_name' => 'Fatma',
                'last_name' => 'Şahin',
                'username' => 'fatma_sahin',
                'email' => 'fatma@example.com',
                'password' => Hash::make('password'),
                'title' => 'İçerik Yazarı',
                'bio' => 'SEO uyumlu ve etkileyici içerik üretimi.',
                'hourly_rate' => 80,
                'rating' => 4.5,
                'total_reviews' => 28,
                'completed_projects' => 42,
                'total_earned' => 52000,
                'status' => 'active',
                'is_verified' => true,
                'email_verified_at' => now(),
            ],
        ];

        foreach ($users as $userData) {
            User::create($userData);
        }
    }
}