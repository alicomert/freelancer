@extends('layouts.app')

@section('title', 'Hizmetler - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@section('content')
<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <!-- Hero Section -->
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6 gradient-bg text-white">
        <div class="text-center">
            <h1 class="text-3xl font-bold mb-2">Hizmet Marketplace</h1>
            <p class="text-lg opacity-90 mb-4">Freelancerlardan profesyonel hizmetler alın veya kendi hizmetlerinizi satın</p>
            <div class="flex flex-wrap justify-center gap-6 text-sm">
                <div class="flex items-center space-x-2">
                    <i class="fas fa-shield-check"></i>
                    <span>Güvenli Ödeme</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-clock"></i>
                    <span>Hızlı Teslimat</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-star"></i>
                    <span>Kaliteli Hizmet</span>
                </div>
                <div class="flex items-center space-x-2">
                    <i class="fas fa-headset"></i>
                    <span>7/24 Destek</span>
                </div>
            </div>
        </div>
    </div>

    <!-- Hizmet Kategorileri Detaylı -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center">
                <i class="fas fa-th-large text-blue-500 mr-3"></i>
                Tüm Kategoriler
            </h2>
            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                <i class="fas fa-eye mr-2"></i>
                Tümünü Gör
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($serviceCategories as $category)
            <!-- {{ $category->name }} -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="{{ $category->icon }} text-2xl mr-3" style="color: {{ $category->color }}"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">{{ $category->name }}</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">
                                {{ $services->where('category', $category->slug)->count() }} ilan
                            </p>
                        </div>
                    </div>
                    @php
                        $badgeColors = [
                            'hosting-vps' => ['bg' => 'bg-blue-100 dark:bg-blue-900', 'text' => 'text-blue-800 dark:text-blue-300', 'label' => 'Aktif'],
                            'hesap-lisans' => ['bg' => 'bg-green-100 dark:bg-green-900', 'text' => 'text-green-800 dark:text-green-300', 'label' => 'Çok Satan'],
                            'epin-oyun' => ['bg' => 'bg-purple-100 dark:bg-purple-900', 'text' => 'text-purple-800 dark:text-purple-300', 'label' => 'Otomatik'],
                            'script-tema' => ['bg' => 'bg-orange-100 dark:bg-orange-900', 'text' => 'text-orange-800 dark:text-orange-300', 'label' => 'Popüler'],
                            'sosyal-medya' => ['bg' => 'bg-pink-100 dark:bg-pink-900', 'text' => 'text-pink-800 dark:text-pink-300', 'label' => 'Trend'],
                            'seo-pazarlama' => ['bg' => 'bg-indigo-100 dark:bg-indigo-900', 'text' => 'text-indigo-800 dark:text-indigo-300', 'label' => 'Profesyonel'],
                        ];
                        $badge = $badgeColors[$category->slug] ?? ['bg' => 'bg-gray-100 dark:bg-gray-900', 'text' => 'text-gray-800 dark:text-gray-300', 'label' => 'Yeni'];
                    @endphp
                    <span class="{{ $badge['bg'] }} {{ $badge['text'] }} text-xs font-semibold px-2.5 py-0.5 rounded">{{ $badge['label'] }}</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">{{ $category->description }}</p>
            </div>
            @endforeach
        </div>
    </div>

    <!-- Son Hizmet İlanları -->
    <div class="mb-12">
        <div class="flex flex-col mb-6 space-y-4">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center">
                <i class="fas fa-list text-blue-500 mr-3"></i>
                Son Hizmet İlanları
            </h2>
            <div class="flex flex-col sm:flex-row gap-2">
                <select class="w-full sm:w-auto border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    <option>Tüm Kategoriler</option>
                    <option>Hosting & VPS</option>
                    <option>Hesap & Lisans</option>
                    <option>E-Pin & Oyun</option>
                </select>
                <select class="w-full sm:w-auto border border-gray-300 dark:border-gray-600 rounded-lg px-3 py-2 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                    <option>En Yeni</option>
                    <option>En Popüler</option>
                    <option>En Ucuz</option>
                    <option>En Pahalı</option>
                </select>
            </div>
        </div>
        <div class="space-y-4">
            @forelse($services as $service)
            <!-- Hizmet İlanı -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 service-listing transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-{{ $service->color ?? 'blue' }}-400 to-{{ $service->color ?? 'blue' }}-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                <i class="{{ $service->icon ?? 'fas fa-star' }}"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">{{ $service->title }}</h3>
                                    @if($service->badges)
                                        @foreach($service->badges as $badge)
                                            @if($badge === 'featured')
                                                <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300 text-xs px-2 py-1 rounded-full featured-badge">
                                                    <i class="fas fa-fire mr-1"></i>Öne Çıkan
                                                </span>
                                            @elseif($badge === 'auto_delivery')
                                                <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs px-2 py-1 rounded-full auto-delivery">
                                                    <i class="fas fa-bolt mr-1"></i>Otomatik Teslimat
                                                </span>
                                            @elseif($badge === 'trend')
                                                <span class="bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-300 text-xs px-2 py-1 rounded-full">
                                                    <i class="fas fa-heart mr-1"></i>Trend
                                                </span>
                                            @elseif($badge === 'category')
                                                <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded-full category-badge">
                                                    <i class="fas fa-palette mr-1"></i>{{ $service->category->name ?? 'Tasarım' }}
                                                </span>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    {{ Str::limit($service->description, 150) }}
                                </p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-1">
                                        <img src="{{ $service->user->avatar ?? 'https://randomuser.me/api/portraits/men/45.jpg' }}" alt="Satıcı" class="w-6 h-6 rounded-full">
                                        <span>{{ $service->user->name }}</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        <span>{{ number_format($service->rating, 1) }} ({{ $service->review_count }} değerlendirme)</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>{{ $service->sales_count }} satış</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                        <div class="text-right mb-3">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">{{ $service->formatted_price }}</div>
                            @if($service->original_price)
                                <div class="text-sm text-gray-500 dark:text-gray-400 line-through">{{ $service->formatted_original_price }}</div>
                            @else
                                <div class="text-sm text-gray-500 dark:text-gray-400">{{ $service->delivery_time }}</div>
                            @endif
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Satın Al
                        </button>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center py-12">
                <i class="fas fa-box-open text-6xl text-gray-300 dark:text-gray-600 mb-4"></i>
                <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-400 mb-2">Henüz hizmet ilanı bulunmuyor</h3>
                <p class="text-gray-500 dark:text-gray-500">İlk hizmet ilanını sen oluştur!</p>
            </div>
            @endforelse
        </div>

        <!-- Sayfalama -->
        @if($services->hasPages())
        <div class="mt-8">
            {{ $services->links() }}
        </div>
        @endif
    </div>

    <!-- Öne Çıkan Satıcılar -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold text-gray-800 dark:text-white flex items-center">
                <i class="fas fa-crown text-yellow-500 mr-3"></i>
                Öne Çıkan Satıcılar
            </h2>
            <button class="text-blue-500 hover:text-blue-600 font-medium">
                Tümünü Gör <i class="fas fa-arrow-right ml-1"></i>
            </button>
        </div>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            @forelse($topSellers as $seller)
            <!-- Satıcı -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center hover:shadow-lg transition-shadow">
                <img src="{{ $seller->user->avatar ?? 'https://randomuser.me/api/portraits/men/45.jpg' }}" alt="Satıcı" class="w-16 h-16 rounded-full mx-auto mb-4">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">{{ $seller->user->name }}</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">{{ $seller->user->title ?? 'Hizmet Uzmanı' }}</p>
                <div class="flex items-center justify-center space-x-1 mb-3">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ number_format($seller->avg_rating, 1) }}</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">({{ $seller->service_count }})</span>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">{{ $seller->total_sales }} hizmet satışı</div>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors">
                    Profili Görüntüle
                </button>
            </div>
            @empty
            <!-- Varsayılan Satıcılar -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center hover:shadow-lg transition-shadow">
                <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Satıcı" class="w-16 h-16 rounded-full mx-auto mb-4">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">TechHost Pro</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">Hosting Uzmanı</p>
                <div class="flex items-center justify-center space-x-1 mb-3">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">4.9</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">(127)</span>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">89 hizmet satışı</div>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors">
                    Profili Görüntüle
                </button>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center hover:shadow-lg transition-shadow">
                <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Satıcı" class="w-16 h-16 rounded-full mx-auto mb-4">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">AI Solutions</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">AI & Lisans Uzmanı</p>
                <div class="flex items-center justify-center space-x-1 mb-3">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">4.8</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">(234)</span>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">156 hizmet satışı</div>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors">
                    Profili Görüntüle
                </button>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center hover:shadow-lg transition-shadow">
                <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Satıcı" class="w-16 h-16 rounded-full mx-auto mb-4">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">GameStore TR</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">Oyun Kredileri</p>
                <div class="flex items-center justify-center space-x-1 mb-3">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">4.9</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">(445)</span>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">278 hizmet satışı</div>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors">
                    Profili Görüntüle
                </button>
            </div>

            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 text-center hover:shadow-lg transition-shadow">
                <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Satıcı" class="w-16 h-16 rounded-full mx-auto mb-4">
                <h3 class="font-bold text-lg text-gray-900 dark:text-white mb-1">WebDesign Pro</h3>
                <p class="text-gray-500 dark:text-gray-400 text-sm mb-3">Web Tasarım</p>
                <div class="flex items-center justify-center space-x-1 mb-3">
                    <i class="fas fa-star text-yellow-500"></i>
                    <span class="text-sm font-medium text-gray-900 dark:text-white">4.7</span>
                    <span class="text-sm text-gray-500 dark:text-gray-400">(89)</span>
                </div>
                <div class="text-sm text-gray-500 dark:text-gray-400 mb-4">45 hizmet satışı</div>
                <button class="w-full bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg font-medium transition-colors">
                    Profili Görüntüle
                </button>
            </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .gradient-bg {
        background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
    }
    .service-listing:hover {
        border-left-color: #3b82f6;
        background-color: #f8fafc;
    }
    .dark .service-listing:hover {
        background-color: #374151;
    }
    .service-listing {
        border-left: 4px solid transparent;
        transition: all 0.3s ease;
    }
    .auto-delivery {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
    .featured-badge {
        background: linear-gradient(135deg, #f59e0b 0%, #d97706 100%);
    }
    .category-badge {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%);
    }
</style>
@endpush