<?php

namespace Database\Seeders;

use App\Models\SiteSetting;
use Illuminate\Database\Seeder;

class SiteSettingSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            // Genel Site Bilgileri
            [
                'key' => 'site_name',
                'value' => 'FreelancerHub',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Adı',
                'description' => 'Sitenin ana adı',
                'sort_order' => 1
            ],
            [
                'key' => 'site_tagline',
                'value' => 'Türkiye\'nin En Büyük Freelancer Platformu',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Sloganı',
                'description' => 'Site açıklaması/sloganı',
                'sort_order' => 2
            ],
            [
                'key' => 'site_description',
                'value' => 'Freelancer ve işverenler için güvenli, hızlı ve kolay proje yönetim platformu. Binlerce uzman freelancer ile projelerinizi hayata geçirin.',
                'type' => 'textarea',
                'group' => 'general',
                'label' => 'Site Açıklaması',
                'description' => 'SEO için site açıklaması',
                'sort_order' => 3
            ],
            [
                'key' => 'site_keywords',
                'value' => 'freelancer, iş, proje, uzaktan çalışma, yazılım, tasarım, pazarlama',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Anahtar Kelimeleri',
                'description' => 'SEO için anahtar kelimeler (virgülle ayırın)',
                'sort_order' => 4
            ],
            [
                'key' => 'site_domain',
                'value' => 'freelancerhub.com.tr',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Domain',
                'description' => 'Sitenin ana domain adresi',
                'sort_order' => 5
            ],
            [
                'key' => 'site_email',
                'value' => 'info@freelancerhub.com.tr',
                'type' => 'email',
                'group' => 'general',
                'label' => 'Site E-posta',
                'description' => 'Genel iletişim e-posta adresi',
                'sort_order' => 6
            ],
            [
                'key' => 'support_email',
                'value' => 'destek@freelancerhub.com.tr',
                'type' => 'email',
                'group' => 'general',
                'label' => 'Destek E-posta',
                'description' => 'Müşteri destek e-posta adresi',
                'sort_order' => 7
            ],
            [
                'key' => 'site_phone',
                'value' => '+90 212 555 0123',
                'type' => 'text',
                'group' => 'general',
                'label' => 'Site Telefon',
                'description' => 'İletişim telefon numarası',
                'sort_order' => 8
            ],

            // Logo ve Görsel Ayarları
            [
                'key' => 'site_logo',
                'value' => 'logos/logo.png',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Site Logosu',
                'description' => 'Ana site logosu',
                'sort_order' => 1
            ],
            [
                'key' => 'site_logo_dark',
                'value' => 'logos/logo-dark.png',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Dark Mode Logo',
                'description' => 'Karanlık tema için logo',
                'sort_order' => 2
            ],
            [
                'key' => 'site_favicon',
                'value' => 'logos/favicon.ico',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Site Favicon',
                'description' => 'Tarayıcı sekmesi ikonu',
                'sort_order' => 3
            ],
            [
                'key' => 'site_og_image',
                'value' => 'images/og-image.jpg',
                'type' => 'image',
                'group' => 'appearance',
                'label' => 'Sosyal Medya Görseli',
                'description' => 'Sosyal medyada paylaşım görseli',
                'sort_order' => 4
            ],

            // Sosyal Medya
            [
                'key' => 'social_facebook',
                'value' => 'https://facebook.com/freelancerhub',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Facebook',
                'description' => 'Facebook sayfa linki',
                'sort_order' => 1
            ],
            [
                'key' => 'social_twitter',
                'value' => 'https://twitter.com/freelancerhub',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Twitter/X',
                'description' => 'Twitter/X profil linki',
                'sort_order' => 2
            ],
            [
                'key' => 'social_instagram',
                'value' => 'https://instagram.com/freelancerhub',
                'type' => 'url',
                'group' => 'social',
                'label' => 'Instagram',
                'description' => 'Instagram profil linki',
                'sort_order' => 3
            ],
            [
                'key' => 'social_linkedin',
                'value' => 'https://linkedin.com/company/freelancerhub',
                'type' => 'url',
                'group' => 'social',
                'label' => 'LinkedIn',
                'description' => 'LinkedIn şirket sayfası',
                'sort_order' => 4
            ],
            [
                'key' => 'social_youtube',
                'value' => 'https://youtube.com/@freelancerhub',
                'type' => 'url',
                'group' => 'social',
                'label' => 'YouTube',
                'description' => 'YouTube kanal linki',
                'sort_order' => 5
            ],

            // Platform Ayarları
            [
                'key' => 'platform_commission',
                'value' => '10',
                'type' => 'number',
                'group' => 'platform',
                'label' => 'Platform Komisyonu (%)',
                'description' => 'Platform komisyon oranı',
                'sort_order' => 1
            ],
            [
                'key' => 'min_project_budget',
                'value' => '500',
                'type' => 'number',
                'group' => 'platform',
                'label' => 'Minimum Proje Bütçesi (₺)',
                'description' => 'Minimum proje bütçesi',
                'sort_order' => 2
            ],
            [
                'key' => 'max_project_budget',
                'value' => '1000000',
                'type' => 'number',
                'group' => 'platform',
                'label' => 'Maksimum Proje Bütçesi (₺)',
                'description' => 'Maksimum proje bütçesi',
                'sort_order' => 3
            ],
            [
                'key' => 'currency_symbol',
                'value' => '₺',
                'type' => 'text',
                'group' => 'platform',
                'label' => 'Para Birimi Sembolü',
                'description' => 'Kullanılan para birimi sembolü',
                'sort_order' => 4
            ],
            [
                'key' => 'currency_code',
                'value' => 'TRY',
                'type' => 'text',
                'group' => 'platform',
                'label' => 'Para Birimi Kodu',
                'description' => 'ISO para birimi kodu',
                'sort_order' => 5
            ],

            // İletişim Bilgileri
            [
                'key' => 'company_address',
                'value' => 'Maslak Mahallesi, Büyükdere Caddesi No:123, Sarıyer/İstanbul',
                'type' => 'textarea',
                'group' => 'contact',
                'label' => 'Şirket Adresi',
                'description' => 'Fiziksel şirket adresi',
                'sort_order' => 1
            ],
            [
                'key' => 'company_tax_number',
                'value' => '1234567890',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Vergi Numarası',
                'description' => 'Şirket vergi numarası',
                'sort_order' => 2
            ],
            [
                'key' => 'company_trade_registry',
                'value' => 'İstanbul Ticaret Sicili 123456',
                'type' => 'text',
                'group' => 'contact',
                'label' => 'Ticaret Sicil',
                'description' => 'Ticaret sicil bilgisi',
                'sort_order' => 3
            ],

            // SEO ve Analytics
            [
                'key' => 'google_analytics_id',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Analytics ID',
                'description' => 'Google Analytics takip kodu',
                'sort_order' => 1
            ],
            [
                'key' => 'google_tag_manager_id',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Google Tag Manager ID',
                'description' => 'Google Tag Manager kodu',
                'sort_order' => 2
            ],
            [
                'key' => 'facebook_pixel_id',
                'value' => '',
                'type' => 'text',
                'group' => 'seo',
                'label' => 'Facebook Pixel ID',
                'description' => 'Facebook Pixel takip kodu',
                'sort_order' => 3
            ]
        ];

        foreach ($settings as $setting) {
            SiteSetting::updateOrCreate(
                ['key' => $setting['key']],
                $setting
            );
        }
    }
}