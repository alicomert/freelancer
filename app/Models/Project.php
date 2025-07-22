<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'category_id',
        'title',
        'slug',
        'description',
        'requirements',
        'budget_min',
        'budget_max',
        'budget_type',
        'duration',
        'experience_level',
        'status',
        'deadline',
        'proposals_count',
        'views_count',
        'skills',
        'attachments',
        'is_featured',
        'featured_until',
    ];

    protected function casts(): array
    {
        return [
            'requirements' => 'array',
            'skills' => 'array',
            'attachments' => 'array',
            'budget_min' => 'decimal:2',
            'budget_max' => 'decimal:2',
            'deadline' => 'datetime',
            'featured_until' => 'datetime',
            'is_featured' => 'boolean',
        ];
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true)
                    ->where(function($q) {
                        $q->whereNull('featured_until')
                          ->orWhere('featured_until', '>', now());
                    });
    }

    public function scopeByBudget($query, $min = null, $max = null)
    {
        if ($min) {
            $query->where('budget_min', '>=', $min);
        }
        if ($max) {
            $query->where('budget_max', '<=', $max);
        }
        return $query;
    }

    // Methods
    public function getRouteKeyName()
    {
        return 'slug';
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
                
                // Ensure unique slug
                $count = static::where('slug', 'like', $project->slug . '%')->count();
                if ($count > 0) {
                    $project->slug = $project->slug . '-' . ($count + 1);
                }
            }
        });
    }

    public function incrementViews()
    {
        $this->increment('views_count');
    }

    public function updateProposalsCount()
    {
        $this->update(['proposals_count' => $this->proposals()->count()]);
    }

    public function getBudgetRangeAttribute()
    {
        if ($this->budget_min && $this->budget_max) {
            return '₺' . number_format($this->budget_min) . ' - ₺' . number_format($this->budget_max);
        } elseif ($this->budget_max) {
            return 'Maksimum ₺' . number_format($this->budget_max);
        }
        return 'Bütçe belirtilmemiş';
    }
}