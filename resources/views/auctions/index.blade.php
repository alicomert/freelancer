@extends('layouts.app')

@section('content')
<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <!-- Filter Bar -->
    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-6 transition-colors duration-300">
        <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-4">
            <div class="flex flex-wrap gap-2">
                <button class="px-4 py-2 bg-red-500 text-white rounded-full text-sm font-medium">
                    <i class="fas fa-fire mr-1"></i>
                    Canlı Arttırmalar
                </button>
                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-clock mr-1"></i>
                    Yakında Bitenler
                </button>
                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-star mr-1"></i>
                    Öne Çıkanlar
                </button>
                <button class="px-4 py-2 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full text-sm font-medium hover:bg-gray-200 dark:hover:bg-gray-600 transition-colors">
                    <i class="fas fa-trophy mr-1"></i>
                    Yeni Başlayanlar
                </button>
            </div>
            <div class="flex items-center space-x-2">
                <select class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg px-3 py-2 text-sm transition-colors">
                    <option>Tüm Kategoriler</option>
                    <option>Dijital Ürünler</option>
                    <option>Yazılım & Web</option>
                    <option>Sosyal Medya</option>
                    <option>Oyun & E-Pin</option>
                    <option>Lisans & Hesap</option>
                </select>
                <select class="border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg px-3 py-2 text-sm transition-colors">
                    <option>Sıralama</option>
                    <option>En Yüksek Teklif</option>
                    <option>En Yakın Bitiş</option>
                    <option>En Yeni</option>
                </select>
            </div>
        </div>
    </div>

    <!-- Live Digital Auctions Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 xl:grid-cols-3 gap-6">
        <!-- Digital Product 1 - Instagram Account -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden auction-card transition-all duration-300">
            <div class="relative">
                <div class="h-48 bg-gradient-to-br from-purple-400 via-pink-500 to-red-500 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fab fa-instagram text-6xl mb-2"></i>
                        <p class="text-lg font-bold">@teknoloji_dunyasi</p>
                        <p class="text-sm opacity-90">125K Takipçi</p>
                    </div>
                </div>
                <div class="absolute top-3 left-3">
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        <i class="fas fa-circle mr-1"></i>CANLI
                    </span>
                </div>
                <div class="absolute top-3 right-3 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-clock mr-1"></i>1g 5s 23dk
                </div>
                <div class="absolute bottom-3 left-3 right-3">
                    <div class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>18 teklif veren
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">Instagram Teknoloji Hesabı</h3>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">4.9</span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">Organik büyüme, aktif takipçi kitlesi. Teknoloji nişinde güçlü engagement oranı.</p>
                
                <div class="flex items-center space-x-2 mb-3">
                    <img src="https://randomuser.me/api/portraits/men/25.jpg" alt="Seller" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-gray-600 dark:text-gray-400">SocialMediaPro</span>
                    <i class="fas fa-check-circle text-green-500 text-xs"></i>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Başlangıç Fiyatı</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">₺2,500</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Güncel Teklif</p>
                            <p class="text-xl font-bold bg-red-500 text-white px-2 py-1 rounded">₺8,750</p>
                        </div>
                    </div>
                    
                    <!-- Recent Bids -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@mehmet_k</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺8,750</span>
                            <span class="text-gray-500 dark:text-gray-400">2dk önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@ayse_digital</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺8,500</span>
                            <span class="text-gray-500 dark:text-gray-400">5dk önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@can_sosyal</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺8,250</span>
                            <span class="text-gray-500 dark:text-gray-400">8dk önce</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 mb-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Detaylar
                        </button>
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-question-circle mr-1"></i>Bilgi
                        </button>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="flex items-center space-x-2">
                        <input type="number" placeholder="₺9,000" min="9000" step="250" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Teklif Ver
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Min. artış: ₺250</p>
                </div>
            </div>
        </div>

        <!-- Digital Product 2 - WordPress Theme -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden auction-card transition-all duration-300">
            <div class="relative">
                <div class="h-48 bg-gradient-to-br from-blue-500 to-purple-600 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fab fa-wordpress text-6xl mb-2"></i>
                        <p class="text-lg font-bold">Premium Theme</p>
                        <p class="text-sm opacity-90">E-ticaret Teması</p>
                    </div>
                </div>
                <div class="absolute top-3 left-3">
                    <span class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        <i class="fas fa-exclamation mr-1"></i>BİTİYOR
                    </span>
                </div>
                <div class="absolute top-3 right-3 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-clock mr-1"></i>0g 0s 47dk
                </div>
                <div class="absolute bottom-3 left-3 right-3">
                    <div class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>12 teklif veren
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">WordPress E-ticaret Teması</h3>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">4.7</span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">Responsive tasarım, WooCommerce uyumlu, SEO optimized premium tema.</p>
                
                <div class="flex items-center space-x-2 mb-3">
                    <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Seller" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-gray-600 dark:text-gray-400">WebDesignStudio</span>
                    <i class="fas fa-check-circle text-green-500 text-xs"></i>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Başlangıç Fiyatı</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">₺500</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Güncel Teklif</p>
                            <p class="text-xl font-bold bg-red-500 text-white px-2 py-1 rounded">₺1,850</p>
                        </div>
                    </div>
                    
                    <!-- Recent Bids -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@web_master</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺1,850</span>
                            <span class="text-gray-500 dark:text-gray-400">1dk önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@eticaret_pro</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺1,800</span>
                            <span class="text-gray-500 dark:text-gray-400">3dk önce</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 mb-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Detaylar
                        </button>
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-question-circle mr-1"></i>Bilgi
                        </button>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="flex items-center space-x-2">
                        <input type="number" placeholder="₺1,900" min="1900" step="50" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Teklif Ver
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Min. artış: ₺50</p>
                </div>
            </div>
        </div>

        <!-- Digital Product 3 - Steam Account -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden auction-card transition-all duration-300">
            <div class="relative">
                <div class="h-48 bg-gradient-to-br from-gray-800 to-blue-900 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fab fa-steam text-6xl mb-2"></i>
                        <p class="text-lg font-bold">Steam Hesabı</p>
                        <p class="text-sm opacity-90">150+ Oyun</p>
                    </div>
                </div>
                <div class="absolute top-3 left-3">
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        <i class="fas fa-circle mr-1"></i>CANLI
                    </span>
                </div>
                <div class="absolute top-3 right-3 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-clock mr-1"></i>3g 8s 15dk
                </div>
                <div class="absolute bottom-3 left-3 right-3">
                    <div class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>25 teklif veren
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">Premium Steam Hesabı</h3>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">4.8</span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">CS:GO, GTA V, Cyberpunk 2077 dahil 150+ premium oyun. VAC ban yok.</p>
                
                <div class="flex items-center space-x-2 mb-3">
                    <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Seller" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-gray-600 dark:text-gray-400">GamerPro</span>
                    <i class="fas fa-check-circle text-green-500 text-xs"></i>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Başlangıç Fiyatı</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">₺3,000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Güncel Teklif</p>
                            <p class="text-xl font-bold bg-red-500 text-white px-2 py-1 rounded">₺12,500</p>
                        </div>
                    </div>
                    
                    <!-- Recent Bids -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@oyuncu_ali</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺12,500</span>
                            <span class="text-gray-500 dark:text-gray-400">30sn önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@steam_lover</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺12,000</span>
                            <span class="text-gray-500 dark:text-gray-400">2dk önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@gamer_pro</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺11,500</span>
                            <span class="text-gray-500 dark:text-gray-400">4dk önce</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 mb-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Detaylar
                        </button>
                        <button class="bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-question-circle mr-1"></i>Bilgi
                        </button>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="flex items-center space-x-2">
                        <input type="number" placeholder="₺13,000" min="13000" step="500" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Teklif Ver
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Min. artış: ₺500</p>
                </div>
            </div>
        </div>

        <!-- Digital Product 4 - Adobe License -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden auction-card transition-all duration-300">
            <div class="relative">
                <div class="h-48 bg-gradient-to-br from-red-600 to-orange-500 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fas fa-paint-brush text-6xl mb-2"></i>
                        <p class="text-lg font-bold">Adobe CC 2024</p>
                        <p class="text-sm opacity-90">1 Yıl Lisans</p>
                    </div>
                </div>
                <div class="absolute top-3 left-3">
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        <i class="fas fa-circle mr-1"></i>CANLI
                    </span>
                </div>
                <div class="absolute top-3 right-3 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-clock mr-1"></i>2g 12s 8dk
                </div>
                <div class="absolute bottom-3 left-3 right-3">
                    <div class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>31 teklif veren
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">Adobe Creative Cloud 2024</h3>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">4.9</span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">Photoshop, Illustrator, Premiere Pro dahil tüm uygulamalar. 1 yıl garanti.</p>
                
                <div class="flex items-center space-x-2 mb-3">
                    <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Seller" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-gray-600 dark:text-gray-400">LicenseDealer</span>
                    <i class="fas fa-check-circle text-green-500 text-xs"></i>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Başlangıç Fiyatı</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">₺800</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Güncel Teklif</p>
                            <p class="text-xl font-bold bg-red-500 text-white px-2 py-1 rounded">₺2,150</p>
                        </div>
                    </div>
                    
                    <!-- Recent Bids -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@designer_pro</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺2,150</span>
                            <span class="text-gray-500 dark:text-gray-400">45sn önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@grafik_uzman</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺2,100</span>
                            <span class="text-gray-500 dark:text-gray-400">2dk önce</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 mb-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Detaylar
                        </button>
                        <button class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-question-circle mr-1"></i>Bilgi
                        </button>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="flex items-center space-x-2">
                        <input type="number" placeholder="₺2,200" min="2200" step="50" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Teklif Ver
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Min. artış: ₺50</p>
                </div>
            </div>
        </div>

        <!-- Digital Product 5 - YouTube Channel -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden auction-card transition-all duration-300">
            <div class="relative">
                <div class="h-48 bg-gradient-to-br from-red-500 to-red-700 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fab fa-youtube text-6xl mb-2"></i>
                        <p class="text-lg font-bold">YouTube Kanalı</p>
                        <p class="text-sm opacity-90">50K Abone</p>
                    </div>
                </div>
                <div class="absolute top-3 left-3">
                    <span class="bg-orange-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        <i class="fas fa-exclamation mr-1"></i>BİTİYOR
                    </span>
                </div>
                <div class="absolute top-3 right-3 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-clock mr-1"></i>0g 1s 12dk
                </div>
                <div class="absolute bottom-3 left-3 right-3">
                    <div class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>22 teklif veren
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">Teknoloji YouTube Kanalı</h3>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">4.6</span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">Monetize edilmiş kanal, düzenli gelir. Teknoloji nişinde güçlü izleyici kitlesi.</p>
                
                <div class="flex items-center space-x-2 mb-3">
                    <img src="https://randomuser.me/api/portraits/men/38.jpg" alt="Seller" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-gray-600 dark:text-gray-400">ContentCreator</span>
                    <i class="fas fa-check-circle text-green-500 text-xs"></i>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Başlangıç Fiyatı</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">₺5,000</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Güncel Teklif</p>
                            <p class="text-xl font-bold bg-red-500 text-white px-2 py-1 rounded">₺18,750</p>
                        </div>
                    </div>
                    
                    <!-- Recent Bids -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@youtube_king</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺18,750</span>
                            <span class="text-gray-500 dark:text-gray-400">15sn önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@content_pro</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺18,500</span>
                            <span class="text-gray-500 dark:text-gray-400">1dk önce</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 mb-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Detaylar
                        </button>
                        <button class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-question-circle mr-1"></i>Bilgi
                        </button>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="flex items-center space-x-2">
                        <input type="number" placeholder="₺19,000" min="19000" step="250" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Teklif Ver
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Min. artış: ₺250</p>
                </div>
            </div>
        </div>

        <!-- Digital Product 6 - Mobile App Source Code -->
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden auction-card transition-all duration-300">
            <div class="relative">
                <div class="h-48 bg-gradient-to-br from-green-500 to-blue-600 flex items-center justify-center">
                    <div class="text-center text-white">
                        <i class="fas fa-mobile-alt text-6xl mb-2"></i>
                        <p class="text-lg font-bold">Mobil Uygulama</p>
                        <p class="text-sm opacity-90">Kaynak Kodu</p>
                    </div>
                </div>
                <div class="absolute top-3 left-3">
                    <span class="bg-red-500 text-white text-xs font-bold px-2 py-1 rounded-full">
                        <i class="fas fa-circle mr-1"></i>CANLI
                    </span>
                </div>
                <div class="absolute top-3 right-3 bg-black bg-opacity-50 text-white text-xs font-bold px-2 py-1 rounded-full">
                    <i class="fas fa-clock mr-1"></i>4g 6s 35dk
                </div>
                <div class="absolute bottom-3 left-3 right-3">
                    <div class="bg-black bg-opacity-50 text-white text-xs px-2 py-1 rounded">
                        <i class="fas fa-users mr-1"></i>15 teklif veren
                    </div>
                </div>
            </div>
            
            <div class="p-4">
                <div class="flex items-center justify-between mb-2">
                    <h3 class="font-bold text-lg text-gray-800 dark:text-white">E-ticaret Mobil App</h3>
                    <div class="flex items-center space-x-1">
                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                        <span class="text-sm text-gray-600 dark:text-gray-400">4.7</span>
                    </div>
                </div>
                
                <p class="text-gray-600 dark:text-gray-400 text-sm mb-3">React Native ile geliştirilmiş, iOS ve Android uyumlu. Tam kaynak kodu.</p>
                
                <div class="flex items-center space-x-2 mb-3">
                    <img src="https://randomuser.me/api/portraits/men/42.jpg" alt="Seller" class="w-6 h-6 rounded-full">
                    <span class="text-sm text-gray-600 dark:text-gray-400">MobileDev</span>
                    <i class="fas fa-check-circle text-green-500 text-xs"></i>
                </div>
                
                <div class="border-t border-gray-200 dark:border-gray-700 pt-3">
                    <div class="flex items-center justify-between mb-3">
                        <div>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Başlangıç Fiyatı</p>
                            <p class="text-sm font-medium text-gray-700 dark:text-gray-300">₺1,500</p>
                        </div>
                        <div class="text-right">
                            <p class="text-xs text-gray-500 dark:text-gray-400">Güncel Teklif</p>
                            <p class="text-xl font-bold bg-red-500 text-white px-2 py-1 rounded">₺4,250</p>
                        </div>
                    </div>
                    
                    <!-- Recent Bids -->
                    <div class="space-y-2 mb-3">
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@app_developer</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺4,250</span>
                            <span class="text-gray-500 dark:text-gray-400">3dk önce</span>
                        </div>
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-gray-600 dark:text-gray-400">@mobile_expert</span>
                            <span class="font-medium text-gray-900 dark:text-white">₺4,000</span>
                            <span class="text-gray-500 dark:text-gray-400">7dk önce</span>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="flex items-center space-x-2 mb-3">
                        <button class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-info-circle mr-1"></i>Detaylar
                        </button>
                        <button class="flex-1 bg-gray-500 hover:bg-gray-600 text-white px-3 py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-question-circle mr-1"></i>Bilgi
                        </button>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="flex items-center space-x-2">
                        <input type="number" placeholder="₺4,500" min="4500" step="250" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-lg text-sm focus:ring-2 focus:ring-red-500 focus:border-transparent transition-colors">
                        <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                            Teklif Ver
                        </button>
                    </div>
                    <p class="text-xs text-gray-500 dark:text-gray-400 mt-1">Min. artış: ₺250</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-8">
        <button class="bg-blue-500 hover:bg-blue-600 text-white px-8 py-3 rounded-lg font-medium transition-colors">
            <i class="fas fa-plus mr-2"></i>Daha Fazla Yükle
        </button>
    </div>
</div>

<style>
.auction-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
}
.dark .auction-card:hover {
    box-shadow: 0 10px 25px -5px rgba(255, 255, 255, 0.1);
}
</style>
@endsection