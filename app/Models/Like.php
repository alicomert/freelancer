<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'likeable_id',
        'likeable_type',
    ];

    // Polimorfik ilişki
    public function likeable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Scope'lar
    public function scopeForPost($query, $postId)
    {
        return $query->where('likeable_type', Post::class)
                    ->where('likeable_id', $postId);
    }

    public function scopeForComment($query, $commentId)
    {
        return $query->where('likeable_type', Comment::class)
                    ->where('likeable_id', $commentId);
    }

    public function scopeByUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }
}