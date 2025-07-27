<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserBlock extends Model
{
    protected $fillable = [
        'blocker_id',
        'blocked_id',
        'reason'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Engelleyen kullanıcı
     */
    public function blocker(): BelongsTo
    {
        return $this->belongsTo(User::class, 'blocker_id');
    }

    /**
     * Engellenen kullanıcı
     */
    public function blocked(): BelongsTo
    {
        return $this->belongsTo(User::class, 'blocked_id');
    }

    /**
     * Performans için scope'lar
     */
    public function scopeByBlocker($query, $blockerId)
    {
        return $query->where('blocker_id', $blockerId);
    }

    public function scopeByBlocked($query, $blockedId)
    {
        return $query->where('blocked_id', $blockedId);
    }

    public function scopeBlockRelation($query, $blockerId, $blockedId)
    {
        return $query->where('blocker_id', $blockerId)
                    ->where('blocked_id', $blockedId);
    }
}
