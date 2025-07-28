<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostOptimized extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts_optimized';

    protected $fillable = [
        'user_id',
        'category_id',
        'post_type',
        'title',
        'content',
        'excerpt',
        'featured_image',
        'gallery_images',
        'status',
        'visibility',
        'is_featured',
        'is_urgent',
        'location',
        'budget_min',
        'budget_max',
        'currency',
        'deadline',
        'skills_required',
        'experience_level',
        'project_duration',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'views_count',
        'likes_count',
        'comments_count',
        'shares_count',
        'click_count',
        'conversion_count',
        'engagement_score',
        'quality_score',
        'seo_score',
        'performance_score',
        'last_activity_at',
        'featured_until',
        'boost_until',
        'published_at'
    ];

    protected $casts = [
        'gallery_images' => 'array',
        'skills_required' => 'array',
        'is_featured' => 'boolean',
        'is_urgent' => 'boolean',
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'views_count' => 'integer',
        'likes_count' => 'integer',
        'comments_count' => 'integer',
        'shares_count' => 'integer',
        'click_count' => 'integer',
        'conversion_count' => 'integer',
        'engagement_score' => 'decimal:2',
        'quality_score' => 'decimal:2',
        'seo_score' => 'decimal:2',
        'performance_score' => 'decimal:2',
        'deadline' => 'datetime',
        'last_activity_at' => 'datetime',
        'featured_until' => 'datetime',
        'boost_until' => 'datetime',
        'published_at' => 'datetime',
        'deleted_at' => 'datetime'
    ];

    protected $dates = [
        'deadline',
        'last_activity_at',
        'featured_until',
        'boost_until',
        'published_at',
        'deleted_at'
    ];

    // İlişkiler
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class, 'post_tags', 'post_id', 'tag_id');
    }

    public function service(): HasOne
    {
        return $this->hasOne(PostService::class, 'post_id');
    }

    public function auction(): HasOne
    {
        return $this->hasOne(PostAuction::class, 'post_id');
    }

    public function portfolio(): HasOne
    {
        return $this->hasOne(PostPortfolio::class, 'post_id');
    }

    public function poll(): HasOne
    {
        return $this->hasOne(PostPoll::class, 'post_id');
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class, 'post_id');
    }

    public function likes(): HasMany
    {
        return $this->hasMany(Like::class, 'post_id');
    }

    // Scope'lar
    public function scopePublished($query)
    {
        return $query->where('status', 'published');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        return $query->where('post_type', $type);
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeInBudgetRange($query, $minBudget, $maxBudget)
    {
        return $query->where(function ($q) use ($minBudget, $maxBudget) {
            $q->whereBetween('budget_min', [$minBudget, $maxBudget])
              ->orWhereBetween('budget_max', [$minBudget, $maxBudget])
              ->orWhere(function ($subQ) use ($minBudget, $maxBudget) {
                  $subQ->where('budget_min', '<=', $minBudget)
                       ->where('budget_max', '>=', $maxBudget);
              });
        });
    }

    public function scopeWithLocation($query, $location)
    {
        return $query->where('location', 'like', "%{$location}%");
    }

    public function scopePopular($query)
    {
        return $query->orderBy('engagement_score', 'desc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Accessor'lar
    public function getIsActiveAttribute(): bool
    {
        return $this->status === 'published' && 
               ($this->deadline === null || $this->deadline->isFuture());
    }

    public function getIsFeaturedActiveAttribute(): bool
    {
        return $this->is_featured && 
               ($this->featured_until === null || $this->featured_until->isFuture());
    }

    public function getIsBoostedAttribute(): bool
    {
        return $this->boost_until !== null && $this->boost_until->isFuture();
    }

    public function getBudgetRangeAttribute(): string
    {
        if ($this->budget_min && $this->budget_max) {
            return "{$this->budget_min} - {$this->budget_max} {$this->currency}";
        } elseif ($this->budget_min) {
            return "Min: {$this->budget_min} {$this->currency}";
        } elseif ($this->budget_max) {
            return "Max: {$this->budget_max} {$this->currency}";
        }
        return 'Bütçe belirtilmemiş';
    }

    // Mutator'lar
    public function setSkillsRequiredAttribute($value)
    {
        $this->attributes['skills_required'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setGalleryImagesAttribute($value)
    {
        $this->attributes['gallery_images'] = is_array($value) ? json_encode($value) : $value;
    }

    // Yardımcı metodlar
    public function incrementViewCount(): void
    {
        $this->increment('view_count');
        $this->touch('last_activity_at');
    }

    public function incrementLikeCount(): void
    {
        $this->increment('like_count');
        $this->updateEngagementScore();
    }

    public function decrementLikeCount(): void
    {
        $this->decrement('like_count');
        $this->updateEngagementScore();
    }

    public function incrementCommentCount(): void
    {
        $this->increment('comment_count');
        $this->updateEngagementScore();
    }

    public function updateEngagementScore(): void
    {
        $score = ($this->like_count * 1) + 
                ($this->comment_count * 2) + 
                ($this->share_count * 3) + 
                ($this->view_count * 0.1);
        
        $this->update(['engagement_score' => $score]);
    }

    public function calculateQualityScore(): float
    {
        $score = 0;
        
        // İçerik kalitesi (40%)
        $contentLength = strlen(strip_tags($this->content));
        if ($contentLength > 500) $score += 40;
        elseif ($contentLength > 200) $score += 30;
        elseif ($contentLength > 100) $score += 20;
        else $score += 10;
        
        // Görsel içerik (20%)
        if ($this->featured_image) $score += 10;
        if ($this->gallery_images && count($this->gallery_images) > 0) $score += 10;
        
        // Etkileşim (25%)
        $engagementRatio = $this->view_count > 0 ? 
            ($this->like_count + $this->comment_count) / $this->view_count : 0;
        $score += min(25, $engagementRatio * 100);
        
        // Tamamlık (15%)
        $completeness = 0;
        if ($this->budget_min || $this->budget_max) $completeness += 5;
        if ($this->deadline) $completeness += 5;
        if ($this->skills_required && count($this->skills_required) > 0) $completeness += 5;
        $score += $completeness;
        
        return min(100, $score);
    }
}
