<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

class SiteSettingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        // Veritabanı bağlantısı varsa ve site_settings tablosu mevcutsa
        if (Schema::hasTable('site_settings')) {
            try {
                // Tüm view'larda site ayarlarını kullanılabilir yap
                View::composer('*', function ($view) {
                    $siteSettings = $this->getSiteSettings();
                    $view->with('siteSettings', $siteSettings);
                });
            } catch (\Exception $e) {
                // Hata durumunda varsayılan değerler kullan
                View::composer('*', function ($view) {
                    $view->with('siteSettings', $this->getDefaultSettings());
                });
            }
        } else {
            // Tablo yoksa varsayılan değerler kullan
            View::composer('*', function ($view) {
                $view->with('siteSettings', $this->getDefaultSettings());
            });
        }
    }

    /**
     * Site ayarlarını getir
     */
    private function getSiteSettings(): array
    {
        return [
            'site_name' => SiteSetting::get('site_name', 'FreelancerHub'),
            'site_tagline' => SiteSetting::get('site_tagline', 'Türkiye\'nin En Büyük Freelancer Platformu'),
            'site_description' => SiteSetting::get('site_description', 'Freelancer ve işverenler için güvenli platform'),
            'site_keywords' => SiteSetting::get('site_keywords', 'freelancer, iş, proje'),
            'site_domain' => SiteSetting::get('site_domain', 'freelancerhub.com.tr'),
            'site_email' => SiteSetting::get('site_email', 'info@freelancerhub.com.tr'),
            'support_email' => SiteSetting::get('support_email', 'destek@freelancerhub.com.tr'),
            'site_phone' => SiteSetting::get('site_phone', '+90 212 555 0123'),
            'site_logo' => SiteSetting::get('site_logo', 'logos/logo.png'),
            'site_logo_dark' => SiteSetting::get('site_logo_dark', 'logos/logo-dark.png'),
            'site_favicon' => SiteSetting::get('site_favicon', 'logos/favicon.ico'),
            'site_og_image' => SiteSetting::get('site_og_image', 'images/og-image.jpg'),
            'currency_symbol' => SiteSetting::get('currency_symbol', '₺'),
            'currency_code' => SiteSetting::get('currency_code', 'TRY'),
            'platform_commission' => SiteSetting::get('platform_commission', 10),
            'min_project_budget' => SiteSetting::get('min_project_budget', 500),
            'max_project_budget' => SiteSetting::get('max_project_budget', 1000000),
            'social_facebook' => SiteSetting::get('social_facebook', ''),
            'social_twitter' => SiteSetting::get('social_twitter', ''),
            'social_instagram' => SiteSetting::get('social_instagram', ''),
            'social_linkedin' => SiteSetting::get('social_linkedin', ''),
            'social_youtube' => SiteSetting::get('social_youtube', ''),
            'company_address' => SiteSetting::get('company_address', ''),
            'company_tax_number' => SiteSetting::get('company_tax_number', ''),
            'company_trade_registry' => SiteSetting::get('company_trade_registry', ''),
            'google_analytics_id' => SiteSetting::get('google_analytics_id', ''),
            'google_tag_manager_id' => SiteSetting::get('google_tag_manager_id', ''),
            'facebook_pixel_id' => SiteSetting::get('facebook_pixel_id', ''),
        ];
    }

    /**
     * Varsayılan ayarları getir (veritabanı bağlantısı yoksa)
     */
    private function getDefaultSettings(): array
    {
        return [
            'site_name' => 'FreelancerHub',
            'site_tagline' => 'Türkiye\'nin En Büyük Freelancer Platformu',
            'site_description' => 'Freelancer ve işverenler için güvenli, hızlı ve kolay proje yönetim platformu',
            'site_keywords' => 'freelancer, iş, proje, uzaktan çalışma, yazılım, tasarım, pazarlama',
            'site_domain' => 'freelancerhub.com.tr',
            'site_email' => 'info@freelancerhub.com.tr',
            'support_email' => 'destek@freelancerhub.com.tr',
            'site_phone' => '+90 212 555 0123',
            'site_logo' => 'logos/logo.png',
            'site_logo_dark' => 'logos/logo-dark.png',
            'site_favicon' => 'logos/favicon.ico',
            'site_og_image' => 'images/og-image.jpg',
            'currency_symbol' => '₺',
            'currency_code' => 'TRY',
            'platform_commission' => 10,
            'min_project_budget' => 500,
            'max_project_budget' => 1000000,
            'social_facebook' => '',
            'social_twitter' => '',
            'social_instagram' => '',
            'social_linkedin' => '',
            'social_youtube' => '',
            'company_address' => '',
            'company_tax_number' => '',
            'company_trade_registry' => '',
            'google_analytics_id' => '',
            'google_tag_manager_id' => '',
            'facebook_pixel_id' => '',
        ];
    }
}