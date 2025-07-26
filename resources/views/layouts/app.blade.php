<!DOCTYPE html>
<html lang="tr" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', ($siteSettings['site_name'] ?? 'FreelancerHub') . ' | ' . ($siteSettings['site_tagline'] ?? 'Sosyal Forum & Freelance Platform'))</title>
    
    <!-- Default Meta Tags -->
    <meta name="description" content="@yield('meta_description', $siteSettings['site_description'] ?? 'Freelancer ve işverenler için güvenli platform')">
    <meta name="keywords" content="@yield('meta_keywords', $siteSettings['site_keywords'] ?? 'freelancer, iş, proje')">
    <meta name="author" content="@yield('meta_author', $siteSettings['site_name'] ?? 'Freelancer')">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Page-specific Meta Tags -->
    @stack('meta')
    
    <!-- Default Open Graph Meta Tags (will be overridden by page-specific ones) -->
    @if(!View::hasSection('meta'))
    <meta property="og:title" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    <meta property="og:description" content="{{ $siteSettings['site_description'] ?? 'Freelancer ve işverenler için güvenli platform' }}">
    <meta property="og:image" content="{{ asset($siteSettings['site_og_image'] ?? 'images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    
    <!-- Default Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    <meta name="twitter:description" content="{{ $siteSettings['site_description'] ?? 'Freelancer ve işverenler için güvenli platform' }}">
    <meta name="twitter:image" content="{{ asset($siteSettings['site_og_image'] ?? 'images/og-image.jpg') }}">
    @endif
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($siteSettings['site_favicon'] ?? 'logos/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset($siteSettings['site_favicon'] ?? 'logos/favicon.ico') }}">
    
    <!-- Default Canonical URL (will be overridden by page-specific ones) -->
    @if(!View::hasSection('meta'))
    <link rel="canonical" href="{{ url()->current() }}">
    @endif
    
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
        }
    </script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Custom CSS for elements that need more precise styling */
        .gradient-bg {
            background: linear-gradient(135deg, #3b82f6 0%, #8b5cf6 100%);
        }
        .post-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        .dark .post-card:hover {
            box-shadow: 0 10px 25px -5px rgba(255, 255, 255, 0.1);
        }
        .nav-item:hover .nav-icon {
            transform: scale(1.2);
        }
        .profile-cover {
            height: 200px;
            background-size: cover;
            background-position: center;
        }
        @media (min-width: 1024px) {
            .profile-cover {
                height: 300px;
            }
        }
        .scrollbar-hide::-webkit-scrollbar {
            display: none;
        }
        .scrollbar-hide {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
        .modal-backdrop {
            backdrop-filter: blur(4px);
            background: rgba(0, 0, 0, 0.5);
        }
        .dark .modal-backdrop {
            background: rgba(0, 0, 0, 0.7);
        }
    </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased transition-colors duration-300">
    <!-- Mobile Navigation -->
    <div class="lg:hidden fixed bottom-0 left-0 right-0 bg-white dark:bg-gray-800 shadow-lg z-50 border-t border-gray-200 dark:border-gray-700 transition-colors duration-300">
        <div class="flex justify-around items-center py-2 px-1">
            <a href="/" class="nav-item text-center flex-1 py-2 {{ request()->is('/') ? 'bg-blue-50 dark:bg-blue-900/20 rounded-lg' : '' }}">
                <i class="nav-icon fas fa-home {{ request()->is('/') ? 'text-blue-600 dark:text-blue-400' : 'text-blue-500' }} text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight {{ request()->is('/') ? 'text-blue-600 dark:text-blue-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Ana Sayfa</span>
            </a>
            <a href="/community" class="nav-item text-center flex-1 py-2 {{ request()->is('community*') ? 'bg-purple-50 dark:bg-purple-900/20 rounded-lg' : '' }}">
                <i class="nav-icon fas fa-users {{ request()->is('community*') ? 'text-purple-600 dark:text-purple-400' : 'text-purple-500' }} text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight {{ request()->is('community*') ? 'text-purple-600 dark:text-purple-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Topluluk</span>
            </a>
            <a href="/projects" class="nav-item text-center flex-1 py-2 {{ request()->is('projects*') ? 'bg-green-50 dark:bg-green-900/20 rounded-lg' : '' }}">
                <i class="nav-icon fas fa-briefcase {{ request()->is('projects*') ? 'text-green-600 dark:text-green-400' : 'text-green-500' }} text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight {{ request()->is('projects*') ? 'text-green-600 dark:text-green-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Projeler</span>
            </a>
            <a href="/services" class="nav-item text-center flex-1 py-2 {{ request()->is('services*') ? 'bg-orange-50 dark:bg-orange-900/20 rounded-lg' : '' }}">
                <i class="nav-icon fas fa-cogs {{ request()->is('services*') ? 'text-orange-600 dark:text-orange-400' : 'text-orange-500' }} text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight {{ request()->is('services*') ? 'text-orange-600 dark:text-orange-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Hizmetler</span>
            </a>
       
            <a href="/profile" class="nav-item text-center flex-1 py-2 {{ request()->is('profile*') ? 'bg-pink-50 dark:bg-pink-900/20 rounded-lg' : '' }}">
                <i class="nav-icon fas fa-user {{ request()->is('profile*') ? 'text-pink-600 dark:text-pink-400' : 'text-pink-500' }} text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight {{ request()->is('profile*') ? 'text-pink-600 dark:text-pink-400 font-semibold' : 'text-gray-700 dark:text-gray-300' }}">Profil</span>
            </a>
        </div>
    </div>

    <!-- Desktop Navigation -->
    <nav class="hidden lg:flex flex-col w-64 h-screen fixed left-0 top-0 bg-white dark:bg-gray-800 shadow-lg z-40 transition-colors duration-300">
        <div class="p-4 gradient-bg">
            <h1 class="text-white text-2xl font-bold">{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}</h1>
            <p class="text-white text-opacity-80 text-sm">{{ $siteSettings['site_tagline'] ?? 'Sosyal Forum & Freelance Platform' }}</p>
        </div>
        
        <div class="flex-1 overflow-y-auto scrollbar-hide">
            <div class="p-4">
                @auth
                <div class="flex items-center space-x-3 mb-6">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-10 h-10 rounded-full border-2 border-blue-400">
                    <div>
                        <h4 class="font-semibold text-gray-900 dark:text-white">{{ Auth::user()->name }}</h4>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Web Developer</p>
                    </div>
                </div>
                @else
                <div class="flex items-center space-x-3 mb-6">
                    <div class="w-10 h-10 rounded-full bg-gray-300 dark:bg-gray-600 border-2 border-blue-400 flex items-center justify-center">
                        <i class="fas fa-user text-gray-500 dark:text-gray-400"></i>
                    </div>
                    <div>
                        <button onclick="openAuthModal('login')" class="text-blue-600 dark:text-blue-400 font-semibold hover:text-blue-700 dark:hover:text-blue-300">Giriş Yap</button>
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Hesabınıza giriş yapın</p>
                    </div>
                </div>
                @endauth
                
                <div class="space-y-1">
                    <a href="/" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('/') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-home w-5"></i>
                        <span>Ana Sayfa</span>
                    </a>
                    <a href="/community" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('community*') ? 'bg-purple-50 dark:bg-purple-900/20 text-purple-600 dark:text-purple-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-users w-5"></i>
                        <span>Topluluk</span>
                    </a>
                    <a href="/projects" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('projects*') ? 'bg-green-50 dark:bg-green-900/20 text-green-600 dark:text-green-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-briefcase w-5"></i>
                        <span>Projeler</span>
                    </a>
                    <a href="/services" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('services*') ? 'bg-orange-50 dark:bg-orange-900/20 text-orange-600 dark:text-orange-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-cogs w-5"></i>
                        <span>Hizmetler</span>
                    </a>
                    <a href="/auctions" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('auctions*') ? 'bg-yellow-50 dark:bg-yellow-900/20 text-yellow-600 dark:text-yellow-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-gavel w-5"></i>
                        <span>Açık Arttırma</span>
                    </a>
                    <a href="/messages" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('messages*') ? 'bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-comments w-5"></i>
                        <span>Mesajlar</span>
                    </a>
                    <a href="/notifications" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('notifications*') ? 'bg-red-50 dark:bg-red-900/20 text-red-600 dark:text-red-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-bell w-5"></i>
                        <span>Bildirimler</span>
                    </a>
                    <a href="/wallet" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('wallet*') ? 'bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                        <i class="fas fa-wallet w-5"></i>
                        <span>Cüzdan</span>
                    </a>
                </div>
                
                <div class="mt-6">
                    <h3 class="text-xs uppercase font-semibold text-gray-500 dark:text-gray-400 mb-2">Kategoriler</h3>
                    <div class="space-y-1">
                        <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                            <i class="fas fa-code w-5 text-green-500"></i>
                            <span>Web Geliştirme</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                            <i class="fas fa-paint-brush w-5 text-purple-500"></i>
                            <span>Tasarım</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                            <i class="fas fa-mobile-alt w-5 text-blue-500"></i>
                            <span>Mobil Uygulama</span>
                        </a>
                        <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                            <i class="fas fa-search-dollar w-5 text-yellow-500"></i>
                            <span>SEO</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="p-4 border-t border-gray-200 dark:border-gray-700">
            <!-- Dark Mode Toggle -->
            <button onclick="toggleDarkMode()" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left text-gray-700 dark:text-gray-300 transition-colors mb-2">
                <i class="fas fa-moon dark:hidden w-5"></i>
                <i class="fas fa-sun hidden dark:block w-5"></i>
                <span class="dark:hidden">Karanlık Mod</span>
                <span class="hidden dark:block">Aydınlık Mod</span>
            </button>
            
            <a href="/settings" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 {{ request()->is('settings*') ? 'bg-gray-50 dark:bg-gray-700 text-gray-900 dark:text-white' : 'text-gray-700 dark:text-gray-300' }} transition-colors">
                <i class="fas fa-cog w-5"></i>
                <span>Ayarlar</span>
            </a>
            @auth
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left text-gray-700 dark:text-gray-300 transition-colors">
                    <i class="fas fa-sign-out-alt w-5"></i>
                    <span>Çıkış Yap</span>
                </button>
            </form>
            @else
            <button onclick="openAuthModal('login')" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 w-full text-left text-gray-700 dark:text-gray-300 transition-colors">
                <i class="fas fa-sign-in-alt w-5"></i>
                <span>Giriş Yap</span>
            </button>
            @endauth
        </div>
    </nav>

    <!-- Main Content -->
    <main class="lg:ml-64 pb-20 lg:pb-0">
        <!-- Mobile Header -->
        <header class="lg:hidden flex items-center justify-between p-4 bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-30 transition-colors duration-300">
            <div class="flex items-center space-x-2">
                <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                <h1 class="font-bold text-lg text-gray-900 dark:text-white">{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}</h1>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="toggleDarkMode()" class="text-gray-600 dark:text-gray-300 transition-colors">
                    <i class="fas fa-moon dark:hidden"></i>
                    <i class="fas fa-sun hidden dark:block"></i>
                </button>
                <button class="text-gray-600 dark:text-gray-300 transition-colors">
                    <i class="fas fa-search"></i>
                </button>
                <button class="text-gray-600 dark:text-gray-300 transition-colors">
                    <i class="fas fa-bell"></i>
                </button>
                @guest
                <button onclick="openAuthModal('login')" class="text-blue-600 dark:text-blue-400 transition-colors">
                    <i class="fas fa-sign-in-alt"></i>
                </button>
                @endguest
            </div>
        </header>

        <!-- Desktop Header -->
        <header class="hidden lg:flex items-center justify-between p-4 bg-white dark:bg-gray-800 shadow-sm sticky top-0 z-30 transition-colors duration-300">
            <div class="flex-1 max-w-2xl mx-4">
                <div class="relative">
                    <input type="text" placeholder="Toplulukta ara, proje bul..." 
                           class="w-full py-2 pl-10 pr-4 rounded-full border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white placeholder-gray-500 dark:placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                    <i class="fas fa-search absolute left-3 top-3 text-gray-400 dark:text-gray-500"></i>
                </div>
            </div>
            <div class="flex items-center space-x-4">
                <button onclick="toggleDarkMode()" class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-moon text-gray-600 dark:text-gray-300 dark:hidden"></i>
                    <i class="fas fa-sun text-gray-600 dark:text-gray-300 hidden dark:block"></i>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 relative transition-colors">
                    <i class="fas fa-bell text-gray-600 dark:text-gray-300"></i>
                    <span class="absolute top-0 right-0 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>
                <button class="p-2 rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                    <i class="fas fa-envelope text-gray-600 dark:text-gray-300"></i>
                </button>
                <button class="flex items-center space-x-2 bg-gray-100 dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 rounded-full py-1 px-3 transition-colors">
                    <i class="fas fa-plus text-sm text-gray-600 dark:text-gray-300"></i>
                    <span class="text-sm font-medium text-gray-700 dark:text-gray-300">Gönderi</span>
                </button>
                <div class="w-px h-8 bg-gray-200 dark:bg-gray-600"></div>
                @auth
                <div class="flex items-center space-x-2 cursor-pointer">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-8 h-8 rounded-full">
                    <span class="text-sm font-medium text-gray-900 dark:text-white">{{ Auth::user()->name }}</span>
                    <i class="fas fa-chevron-down text-xs text-gray-500 dark:text-gray-400"></i>
                </div>
                @else
                <div class="flex items-center space-x-2">
                    <button onclick="openAuthModal('login')" class="px-4 py-1 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors">
                        Giriş Yap
                    </button>
                    <button onclick="openAuthModal('register')" class="px-4 py-1 bg-blue-600 dark:bg-blue-700 text-white rounded-full hover:bg-blue-700 dark:hover:bg-blue-600 font-medium transition-colors">
                        Kayıt Ol
                    </button>
                </div>
                @endauth
            </div>
        </header>

        @yield('content')
    
    <!-- Welcome Toast Notification -->
    <div id="welcome-toast" class="fixed top-4 right-4 z-50 transform translate-x-full opacity-0 transition-all duration-500 ease-in-out pointer-events-none">
        <div class="bg-gradient-to-r from-green-500 to-blue-600 text-white px-6 py-4 rounded-lg shadow-lg max-w-sm">
            <div class="flex items-center space-x-3">
                <div class="flex-shrink-0">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                        <i class="fas fa-user-check text-white"></i>
                    </div>
                </div>
                <div class="flex-1">
                    <h4 class="font-semibold text-sm">Hoşgeldin!</h4>
                    <p id="welcome-message" class="text-sm opacity-90"></p>
                </div>
                <button onclick="hideWelcomeToast()" class="text-white hover:text-gray-200 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- General Toast Notification Component -->
    @include('components.toast-notification')
</main>

    <!-- Profile Modal -->
    <div class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden" id="profileModal">
        <div class="absolute top-0 right-0 bottom-0 w-full max-w-md bg-white dark:bg-gray-800 overflow-y-auto">
            <div class="sticky top-0 bg-white dark:bg-gray-800 z-10 p-4 flex justify-between items-center border-b border-gray-200 dark:border-gray-700">
                <h2 class="text-xl font-bold text-gray-900 dark:text-white">Profil</h2>
                <button onclick="closeProfileModal()" class="text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300 transition-colors">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            
            <div class="profile-cover bg-gradient-to-r from-blue-500 to-purple-600 h-32"></div>
            
            <div class="px-4 pb-6">
                <div class="flex justify-between items-start -mt-12 mb-4">
                    <img src="https://randomuser.me/api/portraits/men/32.jpg" alt="Profile" class="w-24 h-24 rounded-full border-4 border-white dark:border-gray-800">
                    <div class="flex space-x-2 mt-4">
                        <button class="px-4 py-1 bg-blue-500 text-white rounded-full hover:bg-blue-600 font-medium transition-colors">
                            <i class="fas fa-user-plus mr-1"></i> Takip Et
                        </button>
                        <button class="p-2 rounded-full border border-gray-300 dark:border-gray-600 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors">
                            <i class="fas fa-ellipsis-h text-gray-600 dark:text-gray-400"></i>
                        </button>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Ahmet Yılmaz</h1>
                    <p class="text-gray-600 dark:text-gray-400 mb-2">Senior Web Developer | React Specialist</p>
                    <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-1"></i>
                            <span>İstanbul, Türkiye</span>
                        </span>
                        <span>•</span>
                        <span class="flex items-center">
                            <i class="fas fa-calendar-alt mr-1"></i>
                            <span>Haziran 2018'den beri üye</span>
                        </span>
                    </div>
                </div>
                
                <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 mb-6">
                    <div class="grid grid-cols-3 gap-4 text-center">
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">142</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Takipçi</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">87</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Takip Edilen</p>
                        </div>
                        <div>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">4.9</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Puan</p>
                        </div>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Hakkımda</h3>
                    <p class="text-gray-700 dark:text-gray-300 mb-3">
                        10 yılı aşkın süredir web geliştirme alanında çalışıyorum. React, Node.js ve MongoDB stack'inde uzmanım. Freelance projeler alıyorum ve aynı zamanda bir eğitmenim.
                    </p>
                    <div class="flex flex-wrap gap-2">
                        <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-400 rounded-full text-xs">React</span>
                        <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-400 rounded-full text-xs">Node.js</span>
                        <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-400 rounded-full text-xs">MongoDB</span>
                        <span class="px-2 py-1 bg-yellow-100 dark:bg-yellow-900 text-yellow-600 dark:text-yellow-400 rounded-full text-xs">JavaScript</span>
                        <span class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-400 rounded-full text-xs">Firebase</span>
                    </div>
                </div>
                
                <div class="mb-6">
                    <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">İstatistikler</h3>
                    <div class="space-y-4">
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-300">Toplam Gönderi</span>
                                <span class="font-medium text-gray-900 dark:text-white">247</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                <div class="bg-blue-500 h-2 rounded-full" style="width: 80%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-300">Toplam Beğeni</span>
                                <span class="font-medium text-gray-900 dark:text-white">5.2K</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                <div class="bg-green-500 h-2 rounded-full" style="width: 65%"></div>
                            </div>
                        </div>
                        <div>
                            <div class="flex justify-between text-sm mb-1">
                                <span class="text-gray-700 dark:text-gray-300">Tamamlanan Proje</span>
                                <span class="font-medium text-gray-900 dark:text-white">48</span>
                            </div>
                            <div class="w-full bg-gray-200 dark:bg-gray-600 rounded-full h-2">
                                <div class="bg-purple-500 h-2 rounded-full" style="width: 90%"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div>
                    <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Bağlantılar</h3>
                    <div class="flex space-x-3">
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-600 text-white flex items-center justify-center hover:bg-blue-700 transition-colors">
                            <i class="fab fa-linkedin-in"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-gray-800 dark:bg-gray-600 text-white flex items-center justify-center hover:bg-gray-900 dark:hover:bg-gray-500 transition-colors">
                            <i class="fab fa-github"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-blue-400 text-white flex items-center justify-center hover:bg-blue-500 transition-colors">
                            <i class="fab fa-twitter"></i>
                        </a>
                        <a href="#" class="w-8 h-8 rounded-full bg-red-600 text-white flex items-center justify-center hover:bg-red-700 transition-colors">
                            <i class="fab fa-youtube"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Authentication Modal -->
    <div id="auth-modal" class="fixed inset-0 z-50 hidden">
        <div class="modal-backdrop fixed inset-0"></div>
        <div class="relative z-10 flex items-center justify-center min-h-screen p-4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl max-w-md w-full transition-colors duration-300">
                <!-- Login Form -->
                <div id="login-form" class="p-6">
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Giriş Yap</h2>
                        <button onclick="closeAuthModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="login-form-element" method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="login-field" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kullanıcı adı veya e-posta adresinizi giriniz</label>
                            <input type="text" id="login-field" name="login_field" required 
                                   placeholder="Kullanıcı adı veya e-posta"
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-4">
                            <label for="login-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Şifre</label>
                            <input type="password" id="login-password" name="password" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-6">
                            <label class="flex items-center">
                                <input type="checkbox" id="login-remember" name="remember" 
                                       class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Beni hatırla</span>
                            </label>
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium transition-colors">
                            Giriş Yap
                        </button>
                    </form>
                    
                    <div class="mt-4 text-center">
                        <p class="text-sm text-gray-600 dark:text-gray-400">
                            Hesabınız yok mu? 
                            <button onclick="switchToRegister()" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors">Kayıt olun</button>
                        </p>
                    </div>
                </div>

                <!-- Register Form -->
                <div id="register-form" class="p-6 hidden">
                    <!-- Progress Bar -->
                    <div class="mb-6">
                        <div class="flex items-center justify-between mb-2">
                            <span id="step-1-label" class="text-sm font-medium text-blue-600 dark:text-blue-400">1. Adım</span>
                            <span id="step-2-label" class="text-sm font-medium text-gray-400 dark:text-gray-500">2. Adım</span>
                        </div>
                        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                            <div id="progress-bar" class="bg-blue-600 dark:bg-blue-500 h-2 rounded-full transition-all duration-300" style="width: 50%"></div>
                        </div>
                    </div>

                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Kayıt Ol</h2>
                        <button onclick="closeAuthModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>

                    <!-- Step 1 Form -->
                    <div id="register-step-1">
                        <form id="register-step1-form">
                            @csrf
                            <div class="mb-4">
                                <label for="register-first-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ad</label>
                                <input type="text" id="register-first-name" name="first_name" required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <div id="first-name-error" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="register-last-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Soyad</label>
                                <input type="text" id="register-last-name" name="last_name" required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <div id="last-name-error" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="register-username" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kullanıcı Adı</label>
                                <input type="text" id="register-username" name="username" required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <div id="username-error" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            
                            <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium transition-colors">
                                Devam Et
                            </button>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Zaten hesabınız var mı? 
                                <button onclick="switchToLogin()" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors">Giriş yapın</button>
                            </p>
                        </div>
                    </div>

                    <!-- Step 2 Form -->
                    <div id="register-step-2" class="hidden">
                        <form id="register-step2-form">
                            @csrf
                            <div class="mb-4">
                                <label for="register-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-posta</label>
                                <input type="email" id="register-email" name="email" required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <div id="email-error" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            
                            <div class="mb-4">
                                <label for="register-birth-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Doğum Tarihi</label>
                                <input type="date" id="register-birth-date" name="birth_date" required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <div id="birth-date-error" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            
                            <div class="mb-6">
                                <label for="register-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Şifre</label>
                                <input type="password" id="register-password" name="password" required 
                                       class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                                <div id="password-error" class="text-red-500 text-sm mt-1 hidden"></div>
                            </div>
                            
                            <div class="flex space-x-3">
                                <button type="button" onclick="goBackToStep1()" class="flex-1 bg-gray-500 dark:bg-gray-600 text-white py-2 px-4 rounded-md hover:bg-gray-600 dark:hover:bg-gray-500 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 font-medium transition-colors">
                                    Geri
                                </button>
                                <button type="submit" class="flex-1 bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium transition-colors">
                                    Kayıt Ol
                                </button>
                            </div>
                        </form>
                        
                        <div class="mt-4 text-center">
                            <p class="text-sm text-gray-600 dark:text-gray-400">
                                Zaten hesabınız var mı? 
                                <button onclick="switchToLogin()" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium transition-colors">Giriş yapın</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Dark mode toggle functionality
        function toggleDarkMode() {
            const html = document.documentElement;
            const isDark = html.classList.contains('dark');
            
            if (isDark) {
                html.classList.remove('dark');
                localStorage.setItem('darkMode', 'false');
            } else {
                html.classList.add('dark');
                localStorage.setItem('darkMode', 'true');
            }
        }

        // Initialize dark mode based on localStorage
        function initializeDarkMode() {
            const darkMode = localStorage.getItem('darkMode');
            const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
            
            if (darkMode === 'true' || (darkMode === null && prefersDark)) {
                document.documentElement.classList.add('dark');
            }
        }

        // Initialize dark mode on page load
        initializeDarkMode();

        // Welcome Toast Functions
        function showWelcomeToast(userName) {
            const toast = document.getElementById('welcome-toast');
            const message = document.getElementById('welcome-message');
            
            if (toast && message) {
                message.textContent = userName + '! Tekrar hoşgeldin 🎉';
                
                // Show toast with smooth animation
                toast.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
                toast.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
                
                // Auto hide after 4 seconds
                setTimeout(() => {
                    hideWelcomeToast();
                }, 4000);
            }
        }

        function hideWelcomeToast() {
            const toast = document.getElementById('welcome-toast');
            if (toast) {
                toast.classList.remove('translate-x-0', 'opacity-100', 'pointer-events-auto');
                toast.classList.add('translate-x-full', 'opacity-0', 'pointer-events-none');
            }
        }

        // Authentication Modal Functions
        function openAuthModal(type = 'login') {
            const modal = document.getElementById('auth-modal');
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            
            if (modal && loginForm && registerForm) {
                if (type === 'register') {
                    loginForm.classList.add('hidden');
                    registerForm.classList.remove('hidden');
                } else {
                    registerForm.classList.add('hidden');
                    loginForm.classList.remove('hidden');
                }
                modal.classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }
        }

        function closeAuthModal() {
            const modal = document.getElementById('auth-modal');
            if (modal) {
                modal.classList.add('hidden');
                document.body.style.overflow = 'auto';
            }
        }

        function switchToRegister() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            if (loginForm && registerForm) {
                loginForm.classList.add('hidden');
                registerForm.classList.remove('hidden');
                // Reset to step 1 when switching to register
                resetToStep1();
            }
        }

        function switchToLogin() {
            const loginForm = document.getElementById('login-form');
            const registerForm = document.getElementById('register-form');
            if (loginForm && registerForm) {
                registerForm.classList.add('hidden');
                loginForm.classList.remove('hidden');
            }
        }

        // Two-step registration functions
        function resetToStep1() {
            const step1 = document.getElementById('register-step-1');
            const step2 = document.getElementById('register-step-2');
            const progressBar = document.getElementById('progress-bar');
            const step1Label = document.getElementById('step-1-label');
            const step2Label = document.getElementById('step-2-label');

            if (step1 && step2 && progressBar && step1Label && step2Label) {
                step1.classList.remove('hidden');
                step2.classList.add('hidden');
                progressBar.style.width = '50%';
                step1Label.classList.remove('text-gray-400', 'dark:text-gray-500');
                step1Label.classList.add('text-blue-600', 'dark:text-blue-400');
                step2Label.classList.remove('text-blue-600', 'dark:text-blue-400');
                step2Label.classList.add('text-gray-400', 'dark:text-gray-500');
            }
        }

        function goToStep2() {
            const step1 = document.getElementById('register-step-1');
            const step2 = document.getElementById('register-step-2');
            const progressBar = document.getElementById('progress-bar');
            const step1Label = document.getElementById('step-1-label');
            const step2Label = document.getElementById('step-2-label');

            if (step1 && step2 && progressBar && step1Label && step2Label) {
                step1.classList.add('hidden');
                step2.classList.remove('hidden');
                progressBar.style.width = '100%';
                step1Label.classList.remove('text-blue-600', 'dark:text-blue-400');
                step1Label.classList.add('text-gray-400', 'dark:text-gray-500');
                step2Label.classList.remove('text-gray-400', 'dark:text-gray-500');
                step2Label.classList.add('text-blue-600', 'dark:text-blue-400');
            }
        }

        function goBackToStep1() {
            resetToStep1();
        }

        // XSS Protection Functions
        function sanitizeInput(input) {
            if (typeof input !== 'string') return input;
            return input.replace(/<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi, '')
                       .replace(/javascript:/gi, '')
                       .replace(/on\w+\s*=/gi, '')
                       .replace(/<[^>]*>/g, '');
        }

        function validateInput(input) {
            if (typeof input !== 'string') return false;
            
            // Check for potential XSS patterns
            const xssPatterns = [
                /<script\b[^<]*(?:(?!<\/script>)<[^<]*)*<\/script>/gi,
                /javascript:/gi,
                /on\w+\s*=/gi,
                /<iframe/gi,
                /<object/gi,
                /<embed/gi,
                /vbscript:/gi,
                /data:text\/html/gi
            ];
            
            return !xssPatterns.some(pattern => pattern.test(input));
        }

        function validateFormData(formData) {
            const errors = [];
            
            for (let [key, value] of formData.entries()) {
                if (key !== 'password' && key !== '_token') { // Don't validate password and CSRF token
                    if (!validateInput(value)) {
                        errors.push(`${key} alanında geçersiz karakter tespit edildi.`);
                    }
                }
            }
            
            return errors;
        }

        function clearErrors() {
            const errorElements = ['first-name-error', 'last-name-error', 'username-error', 'email-error', 'birth-date-error', 'password-error'];
            errorElements.forEach(id => {
                const element = document.getElementById(id);
                if (element) {
                    element.classList.add('hidden');
                    element.textContent = '';
                }
            });
        }

        function showErrors(errors) {
            clearErrors();
            Object.keys(errors).forEach(field => {
                const errorElement = document.getElementById(field + '-error');
                if (errorElement && errors[field] && errors[field].length > 0) {
                    errorElement.textContent = errors[field][0];
                    errorElement.classList.remove('hidden');
                }
            });
        }

        // Close modal when clicking on backdrop
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('auth-modal');
            if (modal && event.target === modal) {
                closeAuthModal();
            }
        });

        // Handle form submissions
        document.addEventListener('DOMContentLoaded', function() {
            const loginForm = document.getElementById('login-form-element');
            const registerStep1Form = document.getElementById('register-step1-form');
            const registerStep2Form = document.getElementById('register-step2-form');

            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    
                    // Client-side XSS validation
                    const validationErrors = validateFormData(formData);
                    if (validationErrors.length > 0) {
                        alert('Güvenlik hatası: ' + validationErrors.join(', '));
                        return;
                    }
                    
                    fetch(this.action, {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeAuthModal();
                            
                            // Show welcome toast if user data is available
                            if (data.user && data.user.full_name) {
                                showWelcomeToast(data.user.full_name);
                                
                                // Reload page after a short delay to show the toast
                                setTimeout(() => {
                                    window.location.reload();
                                }, 1500);
                            } else {
                                window.location.reload();
                            }
                        } else {
                            alert(data.message || 'Giriş başarısız!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Bir hata oluştu!');
                    });
                });
            }

            // Step 1 form submission
            if (registerStep1Form) {
                registerStep1Form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    clearErrors();
                    
                    const formData = new FormData(this);
                    
                    // Client-side XSS validation
                    const validationErrors = validateFormData(formData);
                    if (validationErrors.length > 0) {
                        alert('Güvenlik hatası: ' + validationErrors.join(', '));
                        return;
                    }
                    
                    fetch('{{ route("register.step1") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            goToStep2();
                        } else {
                            if (data.errors) {
                                showErrors(data.errors);
                            } else {
                                alert(data.message || 'Bir hata oluştu!');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Bir hata oluştu!');
                    });
                });
            }

            // Step 2 form submission
            if (registerStep2Form) {
                registerStep2Form.addEventListener('submit', function(e) {
                    e.preventDefault();
                    clearErrors();
                    
                    const formData = new FormData(this);
                    
                    // Client-side XSS validation
                    const validationErrors = validateFormData(formData);
                    if (validationErrors.length > 0) {
                        alert('Güvenlik hatası: ' + validationErrors.join(', '));
                        return;
                    }
                    
                    fetch('{{ route("register") }}', {
                        method: 'POST',
                        body: formData,
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            closeAuthModal();
                            
                            // Show welcome toast for new registration
                            if (data.user && data.user.full_name) {
                                const toast = document.getElementById('welcome-toast');
                                const message = document.getElementById('welcome-message');
                                
                                if (toast && message) {
                                    message.textContent = data.user.full_name + '! ProConnect\'e hoşgeldin 🎉';
                                    
                                    // Show toast with smooth animation
                                    toast.classList.remove('translate-x-full', 'opacity-0', 'pointer-events-none');
                                    toast.classList.add('translate-x-0', 'opacity-100', 'pointer-events-auto');
                                    
                                    // Auto hide after 5 seconds for registration
                                    setTimeout(() => {
                                        hideWelcomeToast();
                                    }, 5000);
                                }
                                
                                // Reload page after a short delay to show the toast
                                setTimeout(() => {
                                    window.location.reload();
                                }, 2000);
                            } else {
                                window.location.reload();
                            }
                        } else {
                            if (data.errors) {
                                showErrors(data.errors);
                            } else {
                                alert(data.message || 'Kayıt başarısız!');
                            }
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Bir hata oluştu!');
                    });
                });
            }
        });

        // Profile Modal Functions
        function openProfileModal() {
            document.getElementById('profileModal').classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }
        
        function closeProfileModal() {
            document.getElementById('profileModal').classList.add('hidden');
            document.body.style.overflow = 'auto';
        }

        // Close profile modal when clicking on backdrop
        document.addEventListener('click', function(event) {
            const profileModal = document.getElementById('profileModal');
            if (profileModal && event.target === profileModal) {
                closeProfileModal();
            }
        });
        
        // For demo purposes, clicking on profile pictures opens the modal
        document.addEventListener('DOMContentLoaded', function() {
            const profilePics = document.querySelectorAll('img[alt="Profile"]');
            profilePics.forEach(pic => {
                pic.addEventListener('click', function() {
                    openProfileModal();
                });
                pic.style.cursor = 'pointer';
            });

            // Check if we need to open login modal (from profile redirect)
            @if(session('openLoginModal'))
                openAuthModal();
                showLoginForm();
            @endif
        });
    </script>
</body>
</html>