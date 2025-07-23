@extends('layouts.app')

@section('title', 'Profil - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

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
                            <i class="fas fa-fire text-blue-500 dark:text-blue-400"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Popüler Gönderiler</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-star text-purple-500 dark:text-purple-400"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Favori Topluluklar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-bolt text-green-500 dark:text-green-400"></i>
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
                            <h4 class="font-medium group-hover:text-blue-600 dark:group-hover:text-blue-400 text-gray-900 dark:text-white">Web Developers</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">12.5k üye</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </a>
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold">
                            FD
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium group-hover:text-blue-600 dark:group-hover:text-blue-400 text-gray-900 dark:text-white">Freelance Dünyası</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">8.2k üye</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </a>
                    <a href="#" class="flex items-center space-x-3 group">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-bold">
                            JS
                        </div>
                        <div class="flex-1">
                            <h4 class="font-medium group-hover:text-blue-600 dark:group-hover:text-blue-400 text-gray-900 dark:text-white">JavaScript Türkiye</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">5.7k üye</p>
                        </div>
                        <button class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                    </a>
                </div>
                <button class="w-full mt-4 text-center text-blue-500 text-sm font-medium hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                    Daha fazla göster
                </button>
            </div>
        </div>
        
        <!-- Main Feed -->
        <div class="w-full lg:w-2/4">
            <!-- Profile Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6 overflow-hidden">
                <!-- Cover Photo -->
                <div class="h-48 lg:h-64 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    <button class="absolute top-4 right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-3 py-1 rounded-full text-sm">
                        <i class="fas fa-camera mr-1"></i> Kapak Fotoğrafını Değiştir
                    </button>
                </div>
                
                <!-- Profile Info -->
                <div class="px-6 pb-6">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between -mt-16 lg:-mt-20">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:space-x-4">
                            <div class="relative mb-4 lg:mb-0">
                                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-32 h-32 lg:w-40 lg:h-40 rounded-full border-4 border-white dark:border-gray-800 shadow-lg">
                                <button class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center">
                                    <i class="fas fa-camera text-sm"></i>
                                </button>
                                <span class="absolute bottom-4 right-4 w-6 h-6 bg-green-500 rounded-full border-2 border-white dark:border-gray-800"></span>
                            </div>
                            <div class="lg:mb-4">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white">Ahmet Yılmaz</h1>
                                <p class="text-lg text-gray-600 dark:text-gray-300 mb-2">Senior Full Stack Developer</p>
                                <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                                    <span class="flex items-center">
                                        <i class="fas fa-map-marker-alt mr-1"></i>
                                        İstanbul, Türkiye
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-calendar-alt mr-1"></i>
                                        Haziran 2018'den beri
                                    </span>
                                    <span class="flex items-center">
                                        <i class="fas fa-clock mr-1"></i>
                                        Son görülme: 2 saat önce
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-4 lg:mt-0">
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-medium">
                                <i class="fas fa-user-plus mr-2"></i>Takip Et
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full font-medium">
                                <i class="fas fa-envelope mr-2"></i>Mesaj Gönder
                            </button>
                            <button class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-full">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700">
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">247</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Gönderi</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">1.2K</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Takipçi</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">89</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Takip</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400">4.9</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Puan</p>
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400">48</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Proje</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Navigation Tabs -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6">
                <div class="flex overflow-x-auto scrollbar-hide">
                    <button class="flex-shrink-0 px-6 py-4 text-blue-600 dark:text-blue-400 border-b-2 border-blue-600 dark:border-blue-400 font-medium whitespace-nowrap">
                        <i class="fas fa-home mr-2"></i>Genel Bakış
                    </button>
                    <button class="flex-shrink-0 px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 font-medium whitespace-nowrap">
                        <i class="fas fa-newspaper mr-2"></i>Gönderiler
                    </button>
                    <button class="flex-shrink-0 px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 font-medium whitespace-nowrap">
                        <i class="fas fa-briefcase mr-2"></i>Hizmetler
                    </button>
                    <button class="flex-shrink-0 px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 font-medium whitespace-nowrap">
                        <i class="fas fa-folder mr-2"></i>Portfolyo
                    </button>
                    <button class="flex-shrink-0 px-6 py-4 text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 font-medium whitespace-nowrap">
                        <i class="fas fa-star mr-2"></i>Değerlendirmeler
                    </button>
                </div>
            </div>
            
            <!-- About Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <h3 class="text-xl font-bold mb-4 text-gray-900 dark:text-white">Hakkımda</h3>
                <p class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed">
                    10 yılı aşkın süredir web geliştirme alanında çalışıyorum. Modern JavaScript framework'leri ve backend teknolojilerinde uzmanım. 
                    Müşteri memnuniyetini ön planda tutarak, kaliteli ve zamanında teslim edilen projeler üretiyorum. 
                    Freelance çalışmanın yanı sıra, genç geliştiricilere mentorluk yapıyor ve teknik blog yazıları yazıyorum.
                </p>
                <div class="flex flex-wrap gap-2">
                    <span class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-300 rounded-full text-sm font-medium">React</span>
                    <span class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-700 dark:text-green-300 rounded-full text-sm font-medium">Node.js</span>
                    <span class="px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-700 dark:text-purple-300 rounded-full text-sm font-medium">MongoDB</span>
                    <span class="px-3 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-300 rounded-full text-sm font-medium">JavaScript</span>
                    <span class="px-3 py-1 bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-300 rounded-full text-sm font-medium">Firebase</span>
                    <span class="px-3 py-1 bg-indigo-100 dark:bg-indigo-900 text-indigo-700 dark:text-indigo-300 rounded-full text-sm font-medium">TypeScript</span>
                </div>
            </div>
            
            <!-- Services Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Hizmetlerim</h3>
                    <button class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
                        Tümünü Gör
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow bg-white dark:bg-gray-800">
                        <div class="flex items-start space-x-3">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-code text-blue-600 dark:text-blue-400"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Full Stack Web Geliştirme</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">Modern teknolojilerle responsive web uygulamaları</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400">₺2,500+</span>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span>4.9 (23)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow bg-white dark:bg-gray-800">
                        <div class="flex items-start space-x-3">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-purple-600 dark:text-purple-400"></i>
                            </div>
                            <div class="flex-1">
                                <h4 class="font-semibold text-gray-900 dark:text-white mb-1">React Native Mobil Uygulama</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">iOS ve Android için cross-platform uygulamalar</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400">₺3,500+</span>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-star text-yellow-400 mr-1"></i>
                                        <span>5.0 (12)</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Portfolio Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Portfolyo</h3>
                    <button class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
                        Tümünü Gör
                    </button>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <div class="group cursor-pointer">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop" alt="Project" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300"></div>
                            <div class="absolute top-3 right-3 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Tamamlandı
                            </div>
                        </div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-1">E-Ticaret Platformu</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">React, Node.js ve MongoDB kullanılarak geliştirilmiş modern e-ticaret sitesi</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded text-xs">React</span>
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded text-xs">Node.js</span>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">2024</span>
                        </div>
                    </div>
                    <div class="group cursor-pointer">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=400&h=250&fit=crop" alt="Project" class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300"></div>
                            <div class="absolute top-3 right-3 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Devam Ediyor
                            </div>
                        </div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-1">Mobil Bankacılık Uygulaması</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2">React Native ile geliştirilmiş güvenli mobil bankacılık uygulaması</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded text-xs">React Native</span>
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 rounded text-xs">Firebase</span>
                            </div>
                            <span class="text-sm text-gray-500 dark:text-gray-400">2024</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recent Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h3 class="text-xl font-bold text-gray-900 dark:text-white">Son Gönderiler</h3>
                    <button class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium">
                        Tümünü Gör
                    </button>
                </div>
                <div class="space-y-4">
                    <div class="border-l-4 border-blue-500 pl-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-1">
                            <span>2 gün önce</span>
                            <span>•</span>
                            <span>Web Geliştirme</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">React 18'in Yeni Özellikleri</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">React 18 ile gelen concurrent features ve automatic batching özelliklerini inceliyoruz...</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <i class="fas fa-heart mr-1 text-red-500"></i>
                                24
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-comment mr-1"></i>
                                8
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-share mr-1"></i>
                                3
                            </span>
                        </div>
                    </div>
                    <div class="border-l-4 border-green-500 pl-4">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-1">
                            <span>1 hafta önce</span>
                            <span>•</span>
                            <span>Freelance</span>
                        </div>
                        <h4 class="font-semibold text-gray-900 dark:text-white mb-2">Freelance Çalışmanın Püf Noktaları</h4>
                        <p class="text-gray-600 dark:text-gray-300 text-sm">10 yıllık freelance deneyimimden öğrendiğim en önemli ipuçlarını paylaşıyorum...</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center">
                                <i class="fas fa-heart mr-1 text-red-500"></i>
                                42
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-comment mr-1"></i>
                                15
                            </span>
                            <span class="flex items-center">
                                <i class="fas fa-share mr-1"></i>
                                7
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar (Mobile Hidden) -->
        <div class="hidden lg:block lg:w-1/4">
            <!-- Trade Score & Verification -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Ticaret Puanı & Doğrulama</h3>
                <div class="text-center mb-4">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold text-white">4.9</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Mükemmel Satıcı</p>
                    <div class="flex justify-center mt-2">
                        <div class="flex space-x-1">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                    </div>
                </div>
                <div class="space-y-2">
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-700 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Kimlik Doğrulandı
                        </span>
                        <i class="fas fa-shield-alt text-green-500"></i>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-700 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            E-posta Doğrulandı
                        </span>
                        <i class="fas fa-envelope text-green-500"></i>
                    </div>
                    <div class="flex items-center justify-between text-sm">
                        <span class="flex items-center text-gray-700 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            Telefon Doğrulandı
                        </span>
                        <i class="fas fa-phone text-green-500"></i>
                    </div>
                </div>
            </div>
            
            <!-- Education & Certifications -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Eğitim & Sertifikalar</h3>
                <div class="space-y-3">
                    <div class="border-l-4 border-blue-500 pl-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">Bilgisayar Mühendisliği</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">İstanbul Teknik Üniversitesi</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">2014 - 2018</p>
                    </div>
                    <div class="border-l-4 border-green-500 pl-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">AWS Certified Developer</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Amazon Web Services</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">2023</p>
                    </div>
                    <div class="border-l-4 border-purple-500 pl-3">
                        <h4 class="font-medium text-gray-900 dark:text-white">React Developer Certificate</h4>
                        <p class="text-sm text-gray-600 dark:text-gray-300">Meta (Facebook)</p>
                        <p class="text-xs text-gray-500 dark:text-gray-400">2022</p>
                    </div>
                </div>
                <button class="w-full mt-3 text-center text-blue-500 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300">
                    Tümünü Gör
                </button>
            </div>
            
            <!-- Expertise & Tools -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Uzmanlık Alanları</h3>
                <div class="space-y-3">
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-300">Frontend Development</span>
                            <span class="font-medium text-gray-900 dark:text-white">Expert</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-blue-500 h-2 rounded-full" style="width: 95%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-300">Backend Development</span>
                            <span class="font-medium text-gray-900 dark:text-white">Advanced</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-green-500 h-2 rounded-full" style="width: 85%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex justify-between text-sm mb-1">
                            <span class="text-gray-700 dark:text-gray-300">Mobile Development</span>
                            <span class="font-medium text-gray-900 dark:text-white">Intermediate</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div class="bg-purple-500 h-2 rounded-full" style="width: 70%"></div>
                        </div>
                    </div>
                </div>
                <div class="mt-4">
                    <h4 class="font-medium text-gray-900 dark:text-white mb-2">Kullandığı Araçlar</h4>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">VS Code</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">Git</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">Docker</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">AWS</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">Figma</span>
                        <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">Postman</span>
                    </div>
                </div>
            </div>
            
            <!-- Performance Stats -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Performans İstatistikleri</h3>
                <div class="space-y-4">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-green-100 dark:bg-green-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-clock text-green-600 dark:text-green-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Ortalama Yanıt Süresi</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">2 saat</p>
                            </div>
                        </div>
                        <span class="text-green-600 dark:text-green-400 font-bold">Hızlı</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-blue-100 dark:bg-blue-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-calendar-check text-blue-600 dark:text-blue-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Zamanında Teslimat</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Son 12 ay</p>
                            </div>
                        </div>
                        <span class="text-blue-600 dark:text-blue-400 font-bold">98%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-redo text-purple-600 dark:text-purple-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Tekrar Sipariş Oranı</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Müşteri sadakati</p>
                            </div>
                        </div>
                        <span class="text-purple-600 dark:text-purple-400 font-bold">85%</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-2">
                            <div class="w-8 h-8 bg-yellow-100 dark:bg-yellow-900 rounded-full flex items-center justify-center">
                                <i class="fas fa-trophy text-yellow-600 dark:text-yellow-400 text-sm"></i>
                            </div>
                            <div>
                                <p class="text-sm font-medium text-gray-900 dark:text-white">Toplam Kazanç</p>
                                <p class="text-xs text-gray-500 dark:text-gray-400">Bu yıl</p>
                            </div>
                        </div>
                        <span class="text-yellow-600 dark:text-yellow-400 font-bold">₺125K</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.scrollbar-hide {
    -ms-overflow-style: none;
    scrollbar-width: none;
}
.scrollbar-hide::-webkit-scrollbar {
    display: none;
}
</style>
@endsection