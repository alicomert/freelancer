<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PostPoll extends Model
{
    use HasFactory;

    protected $fillable = [
        'post_id',
        'question',
        'multiple_choice',
        'anonymous_voting',
        'end_date',
        'show_results',
        'allow_add_options',
        'total_votes'
    ];

    protected $casts = [
        'multiple_choice' => 'boolean',
        'anonymous_voting' => 'boolean',
        'show_results' => 'boolean',
        'allow_add_options' => 'boolean',
        'total_votes' => 'integer',
        'end_date' => 'datetime'
    ];

    protected $dates = [
        'end_date'
    ];

    // İlişkiler
    public function post(): BelongsTo
    {
        return $this->belongsTo(PostOptimized::class, 'post_id');
    }

    public function options(): HasMany
    {
        return $this->hasMany(PollOption::class, 'poll_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PollVote::class, 'poll_id');
    }

    // Scope'lar
    public function scopeActive($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('end_date')
              ->orWhere('end_date', '>', now());
        });
    }

    public function scopeEnded($query)
    {
        return $query->where('end_date', '<=', now());
    }

    public function scopeMultipleChoice($query)
    {
        return $query->where('multiple_choice', true);
    }

    public function scopeSingleChoice($query)
    {
        return $query->where('multiple_choice', false);
    }

    public function scopeAnonymous($query)
    {
        return $query->where('anonymous_voting', true);
    }

    public function scopeWithResults($query)
    {
        return $query->where('show_results', true);
    }

    // Accessor'lar
    public function getIsActiveAttribute(): bool
    {
        return $this->end_date === null || $this->end_date > now();
    }

    public function getIsEndedAttribute(): bool
    {
        return $this->end_date !== null && $this->end_date <= now();
    }

    public function getTimeRemainingAttribute(): ?string
    {
        if (!$this->end_date || $this->is_ended) return null;
        
        $diff = now()->diff($this->end_date);
        
        if ($diff->days > 0) {
            return $diff->days . ' gün ' . $diff->h . ' saat';
        } elseif ($diff->h > 0) {
            return $diff->h . ' saat ' . $diff->i . ' dakika';
        } else {
            return $diff->i . ' dakika';
        }
    }

    public function getParticipationRateAttribute(): float
    {
        if ($this->total_votes === 0) return 0;
        
        // Bu hesaplama için post'un görüntülenme sayısına ihtiyaç var
        $viewCount = $this->post->view_count ?? 1;
        return ($this->total_votes / $viewCount) * 100;
    }

    public function getResultsAttribute(): array
    {
        if (!$this->show_results && $this->is_active) {
            return [];
        }

        $results = [];
        $totalVotes = $this->total_votes;

        foreach ($this->options as $option) {
            $percentage = $totalVotes > 0 ? ($option->vote_count / $totalVotes) * 100 : 0;
            
            $results[] = [
                'id' => $option->id,
                'text' => $option->option_text,
                'votes' => $option->vote_count,
                'percentage' => round($percentage, 1)
            ];
        }

        return $results;
    }

    // Yardımcı metodlar
    public function addOption(string $optionText, int $userId): ?PollOption
    {
        if (!$this->allow_add_options || $this->is_ended) {
            return null;
        }

        $orderIndex = $this->options()->max('order_index') + 1;

        return $this->options()->create([
            'option_text' => $optionText,
            'order_index' => $orderIndex,
            'created_by_user_id' => $userId
        ]);
    }

    public function vote(int $optionId, int $userId, ?string $ipAddress = null, ?string $userAgent = null): bool
    {
        if ($this->is_ended) {
            return false;
        }

        // Kullanıcının daha önce oy verip vermediğini kontrol et
        if (!$this->multiple_choice) {
            $existingVote = $this->votes()
                ->where('user_id', $userId)
                ->exists();
            
            if ($existingVote) {
                return false; // Tek seçimde zaten oy vermiş
            }
        }

        // Seçeneğin bu ankete ait olduğunu kontrol et
        $option = $this->options()->find($optionId);
        if (!$option) {
            return false;
        }

        // Oy ver
        $this->votes()->create([
            'option_id' => $optionId,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent
        ]);

        // Sayaçları güncelle
        $option->increment('vote_count');
        $this->increment('total_votes');

        return true;
    }

    public function removeVote(int $optionId, int $userId): bool
    {
        if ($this->is_ended) {
            return false;
        }

        $vote = $this->votes()
            ->where('option_id', $optionId)
            ->where('user_id', $userId)
            ->first();

        if (!$vote) {
            return false;
        }

        $vote->delete();

        // Sayaçları güncelle
        $option = $this->options()->find($optionId);
        if ($option) {
            $option->decrement('vote_count');
        }
        $this->decrement('total_votes');

        return true;
    }

    public function getUserVotes(int $userId): array
    {
        return $this->votes()
            ->where('user_id', $userId)
            ->pluck('option_id')
            ->toArray();
    }

    public function hasUserVoted(int $userId): bool
    {
        return $this->votes()
            ->where('user_id', $userId)
            ->exists();
    }

    public function endPoll(): void
    {
        if ($this->is_active) {
            $this->update(['end_date' => now()]);
        }
    }

    public function extendPoll(\DateTime $newEndDate): void
    {
        if ($this->is_active && $newEndDate > now()) {
            $this->update(['end_date' => $newEndDate]);
        }
    }

    public function toggleResults(): void
    {
        $this->update(['show_results' => !$this->show_results]);
    }

    public function getWinningOption(): ?PollOption
    {
        return $this->options()
            ->orderBy('vote_count', 'desc')
            ->first();
    }

    public function calculateEngagement(): array
    {
        $totalVotes = $this->total_votes;
        $uniqueVoters = $this->votes()->distinct('user_id')->count();
        $averageVotesPerUser = $uniqueVoters > 0 ? $totalVotes / $uniqueVoters : 0;

        return [
            'total_votes' => $totalVotes,
            'unique_voters' => $uniqueVoters,
            'average_votes_per_user' => round($averageVotesPerUser, 2),
            'participation_rate' => $this->participation_rate
        ];
    }
}
