@extends('layouts.app')

@section('title', 'Bildirimler - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@section('content')
<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        
        <!-- Left Sidebar -->
        <div class="w-full lg:w-1/4">
            <!-- Shortcuts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Bildirim Filtreleri</h3>
                <div class="space-y-2">
                    <button onclick="filterNotifications('all')" class="filter-btn w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-bell text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium">Tüm Bildirimler</span>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ count($notifications) }} bildirim</div>
                        </div>
                    </button>
                    <button onclick="filterNotifications('unread')" class="filter-btn w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-circle text-red-600 dark:text-red-400"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium">Okunmamış</span>
                            <div class="text-xs text-gray-500 dark:text-gray-400">{{ $unreadCount }} bildirim</div>
                        </div>
                    </button>
                    <button onclick="filterNotifications('project_bid')" class="filter-btn w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-briefcase text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium">Proje Teklifleri</span>
                        </div>
                    </button>
                    <button onclick="filterNotifications('message')" class="filter-btn w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-envelope text-green-600 dark:text-green-400"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium">Mesajlar</span>
                        </div>
                    </button>
                    <button onclick="filterNotifications('auction_bid')" class="filter-btn w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-gavel text-yellow-600 dark:text-yellow-400"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium">Açık Arttırma</span>
                        </div>
                    </button>
                    <button onclick="filterNotifications('payment')" class="filter-btn w-full text-left flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-credit-card text-green-600 dark:text-green-400"></i>
                        </div>
                        <div class="flex-1">
                            <span class="font-medium">Ödemeler</span>
                        </div>
                    </button>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Hızlı İşlemler</h3>
                <div class="space-y-2">
                    <button onclick="markAllAsRead()" class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-check-double text-blue-600 dark:text-blue-400"></i>
                        </div>
                        <span class="font-medium">Tümünü Okundu İşaretle</span>
                    </button>
                    <button onclick="deleteAllRead()" class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 bg-red-100 dark:bg-red-900/30 rounded-lg flex items-center justify-center">
                            <i class="fas fa-trash text-red-600 dark:text-red-400"></i>
                        </div>
                        <span class="font-medium">Okunanları Sil</span>
                    </button>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="w-full lg:w-2/4">
            <!-- Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Bildirimler</h1>
                        <p class="text-gray-600 dark:text-gray-400">Tüm aktivitelerinizi takip edin</p>
                    </div>
                    <div class="flex items-center space-x-2">
                        @if($unreadCount > 0)
                        <span class="bg-red-100 dark:bg-red-900/30 text-red-600 dark:text-red-400 px-3 py-1 rounded-full text-sm font-medium">
                            {{ $unreadCount }} okunmamış
                        </span>
                        @endif
                        <button onclick="refreshNotifications()" class="p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-600 dark:text-gray-400">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Notifications List -->
            <div class="space-y-3" id="notifications-container">
                @foreach($notifications as $notification)
                <div class="notification-item bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 border-l-4 border-{{ $notification['color'] }}-500 {{ !$notification['is_read'] ? 'bg-blue-50 dark:bg-blue-900/10' : '' }}" 
                     data-type="{{ $notification['type'] }}" 
                     data-read="{{ $notification['is_read'] ? 'true' : 'false' }}">
                    <div class="flex items-start space-x-4">
                        <div class="flex-shrink-0">
                            <div class="w-12 h-12 bg-{{ $notification['color'] }}-100 dark:bg-{{ $notification['color'] }}-900/30 rounded-lg flex items-center justify-center">
                                <i class="{{ $notification['icon'] }} text-{{ $notification['color'] }}-600 dark:text-{{ $notification['color'] }}-400"></i>
                            </div>
                        </div>
                        <div class="flex-1 min-w-0">
                            <div class="flex items-start justify-between">
                                <div class="flex-1">
                                    <h3 class="text-sm font-semibold text-gray-900 dark:text-white">{{ $notification['title'] }}</h3>
                                    <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">{{ $notification['message'] }}</p>
                                    <div class="flex items-center space-x-4 mt-2">
                                        <span class="text-xs text-gray-500 dark:text-gray-400">
                                            {{ $notification['created_at']->diffForHumans() }}
                                        </span>
                                        @if(!$notification['is_read'])
                                        <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400">
                                            Yeni
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="flex items-center space-x-2 ml-4">
                                    @if(!$notification['is_read'])
                                    <button onclick="markAsRead({{ $notification['id'] }})" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-400 hover:text-blue-600 dark:hover:text-blue-400" title="Okundu işaretle">
                                        <i class="fas fa-check text-xs"></i>
                                    </button>
                                    @endif
                                    <button onclick="deleteNotification({{ $notification['id'] }})" class="p-1 rounded hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-400 hover:text-red-600 dark:hover:text-red-400" title="Sil">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>
                            </div>
                            
                            <!-- Action Buttons based on notification type -->
                            @if($notification['type'] === 'project_bid')
                            <div class="mt-3 flex space-x-2">
                                <button class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">
                                    Teklifi Görüntüle
                                </button>
                                <button class="px-3 py-1 bg-gray-200 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs hover:bg-gray-300 dark:hover:bg-gray-600">
                                    Projeye Git
                                </button>
                            </div>
                            @elseif($notification['type'] === 'message')
                            <div class="mt-3">
                                <button class="px-3 py-1 bg-green-500 text-white rounded text-xs hover:bg-green-600">
                                    Mesajı Yanıtla
                                </button>
                            </div>
                            @elseif($notification['type'] === 'auction_bid')
                            <div class="mt-3 flex space-x-2">
                                <button class="px-3 py-1 bg-yellow-500 text-white rounded text-xs hover:bg-yellow-600">
                                    Açık Arttırmaya Git
                                </button>
                                <button class="px-3 py-1 bg-blue-500 text-white rounded text-xs hover:bg-blue-600">
                                    Yeni Teklif Ver
                                </button>
                            </div>
                            @elseif($notification['type'] === 'service_order')
                            <div class="mt-3">
                                <button class="px-3 py-1 bg-purple-500 text-white rounded text-xs hover:bg-purple-600">
                                    Siparişi Görüntüle
                                </button>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Load More -->
            <div class="mt-6 text-center">
                <button class="px-6 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors">
                    Daha Fazla Yükle
                </button>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="w-full lg:w-1/4">
            <!-- Notification Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">İstatistikler</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Bugün</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ collect($notifications)->where('created_at', '>=', now()->startOfDay())->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Bu Hafta</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ collect($notifications)->where('created_at', '>=', now()->startOfWeek())->count() }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Bu Ay</span>
                        <span class="font-semibold text-gray-900 dark:text-white">{{ count($notifications) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-400">Okunma Oranı</span>
                        <span class="font-semibold text-green-600 dark:text-green-400">{{ round((count($notifications) - $unreadCount) / count($notifications) * 100) }}%</span>
                    </div>
                </div>
            </div>

            <!-- Notification Types -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Bildirim Türleri</h3>
                <div class="space-y-3">
                    @php
                        $typeStats = collect($notifications)->groupBy('type')->map(function($group) {
                            return $group->count();
                        });
                    @endphp
                    
                    @foreach($typeStats as $type => $count)
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            @switch($type)
                                @case('project_bid')
                                    <i class="fas fa-briefcase text-blue-600 dark:text-blue-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Proje Teklifleri</span>
                                    @break
                                @case('message')
                                    <i class="fas fa-envelope text-green-600 dark:text-green-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Mesajlar</span>
                                    @break
                                @case('auction_bid')
                                    <i class="fas fa-gavel text-yellow-600 dark:text-yellow-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Açık Arttırma</span>
                                    @break
                                @case('service_order')
                                    <i class="fas fa-shopping-cart text-purple-600 dark:text-purple-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Hizmet Siparişi</span>
                                    @break
                                @case('payment')
                                    <i class="fas fa-credit-card text-green-600 dark:text-green-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Ödemeler</span>
                                    @break
                                @default
                                    <i class="fas fa-bell text-gray-600 dark:text-gray-400"></i>
                                    <span class="text-sm text-gray-700 dark:text-gray-300">Diğer</span>
                            @endswitch
                        </div>
                        <span class="text-sm font-medium text-gray-900 dark:text-white">{{ $count }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            <!-- Settings -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Bildirim Ayarları</h3>
                <div class="space-y-3">
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">E-posta bildirimleri</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" checked class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Push bildirimleri</span>
                    </label>
                    <label class="flex items-center">
                        <input type="checkbox" class="rounded border-gray-300 text-blue-600 focus:ring-blue-500">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">SMS bildirimleri</span>
                    </label>
                    <button class="w-full mt-3 px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition-colors text-sm">
                        Ayarları Kaydet
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Bildirim filtreleme
function filterNotifications(type) {
    const notifications = document.querySelectorAll('.notification-item');
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    // Aktif filter butonunu güncelle
    filterBtns.forEach(btn => btn.classList.remove('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400'));
    event.target.closest('.filter-btn').classList.add('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
    
    notifications.forEach(notification => {
        if (type === 'all') {
            notification.style.display = 'block';
        } else if (type === 'unread') {
            notification.style.display = notification.dataset.read === 'false' ? 'block' : 'none';
        } else {
            notification.style.display = notification.dataset.type === type ? 'block' : 'none';
        }
    });
}

// Bildirimi okundu olarak işaretle
function markAsRead(id) {
    fetch(`/notifications/${id}/read`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const notification = document.querySelector(`[data-id="${id}"]`);
            if (notification) {
                notification.classList.remove('bg-blue-50', 'dark:bg-blue-900/10');
                notification.dataset.read = 'true';
                const newBadge = notification.querySelector('.bg-blue-100');
                if (newBadge) newBadge.remove();
                const checkBtn = notification.querySelector('.fa-check').closest('button');
                if (checkBtn) checkBtn.remove();
            }
            showNotification('Bildirim okundu olarak işaretlendi', 'success');
        }
    })
    .catch(error => {
        showNotification('Bir hata oluştu', 'error');
    });
}

// Tüm bildirimleri okundu olarak işaretle
function markAllAsRead() {
    fetch('/notifications/mark-all-read', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            location.reload();
        }
    })
    .catch(error => {
        showNotification('Bir hata oluştu', 'error');
    });
}

