@extends('layouts.app')

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
                    <input type="text" placeholder="Neler paylaşmak istersin?" 
                           class="flex-1 py-2 px-4 bg-gray-100 dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 focus:outline-none cursor-pointer transition-colors">
                </div>
                <div class="flex justify-between border-t dark:border-gray-700 pt-3">
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
            
            <!-- Post Filters -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-3 mb-4 flex overflow-x-auto scrollbar-hide transition-colors duration-300">
                <button class="flex-shrink-0 px-4 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full mr-2 font-medium">
                    <i class="fas fa-fire mr-1"></i> Popüler
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full mr-2 font-medium transition-colors">
                    <i class="fas fa-clock mr-1"></i> Son
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full mr-2 font-medium transition-colors">
                    <i class="fas fa-star mr-1"></i> Takip Edilenler
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full mr-2 font-medium transition-colors">
                    <i class="fas fa-bolt mr-1"></i> Canlı
                </button>
                <button class="flex-shrink-0 px-4 py-1 hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 rounded-full font-medium transition-colors">
                    <i class="fas fa-trophy mr-1"></i> Öne Çıkanlar
                </button>
            </div>
            
            <!-- Posts -->
            <div class="space-y-4">
                <!-- Post 1 -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Ayşe Kaya</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>Web Developer</span>
                                        <span>•</span>
                                        <span>2 saat önce</span>
                                        <span>•</span>
                                        <span class="text-blue-500">#webdevelopment</span>
                                    </div>
                                </div>
                            </div>
                            <button class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">React ve Next.js ile Modern Web Uygulamaları Geliştirme</h3>
                            <p class="text-gray-700 dark:text-gray-300">
                                Merhaba arkadaşlar, bugün sizlerle React ve Next.js kullanarak nasıl daha performanslı web uygulamaları geliştirebileceğimizi konuşacağız. Özellikle server-side rendering'in avantajlarından bahsedeceğim.
                            </p>
                        </div>
                        
                        <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-3 mb-4 transition-colors duration-300">
                            <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-2">
                                <i class="fas fa-link"></i>
                                <span>medium.com/react-nextjs-guide</span>
                            </div>
                            <h4 class="font-semibold mb-1 text-gray-900 dark:text-white">React ve Next.js Kılavuzu</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Next.js ile React uygulamalarınızı nasıl optimize edebileceğinizi öğrenin</p>
                        </div>
                        
                        <div class="flex items-center justify-between text-gray-500 dark:text-gray-400 border-t dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-500 transition-colors">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>124 Beğeni</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-green-500 transition-colors">
                                    <i class="far fa-comment-alt"></i>
                                    <span>23 Yorum</span>
                                </button>
                            </div>
                            <button class="flex items-center space-x-1 hover:text-purple-500 transition-colors">
                                <i class="far fa-share-square"></i>
                                <span>Paylaş</span>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Post 2 - Project -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/men/75.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Mehmet Özkan</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>Startup Kurucusu</span>
                                        <span>•</span>
                                        <span>4 saat önce</span>
                                        <span>•</span>
                                        <span class="text-green-500">#freelance</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-300 rounded-full text-xs font-medium">PROJE</span>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">E-ticaret Sitesi Geliştiricisi Aranıyor</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-3">
                                Yeni e-ticaret projemiz için deneyimli bir full-stack developer arıyoruz. Modern teknolojiler kullanarak kullanıcı dostu bir platform geliştireceğiz.
                            </p>
                            
                            <div class="grid grid-cols-2 gap-3 mb-3">
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-dollar-sign text-green-500"></i>
                                    <span>Bütçe: ₺15,000 - ₺25,000</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-clock text-blue-500"></i>
                                    <span>Süre: 2-3 ay</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-star text-yellow-500"></i>
                                    <span>Deneyim: 3+ yıl</span>
                                </div>
                                <div class="flex items-center space-x-2 text-sm text-gray-700 dark:text-gray-300">
                                    <i class="fas fa-users text-purple-500"></i>
                                    <span>12 teklif alındı</span>
                                </div>
                            </div>
                            
                            <div class="flex flex-wrap gap-2">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">React</span>
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">Node.js</span>
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">MongoDB</span>
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">E-ticaret</span>
                            </div>
                        </div>
                        
                        <div class="flex items-center justify-between text-gray-500 dark:text-gray-400 border-t dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-500 transition-colors">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>18 Beğeni</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-green-500 transition-colors">
                                    <i class="far fa-comment-alt"></i>
                                    <span>5 Yorum</span>
                                </button>
                            </div>
                            <button class="px-4 py-2 bg-blue-600 dark:bg-blue-700 text-white rounded-lg text-sm font-medium hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
                                Teklif Ver
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Post 3 - Discussion with Poll -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm overflow-hidden post-card transition-all duration-300">
                    <div class="p-4">
                        <div class="flex items-center justify-between mb-3">
                            <div class="flex items-center space-x-3">
                                <img src="https://randomuser.me/api/portraits/women/68.jpg" alt="Profile" class="w-10 h-10 rounded-full">
                                <div>
                                    <h4 class="font-semibold text-gray-900 dark:text-white">Zeynep Yılmaz</h4>
                                    <div class="flex items-center space-x-1 text-xs text-gray-500 dark:text-gray-400">
                                        <span>UI/UX Designer</span>
                                        <span>•</span>
                                        <span>6 saat önce</span>
                                        <span>•</span>
                                        <span class="text-purple-500">#frontend</span>
                                    </div>
                                </div>
                            </div>
                            <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-300 rounded-full text-xs font-medium">ANKET</span>
                        </div>
                        
                        <div class="mb-4">
                            <h3 class="font-bold text-lg mb-2 text-gray-900 dark:text-white">Hangi frontend framework'ü tercih ediyorsunuz?</h3>
                            <p class="text-gray-700 dark:text-gray-300 mb-4">
                                Yeni projemde hangi frontend framework'ü kullanacağıma karar vermeye çalışıyorum. Sizin deneyimlerinizi merak ediyorum!
                            </p>
                            
                            <div class="space-y-3">
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-gray-900 dark:text-white">React</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">45%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-blue-600 h-2 rounded-full" style="width: 45%"></div>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-gray-900 dark:text-white">Vue.js</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">30%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-green-600 h-2 rounded-full" style="width: 30%"></div>
                                    </div>
                                </div>
                                
                                <div class="border border-gray-200 dark:border-gray-600 rounded-lg p-3 hover:bg-gray-50 dark:hover:bg-gray-700 cursor-pointer transition-colors">
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="font-medium text-gray-900 dark:text-white">Angular</span>
                                        <span class="text-sm text-gray-500 dark:text-gray-400">25%</span>
                                    </div>
                                    <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                        <div class="bg-red-600 h-2 rounded-full" style="width: 25%"></div>
                                    </div>
                                </div>
                            </div>
                            
                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-3">127 kişi oy verdi</p>
                        </div>
                        
                        <div class="flex items-center justify-between text-gray-500 dark:text-gray-400 border-t dark:border-gray-700 pt-3">
                            <div class="flex items-center space-x-4">
                                <button class="flex items-center space-x-1 hover:text-blue-500 transition-colors">
                                    <i class="far fa-thumbs-up"></i>
                                    <span>32 Beğeni</span>
                                </button>
                                <button class="flex items-center space-x-1 hover:text-green-500 transition-colors">
                                    <i class="far fa-comment-alt"></i>
                                    <span>15 Yorum</span>
                                </button>
                            </div>
                            <button class="flex items-center space-x-1 hover:text-purple-500 transition-colors">
                                <i class="far fa-share-square"></i>
                                <span>Paylaş</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar -->
        <div class="hidden lg:block lg:w-1/4">
            <!-- Featured Freelancers -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4 transition-colors duration-300">
                <h3 class="font-semibold text-lg mb-4 text-gray-900 dark:text-white">Öne Çıkan Freelancerlar</h3>
                <div class="space-y-4">
                    <div class="flex items-center space-x-3">
                        <img src="https://randomuser.me/api/portraits/men/45.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 dark:text-white">Ali Veli</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Full Stack Developer</p>
                            <div class="flex items-center space-x-1 mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400">(4.9)</span>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-600 dark:bg-blue-700 text-white rounded-lg text-sm hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
                            İncele
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <img src="https://randomuser.me/api/portraits/women/32.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 dark:text-white">Fatma Şahin</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">UI/UX Designer</p>
                            <div class="flex items-center space-x-1 mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400">(4.8)</span>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-600 dark:bg-blue-700 text-white rounded-lg text-sm hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
                            İncele
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-3">
                        <img src="https://randomuser.me/api/portraits/men/67.jpg" alt="Profile" class="w-12 h-12 rounded-full">
                        <div class="flex-1">
                            <h4 class="font-medium text-gray-900 dark:text-white">Can Özkan</h4>
                            <p class="text-sm text-gray-600 dark:text-gray-400">Mobile Developer</p>
                            <div class="flex items-center space-x-1 mt-1">
                                <div class="flex text-yellow-400">
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="fas fa-star text-xs"></i>
                                    <i class="far fa-star text-xs"></i>
                                </div>
                                <span class="text-xs text-gray-500 dark:text-gray-400">(4.7)</span>
                            </div>
                        </div>
                        <button class="px-3 py-1 bg-blue-600 dark:bg-blue-700 text-white rounded-lg text-sm hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
                            İncele
                        </button>
                    </div>
                </div>
                <button class="w-full mt-4 text-center text-blue-500 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                    Tümünü Gör
                </button>
            </div>

            <!-- Trending Topics -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 transition-colors duration-300">
                <h3 class="font-semibold text-lg mb-4 text-gray-900 dark:text-white">Trend Konular</h3>
                <div class="space-y-3">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">#ReactJS</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">1.2k gönderi</p>
                        </div>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">#FreelanceLife</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">856 gönderi</p>
                        </div>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">#WebDesign</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">743 gönderi</p>
                        </div>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">#StartupLife</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">621 gönderi</p>
                        </div>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                    
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="font-medium text-gray-900 dark:text-white">#RemoteWork</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">534 gönderi</p>
                        </div>
                        <i class="fas fa-fire text-orange-500"></i>
                    </div>
                </div>
                <button class="w-full mt-4 text-center text-blue-500 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300 transition-colors">
                    Daha fazla göster
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Profile Modal (Hidden by default) -->
<div id="profileModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white dark:bg-gray-800 rounded-lg max-w-md w-full p-6 transition-colors duration-300">
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Profil</h3>
                <button onclick="closeProfileModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="text-center mb-6">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-20 h-20 rounded-full mx-auto mb-3">
                <h4 class="font-semibold text-lg text-gray-900 dark:text-white">Ahmet Yılmaz</h4>
                <p class="text-gray-600 dark:text-gray-400">Web Developer</p>
            </div>
            
            <div class="grid grid-cols-3 gap-4 mb-6">
                <div class="text-center">
                    <p class="font-semibold text-lg text-gray-900 dark:text-white">127</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Gönderi</p>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-lg text-gray-900 dark:text-white">1.2k</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Takipçi</p>
                </div>
                <div class="text-center">
                    <p class="font-semibold text-lg text-gray-900 dark:text-white">856</p>
                    <p class="text-sm text-gray-500 dark:text-gray-400">Takip</p>
                </div>
            </div>
            
            <div class="mb-6">
                <h5 class="font-semibold mb-2 text-gray-900 dark:text-white">Yetenekler</h5>
                <div class="flex flex-wrap gap-2">
                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">React</span>
                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">JavaScript</span>
                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">Node.js</span>
                    <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-300 rounded-full text-xs">CSS</span>
                </div>
            </div>
            
            <div class="flex space-x-3">
                <button class="flex-1 bg-blue-600 dark:bg-blue-700 text-white py-2 rounded-lg hover:bg-blue-700 dark:hover:bg-blue-600 transition-colors">
                    Takip Et
                </button>
                <button class="flex-1 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 py-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                    Mesaj Gönder
                </button>
            </div>
        </div>
    </div>
</div>

<script>
function openProfileModal() {
    document.getElementById('profileModal').classList.remove('hidden');
}

function closeProfileModal() {
    document.getElementById('profileModal').classList.add('hidden');
}
</script>
@endsection
