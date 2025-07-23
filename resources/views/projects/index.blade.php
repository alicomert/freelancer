@extends('layouts.app')

@section('title', 'Projeler - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Sidebar (Mobile Hidden) -->
        <div class="hidden lg:block lg:w-1/4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-800 dark:text-white">Kısayollar</h3>
                <div class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-fire text-blue-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Popüler Gönderiler</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-star text-purple-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Favori Topluluklar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-bolt text-green-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Son Projeler</span>
                    </a>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-800 dark:text-white">Takip Ettiğin Topluluklar</h3>
                <div class="space-y-3">
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                            WD
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium group-hover:text-blue-600 text-gray-800 dark:text-white">Web Developers</h4>
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
                            <h4 class="font-medium group-hover:text-blue-600 text-gray-800 dark:text-white">Freelance Dünyası</h4>
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
                            <h4 class="font-medium group-hover:text-blue-600 text-gray-800 dark:text-white">JavaScript Türkiye</h4>
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
        
        <!-- Main Feed -->
        <div class="w-full lg:w-2/4">
            <!-- Project Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-6">
                <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
                    <div class="flex flex-wrap gap-2">
                        <button class="px-4 py-2 bg-blue-500 text-white rounded-full text-sm font-medium hover:bg-blue-600 transition-colors">
                            <i class="fas fa-fire mr-1"></i> Popüler
                        </button>
                        <button class="px-4 py-2 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">
                            <i class="fas fa-clock mr-1"></i> Yeni
                        </button>
                        <button class="px-4 py-2 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">
                            <i class="fas fa-dollar-sign mr-1"></i> Yüksek Bütçe
                        </button>
                        <button class="px-4 py-2 bg-gray-100 dark:bg-gray-600 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-500 transition-colors">
                            <i class="fas fa-bolt mr-1"></i> Acil
                        </button>
                    </div>
                    <div class="flex items-center space-x-2">
                        <select class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 bg-white dark:bg-gray-700 text-gray-900 dark:text-white">
                            <option>Tüm Kategoriler</option>
                            <option>Web Geliştirme</option>
                            <option>Mobil Uygulama</option>
                            <option>Tasarım</option>
                            <option>SEO</option>
                        </select>
                        <button class="p-2 border border-gray-300 dark:border-gray-600 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                            <i class="fas fa-filter text-gray-600 dark:text-gray-400"></i>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Sana Özel Alıcı İstekleri -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                        <i class="fas fa-star text-yellow-500 mr-2"></i>
                        Sana Özel Alıcı İstekleri
                    </h2>
                    <button class="text-blue-500 text-sm font-medium hover:text-blue-700">
                        Tümünü Gör
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="border border-blue-200 dark:border-blue-700 rounded-lg p-4 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-medium text-gray-800 dark:text-white">React.js ile E-ticaret Sitesi</h3>
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full font-medium">₺15,000 - ₺25,000</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">Modern bir e-ticaret platformu geliştirmek istiyoruz. React.js, Node.js ve MongoDB kullanılacak...</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                                <span><i class="fas fa-clock mr-1"></i> 2 saat önce</span>
                                <span><i class="fas fa-user mr-1"></i> 3 teklif</span>
                                <span><i class="fas fa-map-marker-alt mr-1"></i> İstanbul</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>
                    <div class="border border-blue-200 dark:border-blue-700 rounded-lg p-4 bg-blue-50 dark:bg-blue-900/20 hover:bg-blue-100 dark:hover:bg-blue-900/30 transition-colors cursor-pointer">
                        <div class="flex items-start justify-between mb-2">
                            <h3 class="font-medium text-gray-800 dark:text-white">Mobil Uygulama UI/UX Tasarımı</h3>
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full font-medium">₺8,000 - ₺12,000</span>
                        </div>
                        <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">Fitness uygulaması için modern ve kullanıcı dostu arayüz tasarımı yapılacak...</p>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                                <span><i class="fas fa-clock mr-1"></i> 4 saat önce</span>
                                <span><i class="fas fa-user mr-1"></i> 1 teklif</span>
                                <span><i class="fas fa-map-marker-alt mr-1"></i> Ankara</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-1 rounded-full text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tüm Projeler -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-lg font-semibold text-gray-800 dark:text-white">
                        <i class="fas fa-briefcase text-blue-500 mr-2"></i>
                        Tüm Projeler
                    </h2>
                    <div class="flex items-center space-x-2">
                        <button class="text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-300">
                            <i class="fas fa-th-large"></i>
                        </button>
                        <button class="text-blue-500">
                            <i class="fas fa-list"></i>
                        </button>
                    </div>
                </div>
                
                <div class="space-y-4">
                    <!-- Project Card 1 -->
                    <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800 dark:text-white mb-1">Laravel ile CRM Sistemi Geliştirme</h3>
                                <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400 mb-2">
                                    <span><i class="fas fa-tag mr-1"></i> Web Geliştirme</span>
                                    <span><i class="fas fa-clock mr-1"></i> 1 gün önce</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> İstanbul</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">Şirketimiz için kapsamlı bir CRM sistemi geliştirmek istiyoruz. Laravel framework kullanılacak, modern arayüz ve raporlama modülleri olacak...</p>
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 text-xs px-2 py-1 rounded-full">Laravel</span>
                                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-xs px-2 py-1 rounded-full">MySQL</span>
                                    <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200 text-xs px-2 py-1 rounded-full">Vue.js</span>
                                </div>
                            </div>
                            <div class="text-right ml-4">
                                <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 text-sm px-3 py-1 rounded-full font-medium">₺20,000 - ₺35,000</span>
                                <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Sabit Fiyat</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500 dark:text-gray-400">
                                <span><i class="fas fa-user mr-1"></i> 5 teklif</span>
                                <span><i class="fas fa-star mr-1"></i> 4.8+ puan</span>
                                <span><i class="fas fa-calendar mr-1"></i> 30 gün</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>

                    <!-- Project Card 2 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800 mb-1">E-ticaret Sitesi Logo ve Kurumsal Kimlik</h3>
                                <div class="flex items-center space-x-4 text-xs text-gray-500 mb-2">
                                    <span><i class="fas fa-tag mr-1"></i> Grafik Tasarım</span>
                                    <span><i class="fas fa-clock mr-1"></i> 3 gün önce</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> Ankara</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Yeni kurulan e-ticaret sitemiz için profesyonel logo tasarımı ve kurumsal kimlik çalışması yapılacak. Modern ve akılda kalıcı olmalı...</p>
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="bg-pink-100 text-pink-800 text-xs px-2 py-1 rounded-full">Logo Tasarım</span>
                                    <span class="bg-purple-100 text-purple-800 text-xs px-2 py-1 rounded-full">Kurumsal Kimlik</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Adobe Illustrator</span>
                                </div>
                            </div>
                            <div class="text-right ml-4">
                                <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">₺3,000 - ₺5,000</span>
                                <div class="text-xs text-gray-500 mt-1">Sabit Fiyat</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span><i class="fas fa-user mr-1"></i> 12 teklif</span>
                                <span><i class="fas fa-star mr-1"></i> 4.5+ puan</span>
                                <span><i class="fas fa-calendar mr-1"></i> 7 gün</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>

                    <!-- Project Card 3 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800 mb-1">React Native Mobil Uygulama Geliştirme</h3>
                                <div class="flex items-center space-x-4 text-xs text-gray-500 mb-2">
                                    <span><i class="fas fa-tag mr-1"></i> Mobil Uygulama</span>
                                    <span><i class="fas fa-clock mr-1"></i> 5 gün önce</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> İzmir</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Restoran için sipariş takip uygulaması geliştirilecek. React Native kullanılacak, iOS ve Android platformlarında çalışacak...</p>
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">React Native</span>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Firebase</span>
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Push Notification</span>
                                </div>
                            </div>
                            <div class="text-right ml-4">
                                <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">₺12,000 - ₺18,000</span>
                                <div class="text-xs text-gray-500 mt-1">Sabit Fiyat</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span><i class="fas fa-user mr-1"></i> 8 teklif</span>
                                <span><i class="fas fa-star mr-1"></i> 4.7+ puan</span>
                                <span><i class="fas fa-calendar mr-1"></i> 45 gün</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>

                    <!-- Project Card 4 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800 mb-1">WordPress E-ticaret Sitesi SEO Optimizasyonu</h3>
                                <div class="flex items-center space-x-4 text-xs text-gray-500 mb-2">
                                    <span><i class="fas fa-tag mr-1"></i> SEO</span>
                                    <span><i class="fas fa-clock mr-1"></i> 1 hafta önce</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> Bursa</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Mevcut WordPress e-ticaret sitemizin SEO performansını artırmak istiyoruz. Teknik SEO, içerik optimizasyonu ve hız iyileştirmeleri...</p>
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="bg-orange-100 text-orange-800 text-xs px-2 py-1 rounded-full">WordPress</span>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">SEO</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Google Analytics</span>
                                </div>
                            </div>
                            <div class="text-right ml-4">
                                <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">₺4,000 - ₺7,000</span>
                                <div class="text-xs text-gray-500 mt-1">Sabit Fiyat</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span><i class="fas fa-user mr-1"></i> 15 teklif</span>
                                <span><i class="fas fa-star mr-1"></i> 4.6+ puan</span>
                                <span><i class="fas fa-calendar mr-1"></i> 14 gün</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>

                    <!-- Project Card 5 -->
                    <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow cursor-pointer">
                        <div class="flex items-start justify-between mb-3">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800 mb-1">Python ile Veri Analizi ve Dashboard</h3>
                                <div class="flex items-center space-x-4 text-xs text-gray-500 mb-2">
                                    <span><i class="fas fa-tag mr-1"></i> Veri Analizi</span>
                                    <span><i class="fas fa-clock mr-1"></i> 2 hafta önce</span>
                                    <span><i class="fas fa-map-marker-alt mr-1"></i> İstanbul</span>
                                </div>
                                <p class="text-gray-600 text-sm mb-3">Satış verilerimizi analiz edecek ve görselleştirecek bir dashboard uygulaması geliştirilecek. Python, Pandas ve Plotly kullanılacak...</p>
                                <div class="flex items-center space-x-2 mb-2">
                                    <span class="bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded-full">Python</span>
                                    <span class="bg-blue-100 text-blue-800 text-xs px-2 py-1 rounded-full">Pandas</span>
                                    <span class="bg-green-100 text-green-800 text-xs px-2 py-1 rounded-full">Plotly</span>
                                </div>
                            </div>
                            <div class="text-right ml-4">
                                <span class="bg-green-100 text-green-800 text-sm px-3 py-1 rounded-full font-medium">₺8,000 - ₺12,000</span>
                                <div class="text-xs text-gray-500 mt-1">Sabit Fiyat</div>
                            </div>
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center space-x-4 text-xs text-gray-500">
                                <span><i class="fas fa-user mr-1"></i> 6 teklif</span>
                                <span><i class="fas fa-star mr-1"></i> 4.9+ puan</span>
                                <span><i class="fas fa-calendar mr-1"></i> 21 gün</span>
                            </div>
                            <button class="bg-blue-500 text-white px-4 py-2 rounded-lg text-sm font-medium hover:bg-blue-600">
                                Teklif Ver
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-6">
                    <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-6 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Daha Fazla Proje Yükle
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="w-full lg:w-1/4">
            <!-- Quick Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-800 dark:text-white">İstatistikler</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Aktif Projeler</span>
                        <span class="font-semibold text-blue-600 dark:text-blue-400">1,247</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Bu Hafta Eklenen</span>
                        <span class="font-semibold text-green-600 dark:text-green-400">89</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span class="text-gray-600 dark:text-gray-300">Ortalama Bütçe</span>
                        <span class="font-semibold text-purple-600 dark:text-purple-400">₺12,500</span>
                    </div>
                </div>
            </div>

            <!-- Top Categories -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-800 dark:text-white">Popüler Kategoriler</h3>
                <div class="space-y-2">
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-code text-blue-500"></i>
                            <span class="text-gray-700 dark:text-gray-300">Web Geliştirme</span>
                        </div>
                        <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">324</span>
                    </a>
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-mobile-alt text-green-500"></i>
                            <span class="text-gray-700 dark:text-gray-300">Mobil Uygulama</span>
                        </div>
                        <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">198</span>
                    </a>
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-paint-brush text-purple-500"></i>
                            <span class="text-gray-700 dark:text-gray-300">Tasarım</span>
                        </div>
                        <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">156</span>
                    </a>
                    <a href="#" class="flex items-center justify-between p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700">
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-search-dollar text-yellow-500"></i>
                            <span class="text-gray-700 dark:text-gray-300">SEO</span>
                        </div>
                        <span class="text-xs bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 px-2 py-1 rounded-full">89</span>
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-800 dark:text-white">Son Aktiviteler</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium text-gray-800 dark:text-white">Ayşe K.</span> yeni bir proje ekledi</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">5 dakika önce</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User" class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium text-gray-800 dark:text-white">Mehmet Y.</span> bir projeye teklif verdi</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">15 dakika önce</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User" class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 dark:text-gray-300"><span class="font-medium text-gray-800 dark:text-white">Zeynep A.</span> projesini tamamladı</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">1 saat önce</p>
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
    .post-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
    }
    .nav-item:hover .nav-icon {
        transform: scale(1.2);
    }
    .scrollbar-hide::-webkit-scrollbar {
        display: none;
    }
    .scrollbar-hide {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>
@endpush