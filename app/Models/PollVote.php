<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Carbon\Carbon;

class PollVote extends Model
{
    use HasFactory;

    protected $fillable = [
        'poll_id',
        'option_id',
        'user_id',
        'ip_address',
        'user_agent'
    ];

    protected $casts = [
        'poll_id' => 'integer',
        'option_id' => 'integer',
        'user_id' => 'integer'
    ];

    // İlişkiler
    public function poll(): BelongsTo
    {
        return $this->belongsTo(PostPoll::class, 'poll_id');
    }

    public function option(): BelongsTo
    {
        return $this->belongsTo(PollOption::class, 'option_id');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Scope'lar
    public function scopeByUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    public function scopeByPoll($query, int $pollId)
    {
        return $query->where('poll_id', $pollId);
    }

    public function scopeByOption($query, int $optionId)
    {
        return $query->where('option_id', $optionId);
    }

    public function scopeToday($query)
    {
        return $query->whereDate('created_at', today());
    }

    public function scopeThisWeek($query)
    {
        return $query->whereBetween('created_at', [
            now()->startOfWeek(),
            now()->endOfWeek()
        ]);
    }

    public function scopeThisMonth($query)
    {
        return $query->whereMonth('created_at', now()->month)
                    ->whereYear('created_at', now()->year);
    }

    public function scopeByDateRange($query, string $startDate, string $endDate)
    {
        return $query->whereBetween('created_at', [
            Carbon::parse($startDate)->startOfDay(),
            Carbon::parse($endDate)->endOfDay()
        ]);
    }

    public function scopeByIp($query, string $ipAddress)
    {
        return $query->where('ip_address', $ipAddress);
    }

    public function scopeAnonymous($query)
    {
        return $query->whereHas('poll', function ($q) {
            $q->where('anonymous_voting', true);
        });
    }

    // Accessor'lar
    public function getIsAnonymousAttribute(): bool
    {
        return $this->poll->anonymous_voting ?? false;
    }

    public function getVoteTimeAttribute(): string
    {
        return $this->created_at->diffForHumans();
    }

    public function getFormattedDateAttribute(): string
    {
        return $this->created_at->format('d.m.Y H:i');
    }

    public function getUserInfoAttribute(): array
    {
        if ($this->is_anonymous) {
            return [
                'name' => 'Anonim',
                'avatar' => null,
                'id' => null
            ];
        }

        return [
            'name' => $this->user->name ?? 'Bilinmeyen Kullanıcı',
            'avatar' => $this->user->avatar ?? null,
            'id' => $this->user_id
        ];
    }

    public function getBrowserInfoAttribute(): ?array
    {
        if (!$this->user_agent) {
            return null;
        }

        // Basit user agent parsing
        $userAgent = $this->user_agent;
        $browser = 'Bilinmeyen';
        $platform = 'Bilinmeyen';

        // Browser detection
        if (strpos($userAgent, 'Chrome') !== false) {
            $browser = 'Chrome';
        } elseif (strpos($userAgent, 'Firefox') !== false) {
            $browser = 'Firefox';
        } elseif (strpos($userAgent, 'Safari') !== false) {
            $browser = 'Safari';
        } elseif (strpos($userAgent, 'Edge') !== false) {
            $browser = 'Edge';
        }

        // Platform detection
        if (strpos($userAgent, 'Windows') !== false) {
            $platform = 'Windows';
        } elseif (strpos($userAgent, 'Mac') !== false) {
            $platform = 'macOS';
        } elseif (strpos($userAgent, 'Linux') !== false) {
            $platform = 'Linux';
        } elseif (strpos($userAgent, 'Android') !== false) {
            $platform = 'Android';
        } elseif (strpos($userAgent, 'iOS') !== false) {
            $platform = 'iOS';
        }

        return [
            'browser' => $browser,
            'platform' => $platform,
            'full_agent' => $userAgent
        ];
    }

    // Yardımcı metodlar
    public function canBeDeleted(): bool
    {
        // Anket bitmiş ise oylar silinemez (veri bütünlüğü için)
        if ($this->poll->is_ended) {
            return false;
        }

        // Sadece kendi oyunu silebilir
        return true;
    }

    public function delete()
    {
        if (!$this->canBeDeleted()) {
            return false;
        }

        // Seçeneğin oy sayısını azalt
        $this->option->decrementVotes();

        // Anketin toplam oy sayısını azalt
        $this->poll->decrement('total_votes');

        return parent::delete();
    }

    // Static metodlar
    public static function createVote(
        int $pollId, 
        int $optionId, 
        int $userId, 
        ?string $ipAddress = null, 
        ?string $userAgent = null
    ): ?self {
        $poll = PostPoll::find($pollId);
        
        if (!$poll || $poll->is_ended) {
            return null;
        }

        // Tek seçimli ankette kullanıcının daha önce oy verip vermediğini kontrol et
        if (!$poll->multiple_choice) {
            $existingVote = self::where('poll_id', $pollId)
                              ->where('user_id', $userId)
                              ->exists();
            
            if ($existingVote) {
                return null;
            }
        }

        // Seçeneğin bu ankete ait olduğunu kontrol et
        $option = PollOption::where('id', $optionId)
                           ->where('poll_id', $pollId)
                           ->first();
        
        if (!$option) {
            return null;
        }

        // Oy oluştur
        $vote = self::create([
            'poll_id' => $pollId,
            'option_id' => $optionId,
            'user_id' => $userId,
            'ip_address' => $ipAddress,
            'user_agent' => $userAgent
        ]);

        // Sayaçları güncelle
        $option->incrementVotes();
        $poll->increment('total_votes');

        return $vote;
    }

    public static function removeVote(int $pollId, int $optionId, int $userId): bool
    {
        $vote = self::where('poll_id', $pollId)
                   ->where('option_id', $optionId)
                   ->where('user_id', $userId)
                   ->first();

        if (!$vote) {
            return false;
        }

        return $vote->delete() !== false;
    }

    public static function getUserVotesForPoll(int $pollId, int $userId): \Illuminate\Database\Eloquent\Collection
    {
        return self::where('poll_id', $pollId)
                  ->where('user_id', $userId)
                  ->with(['option'])
                  ->get();
    }

    public static function getVoteStatsByPoll(int $pollId): array
    {
        $votes = self::where('poll_id', $pollId)->get();
        
        $stats = [
            'total_votes' => $votes->count(),
            'unique_voters' => $votes->unique('user_id')->count(),
            'votes_by_hour' => [],
            'votes_by_day' => [],
            'top_browsers' => [],
            'top_platforms' => []
        ];

        // Saatlik dağılım
        $votesByHour = $votes->groupBy(function ($vote) {
            return $vote->created_at->format('H');
        });

        foreach ($votesByHour as $hour => $hourVotes) {
            $stats['votes_by_hour'][$hour] = $hourVotes->count();
        }

        // Günlük dağılım
        $votesByDay = $votes->groupBy(function ($vote) {
            return $vote->created_at->format('Y-m-d');
        });

        foreach ($votesByDay as $day => $dayVotes) {
            $stats['votes_by_day'][$day] = $dayVotes->count();
        }

        // Browser istatistikleri
        $browsers = $votes->map(function ($vote) {
            return $vote->browser_info['browser'] ?? 'Bilinmeyen';
        })->countBy();

        $stats['top_browsers'] = $browsers->sortDesc()->take(5)->toArray();

        // Platform istatistikleri
        $platforms = $votes->map(function ($vote) {
            return $vote->browser_info['platform'] ?? 'Bilinmeyen';
        })->countBy();

        $stats['top_platforms'] = $platforms->sortDesc()->take(5)->toArray();

        return $stats;
    }

    public static function detectDuplicateVotes(int $pollId): array
    {
        // IP adresine göre şüpheli oylar
        $suspiciousIpVotes = self::where('poll_id', $pollId)
            ->whereNotNull('ip_address')
            ->selectRaw('ip_address, COUNT(*) as vote_count')
            ->groupBy('ip_address')
            ->having('vote_count', '>', 5) // Aynı IP'den 5'ten fazla oy
            ->get();

        // Kullanıcı bazında şüpheli oylar (çoklu seçimli anketlerde)
        $suspiciousUserVotes = self::where('poll_id', $pollId)
            ->selectRaw('user_id, COUNT(*) as vote_count')
            ->groupBy('user_id')
            ->having('vote_count', '>', 10) // Aynı kullanıcıdan 10'dan fazla oy
            ->get();

        return [
            'suspicious_ip_votes' => $suspiciousIpVotes->toArray(),
            'suspicious_user_votes' => $suspiciousUserVotes->toArray()
        ];
    }
}
