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
            <!-- Hosting & VPS -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-server text-blue-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Hosting & VPS</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">47 ilan</p>
                        </div>
                    </div>
                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs font-semibold px-2.5 py-0.5 rounded">Aktif</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Shared hosting, VPS, dedicated sunucu kiralama hizmetleri</p>
            </div>

            <!-- Hesap & Lisans Satışları -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-key text-green-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Hesap & Lisans</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">156 ilan</p>
                        </div>
                    </div>
                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs font-semibold px-2.5 py-0.5 rounded">Çok Satan</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Canva, ChatGPT, Adobe, Office, Windows lisansları</p>
            </div>

            <!-- E-Pin & Oyun Kredileri -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-gamepad text-purple-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">E-Pin & Oyun</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">89 ilan</p>
                        </div>
                    </div>
                    <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 text-xs font-semibold px-2.5 py-0.5 rounded">Otomatik</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Steam, PSN, Xbox, Google Play, iTunes kredileri</p>
            </div>

            <!-- Script & Tema Satışları -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-code text-orange-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Script & Tema</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">73 ilan</p>
                        </div>
                    </div>
                    <span class="bg-orange-100 dark:bg-orange-900 text-orange-800 dark:text-orange-300 text-xs font-semibold px-2.5 py-0.5 rounded">Popüler</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">WordPress, PHP, HTML temaları ve scriptleri</p>
            </div>

            <!-- Sosyal Medya Hesapları -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="fab fa-instagram text-pink-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">Sosyal Medya</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">124 ilan</p>
                        </div>
                    </div>
                    <span class="bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-300 text-xs font-semibold px-2.5 py-0.5 rounded">Trend</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">Instagram, TikTok, YouTube, Facebook hesap satışları</p>
            </div>

            <!-- SEO & Dijital Pazarlama -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-md p-6 hover:shadow-lg transition-shadow">
                <div class="flex items-center justify-between mb-4">
                    <div class="flex items-center">
                        <i class="fas fa-chart-line text-indigo-500 text-2xl mr-3"></i>
                        <div>
                            <h3 class="font-bold text-lg text-gray-900 dark:text-white">SEO & Pazarlama</h3>
                            <p class="text-sm text-gray-500 dark:text-gray-400">62 ilan</p>
                        </div>
                    </div>
                    <span class="bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-300 text-xs font-semibold px-2.5 py-0.5 rounded">Profesyonel</span>
                </div>
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4">SEO, Google Ads, sosyal medya pazarlama hizmetleri</p>
            </div>
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
            <!-- Hizmet İlanı 1 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 service-listing transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-blue-400 to-blue-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                <i class="fas fa-server"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Premium Shared Hosting - 1 Yıl</h3>
                                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs px-2 py-1 rounded-full auto-delivery">
                                        <i class="fas fa-bolt mr-1"></i>Otomatik Teslimat
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    cPanel, SSL sertifikası, günlük yedekleme, 24/7 teknik destek dahil premium hosting paketi. 
                                    Unlimited bandwidth ve 50GB SSD depolama alanı.
                                </p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-1">
                                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Satıcı" class="w-6 h-6 rounded-full">
                                        <span>TechHost Pro</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        <span>4.9 (127 değerlendirme)</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>89 satış</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                        <div class="text-right mb-3">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">₺299</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400 line-through">₺599</div>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Satın Al
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hizmet İlanı 2 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 service-listing transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-green-400 to-green-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                <i class="fas fa-key"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">ChatGPT Plus Hesabı - 1 Aylık</h3>
                                    <span class="bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-300 text-xs px-2 py-1 rounded-full featured-badge">
                                        <i class="fas fa-fire mr-1"></i>Öne Çıkan
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    Orijinal ChatGPT Plus hesabı. GPT-4 erişimi, öncelikli yanıt süresi, yeni özellikler dahil. 
                                    Hesap bilgileri anında teslim edilir.
                                </p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-1">
                                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Satıcı" class="w-6 h-6 rounded-full">
                                        <span>AI Solutions</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        <span>4.8 (234 değerlendirme)</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>156 satış</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                        <div class="text-right mb-3">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">₺89</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Aylık</div>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Satın Al
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hizmet İlanı 3 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 service-listing transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-purple-400 to-purple-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                <i class="fas fa-gamepad"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Steam Cüzdan Kodu - 100 TL</h3>
                                    <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs px-2 py-1 rounded-full auto-delivery">
                                        <i class="fas fa-bolt mr-1"></i>Otomatik Teslimat
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    Orijinal Steam cüzdan kodu. Anında teslimat, güvenli ödeme. 
                                    Tüm Steam oyunları ve içerikleri için kullanılabilir.
                                </p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-1">
                                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Satıcı" class="w-6 h-6 rounded-full">
                                        <span>GameStore TR</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        <span>4.9 (445 değerlendirme)</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>278 satış</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                        <div class="text-right mb-3">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">₺95</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">%5 indirim</div>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Satın Al
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hizmet İlanı 4 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 service-listing transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-orange-400 to-orange-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                <i class="fas fa-code"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">WordPress E-Ticaret Teması + Kurulum</h3>
                                    <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded-full category-badge">
                                        <i class="fas fa-palette mr-1"></i>Tasarım
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    Profesyonel e-ticaret teması, kurulum ve temel konfigürasyon dahil. 
                                    WooCommerce uyumlu, responsive tasarım, SEO optimizasyonu.
                                </p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-1">
                                        <img src="https://randomuser.me/api/portraits/women/28.jpg" alt="Satıcı" class="w-6 h-6 rounded-full">
                                        <span>WebDesign Pro</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        <span>4.7 (89 değerlendirme)</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>45 satış</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                        <div class="text-right mb-3">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">₺499</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Kurulum dahil</div>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Satın Al
                        </button>
                    </div>
                </div>
            </div>

            <!-- Hizmet İlanı 5 -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 service-listing transition-all duration-300">
                <div class="flex flex-col lg:flex-row lg:items-center justify-between">
                    <div class="flex-1">
                        <div class="flex items-start space-x-4">
                            <div class="w-16 h-16 bg-gradient-to-r from-pink-400 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold text-xl">
                                <i class="fab fa-instagram"></i>
                            </div>
                            <div class="flex-1">
                                <div class="flex items-center space-x-2 mb-2">
                                    <h3 class="text-lg font-bold text-gray-900 dark:text-white">Instagram Hesabı - 50K Takipçi</h3>
                                    <span class="bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-300 text-xs px-2 py-1 rounded-full">
                                        <i class="fas fa-heart mr-1"></i>Trend
                                    </span>
                                </div>
                                <p class="text-gray-600 dark:text-gray-300 text-sm mb-3">
                                    Organik takipçili Instagram hesabı. Aktif kullanıcılar, yüksek etkileşim oranı. 
                                    Lifestyle nişinde, kadın takipçi ağırlıklı.
                                </p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <div class="flex items-center space-x-1">
                                        <img src="https://randomuser.me/api/portraits/women/55.jpg" alt="Satıcı" class="w-6 h-6 rounded-full">
                                        <span>SocialMedia Expert</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-star text-yellow-500"></i>
                                        <span>4.6 (67 değerlendirme)</span>
                                    </div>
                                    <div class="flex items-center space-x-1">
                                        <i class="fas fa-shopping-cart"></i>
                                        <span>23 satış</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mt-4 lg:mt-0 lg:ml-6 flex flex-col items-end">
                        <div class="text-right mb-3">
                            <div class="text-2xl font-bold text-green-600 dark:text-green-400">₺2,499</div>
                            <div class="text-sm text-gray-500 dark:text-gray-400">Güvenli transfer</div>
                        </div>
                        <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition-colors">
                            <i class="fas fa-shopping-cart mr-2"></i>
                            Satın Al
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Load More Button -->
        <div class="text-center mt-8">
            <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-8 py-3 rounded-lg font-medium transition-colors">
                <i class="fas fa-plus mr-2"></i>
                Daha Fazla Hizmet Yükle
            </button>
        </div>
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
            <!-- Satıcı 1 -->
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

            <!-- Satıcı 2 -->
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

            <!-- Satıcı 3 -->
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

            <!-- Satıcı 4 -->
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