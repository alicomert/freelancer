<?php

namespace App\Http\Controllers;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class SiteSettingController extends Controller
{
    /**
     * Site ayarları yönetim sayfasını göster
     */
    public function index(): View
    {
        $settings = SiteSetting::getAllGrouped();
        return view('admin.site-settings.index', compact('settings'));
    }

    /**
     * Belirli bir ayarı getir
     */
    public function show(string $key): JsonResponse
    {
        $setting = SiteSetting::where('key', $key)->first();
        
        if (!$setting) {
            return response()->json(['error' => 'Ayar bulunamadı'], 404);
        }

        return response()->json($setting);
    }

    /**
     * Ayarları güncelle
     */
    public function update(Request $request): JsonResponse
    {
        $request->validate([
            'settings' => 'required|array',
            'settings.*.key' => 'required|string',
            'settings.*.value' => 'nullable|string',
        ]);

        try {
            foreach ($request->settings as $settingData) {
                SiteSetting::set($settingData['key'], $settingData['value']);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ayarlar başarıyla güncellendi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ayarlar güncellenirken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Yeni ayar oluştur
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'key' => 'required|string|unique:site_settings,key',
            'value' => 'nullable|string',
            'type' => 'required|in:text,textarea,number,email,url,image,boolean,json',
            'group' => 'required|string',
            'label' => 'required|string',
            'description' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'is_active' => 'boolean'
        ]);

        try {
            $setting = SiteSetting::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Ayar başarıyla oluşturuldu',
                'setting' => $setting
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ayar oluşturulurken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Ayarı sil
     */
    public function destroy(string $key): JsonResponse
    {
        try {
            $setting = SiteSetting::where('key', $key)->first();
            
            if (!$setting) {
                return response()->json(['error' => 'Ayar bulunamadı'], 404);
            }

            $setting->delete();

            return response()->json([
                'success' => true,
                'message' => 'Ayar başarıyla silindi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Ayar silinirken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * Cache'i temizle
     */
    public function clearCache(): JsonResponse
    {
        try {
            SiteSetting::clearCache();

            return response()->json([
                'success' => true,
                'message' => 'Cache başarıyla temizlendi'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Cache temizlenirken hata oluştu: ' . $e->getMessage()
            ], 500);
        }
    }

    /**
     * API için tüm public ayarları getir
     */
    public function getPublicSettings(): JsonResponse
    {
        $publicKeys = [
            'site_name',
            'site_tagline', 
            'site_description',
            'site_domain',
            'site_logo',
            'site_logo_dark',
            'site_favicon',
            'currency_symbol',
            'currency_code',
            'social_facebook',
            'social_twitter',
            'social_instagram',
            'social_linkedin',
            'social_youtube'
        ];

        $settings = [];
        foreach ($publicKeys as $key) {
            $settings[$key] = SiteSetting::get($key);
        }

        return response()->json($settings);
    }
}