<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Crypt;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'username',
        'email',
        'password',
        'first_name',
        'last_name',
        'avatar',
        'cover_image',
        'bio',
        'title',
        'hourly_rate',
        'location',
        'website',
        'phone',
        'birth_date',
        'tc_identity',
        'tc_verified',
        'is_freelancer',
        'is_company',
        'company_name',
        'company_tax_number',
        'company_address',
        'joined_date',
        'followers_count',
        'following_count',
        'posts_count',
        'rating',
        'total_reviews',
        'total_earned',
        'completed_projects',
        'is_verified',
        'is_online',
        'last_seen',
        'status',
        'account_status',
        'banned_at',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'last_seen' => 'datetime',
            'birth_date' => 'date',
            'joined_date' => 'date',
            'banned_at' => 'datetime',
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'is_online' => 'boolean',
            'tc_verified' => 'boolean',
            'is_freelancer' => 'boolean',
            'is_company' => 'boolean',
            'rating' => 'decimal:2',
            'total_earned' => 'decimal:2',
            'hourly_rate' => 'decimal:2',
        ];
    }

    // Relationships
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function clientContracts()
    {
        return $this->hasMany(Contract::class, 'client_id');
    }

    public function freelancerContracts()
    {
        return $this->hasMany(Contract::class, 'freelancer_id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function receivedMessages()
    {
        return $this->hasMany(Message::class, 'receiver_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follows', 'following_id', 'follower_id');
    }

    public function following()
    {
        return $this->belongsToMany(User::class, 'follows', 'follower_id', 'following_id');
    }

    // Yeni performanslı takip etme ilişkileri
    public function userFollows()
    {
        return $this->hasMany(UserFollow::class, 'follower_id');
    }

    public function userFollowers()
    {
        return $this->hasMany(UserFollow::class, 'following_id');
    }

    // Engelleme ilişkileri
    public function blockedUsers()
    {
        return $this->hasMany(UserBlock::class, 'blocker_id');
    }

    public function blockedByUsers()
    {
        return $this->hasMany(UserBlock::class, 'blocked_id');
    }

    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }

    public function reviewsGiven()
    {
        return $this->hasMany(Review::class, 'reviewer_id');
    }

    public function reviewsReceived()
    {
        return $this->hasMany(Review::class, 'reviewed_id');
    }

    public function educations()
    {
        return $this->hasMany(UserEducation::class)->orderBy('sort_order', 'asc');
    }

    public function skills()
    {
        return $this->hasMany(UserSkill::class)->orderBy('sort_order', 'asc');
    }

    // Scopes
    public function scopeActive($query)
    {
        return $query->where('status', 'active');
    }

    public function scopeVerified($query)
    {
        return $query->where('is_verified', true);
    }

    public function scopeOnline($query)
    {
        return $query->where('is_online', true);
    }

    // Accessors
    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function setTcIdentityAttribute($value)
    {
        $this->attributes['tc_identity'] = Crypt::encryptString($value);
    }

    public function getTcIdentityAttribute($value)
    {
        try {
            return Crypt::decryptString($value);
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return $value;
        }
    }

    public function getAvatarUrlAttribute()
    {
        return $this->avatar 
            ? asset('storage/' . $this->avatar)
            : 'https://ui-avatars.com/api/?name=' . urlencode($this->full_name);
    }

    // Methods
    public function updateOnlineStatus()
    {
        $this->update([
            'is_online' => true,
            'last_seen' => now()
        ]);
    }

    public function updateRating()
    {
        $reviews = $this->reviewsReceived()->where('is_public', true);
        $this->update([
            'rating' => $reviews->avg('rating') ?? 0,
            'total_reviews' => $reviews->count()
        ]);
    }

    // Performanslı takip etme metodları
    public function followUser($userId)
    {
        // Zaten takip ediyorsa veya kendisini takip etmeye çalışıyorsa
        if ($this->id == $userId || $this->isFollowing($userId)) {
            return false;
        }

        // Engelleme kontrolü
        if ($this->isBlocked($userId) || $this->isBlockedBy($userId)) {
            return false;
        }

        // Takip et
        UserFollow::create([
            'follower_id' => $this->id,
            'following_id' => $userId
        ]);

        // Sayaçları güncelle
        $this->increment('following_count');
        User::where('id', $userId)->increment('followers_count');

        return true;
    }

    public function unfollowUser($userId)
    {
        $follow = UserFollow::where('follower_id', $this->id)
                           ->where('following_id', $userId)
                           ->first();

        if ($follow) {
            $follow->delete();
            
            // Sayaçları güncelle
            $this->decrement('following_count');
            User::where('id', $userId)->decrement('followers_count');
            
            return true;
        }

        return false;
    }

    public function isFollowing($userId)
    {
        return UserFollow::where('follower_id', $this->id)
                        ->where('following_id', $userId)
                        ->exists();
    }

    public function blockUser($userId, $reason = null)
    {
        // Kendisini engelleyemez
        if ($this->id == $userId) {
            return false;
        }

        // Zaten engelliyorsa
        if ($this->isBlocked($userId)) {
            return false;
        }

        // Takip ilişkisini kaldır
        $this->unfollowUser($userId);
        User::find($userId)->unfollowUser($this->id);

        // Engelle
        UserBlock::create([
            'blocker_id' => $this->id,
            'blocked_id' => $userId,
            'reason' => $reason
        ]);

        return true;
    }

    public function unblockUser($userId)
    {
        $block = UserBlock::where('blocker_id', $this->id)
                          ->where('blocked_id', $userId)
                          ->first();

        if ($block) {
            $block->delete();
            return true;
        }

        return false;
    }

    public function isBlocked($userId)
    {
        return UserBlock::where('blocker_id', $this->id)
                       ->where('blocked_id', $userId)
                       ->exists();
    }

    public function isBlockedBy($userId)
    {
        return UserBlock::where('blocker_id', $userId)
                       ->where('blocked_id', $this->id)
                       ->exists();
    }
}
