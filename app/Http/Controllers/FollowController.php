<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserFollow;
use App\Models\UserBlock;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
{
    // Laravel 11'de middleware tanımlaması route seviyesinde yapılır

    /**
     * Kullanıcıyı takip et
     */
    public function follow(Request $request, $userId)
    {
        $user = Auth::user();
        $targetUser = User::findOrFail($userId);

        if ($user->followUser($userId)) {
            return response()->json([
                'success' => true,
                'message' => $targetUser->full_name . ' takip edildi.',
                'following' => true,
                'followers_count' => $targetUser->fresh()->followers_count
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Takip işlemi başarısız.'
        ], 400);
    }

    /**
     * Kullanıcıyı takipten çıkar
     */
    public function unfollow(Request $request, $userId)
    {
        $user = Auth::user();
        $targetUser = User::findOrFail($userId);

        if ($user->unfollowUser($userId)) {
            return response()->json([
                'success' => true,
                'message' => $targetUser->full_name . ' takipten çıkarıldı.',
                'following' => false,
                'followers_count' => $targetUser->fresh()->followers_count
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Takipten çıkarma işlemi başarısız.'
        ], 400);
    }

    /**
     * Kullanıcıyı engelle
     */
    public function block(Request $request, $userId)
    {
        $request->validate([
            'reason' => 'nullable|string|max:500'
        ]);

        $user = Auth::user();
        $targetUser = User::findOrFail($userId);

        if ($user->blockUser($userId, $request->reason)) {
            return response()->json([
                'success' => true,
                'message' => $targetUser->full_name . ' engellendi.',
                'blocked' => true
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Engelleme işlemi başarısız.'
        ], 400);
    }

    /**
     * Kullanıcının engelini kaldır
     */
    public function unblock(Request $request, $userId)
    {
        $user = Auth::user();
        $targetUser = User::findOrFail($userId);

        if ($user->unblockUser($userId)) {
            return response()->json([
                'success' => true,
                'message' => $targetUser->full_name . ' engelinden kaldırıldı.',
                'blocked' => false
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Engel kaldırma işlemi başarısız.'
        ], 400);
    }

    /**
     * Takip durumunu kontrol et
     */
    public function checkStatus(Request $request, $userId)
    {
        $user = Auth::user();
        $targetUser = User::findOrFail($userId);

        return response()->json([
            'following' => $user->isFollowing($userId),
            'blocked' => $user->isBlocked($userId),
            'blocked_by' => $user->isBlockedBy($userId),
            'followers_count' => $targetUser->followers_count,
            'following_count' => $targetUser->following_count
        ]);
    }

    /**
     * Kullanıcının takipçilerini getir
     */
    public function getFollowers(Request $request, $userId)
    {
        $request->validate([
            'page' => 'integer|min:1',
            'search' => 'nullable|string|max:255'
        ]);

        $perPage = 20; // Her sayfada 20 takipçi
        $page = $request->get('page', 1);
        $search = $request->get('search');

        $query = UserFollow::with(['follower' => function($query) {
                $query->select('id', 'username', 'first_name', 'last_name', 'avatar');
            }])
            ->where('following_id', $userId)
            ->orderBy('created_at', 'desc');

        // Arama filtresi
        if ($search) {
            $query->whereHas('follower', function($q) use ($search) {
                $q->where('username', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            });
        }

        $followers = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $followers->items(),
            'current_page' => $followers->currentPage(),
            'last_page' => $followers->lastPage(),
            'total' => $followers->total(),
            'has_more' => $followers->hasMorePages()
        ]);
    }

    /**
     * Kullanıcının takip ettiklerini getir
     */
    public function getFollowing(Request $request, $userId)
    {
        $request->validate([
            'page' => 'integer|min:1',
            'search' => 'nullable|string|max:255'
        ]);

        $perPage = 20; // Her sayfada 20 takip edilen
        $page = $request->get('page', 1);
        $search = $request->get('search');

        $query = UserFollow::with(['following' => function($query) {
                $query->select('id', 'username', 'first_name', 'last_name', 'avatar');
            }])
            ->where('follower_id', $userId)
            ->orderBy('created_at', 'desc');

        // Arama filtresi
        if ($search) {
            $query->whereHas('following', function($q) use ($search) {
                $q->where('username', 'LIKE', "%{$search}%")
                  ->orWhere('first_name', 'LIKE', "%{$search}%")
                  ->orWhere('last_name', 'LIKE', "%{$search}%")
                  ->orWhereRaw("CONCAT(first_name, ' ', last_name) LIKE ?", ["%{$search}%"]);
            });
        }

        $following = $query->paginate($perPage, ['*'], 'page', $page);

        return response()->json([
            'success' => true,
            'data' => $following->items(),
            'current_page' => $following->currentPage(),
            'last_page' => $following->lastPage(),
            'total' => $following->total(),
            'has_more' => $following->hasMorePages()
        ]);
    }
}
