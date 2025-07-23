@extends('layouts.app')

@section('title', 'Mesajlar - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@section('content')
<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Sidebar (Mobile Hidden) -->
        <div class="hidden lg:block lg:w-1/4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Kısayollar</h3>
                <div class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-fire text-blue-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Popüler Gönderiler</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-star text-purple-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Favori Topluluklar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-bolt text-green-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Son Projeler</span>
                    </a>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Takip Ettiğin Topluluklar</h3>
                <div class="space-y-3">
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                            WD
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium group-hover:text-blue-600 text-gray-900 dark:text-white">Web Developers</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">12.5k üye</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </a>
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold">
                            FD
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium group-hover:text-blue-600 text-gray-900 dark:text-white">Freelance Dünyası</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">8.2k üye</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </a>
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-bold">
                            JS
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium group-hover:text-blue-600 text-gray-900 dark:text-white">JavaScript Türkiye</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">5.7k üye</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </a>
                </div>
                <button class="w-full mt-4 text-center text-blue-500 text-sm font-medium hover:text-blue-700">
                    Daha fazla göster
                </button>
            </div>
        </div>
        
        <!-- Main Messages Area -->
        <div class="w-full lg:w-2/4">
            <!-- Messages Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-4">
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between">
                        <h2 class="text-xl font-bold text-gray-900 dark:text-white">Mesajlar</h2>
                        <button class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition-colors">
                            <i class="fas fa-plus mr-2"></i>Yeni Mesaj
                        </button>
                    </div>
                    <div class="mt-4">
                        <div class="relative">
                            <input type="text" placeholder="Mesajlarda ara..." 
                                   class="w-full py-2 pl-10 pr-4 rounded-lg border border-gray-300 dark:border-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
                        </div>
                    </div>
                </div>
                
                <!-- Message Filters -->
                <div class="p-4 border-b border-gray-200 dark:border-gray-700">
                    <div class="flex space-x-4">
                        <button class="px-4 py-2 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg font-medium filter-btn active" data-filter="all">
                            Tümü
                        </button>
                        <button class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg filter-btn" data-filter="unread">
                            Okunmamış
                        </button>
                        <button class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg filter-btn" data-filter="projects">
                            Proje Mesajları
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Conversations List -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm">
                <!-- Active Conversation -->
                <div class="conversation-item p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer border-l-4 border-blue-500 bg-blue-50 dark:bg-blue-900/20 active" data-conversation="1">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-semibold text-gray-900 dark:text-white">Zeynep Arslan</h4>
                                <span class="text-xs text-gray-500 dark:text-gray-400">2 dk önce</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Proje detayları hakkında konuşabilir miyiz?</p>
                            <div class="flex items-center justify-between mt-2">
                                <div class="flex items-center space-x-2">
                                    <span class="bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-briefcase mr-1"></i>Proje
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Web Tasarım Projesi</span>
                                </div>
                                <span class="bg-blue-500 text-white text-xs px-2 py-1 rounded-full">2</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Other Conversations -->
                <div class="conversation-item p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" data-conversation="2">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-400 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900 dark:text-white">Can Yücel</h4>
                                <span class="text-xs text-gray-500 dark:text-gray-400">1 saat önce</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Teşekkürler, projeyi teslim ettim.</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-code mr-1"></i>Geliştirme
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">React Dashboard</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="conversation-item p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" data-conversation="3">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900 dark:text-white">Elif Kaya</h4>
                                <span class="text-xs text-gray-500 dark:text-gray-400">3 saat önce</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Logo tasarımı için görüşelim.</p>
                            <div class="flex items-center justify-between mt-2">
                                <div class="flex items-center space-x-2">
                                    <span class="bg-pink-100 dark:bg-pink-900 text-pink-600 dark:text-pink-300 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-paint-brush mr-1"></i>Tasarım
                                    </span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">Logo Tasarımı</span>
                                </div>
                                <span class="bg-red-500 text-white text-xs px-2 py-1 rounded-full">1</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="conversation-item p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" data-conversation="4">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/33.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-400 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900 dark:text-white">Mehmet Özkan</h4>
                                <span class="text-xs text-gray-500 dark:text-gray-400">1 gün önce</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">SEO çalışması tamamlandı.</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-300 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-search-dollar mr-1"></i>SEO
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">E-ticaret SEO</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="conversation-item p-4 border-b border-gray-200 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" data-conversation="5">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900 dark:text-white">Ayşe Demir</h4>
                                <span class="text-xs text-gray-500 dark:text-gray-400">2 gün önce</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">Mobil uygulama projesi başlayabilir.</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-mobile-alt mr-1"></i>Mobil
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Flutter App</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="conversation-item p-4 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer" data-conversation="6">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/men/55.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-gray-400 rounded-full border-2 border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <div class="flex items-center justify-between">
                                <h4 class="font-medium text-gray-900 dark:text-white">Emre Şahin</h4>
                                <span class="text-xs text-gray-500 dark:text-gray-400">1 hafta önce</span>
                            </div>
                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">WordPress sitesi hazır.</p>
                            <div class="flex items-center space-x-2 mt-2">
                                <span class="bg-indigo-100 dark:bg-indigo-900 text-indigo-600 dark:text-indigo-300 text-xs px-2 py-1 rounded-full">
                                    <i class="fas fa-wordpress mr-1"></i>WordPress
                                </span>
                                <span class="text-xs text-gray-500 dark:text-gray-400">Kurumsal Site</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Sidebar -->
        <div class="hidden lg:block lg:w-1/4">
            <!-- Online Users -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Çevrimiçi Kullanıcılar</h3>
                <div class="space-y-3">
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                            <span class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 rounded-full border border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Zeynep Arslan</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Aktif</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-comment text-sm"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/45.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                            <span class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 rounded-full border border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Elif Kaya</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Aktif</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-comment text-sm"></i>
                        </button>
                    </div>
                    <div class="flex items-center space-x-3">
                        <div class="relative">
                            <img src="https://randomuser.me/api/portraits/women/29.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                            <span class="absolute bottom-0 right-0 w-2 h-2 bg-green-500 rounded-full border border-white dark:border-gray-800"></span>
                        </div>
                        <div class="flex-1">
                            <h4 class="text-sm font-medium text-gray-900 dark:text-white">Ayşe Demir</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Aktif</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700">
                            <i class="fas fa-comment text-sm"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Hızlı İşlemler</h3>
                <div class="space-y-2">
                    <button class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-left transition-colors">
                        <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-plus text-blue-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Yeni Proje Oluştur</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-left transition-colors">
                        <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-search text-green-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Freelancer Ara</span>
                    </button>
                    <button class="w-full flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-left transition-colors">
                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-users text-purple-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Topluluk Oluştur</span>
                    </button>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Son Aktiviteler</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium text-gray-900 dark:text-white">Zeynep Arslan</span> size mesaj gönderdi
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">2 dakika önce</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium text-gray-900 dark:text-white">Can Yücel</span> projeyi teslim etti
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">1 saat önce</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <div class="w-2 h-2 bg-purple-500 rounded-full mt-2"></div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                <span class="font-medium text-gray-900 dark:text-white">Elif Kaya</span> teklifinizi kabul etti
                            </p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">3 saat önce</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .conversation-item {
        transition: all 0.3s ease;
        border-left: 4px solid transparent;
    }
    
    .conversation-item.active {
        border-left-color: #3b82f6;
        background-color: #eff6ff;
    }
    
    .dark .conversation-item.active {
        background-color: rgba(59, 130, 246, 0.1);
    }
    
    .conversation-item:hover:not(.active) {
        border-left-color: #e5e7eb;
    }
    
    .dark .conversation-item:hover:not(.active) {
        border-left-color: #374151;
    }
    
    .filter-btn.active {
        background-color: #dbeafe;
        color: #2563eb;
    }
    
    .dark .filter-btn.active {
        background-color: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Conversation selection
    const conversations = document.querySelectorAll('.conversation-item');
    conversations.forEach(conversation => {
        conversation.addEventListener('click', function() {
            // Remove active class from all conversations
            conversations.forEach(c => c.classList.remove('active'));
            
            // Add active class to clicked conversation
            this.classList.add('active');
            
            // Update background colors based on theme
            conversations.forEach(c => {
                c.classList.remove('bg-blue-50', 'dark:bg-blue-900/20');
            });
            this.classList.add('bg-blue-50', 'dark:bg-blue-900/20');
        });
    });
    
    // Filter buttons
    const filterBtns = document.querySelectorAll('.filter-btn');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all filter buttons
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
                b.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            });
            
            // Add active class to clicked button
            this.classList.add('active', 'bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
            this.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            
            // Here you can add filtering logic based on data-filter attribute
            const filter = this.getAttribute('data-filter');
            console.log('Filter selected:', filter);
        });
    });
});
</script>
@endpush