<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ServiceItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_service_id',
        'title',
        'description',
        'price',
        'delivery_time_type',
        'delivery_time_unit',
        'delivery_time_min',
        'delivery_time_max',
        'sale_type',
        'external_url',
        'auto_delivery',
        'is_active',
        'sort_order',
        'features',
        'requirements'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'auto_delivery' => 'boolean',
        'is_active' => 'boolean',
        'features' => 'array',
        'delivery_time_min' => 'integer',
        'delivery_time_max' => 'integer',
        'sort_order' => 'integer'
    ];

    // İlişkiler
    public function postService()
    {
        return $this->belongsTo(PostService::class);
    }

    // Scope'lar
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeInternal($query)
    {
        return $query->where('sale_type', 'internal');
    }

    public function scopeExternal($query)
    {
        return $query->where('sale_type', 'external');
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderBy('price');
    }

    // Accessor'lar
    public function getFormattedPriceAttribute()
    {
        return number_format($this->price, 2) . ' ₺';
    }

    public function getDeliveryTimeTextAttribute()
    {
        $unitText = [
            'hour' => 'saat',
            'day' => 'gün',
            'week' => 'hafta'
        ];

        $unit = $unitText[$this->delivery_time_unit] ?? 'gün';

        if ($this->delivery_time_type === 'range' && $this->delivery_time_max) {
            return "{$this->delivery_time_min}-{$this->delivery_time_max} {$unit}";
        }

        return "{$this->delivery_time_min} {$unit}";
    }

    public function getIsExternalAttribute()
    {
        return $this->sale_type === 'external';
    }

    public function getIsInternalAttribute()
    {
        return $this->sale_type === 'internal';
    }
}
