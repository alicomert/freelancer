<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tag extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'icon',
        'is_featured',
        'usage_count',
        'category_id'
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'usage_count' => 'integer'
    ];

    // İlişkiler
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(PostOptimized::class, 'post_tags', 'tag_id', 'post_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Scope'lar
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopePopular($query)
    {
        return $query->orderBy('usage_count', 'desc');
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    // Yardımcı metodlar
    public function incrementUsage(): void
    {
        $this->increment('usage_count');
    }

    public function decrementUsage(): void
    {
        $this->decrement('usage_count');
    }

    // Accessor'lar
    public function getUrlAttribute(): string
    {
        return route('tags.show', $this->slug);
    }
}
