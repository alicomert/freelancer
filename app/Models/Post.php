<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'posts_optimized';

    protected $fillable = [
        'uuid',
        'user_id',
        'community_id',
        'category_id',
        'post_type',
        'title',
        'slug',
        'content',
        'excerpt',
        'featured_image',
        'status',
        'likes_count',
        'comments_count',
        'views_count',
        'is_featured',
        'is_pinned',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'published_at'
    ];

    protected $casts = [
        'meta_keywords' => 'array',
        'is_featured' => 'boolean',
        'is_pinned' => 'boolean',
        'published_at' => 'datetime'
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    // Scopes
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeByType($query, $type)
    {
        $typeMap = [
            'post' => 1,
            'service' => 2,
            'auction' => 3,
            'poll' => 4,
            'portfolio' => 5,
            'article' => 6,
            'question' => 7
        ];
        
        return $query->where('post_type', $typeMap[$type] ?? 1);
    }

    // Accessors
    public function getExcerptAttribute()
    {
        return \Str::limit($this->content, 150);
    }

    public function getReadTimeAttribute()
    {
        $wordCount = str_word_count(strip_tags($this->content));
        $readingSpeed = 200; // words per minute
        return ceil($wordCount / $readingSpeed);
    }

    // Methods
    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function incrementLikes()
    {
        $this->increment('likes_count');
    }

    public function decrementLikes()
    {
        $this->decrement('likes_count');
    }

    public function incrementComments()
    {
        $this->increment('comments_count');
    }

    public function decrementComments()
    {
        $this->decrement('comments_count');
    }
}