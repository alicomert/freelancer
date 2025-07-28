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
        'price_type',
        'delivery_time',
        'delivery_time_unit',
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
        'revisions_included' => 'integer',
        'delivery_time' => 'integer',
        'express_delivery_time' => 'integer',
        'express_delivery_price' => 'decimal:2',
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

    public function getDeliveryTimeTextAttribute(): string
    {
        $unit = $this->delivery_time_unit === 'days' ? 'gün' : 'saat';
        return $this->delivery_time . ' ' . $unit;
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
