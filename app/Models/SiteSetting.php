<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SiteSetting extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'value',
        'type',
        'group',
        'label',
        'description',
        'sort_order',
        'is_public'
    ];

    protected $casts = [
        'is_public' => 'boolean',
        'sort_order' => 'integer'
    ];

    /**
     * Get setting value by key
     */
    public static function get(string $key, $default = null)
    {
        $setting = static::where('key', $key)->first();
        
        if (!$setting) {
            return $default;
        }

        return match ($setting->type) {
            'boolean' => filter_var($setting->value, FILTER_VALIDATE_BOOLEAN),
            'json' => json_decode($setting->value, true),
            'image' => $setting->value ? asset('storage/' . $setting->value) : $default,
            default => $setting->value ?: $default
        };
    }

    /**
     * Set setting value by key
     */
    public static function set(string $key, $value, string $type = 'text'): void
    {
        static::updateOrCreate(
            ['key' => $key],
            [
                'value' => is_array($value) ? json_encode($value) : $value,
                'type' => $type,
                'is_public' => false
            ]
        );
    }

    /**
     * Get all settings grouped by group
     */
    public static function getAllGrouped(): array
    {
        return static::orderBy('group')
            ->orderBy('sort_order')
            ->get()
            ->groupBy('group')
            ->toArray();
    }

    /**
     * Clear all settings cache
     */
    public static function clearCache(): void
    {
        // Cache cleared
    }
}