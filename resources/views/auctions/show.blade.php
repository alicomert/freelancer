@extends('layouts.app')

@section('content')
<div class="min-h-screen bg-gray-50 dark:bg-gray-900">
    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Left Column - Product Details -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Product Image and Basic Info -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md overflow-hidden">
                    <div class="relative">
                        <div class="h-64 md:h-80 bg-gradient-to-br from-purple-500 to-blue-600 flex items-center justify-center">
                            <div class="text-center text-white">
                                <i class="fab fa-instagram text-8xl mb-4"></i>
                                <p class="text-2xl font-bold">Instagram Hesabı</p>
                                <p class="text-lg opacity-90">125K Takipçi</p>
                            </div>
                        </div>
                        <div class="absolute top-4 left-4">
                            <span class="bg-gradient-to-r from-green-500 to-green-600 text-white text-sm font-bold px-3 py-1 rounded-full">
                                <i class="fas fa-circle mr-1"></i>CANLI
                            </span>
                        </div>
                        <div class="absolute top-4 right-4 bg-red-600 bg-opacity-90 text-white text-sm font-bold px-3 py-1 rounded-full">
                            <i class="fas fa-clock mr-1"></i>2g 14s 32dk
                        </div>
                    </div>
                    
                    <div class="p-6">
                        <div class="flex items-center justify-between mb-4">
                            <h1 class="text-2xl font-bold text-gray-800 dark:text-white">Lifestyle Instagram Hesabı</h1>
                            <div class="flex items-center space-x-2">
                                <i class="fas fa-star text-yellow-400"></i>
                                <span class="text-gray-600 dark:text-gray-300">4.8 (156 değerlendirme)</span>
                            </div>
                        </div>
                        
                        <p class="text-gray-600 dark:text-gray-300 mb-6">Organik büyüme ile 125K takipçiye ulaşmış lifestyle nişinde Instagram hesabı. Yüksek etkileşim oranı ve aktif takipçi kitlesi. Monetize edilmiş hesap, düzenli sponsorluk gelirleri mevcut.</p>
                        
                        <!-- Product Features -->
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-6">
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class="fas fa-users text-blue-500 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">125K Takipçi</p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class="fas fa-heart text-red-500 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">8.5% Etkileşim</p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class="fas fa-calendar text-green-500 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">3 Yıllık</p>
                            </div>
                            <div class="text-center p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                                <i class="fas fa-dollar-sign text-yellow-500 text-xl mb-2"></i>
                                <p class="text-sm font-medium text-gray-800 dark:text-white">Monetize</p>
                            </div>
                        </div>
                        
                        <!-- Seller Info -->
                        <div class="flex items-center space-x-4 p-4 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Seller" class="w-12 h-12 rounded-full">
                            <div class="flex-1">
                                <h3 class="font-medium text-gray-800 dark:text-white">SocialMediaPro</h3>
                                <div class="flex items-center space-x-2">
                                    <div class="flex items-center">
                                        <i class="fas fa-star text-yellow-400 text-sm"></i>
                                        <span class="text-sm text-gray-600 dark:text-gray-300 ml-1">4.9 (234 satış)</span>
                                    </div>
                                    <i class="fas fa-check-circle text-green-500 text-sm"></i>
                                    <span class="text-sm text-green-600 dark:text-green-400">Doğrulanmış</span>
                                </div>
                            </div>
                            <button class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium hover:from-blue-600 hover:to-blue-700 transition-all">
                                <i class="fas fa-envelope mr-1"></i>Mesaj Gönder
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Detailed Description -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Detaylı Açıklama</h2>
                    <div class="prose max-w-none text-gray-600 dark:text-gray-300">
                        <p class="mb-4">Bu Instagram hesabı 3 yıl önce kurulmuş ve organik büyüme stratejileri ile 125.000 takipçiye ulaşmıştır. Hesap lifestyle, moda ve seyahat nişlerinde içerik üretmektedir.</p>
                        
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Hesap Özellikleri:</h3>
                        <ul class="list-disc list-inside mb-4 space-y-1">
                            <li>125.000 organik takipçi</li>
                            <li>%8.5 ortalama etkileşim oranı</li>
                            <li>Günlük 10.000+ erişim</li>
                            <li>Aylık 500.000+ gösterim</li>
                            <li>Aktif ve gerçek takipçi kitlesi</li>
                            <li>Monetize edilmiş hesap</li>
                        </ul>
                        
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Gelir Potansiyeli:</h3>
                        <ul class="list-disc list-inside mb-4 space-y-1">
                            <li>Sponsorlu gönderi başına 2.000-5.000 TL</li>
                            <li>Story reklamları 500-1.000 TL</li>
                            <li>Ürün tanıtımları %10-15 komisyon</li>
                            <li>Affiliate marketing gelirleri</li>
                        </ul>
                        
                        <h3 class="text-lg font-semibold text-gray-800 dark:text-white mb-2">Devir Süreci:</h3>
                        <p class="mb-4">Hesap devri güvenli bir şekilde gerçekleştirilecektir. E-posta değişimi, telefon numarası güncelleme ve tüm güvenlik ayarları alıcıya devredilecektir. 30 gün boyunca ücretsiz destek sağlanacaktır.</p>
                    </div>
                </div>
 <!-- Current Bid Info -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <div class="text-center mb-6">
                        <p class="text-sm text-gray-500 dark:text-gray-400 mb-1">Güncel Teklif</p>
                        <p id="currentBid" class="text-3xl font-bold bg-gradient-to-r from-red-500 to-red-600 text-white px-4 py-2 rounded-lg inline-block">₺12,750</p>
                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-2">Başlangıç: <span id="startingPrice">₺5,000</span></p>
                    </div>
                    
                    <!-- Countdown -->
                    <div class="text-center mb-6 p-4 bg-red-50 dark:bg-red-900 rounded-lg border border-red-200 dark:border-red-700">
                        <p class="text-sm text-red-600 dark:text-red-400 mb-2">Açık Arttırma Bitiyor</p>
                        <div class="text-2xl font-bold text-red-600 dark:text-red-400" id="countdown">02:14:32</div>
                        <p id="timeLeft" class="text-xs text-red-500 dark:text-red-400 mt-1">2 gün 14 saat 32 dakika</p>
                    </div>
                    
                    <!-- Bid Input -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Teklifiniz</label>
                        <div class="flex items-center space-x-2 mb-2">
                            <input type="number" placeholder="₺13,000" min="13000" step="250" 
                                   class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg text-lg font-medium focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg font-medium transition-colors">
                                Teklif Ver
                            </button>
                        </div>
                        <p class="text-xs text-gray-500 dark:text-gray-400">Minimum artış: ₺250</p>
                        <p class="text-xs text-red-500 dark:text-red-400 mt-1">Sonraki minimum teklif: ₺13,000</p>
                    </div>
                    
                    <!-- Quick Bid Buttons -->
                    <div class="grid grid-cols-2 gap-2 mb-6">
                        <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg text-sm font-medium transition-colors">
                            +₺250
                        </button>
                        <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg text-sm font-medium transition-colors">
                            +₺500
                        </button>
                        <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg text-sm font-medium transition-colors">
                            +₺1,000
                        </button>
                        <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg text-sm font-medium transition-colors">
                            +₺2,000
                        </button>
                    </div>
                    
                    <!-- Auction Stats -->
                    <div class="grid grid-cols-2 gap-4 mb-6 text-center">
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">47</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">Teklif Veren</p>
                        </div>
                        <div class="p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <p class="text-2xl font-bold text-gray-800 dark:text-white">156</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">İzleyen</p>
                        </div>
                    </div>
                    
                    <!-- Action Buttons -->
                    <div class="space-y-2">
                        <button class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-heart mr-2"></i>Favorilere Ekle
                        </button>
                        <button class="w-full bg-gray-500 hover:bg-gray-600 text-white py-2 rounded-lg text-sm font-medium transition-colors">
                            <i class="fas fa-bell mr-2"></i>Bildirim Al
                        </button>
                    </div>
                </div>
                <!-- Comments Section -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h2 class="text-xl font-bold text-gray-800 dark:text-white mb-4">Sorular ve Yorumlar</h2>
                    
                    <!-- Comment Input -->
                    <div class="mb-6">
                        <div class="flex items-start space-x-3">
                            <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="User" class="w-10 h-10 rounded-full">
                            <div class="flex-1">
                                <textarea placeholder="Soru veya yorumunuzu yazın..." 
                                         class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 dark:bg-gray-700 dark:text-white rounded-lg resize-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                         rows="3"></textarea>
                                <div class="flex items-center justify-between mt-2">
                                    <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-image"></i>
                                        <span>Resim ekle</span>
                                    </div>
                                    <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition-colors">
                                        Gönder
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Comments List -->
                    <div class="space-y-4 max-h-96 overflow-y-auto">
                        <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="User" class="w-8 h-8 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="font-medium text-gray-800 dark:text-white">@digitalmarketer</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">5 dakika önce</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm">Hesabın demografik analizi var mı? Hangi yaş grubundan takipçiler daha çok?</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-500">
                                        <i class="fas fa-thumbs-up mr-1"></i>Beğen (3)
                                    </button>
                                    <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-500">Yanıtla</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-blue-50 dark:bg-blue-900 rounded-lg border-l-4 border-blue-500">
                            <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Seller" class="w-8 h-8 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="font-medium text-gray-800 dark:text-white">@SocialMediaPro</span>
                                    <span class="bg-gradient-to-r from-blue-500 to-blue-600 text-white text-xs px-2 py-1 rounded">Satıcı</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">3 dakika önce</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm">Evet tabii! %65'i 18-34 yaş arası, %25'i 25-44 yaş arası. Kadın takipçi oranı %72. Detaylı analytics raporunu paylaşabilirim.</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-500">
                                        <i class="fas fa-thumbs-up mr-1"></i>Beğen (1)
                                    </button>
                                    <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-500">Yanıtla</button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="flex items-start space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <img src="https://randomuser.me/api/portraits/men/15.jpg" alt="User" class="w-8 h-8 rounded-full">
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-1">
                                    <span class="font-medium text-gray-800 dark:text-white">@contentcreator</span>
                                    <span class="text-xs text-gray-500 dark:text-gray-400">15 dakika önce</span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm">Hesapta herhangi bir kısıtlama var mı? Shadow ban geçmişi?</p>
                                <div class="flex items-center space-x-4 mt-2">
                                    <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-500">
                                        <i class="fas fa-thumbs-up mr-1"></i>Beğen (2)
                                    </button>
                                    <button class="text-xs text-gray-500 dark:text-gray-400 hover:text-blue-500">Yanıtla</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right Column - Bidding Section -->
            <div class="space-y-6">
               

                <!-- Bid History -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Teklif Geçmişi</h3>
                    <div id="bidHistoryList" class="space-y-3 max-h-96 overflow-y-auto">
                        <div class="flex items-center justify-between p-3 bg-green-50 dark:bg-green-900 rounded-lg border border-green-200 dark:border-green-700">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="Bidder" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">@instagrampro</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">2 dakika önce</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-green-600 dark:text-green-400">₺12,750</p>
                                <p class="text-xs text-green-500 dark:text-green-400">En Yüksek</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/women/18.jpg" alt="Bidder" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">@socialexpert</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">5 dakika önce</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-600 dark:text-gray-300">₺12,500</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/men/35.jpg" alt="Bidder" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">@digitalagency</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">8 dakika önce</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-600 dark:text-gray-300">₺12,250</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/women/42.jpg" alt="Bidder" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">@contentmaker</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">12 dakika önce</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-600 dark:text-gray-300">₺12,000</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/men/28.jpg" alt="Bidder" class="w-8 h-8 rounded-full">
                                <div>
                                    <p class="font-medium text-gray-800 dark:text-white">@marketingpro</p>
                                    <p class="text-xs text-gray-500 dark:text-gray-400">15 dakika önce</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <p class="font-bold text-gray-600 dark:text-gray-300">₺11,750</p>
                            </div>
                        </div>
                    </div>
                    
                    <button class="w-full mt-4 text-blue-500 hover:text-blue-600 dark:text-blue-400 dark:hover:text-blue-300 text-sm font-medium transition-colors">
                        Tüm Geçmişi Görüntüle
                    </button>
                </div>

                <!-- Similar Auctions -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6">
                    <h3 class="text-lg font-bold text-gray-800 dark:text-white mb-4">Benzer Açık Arttırmalar</h3>
                    <div class="space-y-3">
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-colors">
                            <div class="w-12 h-12 bg-gradient-to-br from-pink-500 to-red-500 rounded-lg flex items-center justify-center">
                                <i class="fab fa-instagram text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 dark:text-white text-sm">Fashion Instagram</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">89K takipçi</p>
                                <p class="text-sm font-bold text-green-600 dark:text-green-400">₺8,500</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-colors">
                            <div class="w-12 h-12 bg-gradient-to-br from-blue-500 to-purple-500 rounded-lg flex items-center justify-center">
                                <i class="fab fa-tiktok text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 dark:text-white text-sm">TikTok Hesabı</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">250K takipçi</p>
                                <p class="text-sm font-bold text-green-600 dark:text-green-400">₺15,000</p>
                            </div>
                        </div>
                        
                        <div class="flex items-center space-x-3 p-3 bg-gray-50 dark:bg-gray-700 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-600 cursor-pointer transition-colors">
                            <div class="w-12 h-12 bg-gradient-to-br from-red-500 to-red-700 rounded-lg flex items-center justify-center">
                                <i class="fab fa-youtube text-white text-xl"></i>
                            </div>
                            <div class="flex-1">
                                <p class="font-medium text-gray-800 dark:text-white text-sm">YouTube Kanalı</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">45K abone</p>
                                <p class="text-sm font-bold text-green-600 dark:text-green-400">₺22,000</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.auction-card {
    transition: all 0.3s ease;
}
.auction-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
}
.bid-animation {
    animation: pulse 2s infinite;
}
@keyframes pulse {
    0%, 100% { opacity: 1; }
    50% { opacity: 0.7; }
}
</style>

