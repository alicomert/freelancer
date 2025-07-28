<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class PostAuction extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'starting_price',
        'current_price',
        'reserve_price',
        'start_time',
        'end_time',
        'auto_extend',
        'status',
        'winner_user_id',
        'bid_count'
    ];

    protected $casts = [
        'starting_price' => 'decimal:2',
        'current_price' => 'decimal:2',
        'reserve_price' => 'decimal:2',
        'bid_count' => 'integer',
        'auto_extend' => 'boolean',
        'start_time' => 'datetime',
        'end_time' => 'datetime'
    ];

    protected $dates = [
        'start_time',
        'end_time'
    ];

    // İlişkiler
    public function post(): BelongsTo
    {
        return $this->belongsTo(PostOptimized::class, 'post_id');
    }

    public function winner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'winner_user_id');
    }

    // Scope'lar
    public function scopeActive($query)
    {
        return $query->where('status', 'active')
                    ->where('start_time', '<=', now())
                    ->where('end_time', '>', now());
    }

    public function scopeEnded($query)
    {
        return $query->where('status', 'ended')
                    ->orWhere('end_time', '<=', now());
    }

    public function scopePending($query)
    {
        return $query->where('status', 'pending')
                    ->where('start_time', '>', now());
    }

    public function scopeInPriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('current_price', [$minPrice, $maxPrice]);
    }

    public function scopeEndingSoon($query, $hours = 24)
    {
        return $query->where('status', 'active')
                    ->where('end_time', '>', now())
                    ->where('end_time', '<=', now()->addHours($hours));
    }

    // Accessor'lar
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'active' && 
               $this->start_time <= now() && 
               $this->end_time > now();
    }

    public function getIsEndedAttribute(): bool
    {
        return $this->status === 'ended' || $this->end_time <= now();
    }

    public function getIsPendingAttribute(): bool
    {
        return $this->status === 'pending' && $this->start_time > now();
    }

    public function getTimeRemainingAttribute(): ?string
    {
        if (!$this->is_active) return null;
        
        $diff = now()->diff($this->end_time);
        
        if ($diff->days > 0) {
            return $diff->days . ' gün ' . $diff->h . ' saat';
        } elseif ($diff->h > 0) {
            return $diff->h . ' saat ' . $diff->i . ' dakika';
        } else {
            return $diff->i . ' dakika';
        }
    }

    public function getFormattedCurrentPriceAttribute(): string
    {
        return number_format($this->current_price, 2) . ' TL';
    }

    public function getFormattedStartingPriceAttribute(): string
    {
        return number_format($this->starting_price, 2) . ' TL';
    }

    public function getFormattedReservePriceAttribute(): ?string
    {
        return $this->reserve_price ? number_format($this->reserve_price, 2) . ' TL' : null;
    }

    public function getHasReservePriceAttribute(): bool
    {
        return $this->reserve_price !== null;
    }

    public function getReservePriceMetAttribute(): bool
    {
        return $this->has_reserve_price && $this->current_price >= $this->reserve_price;
    }

    // Yardımcı metodlar
    public function placeBid(float $amount, int $userId): bool
    {
        if (!$this->is_active) {
            return false;
        }

        if ($amount <= $this->current_price) {
            return false;
        }

        // Reserve price kontrolü
        if ($this->has_reserve_price && $amount < $this->reserve_price) {
            // Reserve price'ın altında teklif verilebilir ama kazanamaz
        }

        $this->update([
            'current_price' => $amount,
            'bid_count' => $this->bid_count + 1
        ]);

        // Açık artırma bittiğinde kazananı belirle
        if ($this->end_time <= now()) {
            $this->endAuction();
        }

        return true;
    }

    public function endAuction(): void
    {
        if ($this->status === 'ended') return;

        $winner = null;
        
        // Reserve price kontrolü
        if (!$this->has_reserve_price || $this->reserve_price_met) {
            // Kazanan var
            $this->update([
                'status' => 'ended',
                'winner_user_id' => $winner // Burada en yüksek teklifi veren kullanıcı ID'si olmalı
            ]);
        } else {
            // Reserve price karşılanmadı
            $this->update([
                'status' => 'ended',
                'winner_user_id' => null
            ]);
        }
    }

    public function extendTime(int $minutes): void
    {
        if ($this->is_active) {
            $this->update([
                'end_time' => $this->end_time->addMinutes($minutes)
            ]);
        }
    }

    public function cancel(): void
    {
        if ($this->status !== 'ended') {
            $this->update([
                'status' => 'cancelled'
            ]);
        }
    }

    // Otomatik durum güncellemesi
    public function updateStatus(): void
    {
        $now = now();
        
        if ($this->status === 'pending' && $this->start_time <= $now) {
            $this->update(['status' => 'active']);
        }
        
        if ($this->status === 'active' && $this->end_time <= $now) {
            $this->endAuction();
        }
    }
}
