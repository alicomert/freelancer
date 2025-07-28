<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PollOption extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'option_text',
        'order_index',
        'vote_count',
        'created_by_user_id'
    ];

    protected $casts = [
        'order_index' => 'integer',
        'vote_count' => 'integer',
        'created_by_user_id' => 'integer'
    ];

    // İlişkiler
    public function poll(): BelongsTo
    {
        return $this->belongsTo(PostPoll::class, 'poll_id');
    }

    public function votes(): HasMany
    {
        return $this->hasMany(PollVote::class, 'option_id');
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by_user_id');
    }

    // Scope'lar
    public function scopeOrdered($query)
    {
        return $query->orderBy('order_index');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('vote_count', 'desc');
    }

    public function scopeWithVotes($query)
    {
        return $query->where('vote_count', '>', 0);
    }

    public function scopeUserCreated($query, int $userId)
    {
        return $query->where('created_by_user_id', $userId);
    }

    // Accessor'lar
    public function getPercentageAttribute(): float
    {
        $totalVotes = $this->poll->total_votes ?? 0;
        
        if ($totalVotes === 0) {
            return 0;
        }

        return round(($this->vote_count / $totalVotes) * 100, 1);
    }

    public function getIsWinningAttribute(): bool
    {
        $maxVotes = $this->poll->options()->max('vote_count');
        return $this->vote_count === $maxVotes && $this->vote_count > 0;
    }

    public function getIsUserCreatedAttribute(): bool
    {
        return $this->created_by_user_id !== null;
    }

    public function getFormattedTextAttribute(): string
    {
        return strip_tags($this->option_text);
    }

    // Yardımcı metodlar
    public function incrementVotes(): void
    {
        $this->increment('vote_count');
    }

    public function decrementVotes(): void
    {
        if ($this->vote_count > 0) {
            $this->decrement('vote_count');
        }
    }

    public function updateOrder(int $newOrder): void
    {
        $this->update(['order_index' => $newOrder]);
    }

    public function moveUp(): bool
    {
        $previousOption = $this->poll->options()
            ->where('order_index', '<', $this->order_index)
            ->orderBy('order_index', 'desc')
            ->first();

        if (!$previousOption) {
            return false;
        }

        $currentOrder = $this->order_index;
        $previousOrder = $previousOption->order_index;

        $this->update(['order_index' => $previousOrder]);
        $previousOption->update(['order_index' => $currentOrder]);

        return true;
    }

    public function moveDown(): bool
    {
        $nextOption = $this->poll->options()
            ->where('order_index', '>', $this->order_index)
            ->orderBy('order_index', 'asc')
            ->first();

        if (!$nextOption) {
            return false;
        }

        $currentOrder = $this->order_index;
        $nextOrder = $nextOption->order_index;

        $this->update(['order_index' => $nextOrder]);
        $nextOption->update(['order_index' => $currentOrder]);

        return true;
    }

    public function hasUserVoted(int $userId): bool
    {
        return $this->votes()
            ->where('user_id', $userId)
            ->exists();
    }

    public function getVoters(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->votes()
            ->with('user')
            ->get()
            ->pluck('user')
            ->filter();
    }

    public function getVotesByDate(string $date = null): int
    {
        $query = $this->votes();
        
        if ($date) {
            $query->whereDate('created_at', $date);
        } else {
            $query->whereDate('created_at', today());
        }

        return $query->count();
    }

    public function canBeDeleted(): bool
    {
        // Eğer oy almışsa ve anket aktifse silinemez
        if ($this->vote_count > 0 && $this->poll->is_active) {
            return false;
        }

        // Anket bitmiş ve oy almışsa silinemez (veri bütünlüğü için)
        if ($this->vote_count > 0 && $this->poll->is_ended) {
            return false;
        }

        return true;
    }

    public function delete()
    {
        if (!$this->canBeDeleted()) {
            return false;
        }

        // Oyları da sil
        $this->votes()->delete();

        // Anketin toplam oy sayısını güncelle
        $this->poll->decrement('total_votes', $this->vote_count);

        // Diğer seçeneklerin sırasını yeniden düzenle
        $this->poll->options()
            ->where('order_index', '>', $this->order_index)
            ->decrement('order_index');

        return parent::delete();
    }

    // Static metodlar
    public static function createForPoll(int $pollId, string $optionText, int $userId = null): self
    {
        $poll = PostPoll::find($pollId);
        
        if (!$poll || !$poll->allow_add_options || $poll->is_ended) {
            throw new \Exception('Bu ankete seçenek eklenemez.');
        }

        $orderIndex = $poll->options()->max('order_index') + 1;

        return self::create([
            'poll_id' => $pollId,
            'option_text' => $optionText,
            'order_index' => $orderIndex,
            'created_by_user_id' => $userId
        ]);
    }

    public static function reorderForPoll(int $pollId, array $optionIds): void
    {
        foreach ($optionIds as $index => $optionId) {
            self::where('id', $optionId)
                ->where('poll_id', $pollId)
                ->update(['order_index' => $index + 1]);
        }
    }
}
