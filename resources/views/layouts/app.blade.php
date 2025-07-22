<!DOCTYPE html>
<html lang="tr" class="transition-colors duration-300">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSettings['site_name'] ?? 'FreelancerHub' }} | {{ $siteSettings['site_tagline'] ?? 'Sosyal Forum & Freelance Platform' }}</title>
    <meta name="description" content="{{ $siteSettings['site_description'] ?? 'Freelancer ve işverenler için güvenli platform' }}">
    <meta name="keywords" content="{{ $siteSettings['site_keywords'] ?? 'freelancer, iş, proje' }}">
    <meta name="author" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    <meta property="og:description" content="{{ $siteSettings['site_description'] ?? 'Freelancer ve işverenler için güvenli platform' }}">
    <meta property="og:image" content="{{ asset($siteSettings['site_og_image'] ?? 'images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    <meta name="twitter:description" content="{{ $siteSettings['site_description'] ?? 'Freelancer ve işverenler için güvenli platform' }}">
    <meta name="twitter:image" content="{{ asset($siteSettings['site_og_image'] ?? 'images/og-image.jpg') }}">
    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset($siteSettings['site_favicon'] ?? 'logos/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset($siteSettings['site_favicon'] ?? 'logos/favicon.ico') }}">
    
    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">
    
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
            <a href="/" class="nav-item text-center flex-1 py-2">
                <i class="nav-icon fas fa-home text-blue-500 text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight text-gray-700 dark:text-gray-300">Ana Sayfa</span>
            </a>
            <a href="#" class="nav-item text-center flex-1 py-2">
                <i class="nav-icon fas fa-users text-purple-500 text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight text-gray-700 dark:text-gray-300">Topluluk</span>
            </a>
            <a href="#" class="nav-item text-center flex-1 py-2">
                <i class="nav-icon fas fa-briefcase text-green-500 text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight text-gray-700 dark:text-gray-300">Projeler</span>
            </a>
            <a href="#" class="nav-item text-center flex-1 py-2">
                <i class="nav-icon fas fa-comments text-yellow-500 text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight text-gray-700 dark:text-gray-300">Mesajlar</span>
            </a>
            <a href="#" class="nav-item text-center flex-1 py-2">
                <i class="nav-icon fas fa-user text-pink-500 text-lg block mb-1 transition-transform"></i>
                <span class="text-xs leading-tight text-gray-700 dark:text-gray-300">Profil</span>
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
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-blue-600 dark:text-blue-400 transition-colors">
                        <i class="fas fa-home w-5"></i>
                        <span>Ana Sayfa</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <i class="fas fa-users w-5"></i>
                        <span>Topluluklar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <i class="fas fa-briefcase w-5"></i>
                        <span>Projeler</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <i class="fas fa-comments w-5"></i>
                        <span>Mesajlar</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
                        <i class="fas fa-bell w-5"></i>
                        <span>Bildirimler</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
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
            
            <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 transition-colors">
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
    </main>

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
                            <label for="login-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-posta</label>
                            <input type="email" id="login-email" name="email" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-6">
                            <label for="login-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Şifre</label>
                            <input type="password" id="login-password" name="password" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
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
                    <div class="flex justify-between items-center mb-6">
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Kayıt Ol</h2>
                        <button onclick="closeAuthModal()" class="text-gray-400 dark:text-gray-500 hover:text-gray-600 dark:hover:text-gray-300 transition-colors">
                            <i class="fas fa-times text-xl"></i>
                        </button>
                    </div>
                    
                    <form id="register-form-element" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="mb-4">
                            <label for="register-name" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Ad Soyad</label>
                            <input type="text" id="register-name" name="name" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-4">
                            <label for="register-email" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">E-posta</label>
                            <input type="email" id="register-email" name="email" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-4">
                            <label for="register-birth-date" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Doğum Tarihi</label>
                            <input type="date" id="register-birth-date" name="birth_date" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-4">
                            <label for="register-password" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Şifre</label>
                            <input type="password" id="register-password" name="password" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <div class="mb-6">
                            <label for="register-password-confirmation" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Şifre Tekrar</label>
                            <input type="password" id="register-password-confirmation" name="password_confirmation" required 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 text-gray-900 dark:text-white rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-colors">
                        </div>
                        
                        <button type="submit" class="w-full bg-blue-600 dark:bg-blue-700 text-white py-2 px-4 rounded-md hover:bg-blue-700 dark:hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 font-medium transition-colors">
                            Kayıt Ol
                        </button>
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
            const registerForm = document.getElementById('register-form-element');

            if (loginForm) {
                loginForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    
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
                            window.location.reload();
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

            if (registerForm) {
                registerForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const formData = new FormData(this);
                    
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
                            window.location.reload();
                        } else {
                            alert(data.message || 'Kayıt başarısız!');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Bir hata oluştu!');
                    });
                });
            }
        });
    </script>
</body>
</html>