@extends('layouts.app')

@section('title', 'Topluluk - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@section('content')
<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Sidebar (Mobile Hidden) -->
        <div class="hidden lg:block lg:w-1/4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4 transition-colors duration-300">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Kısayollar</h3>
                <div class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-fire text-blue-500"></i>
                        </div>
                        <span>Popüler Gönderiler</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-star text-purple-500"></i>
                        </div>
                        <span>Favori Topluluklar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-green-100 dark:bg-green-900 flex items-center justify-center">
                            <i class="fas fa-bolt text-green-500"></i>
                        </div>
                        <span>Son Projeler</span>
                    </a>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 transition-colors duration-300">
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
        
        <!-- Main Feed -->
        <div class="w-full lg:w-2/4">
            <!-- Create Post -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4 transition-colors duration-300">
                <div class="flex items-center space-x-3 mb-4">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                    <input type="text" placeholder="Topluluğa bir şeyler paylaş..." 
                           class="flex-1 py-2 px-4 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none cursor-pointer text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 transition-colors">
                </div>
                <div class="flex justify-between border-t border-gray-200 dark:border-gray-700 pt-3">
                    <button class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-1 rounded-md transition-colors">
                        <i class="fas fa-image text-green-500"></i>
                        <span>Fotoğraf</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-1 rounded-md transition-colors">
                        <i class="fas fa-link text-blue-500"></i>
                        <span>Link</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 px-4 py-1 rounded-md transition-colors">
                        <i class="fas fa-poll text-yellow-500"></i>
                        <span>Anket</span>
                    </button>
                </div>
            </div>
            
            <!-- Community Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-3 mb-4 flex overflow-x-auto scrollbar-hide transition-colors duration-300">
                <button class="flex-shrink-0 px-4 py-1 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400 rounded-full mr-2 font-medium">
                    <i class="fas fa-users mr-1"></i> Tüm Topluluklar
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full mr-2 font-medium text-gray-700 dark:text-gray-300 transition-colors">
                    <i class="fas fa-fire mr-1"></i> Popüler
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full mr-2 font-medium text-gray-700 dark:text-gray-300 transition-colors">
                    <i class="fas fa-star mr-1"></i> Takip Edilenler
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full mr-2 font-medium text-gray-700 dark:text-gray-300 transition-colors">
                    <i class="fas fa-plus mr-1"></i> Yeni
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-full font-medium text-gray-700 dark:text-gray-300 transition-colors">
                    <i class="fas fa-trophy mr-1"></i> Öne Çıkanlar
                </button>
            </div>
            
            <!-- Community Posts -->
            <div class="space-y-4">
                <!-- Community Post 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                    WD
                                </div>
                                <div>
                                    <h4 class="font-semibold text-blue-600 dark:text-blue-400">Web Developers Türkiye</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>12.5k üye</span>
                                        <span>•</span>
                                        <span>Ayşe Kaya tarafından</span>
                                        <span>•</span>
                                        <span>3 saat önce</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full text-sm font-medium hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                                    <i class="fas fa-plus mr-1"></i>Katıl
                                </button>
                                <button class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">React 18'in Yeni Özellikleri ve Concurrent Features</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Merhaba arkadaşlar! React 18 ile gelen yeni özellikler hakkında konuşalım. Özellikle Concurrent Features ve Suspense'in nasıl kullanılacağını merak ediyorum. Deneyimlerinizi paylaşabilir misiniz?
                            </p>
                        </div>
                        
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded-full">React</span>
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs px-2 py-1 rounded-full">JavaScript</span>
                            <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 text-xs px-2 py-1 rounded-full">Frontend</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>24</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-comment"></i>
                                    <span>8</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-share"></i>
                                    <span>Paylaş</span>
                                </button>
                            </div>
                            <button class="flex items-center space-x-1 hover:text-yellow-500 transition-colors">
                                <i class="fas fa-bookmark"></i>
                                <span>Kaydet</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Community Post 2 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-purple-400 to-purple-600 flex items-center justify-center text-white font-bold">
                                    FD
                                </div>
                                <div>
                                    <h4 class="font-semibold text-purple-600 dark:text-purple-400">Freelance Dünyası</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>8.2k üye</span>
                                        <span>•</span>
                                        <span>Mehmet Özkan tarafından</span>
                                        <span>•</span>
                                        <span>5 saat önce</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400 rounded-full text-sm font-medium hover:bg-purple-200 dark:hover:bg-purple-800 transition-colors">
                                    <i class="fas fa-check mr-1"></i>Takip Ediliyor
                                </button>
                                <button class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">Freelancer Olarak İlk Yılımda Öğrendiklerim</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Freelancer olarak çalışmaya başlayalı 1 yıl oldu. Bu süreçte öğrendiğim en önemli şeyler: müşteri iletişimi, proje yönetimi ve fiyatlandırma stratejileri. Deneyimlerimi paylaşmak istedim...
                            </p>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 mb-3">
                            <img src="https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=800&q=80" 
                                 alt="Freelancer workspace" class="w-full h-48 object-cover rounded-lg">
                        </div>
                        
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 text-xs px-2 py-1 rounded-full">Freelance</span>
                            <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 text-xs px-2 py-1 rounded-full">Kariyer</span>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded-full">Deneyim</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>42</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-comment"></i>
                                    <span>15</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-share"></i>
                                    <span>Paylaş</span>
                                </button>
                            </div>
                            <button class="flex items-center space-x-1 hover:text-yellow-500 transition-colors">
                                <i class="fas fa-bookmark"></i>
                                <span>Kaydet</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Community Post 3 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-green-400 to-green-600 flex items-center justify-center text-white font-bold">
                                    JS
                                </div>
                                <div>
                                    <h4 class="font-semibold text-green-600 dark:text-green-400">JavaScript Türkiye</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>5.7k üye</span>
                                        <span>•</span>
                                        <span>Zeynep Demir tarafından</span>
                                        <span>•</span>
                                        <span>1 gün önce</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded-full text-sm font-medium hover:bg-green-200 dark:hover:bg-green-800 transition-colors">
                                    <i class="fas fa-plus mr-1"></i>Katıl
                                </button>
                                <button class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">ES2023'te Gelen Yeni JavaScript Özellikleri</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                JavaScript'in 2023 versiyonunda gelen yeni özellikler gerçekten heyecan verici! Array.findLast(), Array.findLastIndex() ve daha birçok kullanışlı method. Hangisini en çok kullanıyorsunuz?
                            </p>
                        </div>
                        
                        <div class="bg-gray-900 dark:bg-gray-800 rounded-lg p-4 mb-3 overflow-x-auto">
                            <pre class="text-green-400 text-sm"><code>// Array.findLast() örneği
const numbers = [1, 2, 3, 4, 5, 4, 3, 2, 1];
const lastEven = numbers.findLast(n => n % 2 === 0);
console.log(lastEven); // 2</code></pre>
                        </div>
                        
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-300 text-xs px-2 py-1 rounded-full">JavaScript</span>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded-full">ES2023</span>
                            <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 text-xs px-2 py-1 rounded-full">Programming</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>67</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-comment"></i>
                                    <span>23</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-share"></i>
                                    <span>Paylaş</span>
                                </button>
                            </div>
                            <button class="flex items-center space-x-1 hover:text-yellow-500 transition-colors">
                                <i class="fas fa-bookmark"></i>
                                <span>Kaydet</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Community Post 4 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-r from-pink-400 to-pink-600 flex items-center justify-center text-white font-bold">
                                    UI
                                </div>
                                <div>
                                    <h4 class="font-semibold text-pink-600 dark:text-pink-400">UI/UX Designers</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>3.1k üye</span>
                                        <span>•</span>
                                        <span>Can Yılmaz tarafından</span>
                                        <span>•</span>
                                        <span>2 gün önce</span>
                                    </div>
                                </div>
                            </div>
                            <div class="flex items-center space-x-2">
                                <button class="px-3 py-1 bg-pink-100 dark:bg-pink-900 text-pink-600 dark:text-pink-400 rounded-full text-sm font-medium hover:bg-pink-200 dark:hover:bg-pink-800 transition-colors">
                                    <i class="fas fa-check mr-1"></i>Takip Ediliyor
                                </button>
                                <button class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-400">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">2024 UI Tasarım Trendleri</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Bu yıl UI tasarımında hangi trendlerin öne çıkacağını düşünüyorsunuz? Bence minimalizm, bold typography ve micro-interactions ön planda olacak. Sizin görüşleriniz neler?
                            </p>
                        </div>
                        
                        <div class="grid grid-cols-2 gap-2 mb-3">
                            <img src="https://images.unsplash.com/photo-1561070791-2526d30994b5?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="UI Design 1" class="w-full h-32 object-cover rounded-lg">
                            <img src="https://images.unsplash.com/photo-1558655146-d09347e92766?ixlib=rb-4.0.3&auto=format&fit=crop&w=400&q=80" 
                                 alt="UI Design 2" class="w-full h-32 object-cover rounded-lg">
                        </div>
                        
                        <div class="flex items-center space-x-2 mb-3">
                            <span class="bg-pink-100 dark:bg-pink-900 text-pink-800 dark:text-pink-300 text-xs px-2 py-1 rounded-full">UI Design</span>
                            <span class="bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 text-xs px-2 py-1 rounded-full">UX</span>
                            <span class="bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 text-xs px-2 py-1 rounded-full">Trends</span>
                        </div>
                        
                        <div class="flex items-center justify-between text-sm text-gray-500 dark:text-gray-400 border-t border-gray-200 dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-thumbs-up"></i>
                                    <span>89</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-comment"></i>
                                    <span>34</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-blue-600 dark:hover:text-blue-400 transition-colors">
                                    <i class="fas fa-share"></i>
                                    <span>Paylaş</span>
                                </button>
                            </div>
                            <button class="flex items-center space-x-1 hover:text-yellow-500 transition-colors">
                                <i class="fas fa-bookmark"></i>
                                <span>Kaydet</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Load More Button -->
                <div class="text-center mt-6">
                    <button class="bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 px-6 py-2 rounded-lg font-medium transition-colors">
                        <i class="fas fa-plus mr-2"></i>
                        Daha Fazla Gönderi Yükle
                    </button>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="w-full lg:w-1/4">
            <!-- Trending Topics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4 transition-colors duration-300">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Trend Konular</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">#React18</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">1.2k gönderi</p>
                        </div>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">#FreelanceLife</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">856 gönderi</p>
                        </div>
                        <i class="fas fa-trending-up text-green-500"></i>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">#WebDev</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">2.3k gönderi</p>
                        </div>
                        <i class="fas fa-chart-line text-blue-500"></i>
                    </div>
                    <div class="flex items-center justify-between">
                        <div>
                            <h4 class="font-medium text-gray-900 dark:text-white">#UIDesign</h4>
                            <p class="text-xs text-gray-500 dark:text-gray-400">634 gönderi</p>
                        </div>
                        <i class="fas fa-star text-yellow-500"></i>
                    </div>
                </div>
            </div>

            <!-- Suggested Communities -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4 transition-colors duration-300">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Önerilen Topluluklar</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-red-400 to-red-600 flex items-center justify-center text-white font-bold text-sm">
                                PY
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Python Türkiye</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">4.2k üye</p>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full text-xs font-medium hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                            Katıl
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-indigo-400 to-indigo-600 flex items-center justify-center text-white font-bold text-sm">
                                ML
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Machine Learning</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">2.8k üye</p>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full text-xs font-medium hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                            Katıl
                        </button>
                    </div>
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-3">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-teal-400 to-teal-600 flex items-center justify-center text-white font-bold text-sm">
                                VU
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Vue.js Türkiye</h4>
                                <p class="text-xs text-gray-500 dark:text-gray-400">1.9k üye</p>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full text-xs font-medium hover:bg-blue-200 dark:hover:bg-blue-800 transition-colors">
                            Katıl
                        </button>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 transition-colors duration-300">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Son Aktiviteler</h3>
                <div class="space-y-3">
                    <div class="flex items-start space-x-3">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="User" class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white"><span class="font-medium">Ayşe K.</span> React konusuna yorum yaptı</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">5 dakika önce</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="https://randomuser.me/api/portraits/men/22.jpg" alt="User" class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white"><span class="font-medium">Mehmet Y.</span> yeni bir topluluk oluşturdu</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">15 dakika önce</p>
                        </div>
                    </div>
                    <div class="flex items-start space-x-3">
                        <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="User" class="w-8 h-8 rounded-full">
                        <div class="flex-1">
                            <p class="text-sm text-gray-900 dark:text-white"><span class="font-medium">Zeynep A.</span> bir gönderiyi beğendi</p>
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