<script>
// Countdown timer
function updateCountdown() {
    const countdownElement = document.getElementById('countdown');
    const timeLeftElement = document.getElementById('timeLeft');
    
    // Sample countdown - in real app this would be calculated from auction end time
    let hours = 2;
    let minutes = 14;
    let seconds = 32;
    
    setInterval(() => {
        seconds--;
        if (seconds < 0) {
            seconds = 59;
            minutes--;
            if (minutes < 0) {
                minutes = 59;
                hours--;
                if (hours < 0) {
                    hours = 0;
                    minutes = 0;
                    seconds = 0;
                }
            }
        }
        
        const formattedTime = `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;
        countdownElement.textContent = formattedTime;
        timeLeftElement.textContent = `${hours} saat ${minutes} dakika ${seconds} saniye`;
    }, 1000);
}

// Initialize countdown when page loads
document.addEventListener('DOMContentLoaded', updateCountdown);

// Quick bid buttons functionality
document.querySelectorAll('.grid button').forEach(button => {
    if (button.textContent.includes('+₺')) {
        button.addEventListener('click', function() {
            const amount = this.textContent.replace('+₺', '').replace(',', '');
            const currentBidInput = document.querySelector('input[type="number"]');
            const currentValue = parseInt(currentBidInput.value.replace('₺', '').replace(',', '')) || 13000;
            const newValue = currentValue + parseInt(amount);
            currentBidInput.value = '₺' + newValue.toLocaleString('tr-TR');
        });
    }
});
</script>
@endsection