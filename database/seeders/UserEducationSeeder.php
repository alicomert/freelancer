<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\UserEducation;
use App\Models\User;

class UserEducationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // ahmet_yilmaz kullanıcısı için eğitim verileri
        $user = User::where('username', 'ahmet_yilmaz')->first();
        
        if ($user) {
            UserEducation::create([
                'user_id' => $user->id,
                'education_name' => 'Bilgisayar Mühendisliği',
                'institution' => 'İstanbul Teknik Üniversitesi',
                'start_year' => '2014',
                'end_year' => '2018',
                'document_link' => 'https://example.com/diploma.pdf',
                'link_access' => 1 // Onaylandı
            ]);

            UserEducation::create([
                'user_id' => $user->id,
                'education_name' => 'Yazılım Geliştirme Sertifikası',
                'institution' => 'Google Developer Certification',
                'start_year' => '2019',
                'end_year' => '2019',
                'document_link' => 'https://example.com/google-cert.pdf',
                'link_access' => 0 // Onay bekliyor
            ]);

            UserEducation::create([
                'user_id' => $user->id,
                'education_name' => 'AWS Cloud Practitioner',
                'institution' => 'Amazon Web Services',
                'start_year' => '2020',
                'end_year' => '2020',
                'document_link' => 'https://example.com/aws-cert.pdf',
                'link_access' => 2 // Reddedildi
            ]);

            UserEducation::create([
                'user_id' => $user->id,
                'education_name' => 'Laravel Certified Developer',
                'institution' => 'Laravel LLC',
                'start_year' => '2021',
                'end_year' => '2021',
                'document_link' => 'https://example.com/laravel-cert.pdf',
                'link_access' => 1 // Onaylandı
            ]);
        }
    }
}
