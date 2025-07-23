<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NotificationController extends Controller
{
    public function index()
    {
        // Demo bildirimler - gerçek uygulamada veritabanından gelecek
        $notifications = [
            [
                'id' => 1,
                'type' => 'project_bid',
                'title' => 'Yeni Teklif Aldınız',
                'message' => 'E-ticaret sitesi projeniz için yeni bir teklif aldınız.',
                'data' => ['project_id' => 1, 'bid_amount' => 15000],
                'is_read' => false,
                'created_at' => now()->subMinutes(5),
                'icon' => 'fas fa-briefcase',
                'color' => 'blue'
            ],
            [
                'id' => 2,
                'type' => 'message',
                'title' => 'Yeni Mesaj',
                'message' => 'Ahmet Yılmaz size bir mesaj gönderdi.',
                'data' => ['sender_id' => 2],
                'is_read' => false,
                'created_at' => now()->subMinutes(15),
                'icon' => 'fas fa-envelope',
                'color' => 'green'
            ],
            [
                'id' => 3,
                'type' => 'auction_bid',
                'title' => 'Açık Arttırma Teklifi',
                'message' => '"Instagram Teknoloji Hesabı" açık arttırmasında teklifiniz aşıldı.',
                'data' => ['auction_id' => 1, 'new_bid' => 25000],
                'is_read' => false,
                'created_at' => now()->subHour(),
                'icon' => 'fas fa-gavel',
                'color' => 'yellow'
            ],
            [
                'id' => 4,
                'type' => 'service_order',
                'title' => 'Hizmet Siparişi',
                'message' => 'Logo tasarım hizmetiniz için yeni sipariş aldınız.',
                'data' => ['service_id' => 3, 'order_amount' => 500],
                'is_read' => true,
                'created_at' => now()->subHours(2),
                'icon' => 'fas fa-shopping-cart',
                'color' => 'purple'
            ],
            [
                'id' => 5,
                'type' => 'community_post',
                'title' => 'Topluluk Gönderisi',
                'message' => 'Web Geliştirme topluluğunda yeni bir gönderi paylaşıldı.',
                'data' => ['community_id' => 1, 'post_id' => 15],
                'is_read' => true,
                'created_at' => now()->subHours(3),
                'icon' => 'fas fa-users',
                'color' => 'indigo'
            ],
            [
                'id' => 6,
                'type' => 'payment',
                'title' => 'Ödeme Alındı',
                'message' => 'Mobil uygulama projesi için ödemeniz alındı.',
                'data' => ['amount' => 12000, 'project_id' => 5],
                'is_read' => true,
                'created_at' => now()->subHours(5),
                'icon' => 'fas fa-credit-card',
                'color' => 'green'
            ],
            [
                'id' => 7,
                'type' => 'profile_view',
                'title' => 'Profil Görüntüleme',
                'message' => 'Profiliniz bu hafta 25 kez görüntülendi.',
                'data' => ['view_count' => 25],
                'is_read' => true,
                'created_at' => now()->subDay(),
                'icon' => 'fas fa-eye',
                'color' => 'gray'
            ],
            [
                'id' => 8,
                'type' => 'system',
                'title' => 'Sistem Güncellemesi',
                'message' => 'Platform yeni özelliklerle güncellendi.',
                'data' => ['version' => '2.1.0'],
                'is_read' => true,
                'created_at' => now()->subDays(2),
                'icon' => 'fas fa-cog',
                'color' => 'blue'
            ]
        ];

        $unreadCount = collect($notifications)->where('is_read', false)->count();
        
        return view('notifications.index', compact('notifications', 'unreadCount'));
    }

    public function markAsRead(Request $request, $id)
    {
        // Gerçek uygulamada veritabanında güncelleme yapılacak
        return response()->json(['success' => true]);
    }

    public function markAllAsRead(Request $request)
    {
        // Gerçek uygulamada tüm bildirimleri okundu olarak işaretle
        return response()->json(['success' => true]);
    }

    public function delete(Request $request, $id)
    {
        // Gerçek uygulamada bildirimi sil
        return response()->json(['success' => true]);
    }
}