<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

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
        'skills',
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
            'password' => 'hashed',
            'is_verified' => 'boolean',
            'is_online' => 'boolean',
            'tc_verified' => 'boolean',
            'is_freelancer' => 'boolean',
            'is_company' => 'boolean',
            'rating' => 'decimal:2',
            'total_earned' => 'decimal:2',
            'hourly_rate' => 'decimal:2',
            'skills' => 'array',
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

    public function sentMessages()
    {
        return $this->hasMany(Message::class, 'sender_id');
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
}
