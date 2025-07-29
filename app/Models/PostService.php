<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostService extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'service_type',
        'price',
        'price_min',
        'price_max',
        'price_type',
        'delivery_time_type',
        'delivery_time_unit',
        'delivery_time_min',
        'delivery_time_max',
        'sale_type',
        'external_url',
        'auto_delivery',
        'revisions_included',
        'features',
        'requirements',
        'portfolio_items',
        'packages',
        'add_ons',
        'faq',
        'is_express_delivery',
        'express_delivery_time',
        'express_delivery_price'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'price_min' => 'decimal:2',
        'price_max' => 'decimal:2',
        'revisions_included' => 'integer',
        'delivery_time_min' => 'integer',
        'delivery_time_max' => 'integer',
        'express_delivery_time' => 'integer',
        'express_delivery_price' => 'decimal:2',
        'auto_delivery' => 'boolean',
        'features' => 'array',
        'requirements' => 'array',
        'portfolio_items' => 'array',
        'packages' => 'array',
        'add_ons' => 'array',
        'faq' => 'array',
        'is_express_delivery' => 'boolean'
    ];

    // İlişkiler
    public function post(): BelongsTo
    {
        return $this->belongsTo(PostOptimized::class, 'post_id');
    }

    public function serviceItems()
    {
        return $this->hasMany(ServiceItem::class)->ordered();
    }

    public function activeServiceItems()
    {
        return $this->hasMany(ServiceItem::class)->active()->ordered();
    }

    // Scope'lar
    public function scopeByServiceType($query, $type)
    {
        return $query->where('service_type', $type);
    }

    public function scopeInPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
    }

    public function scopeWithExpressDelivery($query)
    {
        return $query->where('is_express_delivery', true);
    }

    public function scopeByDeliveryTime($query, $maxDays)
    {
        return $query->where(function ($q) use ($maxDays) {
            $q->where('delivery_time_unit', 'days')
              ->where('delivery_time', '<=', $maxDays)
              ->orWhere('delivery_time_unit', 'hours')
              ->where('delivery_time', '<=', $maxDays * 24);
        });
    }

    // Accessor'lar
    public function getFormattedPriceAttribute(): string
    {
        return number_format($this->price, 2) . ' TL';
    }

    public function getPriceRangeAttribute(): string
    {
        if ($this->serviceItems()->exists()) {
            $minPrice = $this->serviceItems()->min('price');
            $maxPrice = $this->serviceItems()->max('price');
            
            if ($minPrice == $maxPrice) {
                return number_format($minPrice, 0) . ' ₺';
            }
            
            return number_format($minPrice, 0) . '-' . number_format($maxPrice, 0) . ' ₺';
        }

        if ($this->price_min && $this->price_max && $this->price_min != $this->price_max) {
            return number_format($this->price_min, 0) . '-' . number_format($this->price_max, 0) . ' ₺';
        }

        return $this->formatted_price;
    }

    public function getDeliveryTimeTextAttribute(): string
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

    public function getIsExternalAttribute(): bool
    {
        return $this->sale_type === 'external';
    }

    public function getIsInternalAttribute(): bool
    {
        return $this->sale_type === 'internal';
    }

    public function getHasPackagesAttribute(): bool
    {
        return !empty($this->packages) && count($this->packages) > 0;
    }

    public function getHasAddOnsAttribute(): bool
    {
        return !empty($this->add_ons) && count($this->add_ons) > 0;
    }

    // Yardımcı metodlar
    public function getPackageByType(string $type): ?array
    {
        if (!$this->packages) return null;
        
        foreach ($this->packages as $package) {
            if ($package['type'] === $type) {
                return $package;
            }
        }
        
        return null;
    }

    public function calculateTotalPrice(array $selectedAddOns = [], bool $expressDelivery = false): float
    {
        $total = $this->price;
        
        // Add-on'ları ekle
        if (!empty($selectedAddOns) && $this->add_ons) {
            foreach ($this->add_ons as $addOn) {
                if (in_array($addOn['id'], $selectedAddOns)) {
                    $total += $addOn['price'];
                }
            }
        }
        
        // Express teslimat ekle
        if ($expressDelivery && $this->is_express_delivery) {
            $total += $this->express_delivery_price;
        }
        
        return $total;
    }
}
