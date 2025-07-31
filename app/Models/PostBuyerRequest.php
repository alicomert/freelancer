<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PostBuyerRequest extends Model
{
    /**
     * Tablo adı
     *
     * @var string
     */
    protected $table = 'post_buyer_requests';

    /**
     * Doldurulabilir alanlar
     *
     * @var array<string>
     */
    protected $fillable = [
        'post_id',
        'job_type',
        'work_duration_type',
        'delivery_time',
        'budget_min',
        'budget_max',
        'currency',
        'required_skills',
        'experience_level',
        'location',
        'meta_data',
        'status',
        'deadline'
    ];

    /**
     * Cast edilecek alanlar
     *
     * @var array<string, string>
     */
    protected $casts = [
        'budget_min' => 'decimal:2',
        'budget_max' => 'decimal:2',
        'required_skills' => 'array',
        'meta_data' => 'array',
        'deadline' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime'
    ];

    /**
     * Posts_optimized tablosu ile ilişki
     *
     * @return BelongsTo
     */
    public function post(): BelongsTo
    {
        return $this->belongsTo(PostOptimized::class, 'post_id');
    }

    /**
     * Aktif alıcı isteklerini getir
     *
     * @param $query
     * @return mixed
     */
    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    /**
     * Süre bazlı işler için scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeTimeBased($query)
    {
        return $query->where('job_type', 'time_based');
    }

    /**
     * Proje bazlı işler için scope
     *
     * @param $query
     * @return mixed
     */
    public function scopeProjectBased($query)
    {
        return $query->where('job_type', 'project_based');
    }

    /**
     * Bütçe aralığını formatlı şekilde getir
     *
     * @return string
     */
    public function getBudgetRangeAttribute(): string
    {
        if (!$this->budget_min && !$this->budget_max) {
            return 'Belirtilmedi';
        }

        $currency = $this->currency === 'TRY' ? '₺' : $this->currency;
        
        if ($this->budget_min && $this->budget_max) {
            return $currency . number_format($this->budget_min, 2) . ' - ' . $currency . number_format($this->budget_max, 2);
        }

        if ($this->budget_min) {
            return 'Minimum ' . $currency . number_format($this->budget_min, 2);
        }

        return 'Maksimum ' . $currency . number_format($this->budget_max, 2);
    }

    /**
     * Teslim süresini Türkçe olarak getir
     *
     * @return string
     */
    public function getDeliveryTimeTextAttribute(): string
    {
        return match($this->delivery_time) {
            'few_days' => 'Birkaç gün',
            'one_week' => '1 hafta',
            'one_month' => '1 ay',
            'one_to_three_months' => '1-3 ay',
            'more_than_three_months' => '3 aydan fazla',
            default => 'Belirtilmedi'
        };
    }

    /**
     * Çalışma süresini Türkçe olarak getir
     *
     * @return string
     */
    public function getWorkDurationTextAttribute(): string
    {
        if (!$this->work_duration_type) {
            return 'Belirtilmedi';
        }

        return $this->work_duration_type === 'hourly' ? 'Saatlik' : 'Günlük';
    }
}