// Bildirimi sil
function deleteNotification(id) {
    if (confirm('Bu bildirimi silmek istediğinizden emin misiniz?')) {
        fetch(`/notifications/${id}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                const notification = document.querySelector(`[data-id="${id}"]`);
                if (notification) {
                    notification.remove();
                }
                showNotification('Bildirim silindi', 'success');
            }
        })
        .catch(error => {
            showNotification('Bir hata oluştu', 'error');
        });
    }
}

// Okunan bildirimleri sil
function deleteAllRead() {
    if (confirm('Tüm okunan bildirimleri silmek istediğinizden emin misiniz?')) {
        const readNotifications = document.querySelectorAll('[data-read="true"]');
        readNotifications.forEach(notification => {
            notification.remove();
        });
        showNotification('Okunan bildirimler silindi', 'success');
    }
}

// Bildirimleri yenile
function refreshNotifications() {
    location.reload();
}

// Bildirim göster
function showNotification(message, type) {
    // Basit bir toast notification
    const toast = document.createElement('div');
    toast.className = `fixed top-4 right-4 z-50 p-4 rounded-lg text-white ${type === 'success' ? 'bg-green-500' : 'bg-red-500'}`;
    toast.textContent = message;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.remove();
    }, 3000);
}

// Sayfa yüklendiğinde ilk filtreyi aktif yap
document.addEventListener('DOMContentLoaded', function() {
    document.querySelector('.filter-btn').classList.add('bg-blue-100', 'dark:bg-blue-900/30', 'text-blue-600', 'dark:text-blue-400');
});
</script>
@endsection