<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserFollow extends Model
{
    protected $fillable = [
        'follower_id',
        'following_id'
    ];

    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Takip eden kullanıcı
     */
    public function follower(): BelongsTo
    {
        return $this->belongsTo(User::class, 'follower_id');
    }

    /**
     * Takip edilen kullanıcı
     */
    public function following(): BelongsTo
    {
        return $this->belongsTo(User::class, 'following_id');
    }

    /**
     * Performans için scope'lar
     */
    public function scopeByFollower($query, $followerId)
    {
        return $query->where('follower_id', $followerId);
    }

    public function scopeByFollowing($query, $followingId)
    {
        return $query->where('following_id', $followingId);
    }

    public function scopeFollowRelation($query, $followerId, $followingId)
    {
        return $query->where('follower_id', $followerId)
                    ->where('following_id', $followingId);
    }
}
