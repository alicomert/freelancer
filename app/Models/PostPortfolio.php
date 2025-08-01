<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostPortfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        // 'project_title' kaldırıldı
        'client_name',
        'project_url',
        'completion_date',
        'project_duration',
        'project_budget',
        'technologies_used',
        // 'project_description' kaldırıldı
        'challenges_faced',
        'solutions_provided',
        'results_achieved',
        'client_testimonial',
        'project_images',
        'project_files',
        'is_featured_work',
        'display_order'
    ];

    protected $casts = [
        'completion_date' => 'date',
        'project_budget' => 'decimal:2',
        'technologies_used' => 'array',
        'project_images' => 'array',
        'project_files' => 'array',
        'is_featured_work' => 'boolean',
        'display_order' => 'integer'
    ];

    protected $dates = [
        'completion_date'
    ];

    // İlişkiler
    public function post(): BelongsTo
    {
        return $this->belongsTo(PostOptimized::class, 'post_id');
    }

    // Scope'lar
    public function scopeFeatured($query)
    {
        return $query->where('is_featured_work', true);
    }

    public function scopeByTechnology($query, $technology)
    {
        return $query->whereJsonContains('technologies_used', $technology);
    }

    public function scopeInBudgetRange($query, $minBudget, $maxBudget)
    {
        return $query->whereBetween('project_budget', [$minBudget, $maxBudget]);
    }

    public function scopeCompletedAfter($query, $date)
    {
        return $query->where('completion_date', '>=', $date);
    }

    public function scopeOrderedByDisplay($query)
    {
        return $query->orderBy('display_order', 'asc');
    }

    public function scopeRecent($query)
    {
        return $query->orderBy('completion_date', 'desc');
    }

    // Accessor'lar
    public function getFormattedBudgetAttribute(): ?string
    {
        return $this->project_budget ? number_format($this->project_budget, 2) . ' TL' : null;
    }

    public function getProjectAgeAttribute(): ?string
    {
        if (!$this->completion_date) return null;
        
        $diff = now()->diff($this->completion_date);
        
        if ($diff->y > 0) {
            return $diff->y . ' yıl önce';
        } elseif ($diff->m > 0) {
            return $diff->m . ' ay önce';
        } elseif ($diff->d > 0) {
            return $diff->d . ' gün önce';
        } else {
            return 'Bugün';
        }
    }

    public function getHasImagesAttribute(): bool
    {
        return !empty($this->project_images) && count($this->project_images) > 0;
    }

    public function getHasFilesAttribute(): bool
    {
        return !empty($this->project_files) && count($this->project_files) > 0;
    }

    public function getMainImageAttribute(): ?string
    {
        return $this->has_images ? $this->project_images[0] : null;
    }

    public function getTechnologiesListAttribute(): string
    {
        return $this->technologies_used ? implode(', ', $this->technologies_used) : '';
    }

    public function getHasTestimonialAttribute(): bool
    {
        return !empty($this->client_testimonial);
    }

    public function getProjectDurationTextAttribute(): ?string
    {
        if (!$this->project_duration) return null;
        
        if ($this->project_duration < 30) {
            return $this->project_duration . ' gün';
        } elseif ($this->project_duration < 365) {
            $months = round($this->project_duration / 30);
            return $months . ' ay';
        } else {
            $years = round($this->project_duration / 365, 1);
            return $years . ' yıl';
        }
    }

    // Mutator'lar
    public function setTechnologiesUsedAttribute($value)
    {
        $this->attributes['technologies_used'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setProjectImagesAttribute($value)
    {
        $this->attributes['project_images'] = is_array($value) ? json_encode($value) : $value;
    }

    public function setProjectFilesAttribute($value)
    {
        $this->attributes['project_files'] = is_array($value) ? json_encode($value) : $value;
    }

    // Yardımcı metodlar
    public function addImage(string $imagePath): void
    {
        $images = $this->project_images ?? [];
        $images[] = $imagePath;
        $this->update(['project_images' => $images]);
    }

    public function removeImage(string $imagePath): void
    {
        $images = $this->project_images ?? [];
        $images = array_filter($images, fn($img) => $img !== $imagePath);
        $this->update(['project_images' => array_values($images)]);
    }

    public function addFile(string $filePath, string $fileName): void
    {
        $files = $this->project_files ?? [];
        $files[] = [
            'path' => $filePath,
            'name' => $fileName,
            'uploaded_at' => now()->toISOString()
        ];
        $this->update(['project_files' => $files]);
    }

    public function removeFile(string $filePath): void
    {
        $files = $this->project_files ?? [];
        $files = array_filter($files, fn($file) => $file['path'] !== $filePath);
        $this->update(['project_files' => array_values($files)]);
    }

    public function updateDisplayOrder(int $order): void
    {
        $this->update(['display_order' => $order]);
    }

    public function toggleFeatured(): void
    {
        $this->update(['is_featured_work' => !$this->is_featured_work]);
    }
}
