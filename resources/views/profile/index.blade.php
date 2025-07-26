@extends('layouts.app')

@php
    $pageTitle = isset($user) ? $user->full_name . ' - Freelancer Profili' : 'Profil';
    $pageDescription = isset($user) && $user->bio 
        ? Str::limit(strip_tags($user->bio), 155) 
        : (isset($user) ? $user->full_name . ' adlı freelancer\'ın profil sayfası. Hizmetler, portfolyo ve değerlendirmeler.' : 'Freelancer profil sayfası');
    $pageKeywords = isset($user) 
        ? $user->full_name . ', freelancer, ' . ($user->title ?? '') . ', hizmetler, portfolyo'
        : 'freelancer, profil, hizmetler';
    $profileImage = isset($user) && $user->avatar 
        ? asset('storage/' . $user->avatar) 
        : asset('images/default-avatar.jpg');
    $profileUrl = isset($user) ? route('user.profile', $user->username) : url()->current();
@endphp

@section('title', $pageTitle . ' - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@push('meta')
    <!-- SEO Meta Tags -->
    <meta name="description" content="{{ $pageDescription }}">
    <meta name="keywords" content="{{ $pageKeywords }}">
    <meta name="author" content="{{ isset($user) ? $user->full_name : '' }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ $profileUrl }}">
    
    <!-- Open Graph Meta Tags -->
    <meta property="og:title" content="{{ $pageTitle }}">
    <meta property="og:description" content="{{ $pageDescription }}">
    <meta property="og:image" content="{{ $profileImage }}">
    <meta property="og:url" content="{{ $profileUrl }}">
    <meta property="og:type" content="profile">
    <meta property="og:site_name" content="{{ $siteSettings['site_name'] ?? 'FreelancerHub' }}">
    @if(isset($user))
    <meta property="profile:first_name" content="{{ explode(' ', $user->full_name)[0] ?? '' }}">
    <meta property="profile:last_name" content="{{ explode(' ', $user->full_name)[1] ?? '' }}">
    <meta property="profile:username" content="{{ $user->username }}">
    @endif
    
    <!-- Twitter Card Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $pageTitle }}">
    <meta name="twitter:description" content="{{ $pageDescription }}">
    <meta name="twitter:image" content="{{ $profileImage }}">
    <meta name="twitter:url" content="{{ $profileUrl }}">
    
    <!-- Additional SEO Meta Tags -->
    <meta name="geo.region" content="{{ isset($user) && $user->location ? $user->location : 'TR' }}">
    <meta name="geo.placename" content="{{ isset($user) && $user->location ? $user->location : 'Türkiye' }}">
    <meta name="language" content="tr">
    <meta name="revisit-after" content="7 days">
    
    @if(isset($user))
    <!-- Structured Data (JSON-LD) -->
    <script type="application/ld+json">
    {!! json_encode([
        'context' => 'https://schema.org',
        'type' => 'Person',
        'name' => $user->full_name,
        'url' => $profileUrl,
        'image' => $profileImage,
        'description' => $pageDescription,
        'jobTitle' => $user->title ?? 'Kullanıcı',
        'worksFor' => [
            'type' => 'Organization',
            'name' => $siteSettings['site_name'] ?? 'FreelancerHub'
        ],
        'address' => $user->location ? [
            'type' => 'PostalAddress',
            'addressLocality' => $user->location
        ] : null,
        'url' => $user->website ?? null,
        'sameAs' => array_filter([
            $profileUrl,
            $user->website ?? null
        ]),
        'knowsAbout' => $user->userSkills && $user->userSkills->count() > 0 
            ? $user->userSkills->pluck('skill_name')->toArray()
            : ['Freelancing', 'Web Development', 'Design'],
        'memberOf' => [
            'type' => 'Organization',
            'name' => $siteSettings['site_name'] ?? 'FreelancerHub',
            'url' => url('/')
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    
    <!-- Breadcrumb Structured Data -->
    <script type="application/ld+json">
    {!! json_encode([
        'context' => 'https://schema.org',
        'type' => 'BreadcrumbList',
        'itemListElement' => [
            [
                'type' => 'ListItem',
                'position' => 1,
                'name' => 'Ana Sayfa',
                'item' => url('/')
            ],
            [
                'type' => 'ListItem',
                'position' => 2,
                'name' => 'Freelancerlar', 
                'item' => url('/freelancers')
            ],
            [
                'type' => 'ListItem',
                'position' => 3,
                'name' => $user->full_name,
                'item' => $profileUrl
            ]
        ]
    ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}
    </script>
    @endif
@endpush

@section('content')
<!-- SEO Breadcrumb Navigation -->
@if(isset($user))
<nav class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700" aria-label="Breadcrumb">
    <div class="container mx-auto px-4 py-3">
        <ol class="flex items-center space-x-2 text-sm" itemscope itemtype="https://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ url('/') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300" itemprop="item">
                    <span itemprop="name">Ana Sayfa</span>
                </a>
                <meta itemprop="position" content="1" />
            </li>
            <li class="text-gray-400 dark:text-gray-500">
                <i class="fas fa-chevron-right text-xs"></i>
            </li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <a href="{{ url('/freelancers') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300" itemprop="item">
                    <span itemprop="name">Freelancerlar</span>
                </a>
                <meta itemprop="position" content="2" />
            </li>
            <li class="text-gray-400 dark:text-gray-500">
                <i class="fas fa-chevron-right text-xs"></i>
            </li>
            <li itemprop="itemListElement" itemscope itemtype="https://schema.org/ListItem">
                <span class="text-gray-700 dark:text-gray-300 font-medium" itemprop="name">{{ $user->full_name }}</span>
                <meta itemprop="position" content="3" />
            </li>
        </ol>
    </div>
</nav>
@endif

<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Main Feed -->
        <div class="w-full lg:w-3/4">
            <!-- Profile Header -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm mb-6 overflow-hidden" itemscope itemtype="https://schema.org/Person">
                <!-- Cover Photo -->
                <div class="h-48 lg:h-64 bg-gradient-to-r from-blue-500 via-purple-500 to-pink-500 relative">
                    <div class="absolute inset-0 bg-black bg-opacity-20"></div>
                    @if(!isset($user) || (auth()->check() && auth()->user()->id === $user->id))
                    <button class="absolute top-4 right-4 bg-white bg-opacity-20 hover:bg-opacity-30 text-white px-3 py-1 rounded-full text-sm">
                        <i class="fas fa-camera mr-1"></i> Kapak Fotoğrafını Değiştir
                    </button>
                    @endif
                </div>
                
                <!-- Profile Info -->
                <div class="px-6 pb-6 relative">
                    <div class="flex flex-col lg:flex-row lg:items-end lg:justify-between relative z-10">
                        <div class="flex flex-col lg:flex-row lg:items-end lg:space-x-4">
                            <div class="relative -mt-16 lg:-mt-20 mb-4 lg:mb-0">
                                <img src="{{ isset($user) && $user->avatar ? asset('storage/' . $user->avatar) : 'https://randomuser.me/api/portraits/men/32.jpg' }}" 
                                     alt="{{ isset($user) ? $user->full_name . ' profil fotoğrafı' : 'Profil fotoğrafı' }}" 
                                     class="w-32 h-32 lg:w-40 lg:h-40 rounded-full border-4 border-white dark:border-gray-800 shadow-lg"
                                     itemprop="image">
                                @if(!isset($user) || (auth()->check() && auth()->user()->id === $user->id))
                                <button class="absolute bottom-2 right-2 bg-blue-500 hover:bg-blue-600 text-white w-8 h-8 rounded-full flex items-center justify-center" aria-label="Profil fotoğrafını değiştir">
                                    <i class="fas fa-camera text-sm"></i>
                                </button>
                                @endif
                                <span class="absolute bottom-4 right-4 w-6 h-6 bg-green-500 rounded-full border-2 border-white dark:border-gray-800" title="Çevrimiçi"></span>
                            </div>
                            <div class="lg:mb-4">
                                <h1 class="text-2xl lg:text-3xl font-bold text-gray-900 dark:text-white" itemprop="name">
                                    {{ isset($user) ? $user->full_name : '' }}
                                </h1>
                                @if(isset($user) && $user->title)
                                <p class="text-lg text-gray-600 dark:text-gray-300 mb-2" itemprop="jobTitle">{{ $user->title }}</p>
                                @endif
                                <div class="flex flex-wrap items-center gap-4 text-sm">
                                    @if(isset($user) && $user->location)
                                    <span class="flex items-center text-gray-500 dark:text-gray-400" itemprop="address" itemscope itemtype="https://schema.org/PostalAddress">
                                        <i class="fas fa-map-marker-alt mr-1" aria-hidden="true"></i>
                                        <span itemprop="addressLocality">{{ $user->location }}</span>
                                    </span>
                                    @endif
                                    @if(isset($user))
                                    <span class="flex items-center text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-calendar-alt mr-1" aria-hidden="true"></i>
                                        <time datetime="{{ $user->created_at->format('Y-m-d') }}">
                                            {{ \Carbon\Carbon::parse($user->created_at)->locale('tr')->translatedFormat('F Y') }}'ten beri
                                        </time>
                                    </span>
                                    @endif
                                    @if(isset($user) && $user->last_seen)
                                    <span class="flex items-center order-3 lg:order-none">
                                        <i class="fas fa-clock mr-1" aria-hidden="true"></i>
                                        Son görülme: <time datetime="{{ $user->last_seen->toISOString() }}">{{ $user->last_seen->diffForHumans() }}</time>
                                    </span>
                                    @endif
                                    @if(isset($user) && $user->website)
                                    <a href="{{ $user->website }}" target="_blank" rel="noopener noreferrer" class="hidden lg:flex items-center text-gray-500 dark:text-gray-400 hover:text-blue-500 dark:hover:text-blue-400 transition-colors order-4" itemprop="url">
                                        <i class="fas fa-globe mr-1" aria-hidden="true"></i>
                                        {{ $user->website }}
                                    </a>
                                    @endif
                                    <a href="{{ isset($user) && $user->website ? $user->website : '#' }}" target="_blank" rel="noopener noreferrer" class="flex items-center text-blue-500 dark:text-blue-400 lg:hidden hover:text-blue-600 dark:hover:text-blue-300 transition-colors order-4">
                                        <i class="fas fa-globe mr-1" aria-hidden="true"></i>
                                        {{ isset($user) && $user->website ? $user->website : 'Website yok' }}
                                    </a>
                                </div> 
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 mt-4 lg:mt-0">
                            @if(isset($user) && auth()->check() && auth()->user()->id !== $user->id)
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-medium">
                                <i class="fas fa-user-plus mr-2"></i>Takip Et
                            </button>
                            <button class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-full font-medium">
                                <i class="fas fa-envelope mr-2"></i>Mesaj Gönder
                            </button>
                            @elseif(!isset($user) || (auth()->check() && auth()->user()->id === $user->id))
                            <button class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-full font-medium">
                                <i class="fas fa-edit mr-2"></i>Profili Düzenle
                            </button>
                            @endif
                            <button class="border border-gray-300 dark:border-gray-600 hover:bg-gray-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-300 px-4 py-2 rounded-full">
                                <i class="fas fa-ellipsis-h"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Stats -->
                    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mt-6 pt-6 border-t border-gray-200 dark:border-gray-700" itemscope itemtype="https://schema.org/Person">
                        <div class="text-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                            <meta itemprop="interactionType" content="https://schema.org/CreateAction" />
                            <p class="text-2xl font-bold text-gray-900 dark:text-white" itemprop="userInteractionCount">247</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Gönderi</p>
                        </div>
                        <div class="text-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                            <meta itemprop="interactionType" content="https://schema.org/FollowAction" />
                            <p class="text-2xl font-bold text-gray-900 dark:text-white" itemprop="userInteractionCount">1.2K</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Takipçi</p>
                        </div>
                        <div class="text-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                            <meta itemprop="interactionType" content="https://schema.org/SubscribeAction" />
                            <p class="text-2xl font-bold text-gray-900 dark:text-white" itemprop="userInteractionCount">89</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Takip</p>
                        </div>
                        <div class="text-center" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                            <p class="text-2xl font-bold text-blue-600 dark:text-blue-400" itemprop="ratingValue">4.9</p>
                            <p class="text-sm text-gray-500 dark:text-gray-400">Puan</p>
                            <meta itemprop="bestRating" content="5" />
                            <meta itemprop="worstRating" content="1" />
                            <meta itemprop="ratingCount" content="{{ isset($user) && $user->total_reviews ? $user->total_reviews : '0' }}" />
                        </div>
                        <div class="text-center">
                            <p class="text-2xl font-bold text-green-600 dark:text-green-400" itemprop="numberOfEmployees">48</p>
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
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6" itemscope itemtype="https://schema.org/Person">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Hakkımda</h2>
                    @auth
                        @if(auth()->user()->username === $user->username)
                            <button onclick="openSkillsModal()" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium flex items-center" aria-label="Biyografiyi düzenle">
                                <i class="fas fa-edit mr-1" aria-hidden="true"></i>
                                Düzenle
                            </button>
                        @endif
                    @endauth
                </div>
                <div class="text-gray-700 dark:text-gray-300 mb-4 leading-relaxed" data-bio-display itemprop="description">
                    {{ isset($user) && $user->bio ? $user->bio : 'Henüz bir biyografi eklenmemiş.' }}
                </div>
                
                @php
                    $aboutSkills = $user->skills()->orderBy('sort_order')->get();
                    $aboutExpertise = $aboutSkills->where('type', 'expertise');
                    $aboutTools = $aboutSkills->where('type', 'tool');
                    $allAboutSkills = $aboutExpertise->merge($aboutTools);
                    
                    // 6 farklı renk paleti
                    $colors = [
                        'bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300',
                        'bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300',
                        'bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300',
                        'bg-yellow-100 text-yellow-700 dark:bg-yellow-900 dark:text-yellow-300',
                        'bg-red-100 text-red-700 dark:bg-red-900 dark:text-red-300',
                        'bg-indigo-100 text-indigo-700 dark:bg-indigo-900 dark:text-indigo-300'
                    ];
                @endphp
                
                @if($allAboutSkills->count() > 0)
                    <div class="flex flex-wrap gap-2">
                        @foreach($allAboutSkills as $index => $skill)
                            <span class="px-3 py-1 {{ $colors[$index % 6] }} rounded-full text-sm font-medium">
                                {{ $skill->name }}
                            </span>
                        @endforeach
                    </div>
                @endif
                
                @if(isset($user) && $user->bio)
                <meta itemprop="knowsAbout" content="{{ strip_tags($user->bio) }}" />
                @endif
            </div>
            
            <!-- Services Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Hizmetlerim</h2>
                    <a href="{{ url('/services') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium" aria-label="Tüm hizmetleri görüntüle">
                        Tümünü Gör
                    </a>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <article class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow bg-white dark:bg-gray-800" itemscope itemtype="https://schema.org/Service">
                        <div class="flex items-start space-x-3">
                            <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-code text-blue-600 dark:text-blue-400" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-1" itemprop="name">Full Stack Web Geliştirme</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2" itemprop="description">Modern teknolojilerle responsive web uygulamaları</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                        <span itemprop="price">2500</span>
                                        <span itemprop="priceCurrency" content="TRY">₺</span>+
                                        <meta itemprop="availability" content="https://schema.org/InStock" />
                                    </span>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                                        <i class="fas fa-star text-yellow-400 mr-1" aria-hidden="true"></i>
                                        <span><span itemprop="ratingValue">4.9</span> (<span itemprop="reviewCount">23</span>)</span>
                                        <meta itemprop="bestRating" content="5" />
                                        <meta itemprop="worstRating" content="1" />
                                    </div>
                                </div>
                                <meta itemprop="serviceType" content="Web Development" />
                                <meta itemprop="category" content="Technology" />
                            </div>
                        </div>
                    </article>
                    <article class="border border-gray-200 dark:border-gray-700 rounded-lg p-4 hover:shadow-md transition-shadow bg-white dark:bg-gray-800" itemscope itemtype="https://schema.org/Service">
                        <div class="flex items-start space-x-3">
                            <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-mobile-alt text-purple-600 dark:text-purple-400" aria-hidden="true"></i>
                            </div>
                            <div class="flex-1">
                                <h3 class="font-semibold text-gray-900 dark:text-white mb-1" itemprop="name">React Native Mobil Uygulama</h3>
                                <p class="text-sm text-gray-600 dark:text-gray-300 mb-2" itemprop="description">iOS ve Android için cross-platform uygulamalar</p>
                                <div class="flex items-center justify-between">
                                    <span class="text-lg font-bold text-green-600 dark:text-green-400" itemprop="offers" itemscope itemtype="https://schema.org/Offer">
                                        <span itemprop="price">3500</span>
                                        <span itemprop="priceCurrency" content="TRY">₺</span>+
                                        <meta itemprop="availability" content="https://schema.org/InStock" />
                                    </span>
                                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
                                        <i class="fas fa-star text-yellow-400 mr-1" aria-hidden="true"></i>
                                        <span><span itemprop="ratingValue">5.0</span> (<span itemprop="reviewCount">12</span>)</span>
                                        <meta itemprop="bestRating" content="5" />
                                        <meta itemprop="worstRating" content="1" />
                                    </div>
                                </div>
                                <meta itemprop="serviceType" content="Mobile App Development" />
                                <meta itemprop="category" content="Technology" />
                            </div>
                        </div>
                    </article>
                </div>
            </div>
            
            <!-- Portfolio Section -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Portfolyo</h2>
                    <a href="{{ url('/portfolio') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium" aria-label="Tüm portfolyo projelerini görüntüle">
                        Tümünü Gör
                    </a>
                </div>
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                    <article class="group cursor-pointer" itemscope itemtype="https://schema.org/CreativeWork">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="https://images.unsplash.com/photo-1460925895917-afdab827c52f?w=400&h=250&fit=crop" 
                                 alt="E-Ticaret Platformu projesi ekran görüntüsü" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                 itemprop="image">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300"></div>
                            <div class="absolute top-3 right-3 bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Tamamlandı
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-1" itemprop="name">E-Ticaret Platformu</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2" itemprop="description">React, Node.js ve MongoDB kullanılarak geliştirilmiş modern e-ticaret sitesi</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded text-xs" itemprop="keywords">React</span>
                                <span class="px-2 py-1 bg-green-100 dark:bg-green-900 text-green-600 dark:text-green-300 rounded text-xs" itemprop="keywords">Node.js</span>
                            </div>
                            <time class="text-sm text-gray-500 dark:text-gray-400" datetime="2024" itemprop="dateCreated">2024</time>
                        </div>
                        <meta itemprop="genre" content="Web Development" />
                        <meta itemprop="inLanguage" content="tr-TR" />
                        <meta itemprop="creator" content="{{ isset($user) ? $user->full_name : '' }}" />
                    </article>
                    <article class="group cursor-pointer" itemscope itemtype="https://schema.org/CreativeWork">
                        <div class="relative overflow-hidden rounded-lg mb-3">
                            <img src="https://images.unsplash.com/photo-1551650975-87deedd944c3?w=400&h=250&fit=crop" 
                                 alt="Mobil Bankacılık Uygulaması projesi ekran görüntüsü" 
                                 class="w-full h-48 object-cover group-hover:scale-105 transition-transform duration-300"
                                 itemprop="image">
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-20 transition-opacity duration-300"></div>
                            <div class="absolute top-3 right-3 bg-blue-500 text-white px-2 py-1 rounded-full text-xs font-medium">
                                Devam Ediyor
                            </div>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-1" itemprop="name">Mobil Bankacılık Uygulaması</h3>
                        <p class="text-sm text-gray-600 dark:text-gray-300 mb-2" itemprop="description">React Native ile geliştirilmiş güvenli mobil bankacılık uygulaması</p>
                        <div class="flex items-center justify-between">
                            <div class="flex space-x-2">
                                <span class="px-2 py-1 bg-purple-100 dark:bg-purple-900 text-purple-600 dark:text-purple-300 rounded text-xs" itemprop="keywords">React Native</span>
                                <span class="px-2 py-1 bg-red-100 dark:bg-red-900 text-red-600 dark:text-red-300 rounded text-xs" itemprop="keywords">Firebase</span>
                            </div>
                            <time class="text-sm text-gray-500 dark:text-gray-400" datetime="2024" itemprop="dateCreated">2024</time>
                        </div>
                        <meta itemprop="genre" content="Mobile App Development" />
                        <meta itemprop="inLanguage" content="tr-TR" />
                        <meta itemprop="creator" content="{{ isset($user) ? $user->full_name : '' }}" />
                    </article>
                </div>
            </div>
            
            <!-- Recent Posts -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-xl font-bold text-gray-900 dark:text-white">Son Gönderiler</h2>
                    <a href="{{ url('/posts') }}" class="text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 text-sm font-medium" aria-label="Tüm gönderileri görüntüle">
                        Tümünü Gör
                    </a>
                </div>
                <div class="space-y-4">
                    <article class="border-l-4 border-blue-500 pl-4" itemscope itemtype="https://schema.org/BlogPosting">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-1">
                            <time datetime="2024-01-15" itemprop="datePublished">2 gün önce</time>
                            <span>•</span>
                            <span itemprop="articleSection">Web Geliştirme</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2" itemprop="headline">React 18'in Yeni Özellikleri</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm" itemprop="description">React 18 ile gelen concurrent features ve automatic batching özelliklerini inceliyoruz...</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                <meta itemprop="interactionType" content="https://schema.org/LikeAction" />
                                <meta itemprop="userInteractionCount" content="24" />
                                <i class="fas fa-heart mr-1 text-red-500"></i>
                                24
                            </span>
                            <span class="flex items-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                <meta itemprop="interactionType" content="https://schema.org/CommentAction" />
                                <meta itemprop="userInteractionCount" content="8" />
                                <i class="fas fa-comment mr-1"></i>
                                8
                            </span>
                            <span class="flex items-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                <meta itemprop="interactionType" content="https://schema.org/ShareAction" />
                                <meta itemprop="userInteractionCount" content="3" />
                                <i class="fas fa-share mr-1"></i>
                                3
                            </span>
                        </div>
                        <meta itemprop="author" content="{{ isset($user) ? $user->full_name : '' }}" />
                        <meta itemprop="publisher" content="Freelancer Platform" />
                        <meta itemprop="inLanguage" content="tr-TR" />
                        <meta itemprop="keywords" content="React, JavaScript, Web Development, Frontend" />
                    </article>
                    <article class="border-l-4 border-green-500 pl-4" itemscope itemtype="https://schema.org/BlogPosting">
                        <div class="flex items-center space-x-2 text-sm text-gray-500 dark:text-gray-400 mb-1">
                            <time datetime="2024-01-08" itemprop="datePublished">1 hafta önce</time>
                            <span>•</span>
                            <span itemprop="articleSection">Freelance</span>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-2" itemprop="headline">Freelance Çalışmanın Püf Noktaları</h3>
                        <p class="text-gray-600 dark:text-gray-300 text-sm" itemprop="description">10 yıllık freelance deneyimimden öğrendiğim en önemli ipuçlarını paylaşıyorum...</p>
                        <div class="flex items-center space-x-4 mt-2 text-sm text-gray-500 dark:text-gray-400">
                            <span class="flex items-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                <meta itemprop="interactionType" content="https://schema.org/LikeAction" />
                                <meta itemprop="userInteractionCount" content="42" />
                                <i class="fas fa-heart mr-1 text-red-500"></i>
                                42
                            </span>
                            <span class="flex items-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                <meta itemprop="interactionType" content="https://schema.org/CommentAction" />
                                <meta itemprop="userInteractionCount" content="15" />
                                <i class="fas fa-comment mr-1"></i>
                                15
                            </span>
                            <span class="flex items-center" itemprop="interactionStatistic" itemscope itemtype="https://schema.org/InteractionCounter">
                                <meta itemprop="interactionType" content="https://schema.org/ShareAction" />
                                <meta itemprop="userInteractionCount" content="7" />
                                <i class="fas fa-share mr-1"></i>
                                7
                            </span>
                        </div>
                        <meta itemprop="author" content="{{ isset($user) ? $user->full_name : '' }}" />
                        <meta itemprop="publisher" content="Freelancer Platform" />
                        <meta itemprop="inLanguage" content="tr-TR" />
                        <meta itemprop="keywords" content="Freelance, İş, Kariyer, Uzaktan Çalışma" />
                    </article>
                </div>
            </div>
        </div>
        
        <!-- Right Sidebar (Mobile Hidden) -->
        <div class="hidden lg:block lg:w-1/4">
            <!-- Trade Score & Verification -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4" itemscope itemtype="https://schema.org/Organization">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Ticaret Puanı & Doğrulama</h3>
                <div class="text-center mb-4" itemscope itemtype="https://schema.org/AggregateRating">
                    <div class="w-20 h-20 mx-auto bg-gradient-to-r from-green-400 to-green-600 rounded-full flex items-center justify-center mb-2">
                        <span class="text-2xl font-bold text-white" itemprop="ratingValue">4.9</span>
                    </div>
                    <p class="text-sm text-gray-600 dark:text-gray-300">Mükemmel Satıcı</p>
                    <div class="flex justify-center mt-2">
                        <div class="flex space-x-1" itemprop="ratingValue" content="4.9">
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                            <i class="fas fa-star text-yellow-400"></i>
                        </div>
                    </div>
                    <meta itemprop="bestRating" content="5" />
                    <meta itemprop="worstRating" content="1" />
                    <meta itemprop="reviewCount" content="150" />
                </div>
                <div class="space-y-2">
                    @if ($user->tc_verified)
                        <div class="flex items-center justify-between text-sm" itemprop="hasCredential" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
                            <span class="flex items-center text-gray-700 dark:text-gray-300">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span itemprop="credentialCategory">Kimlik Doğrulandı</span>
                            </span>
                            <i class="fas fa-shield-alt text-green-500"></i>
                            <meta itemprop="recognizedBy" content="Freelancer Platform" />
                        </div>
                    @else
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                Kimlik Doğrulanmadı
                            </span>
                            @if (auth()->id() === $user->id)
                                <button id="verify-identity-btn" class="text-blue-500 hover:underline">Doğrula</button>
                            @endif
                        </div>
                    @endif

                    @if ($user->email_verified_at)
                        <div class="flex items-center justify-between text-sm" itemprop="hasCredential" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
                            <span class="flex items-center text-gray-700 dark:text-gray-300">
                                <i class="fas fa-check-circle text-green-500 mr-2"></i>
                                <span itemprop="credentialCategory">E-posta Doğrulandı</span>
                            </span>
                            <i class="fas fa-envelope text-green-500"></i>
                            <meta itemprop="recognizedBy" content="Freelancer Platform" />
                        </div>
                    @else
                        <div class="flex items-center justify-between text-sm">
                            <span class="flex items-center text-gray-500 dark:text-gray-400">
                                <i class="fas fa-times-circle text-red-500 mr-2"></i>
                                E-posta Doğrulanmadı
                            </span>
                        </div>
                    @endif

                    {{-- Telefon doğrulama statik kalabilir veya dinamikleştirilebilir --}}
                    <div class="flex items-center justify-between text-sm" itemprop="hasCredential" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
                        <span class="flex items-center text-gray-700 dark:text-gray-300">
                            <i class="fas fa-check-circle text-green-500 mr-2"></i>
                            <span itemprop="credentialCategory">Telefon Doğrulandı</span>
                        </span>
                        <i class="fas fa-phone text-green-500"></i>
                        <meta itemprop="recognizedBy" content="Freelancer Platform" />
                    </div>
                </div>
                <meta itemprop="name" content="{{ isset($user) ? $user->full_name : '' }}" />
                <meta itemprop="url" content="{{ url()->current() }}" />
            </div>
            
            <!-- Education & Certifications -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Eğitim & Sertifikalar</h3>
                    @auth
                        @if(Auth::user()->username === $user->username)
                            <button onclick="openAddEducationModal()" 
                                    class="inline-flex items-center px-3 py-1.5 border border-transparent text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition-colors duration-200">
                                <i class="fas fa-plus mr-1"></i>
                                Ekle/Düzenle
                            </button>
                        @endif
                    @endauth
                </div>
                
                @if($user->educations && $user->educations->count() > 0)
                    <div class="space-y-3">
                        @foreach($user->educations->take(3) as $education)
                            <div class="border-l-4 border-blue-500 pl-3" itemscope itemtype="https://schema.org/EducationalOccupationalCredential">
                                <div class="flex items-center justify-between">
                                    <h4 class="font-medium text-gray-900 dark:text-white" itemprop="name">{{ $education->education_name }}</h4>
                                    @if($education->link_access == 1)
                                        <i class="fas fa-check-circle text-green-500" title="Onaylandı"></i>
                                        <meta itemprop="credentialStatus" content="Verified" />
                                    @elseif($education->link_access == 0)
                                        <i class="fas fa-clock text-yellow-500" title="Onay bekliyor"></i>
                                        <meta itemprop="credentialStatus" content="Pending" />
                                    @elseif($education->link_access == 2)
                                        <i class="fas fa-times-circle text-red-500" title="Reddedildi"></i>
                                        <meta itemprop="credentialStatus" content="Rejected" />
                                    @endif
                                </div>
                                <p class="text-sm text-gray-600 dark:text-gray-300" itemprop="recognizedBy">{{ $education->institution }}</p>
                                <div class="flex items-center justify-between">
                                    <p class="text-xs text-gray-500 dark:text-gray-400">
                                        <time itemprop="validFrom" datetime="{{ $education->start_year }}">{{ $education->start_year }}</time>{{ $education->end_year ? ' - ' : ' - Devam Ediyor' }}<time itemprop="validThrough" datetime="{{ $education->end_year }}">{{ $education->end_year }}</time>
                                    </p>
                                    @if($education->document_link && ($education->link_access == 1 || $education->link_access == 0))
                                        <a href="{{ $education->document_link }}" target="_blank" 
                                           class="text-xs text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300"
                                           itemprop="url">
                                            Belgeyi Gör
                                            @if($education->link_access == 0)
                                                <span class="text-yellow-500">(Onay Bekliyor)</span>
                                            @endif
                                        </a>
                                    @endif
                                </div>
                                <meta itemprop="credentialCategory" content="Education" />
                                <meta itemprop="competencyRequired" content="{{ $education->education_name }}" />
                            </div>
                        @endforeach
                    </div>
                    
                    @if($user->educations->count() > 3)
                        <button onclick="openEducationModal()" 
                                class="w-full mt-3 text-center text-blue-500 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300">
                            Tümünü Gör ({{ $user->educations->count() }} eğitim)
                        </button>
                    @endif
                @else
                    <div class="text-center py-4">
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Henüz eğitim bilgisi eklenmemiş.</p>
                    </div>
                @endif
            </div>
            
            <!-- Expertise & Tools -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <div class="flex justify-between items-center mb-3">
                    <h3 class="font-semibold text-lg text-gray-900 dark:text-white">Uzmanlık Alanları ve Araçlar</h3>
                    @auth
                        @if(auth()->user()->id === $user->id)
                            <button onclick="openSkillModal()" class="text-sm font-medium text-blue-600 hover:text-blue-800 dark:text-blue-400 dark:hover:text-blue-300">Düzenle</button>
                        @endif
                    @endauth
                </div>

                @php
                    $userSkills = $user->skills()->orderBy('sort_order')->get();
                    $expertise = $userSkills->where('type', 'expertise');
                    $tools = $userSkills->where('type', 'tool');
                @endphp

                @if($expertise->count() > 0)
                    <div id="expertise-list" class="space-y-3 mb-4">
                        @foreach($expertise->take(5) as $skill)
                            <div>
                                <div class="flex justify-between text-sm mb-1">
                                    <span class="text-gray-700 dark:text-gray-300">{{ $skill->name }}</span>
                                    <span class="font-medium text-gray-900 dark:text-white">{{ $skill->level }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-2">
                                    <div class="bg-blue-500 h-2 rounded-full" style="width: {{ $skill->level }}%"></div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div id="expertise-list" class="space-y-3 mb-4 hidden">
                        <!-- Expertise skills will be dynamically loaded here -->
                    </div>
                @endif

                @if($tools->count() > 0)
                    <div id="tools-list">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Kullandığı Araçlar</h4>
                        <div id="tool-tags" class="flex flex-wrap gap-2">
                            @foreach($tools->take(6) as $tool)
                                <span class="px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 rounded text-xs">{{ $tool->name }}</span>
                            @endforeach
                        </div>
                    </div>
                @else
                    <div id="tools-list" class="hidden">
                        <h4 class="font-medium text-gray-900 dark:text-white mb-2">Kullandığı Araçlar</h4>
                        <div id="tool-tags" class="flex flex-wrap gap-2">
                            <!-- Tool skills will be dynamically loaded here -->
                        </div>
                    </div>
                @endif

                @if($expertise->count() === 0 && $tools->count() === 0)
                    <div id="no-skills-message" class="text-center py-4">
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Henüz uzmanlık alanı veya araç eklenmemiş.</p>
                    </div>
                @else
                    <div id="no-skills-message" class="text-center py-4 hidden">
                        <p class="text-gray-500 dark:text-gray-400 text-sm">Henüz uzmanlık alanı veya araç eklenmemiş.</p>
                    </div>
                @endif

                @if($expertise->count() > 5 || $tools->count() > 6)
                    <button id="view-all-skills-btn" onclick="openSkillModal()" class="w-full mt-3 text-center text-blue-500 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300">
                        Tümünü Gör ({{ $expertise->count() + $tools->count() }} beceri)
                    </button>
                @else
                    <button id="view-all-skills-btn" onclick="openSkillModal()" class="w-full mt-3 text-center text-blue-500 dark:text-blue-400 text-sm font-medium hover:text-blue-700 dark:hover:text-blue-300 hidden">
                        Tümünü Gör
                    </button>
                @endif
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

<!-- Skills Modal -->
<div id="skillModal" role="dialog" aria-modal="true" aria-labelledby="skill-modal-title" class="relative z-50 hidden">
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity ease-in-out duration-500 opacity-0" id="skillBackdrop"></div>
    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <div class="pointer-events-auto relative w-screen max-w-2xl transform transition ease-in-out duration-500 sm:duration-700 translate-x-full" id="skillPanel">
                    <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                        <button type="button" onclick="closeSkillModal()" class="relative rounded-md text-red-500 hover:text-red-700 focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:outline-hidden">
                            <span class="sr-only">Paneli kapat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>
                    <div class="flex h-full flex-col overflow-y-auto bg-white dark:bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <h2 id="skill-modal-title" class="text-base font-semibold text-gray-900 dark:text-white">
                                <i class="fas fa-cogs mr-2"></i>
                                Uzmanlık Alanları ve Araçları Yönet
                            </h2>
                        </div>
                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            <div id="skill-success-message" class="hidden mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 rounded-md"></div>
                            <div id="skill-error-message" class="hidden mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 rounded-md"></div>
                            
                            <!-- Add Skill Form - Only for own profile -->
                            <form id="addSkillForm" class="space-y-4 mb-6" style="display: none;">
                                @csrf
                                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div class="md:col-span-2">
                                        <label for="skill_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Beceri Adı</label>
                                        <input type="text" id="skill_name" name="skill_name" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white" placeholder="Örn: Laravel, Photoshop">
                                        <div id="skill_suggestions" class="absolute z-10 w-full bg-white dark:bg-gray-700 border border-gray-300 dark:border-gray-600 rounded-md mt-1 hidden"></div>
                                    </div>
                                    <div>
                                        <label for="skill_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Türü</label>
                                        <select id="skill_type" name="skill_type" class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm dark:bg-gray-700 dark:text-white">
                                            <option value="expertise">Uzmanlık Alanı</option>
                                            <option value="tool">Araç</option>
                                        </select>
                                    </div>
                                </div>
                                <div id="expertise_level_container">
                                    <label for="skill_level" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Seviye</label>
                                    <input type="range" id="skill_level" name="level" min="1" max="100" value="50" class="w-full h-2 bg-gray-200 rounded-lg appearance-none cursor-pointer dark:bg-gray-700">
                                    <div class="text-center text-sm text-gray-500 dark:text-gray-400 mt-1"><span id="skill_level_value">50</span>%</div>
                                </div>
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">Kaydet</button>
                            </form>
                            
                            <!-- Save Order Button - Only for own profile -->
                            <div id="saveOrderContainer" class="mb-6" style="display: none;">
                                <button id="saveOrderBtn" class="w-full bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700 disabled:opacity-50" disabled>
                                    <i class="fas fa-save mr-2"></i>Sırayı Kaydet
                                </button>
                            </div>

                            <!-- Current Skills -->
                            <div class="space-y-4">
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Uzmanlık Alanları</h3>
                                    <ul id="modal-expertise-list" class="mt-2 space-y-2"></ul>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-900 dark:text-white">Araçlar</h3>
                                    <ul id="modal-tools-list" class="mt-2 space-y-2"></ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Education Modal -->
<div id="addEducationModal" role="dialog" aria-modal="true" aria-labelledby="add-education-modal-title" class="relative z-50 hidden">
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity ease-in-out duration-500 opacity-0" id="addEducationBackdrop"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Slide-over panel -->
                <div class="pointer-events-auto relative w-screen max-w-lg transform transition ease-in-out duration-500 sm:duration-700 translate-x-full" id="addEducationPanel">
                    <!-- Close button -->
                    <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                        <button type="button" onclick="closeAddEducationModal()" class="relative rounded-md text-red-500 hover:text-red-700 focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:outline-hidden">
                            <span class="absolute -inset-2.5"></span>
                            <span class="sr-only">Paneli kapat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex h-full flex-col overflow-y-auto bg-white dark:bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <h2 id="add-education-modal-title" class="text-base font-semibold text-gray-900 dark:text-white">
                                <i class="fas fa-graduation-cap mr-2"></i>
                                Eğitim & Sertifika Ekle
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                Eğitim bilgilerinizi ve sertifikalarınızı ekleyin
                            </p>
                        </div>
                        
                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            <!-- Success Message -->
                            <div id="successMessage" class="hidden mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 rounded-md">
                                <div class="flex">
                                    <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                                    <span>Eğitim bilgisi başarıyla eklendi!</span>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <div id="errorMessage" class="hidden mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 rounded-md">
                                <div class="flex">
                                    <i class="fas fa-exclamation-triangle mr-2 mt-0.5"></i>
                                    <span id="errorText">Bir hata oluştu!</span>
                                </div>
                            </div>

                            <!-- Form -->
                            <form id="addEducationForm" class="space-y-6">
                                @csrf
                                
                                <!-- Education Name -->
                                <div>
                                    <label for="education_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Eğitim/Sertifika Adı <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="education_name" 
                                           name="education_name" 
                                           required
                                           maxlength="255"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="Örn: Bilgisayar Mühendisliği, AWS Certified Developer">
                                </div>

                                <!-- Institution -->
                                <div>
                                    <label for="institution" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Kurum/Okul <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="institution" 
                                           name="institution" 
                                           required
                                           maxlength="255"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="Örn: İstanbul Teknik Üniversitesi, Udemy">
                                </div>

                                <!-- Start Year -->
                                <div>
                                    <label for="start_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Başlangıç Yılı <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" 
                                           id="start_year" 
                                           name="start_year" 
                                           required
                                           min="1950"
                                           max="2030"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="2020">
                                </div>

                                <!-- End Year -->
                                <div>
                                    <label for="end_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Bitiş Yılı
                                    </label>
                                    <input type="number" 
                                           id="end_year" 
                                           name="end_year" 
                                           min="1950"
                                           max="2030"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="2024 (Boş bırakabilirsiniz)">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        Eğer hala devam ediyorsa boş bırakın
                                    </p>
                                </div>

                                <!-- Document Link -->
                                <div>
                                    <label for="document_link" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Belge Linki
                                    </label>
                                    <input type="url" 
                                           id="document_link" 
                                           name="document_link" 
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="https://example.com/certificate.pdf">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Belge linki onaylanana kadar "Onaylanıyor..." görünür
                                    </p>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <button type="submit" 
                                            id="submitBtn"
                                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                                        <span id="submitText">
                                            <i class="fas fa-plus mr-2"></i>
                                            Eğitim Ekle
                                        </span>
                                        <span id="loadingText" class="hidden">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Ekleniyor...
                                        </span>
                                    </button>
                                </div>
                            </form>

                            <!-- Existing Educations List -->
                            @if($user->educations && $user->educations->count() > 0)
                                <div class="mt-8 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-sm font-medium text-gray-900 dark:text-white">
                                            <i class="fas fa-list mr-2"></i>
                                            Mevcut Eğitimler
                                            <span class="text-xs text-gray-500 ml-2">(Sürükleyerek sıralayabilirsiniz)</span>
                                        </h3>
                                        <button id="saveSortOrderBtn" onclick="saveSortOrder()" 
                                                class="hidden px-3 py-1 text-xs font-medium text-white bg-blue-600 hover:bg-blue-700 rounded-md transition-colors duration-200">
                                            <i class="fas fa-save mr-1"></i>
                                            Sırayı Kaydet
                                        </button>
                                    </div>
                                    <div id="educationList" class="space-y-3">
                                        @foreach($user->educations as $education)
                                            <div class="education-item flex items-center justify-between p-3 bg-gray-50 dark:bg-gray-700 rounded-lg cursor-move" 
                                                 data-id="<?= $education->id ?>" 
                                                 draggable="true">
                                                <div class="flex items-center">
                                                    <div class="drag-handle mr-3 text-gray-400 hover:text-gray-600 dark:text-gray-500 dark:hover:text-gray-300">
                                                        <i class="fas fa-grip-vertical"></i>
                                                    </div>
                                                    <div class="flex-1">
                                                        <div class="flex items-center justify-between">
                                                            <p class="text-sm font-medium text-gray-900 dark:text-white">
                                                                {{ $education->education_name }}
                                                            </p>
                                                            @if($education->link_access == 1)
                                                                <i class="fas fa-check-circle text-green-500 ml-2" title="Onaylandı"></i>
                                                            @elseif($education->link_access == 0)
                                                                <i class="fas fa-clock text-yellow-500 ml-2" title="Onay bekliyor"></i>
                                                            @elseif($education->link_access == 2)
                                                                <i class="fas fa-times-circle text-red-500 ml-2" title="Reddedildi"></i>
                                                            @endif
                                                        </div>
                                                        <p class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $education->institution }} • {{ $education->start_year }}{{ $education->end_year ? ' - ' . $education->end_year : ' - Devam Ediyor' }}
                                                        </p>
                                                        @if($education->document_link && $education->link_access == 1)
                                                            <div class="mt-1">
                                                                <a href="{{ $education->document_link }}" target="_blank" class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 hover:bg-green-200 dark:hover:bg-green-800">
                                                                    <i class="fas fa-external-link-alt mr-1"></i>
                                                                    Belgeyi Gör
                                                                </a>
                                                            </div>
                                                        @elseif($education->link_access == 0)
                                                            <div class="mt-1">
                                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                                                    <i class="fas fa-clock mr-1"></i>
                                                                    Onay bekliyor
                                                                </span>
                                                            </div>
                                                        @elseif($education->link_access == 2)
                                                            <div class="mt-1">
                                                                <span class="inline-flex items-center px-2 py-1 rounded-full text-xs font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                                    <i class="fas fa-times mr-1"></i>
                                                                    Reddedildi
                                                                </span>
                                                            </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="flex items-center space-x-2">
                                                    <button onclick="editEducation(<?= $education->id ?>)" 
                                                            class="text-blue-500 hover:text-blue-700 dark:text-blue-400 dark:hover:text-blue-300">
                                                        <i class="fas fa-edit text-sm"></i>
                                                    </button>
                                                    <button onclick="deleteEducation(<?= $education->id ?>)" 
                                                            class="text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300">
                                                        <i class="fas fa-trash text-sm"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Education Modal -->
<div id="educationModal" role="dialog" aria-modal="true" aria-labelledby="education-modal-title" class="relative z-50 hidden">
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity ease-in-out duration-500 opacity-0" id="educationBackdrop"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Slide-over panel -->
                <div class="pointer-events-auto relative w-screen max-w-md transform transition ease-in-out duration-500 sm:duration-700 translate-x-full" id="educationPanel">
                    <!-- Close button -->
                    <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                        <button type="button" onclick="closeEducationModal()" class="relative rounded-md text-red-500 hover:text-red-700 focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:outline-hidden">
                            <span class="absolute -inset-2.5"></span>
                            <span class="sr-only">Paneli kapat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex h-full flex-col overflow-y-auto bg-white dark:bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <h2 id="education-modal-title" class="text-base font-semibold text-gray-900 dark:text-white">
                                {{ $user->first_name }} {{ $user->last_name }} - Eğitim & Sertifikalar
                            </h2>
                        </div>
                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            @if($user->educations && $user->educations->count() > 0)
                                <!-- Education Table -->
                                <div class="overflow-hidden bg-white dark:bg-gray-800 shadow rounded-lg">
                                    <div class="px-4 py-5 sm:p-6">
                                        <div class="space-y-6">
                                            @foreach($user->educations as $index => $education)
                                                <div class="border-b border-gray-200 dark:border-gray-700 pb-6 {{ $loop->last ? 'border-b-0 pb-0' : '' }}">
                                                    <div class="flex items-start space-x-4">
                                                        <div class="flex-shrink-0">
                                                            <div class="w-10 h-10 bg-gradient-to-r from-blue-500 to-purple-600 rounded-full flex items-center justify-center">
                                                                <span class="text-white font-bold text-sm">{{ $index + 1 }}</span>
                                                            </div>
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <div class="flex items-center justify-between">
                                                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                                    {{ $education->education_name }}
                                                                </h3>
                                                                @if($education->link_access == 1)
                                                                    <i class="fas fa-check-circle text-green-500 text-lg" title="Onaylandı"></i>
                                                                @elseif($education->link_access == 0)
                                                                    <i class="fas fa-clock text-yellow-500 text-lg" title="Onay bekliyor"></i>
                                                                @elseif($education->link_access == 2)
                                                                    <i class="fas fa-times-circle text-red-500 text-lg" title="Reddedildi"></i>
                                                                @endif
                                                            </div>
                                                            <p class="text-sm text-gray-600 dark:text-gray-300 mt-1">
                                                                <i class="fas fa-university mr-2"></i>
                                                                {{ $education->institution }}
                                                            </p>
                                                            <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                                                                <i class="fas fa-calendar mr-2"></i>
                                                                {{ $education->start_year }}{{ $education->end_year ? ' - ' . $education->end_year : ' - Devam Ediyor' }}
                                                            </p>
                                                            @if($education->document_link && ($education->link_access == 1 || $education->link_access == 0))
                                                                <div class="mt-3">
                                                                    <a href="{{ $education->document_link }}" target="_blank" 
                                                                       class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-white {{ $education->link_access == 1 ? 'bg-blue-600 hover:bg-blue-700 focus:ring-blue-500' : 'bg-yellow-600 hover:bg-yellow-700 focus:ring-yellow-500' }} focus:outline-none focus:ring-2 focus:ring-offset-2 transition-colors duration-200">
                                                                        <i class="fas fa-external-link-alt mr-2"></i>
                                                                        Belgeyi Görüntüle
                                                                        @if($education->link_access == 0)
                                                                            <span class="ml-1 text-xs">(Onay Bekliyor)</span>
                                                                        @endif
                                                                    </a>
                                                                </div>
                                                            @elseif($education->link_access == 2)
                                                                <div class="mt-3">
                                                                    <span class="inline-flex items-center px-3 py-2 rounded-md text-sm font-medium bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                                                        <i class="fas fa-times mr-2"></i>
                                                                        Belge reddedildi
                                                                    </span>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @else
                                <div class="text-center py-8">
                                    <i class="fas fa-graduation-cap text-4xl text-gray-400 dark:text-gray-500 mb-4"></i>
                                    <p class="text-gray-500 dark:text-gray-400">Henüz eğitim bilgisi eklenmemiş.</p>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Skills Modal -->
<div id="skillsModal" role="dialog" aria-modal="true" aria-labelledby="skills-modal-title" class="relative z-50 hidden">
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity ease-in-out duration-500 opacity-0" id="skillsBackdrop"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Slide-over panel -->
                <div class="pointer-events-auto relative w-screen max-w-md transform transition ease-in-out duration-500 sm:duration-700 translate-x-full" id="skillsPanel">
                    <!-- Close button -->
                    <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                        <button type="button" onclick="closeSkillsModal()" class="relative rounded-md text-red-500 hover:text-red-700 focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:outline-hidden">
                            <span class="absolute -inset-2.5"></span>
                            <span class="sr-only">Paneli kapat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex h-full flex-col overflow-y-auto bg-white dark:bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <h2 id="skills-modal-title" class="text-base font-semibold text-gray-900 dark:text-white">
                                <i class="fas fa-edit mr-2"></i>
                                Hakkımda Düzenle
                            </h2>
                        </div>
                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            <!-- Bio Form -->
                            <form id="skillsForm" class="space-y-6">
                                <div>
                                    <label for="bioTextarea" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Hakkımda
                                    </label>
                                    <textarea 
                                        id="bioTextarea" 
                                        name="bio" 
                                        rows="8" 
                                        maxlength="600"
                                        class="block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm resize-none"
                                        placeholder="Kendinizi tanıtın...">{{ isset($user) && $user->bio ? $user->bio : '' }}</textarea>
                                    <div class="flex justify-between items-center mt-1">
                                        <p class="text-xs text-gray-500 dark:text-gray-400">Maksimum 600 karakter</p>
                                        <span id="bioCharCount" class="text-xs text-gray-500 dark:text-gray-400">0/600</span>
                                    </div>
                                </div>

                                <!-- Info Box -->
                                <div class="rounded-md bg-blue-50 dark:bg-blue-900/20 p-4">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle text-blue-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <p class="text-sm text-blue-700 dark:text-blue-300">
                                                Bu bölümde kendinizi tanıtabilir, deneyimlerinizi ve çalışma tarzınızı açıklayabilirsiniz.
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <button type="button" 
                                            onclick="closeSkillsModal()" 
                                            class="rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        İptal
                                    </button>
                                    <button type="submit" 
                                            id="skillsSubmitBtn"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span id="skillsSubmitText">Kaydet</span>
                                        <span id="skillsLoadingText" class="hidden">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Kaydediliyor...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit Education Modal -->
<div id="editEducationModal" role="dialog" aria-modal="true" aria-labelledby="edit-education-modal-title" class="relative z-50 hidden">
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity ease-in-out duration-500 opacity-0" id="editEducationBackdrop"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Slide-over panel -->
                <div class="pointer-events-auto relative w-screen max-w-md transform transition ease-in-out duration-500 sm:duration-700 translate-x-full" id="editEducationPanel">
                    <!-- Close button -->
                    <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                        <button type="button" onclick="closeEditEducationModal()" class="relative rounded-md text-red-500 hover:text-red-700 focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:outline-hidden">
                            <span class="absolute -inset-2.5"></span>
                            <span class="sr-only">Paneli kapat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex h-full flex-col overflow-y-auto bg-white dark:bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <h2 id="edit-education-modal-title" class="text-base font-semibold text-gray-900 dark:text-white">
                                <i class="fas fa-edit mr-2"></i>
                                Eğitim Düzenle
                            </h2>
                        </div>
                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            <!-- Success Message -->
                            <div id="successMessage" class="hidden mb-4 rounded-md bg-green-50 dark:bg-green-900 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-check-circle text-green-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-green-800 dark:text-green-200">
                                            <span></span>
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <div id="errorMessage" class="hidden mb-4 rounded-md bg-red-50 dark:bg-red-900 p-4">
                                <div class="flex">
                                    <div class="flex-shrink-0">
                                        <i class="fas fa-exclamation-circle text-red-400"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="text-sm font-medium text-red-800 dark:text-red-200" id="errorText"></p>
                                    </div>
                                </div>
                            </div>

                            <!-- Edit Education Form -->
                            <form id="editEducationForm" class="space-y-6">
                                <input type="hidden" id="editEducationId" name="education_id">
                                
                                <div>
                                    <label for="editEducationName" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Eğitim/Sertifika Adı <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="editEducationName" 
                                           name="education_name" 
                                           required 
                                           maxlength="255"
                                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="Örn: Bilgisayar Mühendisliği Lisans">
                                </div>

                                <div>
                                    <label for="editInstitution" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Kurum <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="editInstitution" 
                                           name="institution" 
                                           required 
                                           maxlength="255"
                                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="Örn: İstanbul Teknik Üniversitesi">
                                </div>

                                <div class="grid grid-cols-2 gap-4">
                                    <div>
                                        <label for="editStartYear" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Başlangıç Yılı <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" 
                                               id="editStartYear" 
                                               name="start_year" 
                                               required 
                                               min="1950" 
                                               max="2030"
                                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                               placeholder="2020">
                                    </div>
                                    <div>
                                        <label for="editEndYear" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                            Bitiş Yılı
                                        </label>
                                        <input type="number" 
                                               id="editEndYear" 
                                               name="end_year" 
                                               min="1950" 
                                               max="2030"
                                               class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                               placeholder="2024">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Boş bırakın eğer devam ediyorsa</p>
                                    </div>
                                </div>

                                <div>
                                    <label for="editDocumentLink" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Belge Linki
                                    </label>
                                    <input type="url" 
                                           id="editDocumentLink" 
                                           name="document_link" 
                                           class="mt-1 block w-full rounded-md border-gray-300 dark:border-gray-600 shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="https://example.com/diploma.pdf">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Belge linki değiştirilirse onay durumu sıfırlanır
                                    </p>
                                </div>

                                <div class="flex justify-end space-x-3 pt-6 border-t border-gray-200 dark:border-gray-700">
                                    <button type="button" 
                                            onclick="closeEditEducationModal()" 
                                            class="rounded-md border border-gray-300 dark:border-gray-600 bg-white dark:bg-gray-700 px-4 py-2 text-sm font-medium text-gray-700 dark:text-gray-300 shadow-sm hover:bg-gray-50 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                        İptal
                                    </button>
                                    <button type="submit" 
                                            id="editSubmitBtn"
                                            class="inline-flex justify-center rounded-md border border-transparent bg-blue-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <span id="editSubmitText">Güncelle</span>
                                        <span id="editLoadingText" class="hidden">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Güncelleniyor...
                                        </span>
                                    </button>
                                </div>
                            </form>
                        </div>
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

/* Drag and Drop Styles */
.education-item {
    transition: all 0.2s ease;
}

.education-item:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
}

.education-item.dragging {
    opacity: 0.5;
    transform: rotate(5deg);
}

.drag-handle {
    cursor: grab;
    transition: color 0.2s ease;
}

.drag-handle:hover {
    color: #3b82f6;
}

.drag-handle:active {
    cursor: grabbing;
}

.education-item[draggable="true"] {
    cursor: move;
}

.education-item.drag-over {
    border: 2px dashed #3b82f6;
    background-color: rgba(59, 130, 246, 0.05);
}

/* Button hover effects */
.education-item .action-button {
    opacity: 0;
    transition: opacity 0.2s ease;
}

.education-item:hover .action-button {
    opacity: 1;
}

/* Dark mode adjustments */
.dark .education-item:hover {
    box-shadow: 0 4px 12px rgba(255, 255, 255, 0.1);
}

.dark .education-item.drag-over {
    border-color: #60a5fa;
    background-color: rgba(96, 165, 250, 0.05);
}
</style>

<script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
<script>
    // Skill Management
    const skillModal = document.getElementById('skillModal');
    const skillBackdrop = document.getElementById('skillBackdrop');
    const skillPanel = document.getElementById('skillPanel');
    const addSkillForm = document.getElementById('addSkillForm');
    const skillNameInput = document.getElementById('skill_name');
    const skillSuggestions = document.getElementById('skill_suggestions');
    const skillTypeSelect = document.getElementById('skill_type');
    const expertiseLevelContainer = document.getElementById('expertise_level_container');
    const skillLevelInput = document.getElementById('skill_level');
    const skillLevelValue = document.getElementById('skill_level_value');

    function openSkillModal() {
        skillModal.classList.remove('hidden');
        
        // Animate backdrop
        setTimeout(() => {
            skillBackdrop.classList.remove('opacity-0');
            skillBackdrop.classList.add('opacity-100');
        }, 10);
        
        // Animate panel
        setTimeout(() => {
            skillPanel.classList.remove('translate-x-full');
            skillPanel.classList.add('translate-x-0');
        }, 10);
        
        initializeSkills();
        
        // Modal açıldığında form ve kaydet butonunun görünürlüğünü kontrol et
        setTimeout(() => {
            const isOwnProfile = {{ auth()->id() == $user->id ? 'true' : 'false' }};
            const addSkillForm = document.getElementById('addSkillForm');
            const saveOrderContainer = document.getElementById('saveOrderContainer');
            
            if (addSkillForm) {
                addSkillForm.style.display = isOwnProfile ? 'block' : 'none';
            }
            if (saveOrderContainer) {
                saveOrderContainer.style.display = isOwnProfile ? 'block' : 'none';
            }
        }, 100);
    }

    function closeSkillModal() {
        // Animate panel
        skillPanel.classList.remove('translate-x-0');
        skillPanel.classList.add('translate-x-full');
        
        // Animate backdrop
        skillBackdrop.classList.remove('opacity-100');
        skillBackdrop.classList.add('opacity-0');
        
        setTimeout(() => {
            skillModal.classList.add('hidden');
            // Modal kapatıldığında ana sayfayı güncelle
            updateMainPageSkills();
        }, 500);
    }

    skillTypeSelect.addEventListener('change', () => {
        expertiseLevelContainer.style.display = skillTypeSelect.value === 'expertise' ? 'block' : 'none';
    });

    skillLevelInput.addEventListener('input', () => {
        skillLevelValue.textContent = skillLevelInput.value;
    });

    function initializeSkills() {
        // PHP'den gelen user_skills tablosundaki beceri verilerini kullan
        const userSkillsData = @json($user->skills()->orderBy('sort_order')->get());

        let allSkills = [];

        if (Array.isArray(userSkillsData)) {
            allSkills = userSkillsData;
        }
        
        const expertise = allSkills.filter(skill => skill.type === 'expertise');
        const tools = allSkills.filter(skill => skill.type === 'tool');
        const canEdit = <?= json_encode($canEdit ?? false) ?>;
        
        renderSkills(expertise, tools, canEdit);
        renderModalSkills(expertise, tools, canEdit);
        
        // Düzenle butonlarının görünürlüğünü kontrol et
        const editButtons = document.querySelectorAll('[onclick="openSkillModal()"]');
        editButtons.forEach(button => {
            if (canEdit) {
                button.style.display = 'inline-block';
            } else {
                button.style.display = 'none';
            }
        });
        
        // Beceri ekleme formunun görünürlüğünü kontrol et
        const addSkillForm = document.getElementById('addSkillForm');
        if (addSkillForm) {
            if (canEdit) {
                addSkillForm.style.display = 'block';
            } else {
                addSkillForm.style.display = 'none';
            }
        }
    }

    function updateMainPageSkills() {
        // Ana sayfayı güncellemek için sayfa yenile
        location.reload();
    }

    function renderSkills(expertise, tools, canEdit = false) {
        // Ana sayfadaki verileri silme - sadece "Tümünü Gör" butonunu güncelle
        const viewAllBtn = document.getElementById('view-all-skills-btn');
        
        if (expertise.length > 5 || tools.length > 6) {
            viewAllBtn.classList.remove('hidden');
            viewAllBtn.textContent = `Tümünü Gör (${expertise.length + tools.length} beceri)`;
        } else if (expertise.length === 0 && tools.length === 0) {
            viewAllBtn.classList.add('hidden');
        } else {
            viewAllBtn.classList.add('hidden');
        }
    }

    function renderModalSkills(expertise, tools, canEdit = false) {
        const modalExpertiseList = document.getElementById('modal-expertise-list');
        const modalToolsList = document.getElementById('modal-tools-list');
        modalExpertiseList.innerHTML = '';
        modalToolsList.innerHTML = '';

        expertise.forEach(skill => {
            modalExpertiseList.innerHTML += createSkillListItem(skill, canEdit);
        });

        tools.forEach(skill => {
            modalToolsList.innerHTML += createSkillListItem(skill, canEdit);
        });
        
        if (canEdit) {
            initSortable();
        }
    }

    function createSkillListItem(skill, canEdit = false) {
        const levelIndicator = skill.type === 'expertise' ? `<span class="text-sm text-gray-500 dark:text-gray-400">${skill.level}%</span>` : '';
        const deleteButton = canEdit ? `<button onclick="deleteSkill(${skill.id})" class="text-red-500 hover:text-red-700"><i class="fas fa-trash"></i></button>` : '';
        const gripIcon = canEdit ? `<i class="fas fa-grip-vertical cursor-move text-gray-400 mr-3"></i>` : '';
        
        return `
            <li data-id="${skill.id}" class="flex items-center justify-between bg-gray-100 dark:bg-gray-700 p-2 rounded-md">
                <div class="flex items-center">
                    ${gripIcon}
                    <span class="font-medium text-gray-800 dark:text-gray-200">${skill.name}</span>
                </div>
                <div class="flex items-center space-x-3">
                    ${levelIndicator}
                    ${deleteButton}
                </div>
            </li>
        `;
    }

    addSkillForm.addEventListener('submit', async (e) => {
        e.preventDefault();
        const formData = new FormData(addSkillForm);
        
        // Form verilerini backend'in beklediği formata dönüştür
        const data = {
            name: formData.get('skill_name'),
            type: formData.get('skill_type'),
            level: formData.get('level')
        };

        try {
            const response = await fetch('{{ route('skills.store') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': formData.get('_token')
                },
                body: JSON.stringify(data)
            });

            const result = await response.json();

            if (result.success) {
                showSkillMessage('Beceri başarıyla eklendi!', 'success');
                
                // Form reset
                addSkillForm.reset();
                skillLevelValue.textContent = '50';
                
                // Modal içeriğini güncelle (sayfa yenileme yok)
                initializeSkills();
            } else {
                const errorMessages = Object.values(result.errors).flat().join('<br>');
                showSkillMessage(errorMessages, 'error');
            }
        } catch (error) {
            showSkillMessage('Bir hata oluştu.', 'error');
        }
    });

    async function deleteSkill(id) {
        if (!confirm('Bu beceriyi silmek istediğinizden emin misiniz?')) return;

        try {
            const response = await fetch(`/profile/skills/${id}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            });
            const result = await response.json();
            if (result.success) {
                showSkillMessage('Beceri başarıyla silindi!', 'success');
                
                // Modal içeriğini güncelle (sayfa yenileme yok)
                initializeSkills();
            } else {
                showSkillMessage('Beceri silinirken bir hata oluştu.', 'error');
            }
        } catch (error) {
            showSkillMessage('Bir hata oluştu.', 'error');
        }
    }

    let searchTimeout;
    skillNameInput.addEventListener('keyup', () => {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(async () => {
            const query = skillNameInput.value;
            if (query.length < 2) {
                skillSuggestions.classList.add('hidden');
                return;
            }
            try {
                const response = await fetch(`{{ route('skills.search') }}?query=${query}`, {
                    method: 'GET',
                    headers: {
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'X-Requested-With': 'XMLHttpRequest'
                    }
                });
                const suggestions = await response.json();
                renderSuggestions(suggestions);
            } catch (error) {
                console.error('Error searching skills:', error);
            }
        }, 300);
    });

    function renderSuggestions(suggestions) {
        if (suggestions.length === 0) {
            skillSuggestions.classList.add('hidden');
            return;
        }
        skillSuggestions.innerHTML = suggestions.map(s => `<div class="p-2 hover:bg-gray-200 dark:hover:bg-gray-600 cursor-pointer">${s}</div>`).join('');
        skillSuggestions.classList.remove('hidden');
        skillSuggestions.querySelectorAll('div').forEach(item => {
            item.addEventListener('click', () => {
                skillNameInput.value = item.textContent;
                skillSuggestions.classList.add('hidden');
            });
        });
    }

    function initSortable() {
        const expertiseList = document.getElementById('modal-expertise-list');
        const toolsList = document.getElementById('modal-tools-list');
        const saveOrderBtn = document.getElementById('saveOrderBtn');
        
        let hasChanges = false;
        
        const options = {
            animation: 150,
            ghostClass: 'bg-blue-100',
            onEnd: function (evt) {
                hasChanges = true;
                if (saveOrderBtn) {
                    saveOrderBtn.disabled = false;
                    saveOrderBtn.classList.remove('opacity-50');
                }
            }
        };

        new Sortable(expertiseList, options);
        new Sortable(toolsList, options);
        
        // Kaydet butonu click event'i
        if (saveOrderBtn) {
            saveOrderBtn.addEventListener('click', async function() {
                if (!hasChanges) return;
                
                const expertiseItems = Array.from(expertiseList.children);
                const toolsItems = Array.from(toolsList.children);
                
                const allItems = [...expertiseItems, ...toolsItems];
                const skillsOrder = allItems.map((item, index) => ({
                    id: item.dataset.id,
                    sort_order: index
                }));
                
                try {
                    saveOrderBtn.disabled = true;
                    saveOrderBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i>Kaydediliyor...';
                    
                    const response = await fetch('{{ route('skills.updateOrder') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({ skills: skillsOrder })
                    });
                    
                    const result = await response.json();
                    
                    if (result.success) {
                        showSkillMessage('Sıralama başarıyla kaydedildi!', 'success');
                        hasChanges = false;
                        saveOrderBtn.disabled = true;
                        saveOrderBtn.classList.add('opacity-50');
                        saveOrderBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Sırayı Kaydet';
                        
                        // Modal içeriğini güncelle (sayfa yenileme yok)
                        initializeSkills();
                    } else {
                        showSkillMessage('Sıralama kaydedilirken bir hata oluştu.', 'error');
                        saveOrderBtn.disabled = false;
                        saveOrderBtn.classList.remove('opacity-50');
                        saveOrderBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Sırayı Kaydet';
                    }
                } catch (error) {
                    console.error('Error updating skill order:', error);
                    showSkillMessage('Bir hata oluştu.', 'error');
                    saveOrderBtn.disabled = false;
                    saveOrderBtn.classList.remove('opacity-50');
                    saveOrderBtn.innerHTML = '<i class="fas fa-save mr-2"></i>Sırayı Kaydet';
                }
            });
        }
    }

    function showSkillMessage(message, type = 'success') {
        const successDiv = document.getElementById('skill-success-message');
        const errorDiv = document.getElementById('skill-error-message');
        
        if (type === 'success') {
            successDiv.innerHTML = message;
            successDiv.classList.remove('hidden');
            errorDiv.classList.add('hidden');
        } else {
            errorDiv.innerHTML = message;
            errorDiv.classList.remove('hidden');
            successDiv.classList.add('hidden');
        }

        setTimeout(() => {
            successDiv.classList.add('hidden');
            errorDiv.classList.add('hidden');
        }, 5000);
    }



</script>
<script>
// Education Modal Functions
function openEducationModal() {
    const modal = document.getElementById('educationModal');
    const backdrop = document.getElementById('educationBackdrop');
    const panel = document.getElementById('educationPanel');
    
    modal.classList.remove('hidden');
    
    // Animate backdrop
    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
    }, 10);
    
    // Animate panel
    setTimeout(() => {
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
    }, 10);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeEducationModal() {
    const modal = document.getElementById('educationModal');
    const backdrop = document.getElementById('educationBackdrop');
    const panel = document.getElementById('educationPanel');
    
    // Animate out
    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    panel.classList.remove('translate-x-0');
    panel.classList.add('translate-x-full');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
    }, 500);
}

// Add Education Modal Functions
function openAddEducationModal() {
    const modal = document.getElementById('addEducationModal');
    const backdrop = document.getElementById('addEducationBackdrop');
    const panel = document.getElementById('addEducationPanel');
    
    modal.classList.remove('hidden');
    
    // Animate backdrop
    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
    }, 10);
    
    // Animate panel
    setTimeout(() => {
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
    }, 10);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeAddEducationModal() {
    const modal = document.getElementById('addEducationModal');
    const backdrop = document.getElementById('addEducationBackdrop');
    const panel = document.getElementById('addEducationPanel');
    
    // Animate out
    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    panel.classList.remove('translate-x-0');
    panel.classList.add('translate-x-full');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        // Reset form
        document.getElementById('addEducationForm').reset();
        hideMessages();
    }, 500);
}

// Utility Functions - Updated to use new toast system
function showSuccessMessage(message) {
    // Use the new toast system instead of old inline messages
    showSuccessToast('Başarılı!', message);
}

function showErrorMessage(message) {
    // Use the new toast system instead of old inline messages
    showErrorToast('Hata!', message);
}

function hideMessages() {
    // Hide any existing toast
    hideToast();
}

function setLoading(isLoading) {
    // For add education modal
    const submitBtn = document.getElementById('submitBtn');
    const submitText = document.getElementById('submitText');
    const loadingText = document.getElementById('loadingText');
    
    // For edit education modal
    const editSubmitBtn = document.getElementById('editSubmitBtn');
    const editSubmitText = document.getElementById('editSubmitText');
    const editLoadingText = document.getElementById('editLoadingText');
    
    if (isLoading) {
        if (submitBtn) {
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
        }
        if (editSubmitBtn) {
            editSubmitBtn.disabled = true;
            editSubmitText.classList.add('hidden');
            editLoadingText.classList.remove('hidden');
        }
    } else {
        if (submitBtn) {
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            loadingText.classList.add('hidden');
        }
        if (editSubmitBtn) {
            editSubmitBtn.disabled = false;
            editSubmitText.classList.remove('hidden');
            editLoadingText.classList.add('hidden');
        }
    }
}

// XSS Protection Function
function sanitizeInput(str) {
    const div = document.createElement('div');
    div.textContent = str;
    return div.innerHTML;
}

// Validate URL
function isValidUrl(string) {
    try {
        new URL(string);
        return true;
    } catch (_) {
        return false;
    }
}

// Delete Education Function
function deleteEducation(educationId) {
    console.log('deleteEducation called with ID:', educationId, 'Type:', typeof educationId);
    
    if (!educationId || educationId === 'undefined') {
        console.error('Invalid education ID:', educationId);
        showEducationError('delete', 'Geçersiz eğitim ID\'si!');
        return;
    }
    
    if (!confirm('Bu eğitim bilgisini silmek istediğinizden emin misiniz?')) {
        return;
    }
    
    // Show loading toast
    showEducationLoading('deleting');
    
    fetch(`/api/education/${educationId}`, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        hideToast(); // Hide loading toast
        if (data.success) {
            showEducationSuccess('deleted');
            // Reload page after 2 seconds
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            showEducationError('delete', data.message || 'Silme işlemi başarısız!');
        }
    })
    .catch(error => {
        hideToast(); // Hide loading toast
        console.error('Error:', error);
        showEducationError('delete', 'Bir hata oluştu!');
    });
}

// Edit Education Function
function editEducation(educationId) {
    console.log('editEducation called with ID:', educationId, 'Type:', typeof educationId);
    
    if (!educationId || educationId === 'undefined') {
        console.error('Invalid education ID:', educationId);
        showEducationError('load', 'Geçersiz eğitim ID\'si!');
        return;
    }
    
    // Show loading toast
    showEducationLoading('loading');
    
    // Fetch education data
    fetch(`/api/education/${educationId}`, {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        }
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        hideToast(); // Hide loading toast
        if (data.success) {
            // Fill edit form with data
            document.getElementById('editEducationId').value = data.data.id;
            document.getElementById('editEducationName').value = data.data.education_name;
            document.getElementById('editInstitution').value = data.data.institution;
            document.getElementById('editStartYear').value = data.data.start_year;
            document.getElementById('editEndYear').value = data.data.end_year || '';
            document.getElementById('editDocumentLink').value = data.data.document_link || '';
            
            // Store original document link for comparison
            document.getElementById('editEducationForm').setAttribute('data-original-link', data.data.document_link || '');
            
            // Open edit modal
            openEditEducationModal();
        } else {
            showEducationError('load', data.message || 'Eğitim bilgisi yüklenemedi!');
        }
    })
    .catch(error => {
        hideToast(); // Hide loading toast
        console.error('Error:', error);
        showEducationError('load', 'Bir hata oluştu!');
    });
}

// Edit Education Modal Functions
function openEditEducationModal() {
    const modal = document.getElementById('editEducationModal');
    const backdrop = document.getElementById('editEducationBackdrop');
    const panel = document.getElementById('editEducationPanel');
    
    modal.classList.remove('hidden');
    
    // Animate backdrop
    setTimeout(() => {
        backdrop.classList.remove('opacity-0');
        backdrop.classList.add('opacity-100');
    }, 10);
    
    // Animate panel
    setTimeout(() => {
        panel.classList.remove('translate-x-full');
        panel.classList.add('translate-x-0');
    }, 10);
    
    // Prevent body scroll
    document.body.style.overflow = 'hidden';
}

function closeEditEducationModal() {
    const modal = document.getElementById('editEducationModal');
    const backdrop = document.getElementById('editEducationBackdrop');
    const panel = document.getElementById('editEducationPanel');
    
    // Animate panel
    panel.classList.remove('translate-x-0');
    panel.classList.add('translate-x-full');
    
    // Animate backdrop
    backdrop.classList.remove('opacity-100');
    backdrop.classList.add('opacity-0');
    
    // Hide modal after animation
    setTimeout(() => {
        modal.classList.add('hidden');
        document.body.style.overflow = 'auto';
        
        // Reset form
        document.getElementById('editEducationForm').reset();
        hideMessages();
    }, 300);
}

// Drag and Drop Functions
let draggedElement = null;

function initializeDragAndDrop() {
    const educationList = document.getElementById('educationList');
    if (!educationList) return;
    
    const items = educationList.querySelectorAll('.education-item');
    
    items.forEach(item => {
        item.addEventListener('dragstart', handleDragStart);
        item.addEventListener('dragover', handleDragOver);
        item.addEventListener('drop', handleDrop);
        item.addEventListener('dragend', handleDragEnd);
    });
}

function handleDragStart(e) {
    draggedElement = this;
    this.style.opacity = '0.5';
    e.dataTransfer.effectAllowed = 'move';
    e.dataTransfer.setData('text/html', this.outerHTML);
}

function handleDragOver(e) {
    if (e.preventDefault) {
        e.preventDefault();
    }
    e.dataTransfer.dropEffect = 'move';
    return false;
}

function handleDrop(e) {
    if (e.stopPropagation) {
        e.stopPropagation();
    }
    
    if (draggedElement !== this) {
        const draggedId = draggedElement.getAttribute('data-id');
        const targetId = this.getAttribute('data-id');
        
        // Get all items and their current order
        const items = Array.from(document.querySelectorAll('.education-item'));
        const draggedIndex = items.indexOf(draggedElement);
        const targetIndex = items.indexOf(this);
        
        // Move the dragged element
        if (draggedIndex < targetIndex) {
            this.parentNode.insertBefore(draggedElement, this.nextSibling);
        } else {
            this.parentNode.insertBefore(draggedElement, this);
        }
        
        // Show save button when order changes
        showSaveSortButton();
    }
    
    return false;
}

function handleDragEnd(e) {
    this.style.opacity = '1';
    draggedElement = null;
}

function showSaveSortButton() {
    const saveBtn = document.getElementById('saveSortOrderBtn');
    if (saveBtn) {
        saveBtn.classList.remove('hidden');
    }
}

function hideSaveSortButton() {
    const saveBtn = document.getElementById('saveSortOrderBtn');
    if (saveBtn) {
        saveBtn.classList.add('hidden');
    }
}

function saveSortOrder() {
    console.log('saveSortOrder called');
    const items = document.querySelectorAll('.education-item');
    console.log('Found education items:', items.length);
    
    const orderData = [];
    
    items.forEach((item, index) => {
        const dataId = item.getAttribute('data-id');
        console.log(`Item ${index}: data-id = ${dataId}`);
        if (dataId) {
            orderData.push({
                id: parseInt(dataId),
                sort_order: index + 1
            });
        }
    });
    
    console.log('Order data to send:', orderData);
    
    if (orderData.length === 0) {
        showEducationError('sort', 'Sıralanacak eğitim bulunamadı!');
        return;
    }
    
    // Show loading toast
    showEducationLoading('sorting');
    
    // Disable save button during request
    const saveBtn = document.getElementById('saveSortOrderBtn');
    if (saveBtn) {
        saveBtn.disabled = true;
        saveBtn.innerHTML = '<i class="fas fa-spinner fa-spin mr-1"></i>Kaydediliyor...';
    }
    
    // Send update to server - controller expects 'educations' not 'order'
    fetch('/api/education/update-order', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json'
        },
        body: JSON.stringify({ educations: orderData })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        hideToast(); // Hide loading toast
        if (data.success) {
            showEducationSuccess('sorted');
            hideSaveSortButton();
        } else {
            showEducationError('sort', 'Sıralama kaydedilemedi: ' + (data.message || 'Bilinmeyen hata'));
            // Reload page to restore original order
            setTimeout(() => window.location.reload(), 2000);
        }
    })
    .catch(error => {
        hideToast(); // Hide loading toast
        console.error('Error:', error);
        showEducationError('sort', 'Sıralama kaydedilirken bir hata oluştu!');
        // Reload page to restore original order
        setTimeout(() => window.location.reload(), 2000);
    })
    .finally(() => {
        // Re-enable save button
        if (saveBtn) {
            saveBtn.disabled = false;
            saveBtn.innerHTML = '<i class="fas fa-save mr-1"></i>Sırayı Kaydet';
        }
    });
}

function updateSortOrder() {
    // This function is now deprecated - we use saveSortOrder instead
    // Keeping it for backward compatibility but it does nothing
    console.log('updateSortOrder called - now using manual save');
}

// DOM ready event listener
document.addEventListener('DOMContentLoaded', function() {
    // Initialize drag and drop
    initializeDragAndDrop();
    
    // Close modals when clicking backdrop
    const educationBackdrop = document.getElementById('educationBackdrop');
    if (educationBackdrop) {
        educationBackdrop.addEventListener('click', function(e) {
            if (e.target === educationBackdrop) {
                closeEducationModal();
            }
        });
    }
    
    const addEducationBackdrop = document.getElementById('addEducationBackdrop');
    if (addEducationBackdrop) {
        addEducationBackdrop.addEventListener('click', function(e) {
            if (e.target === addEducationBackdrop) {
                closeAddEducationModal();
            }
        });
    }
    
    const editEducationBackdrop = document.getElementById('editEducationBackdrop');
    if (editEducationBackdrop) {
        editEducationBackdrop.addEventListener('click', function(e) {
            if (e.target === editEducationBackdrop) {
                closeEditEducationModal();
            }
        });
    }
    
    // Close modals with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            const educationModal = document.getElementById('educationModal');
            const addEducationModal = document.getElementById('addEducationModal');
            const editEducationModal = document.getElementById('editEducationModal');
            
            if (educationModal && !educationModal.classList.contains('hidden')) {
                closeEducationModal();
            }
            if (addEducationModal && !addEducationModal.classList.contains('hidden')) {
                closeAddEducationModal();
            }
            if (editEducationModal && !editEducationModal.classList.contains('hidden')) {
                closeEditEducationModal();
            }
        }
    });
    
    // Form submission for adding education
    const addEducationForm = document.getElementById('addEducationForm');
    if (addEducationForm) {
        addEducationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            
            // Validate required fields
            const educationName = formData.get('education_name').trim();
            const institution = formData.get('institution').trim();
            const startYear = formData.get('start_year');
            const endYear = formData.get('end_year');
            const documentLink = formData.get('document_link').trim();
            
            // Basic validation
            if (!educationName || !institution || !startYear) {
                showEducationError('add', 'Lütfen zorunlu alanları doldurun!');
                return;
            }
            
            if (startYear < 1950 || startYear > 2030) {
                showEducationError('add', 'Başlangıç yılı 1950-2030 arasında olmalıdır!');
                return;
            }
            
            if (endYear && (endYear < startYear || endYear > 2030)) {
                showEducationError('add', 'Bitiş yılı başlangıç yılından büyük ve 2030\'dan küçük olmalıdır!');
                return;
            }
            
            if (documentLink && !isValidUrl(documentLink)) {
                showEducationError('add', 'Lütfen geçerli bir URL girin!');
                return;
            }
            
            // Sanitize inputs
            const sanitizedData = {
                education_name: sanitizeInput(educationName),
                institution: sanitizeInput(institution),
                start_year: parseInt(startYear),
                end_year: endYear ? parseInt(endYear) : null,
                document_link: documentLink || null
            };
            
            // Show loading toast
            showEducationLoading('adding');
            
            // Submit form
            fetch('/api/education', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(sanitizedData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                hideToast(); // Hide loading toast
                
                if (data.success) {
                    showEducationSuccess('added');
                    addEducationForm.reset();
                    
                    // Reload page after 2 seconds to show new education
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    showEducationError('add', data.message || 'Ekleme işlemi başarısız!');
                }
            })
            .catch(error => {
                hideToast(); // Hide loading toast
                console.error('Error:', error);
                showEducationError('add', 'Bir hata oluştu! Lütfen tekrar deneyin.');
            });
        });
    }
    
    // Form submission for editing education
    const editEducationForm = document.getElementById('editEducationForm');
    if (editEducationForm) {
        editEducationForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Get form data
            const formData = new FormData(this);
            const educationId = formData.get('education_id');
            const originalLink = this.getAttribute('data-original-link') || '';
            
            // Validate required fields
            const educationName = formData.get('education_name').trim();
            const institution = formData.get('institution').trim();
            const startYear = formData.get('start_year');
            const endYear = formData.get('end_year');
            const documentLink = formData.get('document_link').trim();
            
            // Basic validation
            if (!educationName || !institution || !startYear) {
                showEducationError('update', 'Lütfen zorunlu alanları doldurun!');
                return;
            }
            
            if (startYear < 1950 || startYear > 2030) {
                showEducationError('update', 'Başlangıç yılı 1950-2030 arasında olmalıdır!');
                return;
            }
            
            if (endYear && (endYear < startYear || endYear > 2030)) {
                showEducationError('update', 'Bitiş yılı başlangıç yılından büyük ve 2030\'dan küçük olmalıdır!');
                return;
            }
            
            if (documentLink && !isValidUrl(documentLink)) {
                showEducationError('update', 'Lütfen geçerli bir URL girin!');
                return;
            }
            
            // Sanitize inputs
            const sanitizedData = {
                education_name: sanitizeInput(educationName),
                institution: sanitizeInput(institution),
                start_year: parseInt(startYear),
                end_year: endYear ? parseInt(endYear) : null,
                document_link: documentLink || null
            };
            
            // Check if document link changed
            if (originalLink !== documentLink) {
                sanitizedData.reset_link_access = true;
            }
            
            // Show loading toast
            showEducationLoading('updating');
            
            // Submit form
            fetch(`/api/education/${educationId}`, {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json'
                },
                body: JSON.stringify(sanitizedData)
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                hideToast(); // Hide loading toast
                
                if (data.success) {
                    showEducationSuccess('updated');
                    
                    // Reload page after 2 seconds to show updated education
                    setTimeout(() => {
                        window.location.reload();
                    }, 2000);
                } else {
                    showEducationError('update', data.message || 'Güncelleme işlemi başarısız!');
                }
            })
            .catch(error => {
                hideToast(); // Hide loading toast
                console.error('Error:', error);
                showEducationError('update', 'Bir hata oluştu! Lütfen tekrar deneyin.');
            });
        });
    }
    
    // Bio Modal Functions
    window.openSkillsModal = function() {
        const modal = document.getElementById('skillsModal');
        const backdrop = document.getElementById('skillsBackdrop');
        const panel = document.getElementById('skillsPanel');
        
        // Load current bio
        loadCurrentBio();
        
        modal.classList.remove('hidden');
        
        // Animate backdrop
        setTimeout(() => {
            backdrop.classList.remove('opacity-0');
            backdrop.classList.add('opacity-100');
        }, 10);
        
        // Animate panel
        setTimeout(() => {
            panel.classList.remove('translate-x-full');
            panel.classList.add('translate-x-0');
        }, 10);
        
        // Prevent body scroll
        document.body.style.overflow = 'hidden';
    }

    window.closeSkillsModal = function() {
        const modal = document.getElementById('skillsModal');
        const backdrop = document.getElementById('skillsBackdrop');
        const panel = document.getElementById('skillsPanel');
        
        // Animate panel
        panel.classList.remove('translate-x-0');
        panel.classList.add('translate-x-full');
        
        // Animate backdrop
        backdrop.classList.remove('opacity-100');
        backdrop.classList.add('opacity-0');
        
        // Hide modal after animation
        setTimeout(() => {
            modal.classList.add('hidden');
            document.body.style.overflow = 'auto';
            
            // Reset form
            document.getElementById('skillsForm').reset();
            updateBioCharCount();
        }, 300);
    }

    function loadCurrentBio() {
        // Load current bio
        const bioTextarea = document.getElementById('bioTextarea');
        const currentBio = @json($user->bio ?? '');
        bioTextarea.value = currentBio;
        updateBioCharCount();
    }

    function updateBioCharCount() {
        const bioTextarea = document.getElementById('bioTextarea');
        const charCount = document.getElementById('bioCharCount');
        const currentLength = bioTextarea.value.length;
        charCount.textContent = `${currentLength}/600`;
        
        // Change color based on character count
        if (currentLength > 550) {
            charCount.classList.add('text-red-500');
            charCount.classList.remove('text-gray-500');
        } else if (currentLength > 500) {
            charCount.classList.add('text-yellow-500');
            charCount.classList.remove('text-gray-500', 'text-red-500');
        } else {
            charCount.classList.add('text-gray-500');
            charCount.classList.remove('text-red-500', 'text-yellow-500');
        }
    }

    // Event listeners for bio modal
    const bioTextarea = document.getElementById('bioTextarea');
    if (bioTextarea) {
        bioTextarea.addEventListener('input', updateBioCharCount);
    }
    
    // Notification function
    function showNotification(message, type = 'success') {
        if (type === 'success') {
            showSuccessToast(message);
        } else if (type === 'error') {
            showErrorToast(message);
        } else if (type === 'warning') {
            showWarningToast(message);
        } else if (type === 'info') {
            showInfoToast(message);
        }
    }

    // Bio form submission
    const skillsForm = document.getElementById('skillsForm');
    if (skillsForm) {
        skillsForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const bio = formData.get('bio').trim();
            
            // Show loading state
            const submitBtn = document.getElementById('skillsSubmitBtn');
            const submitText = document.getElementById('skillsSubmitText');
            const loadingText = document.getElementById('skillsLoadingText');
            
            submitBtn.disabled = true;
            submitText.classList.add('hidden');
            loadingText.classList.remove('hidden');
            
            // Send bio update request
            fetch('{{ route('profile.update.bio') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    bio: bio
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update the bio display on the page
                    const bioDisplay = document.querySelector('[data-bio-display]');
                    if (bioDisplay) {
                        if (bio) {
                            bioDisplay.textContent = bio;
                            bioDisplay.classList.remove('text-gray-500', 'italic');
                            bioDisplay.classList.add('text-gray-700', 'dark:text-gray-300');
                        } else {
                            bioDisplay.textContent = 'Henüz bir biyografi eklenmemiş.';
                            bioDisplay.classList.add('text-gray-500', 'italic');
                            bioDisplay.classList.remove('text-gray-700', 'dark:text-gray-300');
                        }
                    }
                    
                    // Close modal
                    closeSkillsModal();
                    
                    // Show success message
                    showNotification('Hakkımda bölümü başarıyla güncellendi!', 'success');
                } else {
                    showNotification('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                showNotification('Bir hata oluştu. Lütfen tekrar deneyin.', 'error');
            })
            .finally(() => {
                // Reset button state
                submitBtn.disabled = false;
                submitText.classList.remove('hidden');
                loadingText.classList.add('hidden');
            });
        });
    }
    
    // Identity Verification Modal
    const verifyIdentityBtn = document.getElementById('verify-identity-btn');
    const identityModal = document.getElementById('identity-verification-modal');
    const closeIdentityModalBtn = document.getElementById('close-identity-modal-btn');
    const identityForm = document.getElementById('identity-verification-form');

    function openIdentityVerificationModal() {
        const modal = document.getElementById('identity-verification-modal');
        const backdrop = document.getElementById('identityVerificationBackdrop');
        const panel = document.getElementById('identityVerificationPanel');
        
        if (modal && backdrop && panel) {
            modal.classList.remove('hidden');
            
            // Trigger animations
            setTimeout(() => {
                backdrop.classList.remove('opacity-0');
                backdrop.classList.add('opacity-100');
                panel.classList.remove('translate-x-full');
                panel.classList.add('translate-x-0');
            }, 10);
        }
    }

    function closeIdentityVerificationModal() {
        const modal = document.getElementById('identity-verification-modal');
        const backdrop = document.getElementById('identityVerificationBackdrop');
        const panel = document.getElementById('identityVerificationPanel');
        
        if (modal && backdrop && panel) {
            // Trigger exit animations
            backdrop.classList.remove('opacity-100');
            backdrop.classList.add('opacity-0');
            panel.classList.remove('translate-x-0');
            panel.classList.add('translate-x-full');
            
            // Hide modal after animation
            setTimeout(() => {
                modal.classList.add('hidden');
                
                // Reset form
                const form = document.getElementById('identity-verification-form');
                if (form) {
                    form.reset();
                }
                
                // Hide messages
                const successMsg = document.getElementById('identitySuccessMessage');
                const errorMsg = document.getElementById('identityErrorMessage');
                if (successMsg) successMsg.classList.add('hidden');
                if (errorMsg) errorMsg.classList.add('hidden');
                
                // Reset button state
                const submitBtn = document.getElementById('identitySubmitBtn');
                const submitText = document.getElementById('identitySubmitText');
                const loadingText = document.getElementById('identityLoadingText');
                
                if (submitBtn && submitText && loadingText) {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingText.classList.add('hidden');
                }
            }, 500);
        }
    }

    if (verifyIdentityBtn) {
        verifyIdentityBtn.addEventListener('click', () => {
            openIdentityVerificationModal();
        });
    }

    if (closeIdentityModalBtn) {
        closeIdentityModalBtn.addEventListener('click', () => {
            closeIdentityVerificationModal();
        });
    }

    // Close modal when clicking backdrop
    if (identityModal) {
        identityModal.addEventListener('click', (e) => {
            if (e.target === identityModal) {
                closeIdentityVerificationModal();
            }
        });
    }

    // Close modal with Escape key
    document.addEventListener('keydown', (e) => {
        if (e.key === 'Escape') {
            const identityModal = document.getElementById('identity-verification-modal');
            if (identityModal && !identityModal.classList.contains('hidden')) {
                closeIdentityVerificationModal();
            }
        }
    });

    if (identityForm) {
        identityForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Show loading state
            const submitBtn = document.getElementById('identitySubmitBtn');
            const submitText = document.getElementById('identitySubmitText');
            const loadingText = document.getElementById('identityLoadingText');
            const successMsg = document.getElementById('identitySuccessMessage');
            const errorMsg = document.getElementById('identityErrorMessage');
            const errorText = document.getElementById('identityErrorText');

            if (submitBtn && submitText && loadingText) {
                submitBtn.disabled = true;
                submitText.classList.add('hidden');
                loadingText.classList.remove('hidden');
            }

            // Hide previous messages
            if (successMsg) successMsg.classList.add('hidden');
            if (errorMsg) errorMsg.classList.add('hidden');

            const formData = new FormData(this);

            fetch('{{ route('profile.verify-identity') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Accept': 'application/json',
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                // Reset loading state
                if (submitBtn && submitText && loadingText) {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingText.classList.add('hidden');
                }

                if (data.success) {
                    // Show success message
                    if (successMsg) {
                        successMsg.classList.remove('hidden');
                    }
                    
                    showSuccessToast('Başarılı!', 'Kimlik başarıyla doğrulandı!');
                    
                    setTimeout(() => {
                        closeIdentityVerificationModal();
                        window.location.reload();
                    }, 2000);
                } else {
                    // Show error message
                    if (errorMsg && errorText) {
                        errorText.textContent = data.message || 'Kimlik doğrulama başarısız!';
                        errorMsg.classList.remove('hidden');
                    }
                    showErrorToast('Hata!', data.message);
                }
            })
            .catch(error => {
                // Reset loading state
                if (submitBtn && submitText && loadingText) {
                    submitBtn.disabled = false;
                    submitText.classList.remove('hidden');
                    loadingText.classList.add('hidden');
                }

                console.error('Error:', error);
                
                // Show error message
                if (errorMsg && errorText) {
                    errorText.textContent = 'Bir hata oluştu. Lütfen tekrar deneyin.';
                    errorMsg.classList.remove('hidden');
                }
                showErrorToast('Hata!', 'Bir hata oluştu. Lütfen tekrar deneyin.');
            });
        });
    }
});
</script>
<!-- Identity Verification Modal -->
<div id="identity-verification-modal" role="dialog" aria-modal="true" aria-labelledby="identity-verification-modal-title" class="relative z-50 hidden">
    <!-- Background backdrop -->
    <div class="fixed inset-0 bg-gray-500/75 transition-opacity ease-in-out duration-500 opacity-0" id="identityVerificationBackdrop"></div>

    <div class="fixed inset-0 overflow-hidden">
        <div class="absolute inset-0 overflow-hidden">
            <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10 sm:pl-16">
                <!-- Slide-over panel -->
                <div class="pointer-events-auto relative w-screen max-w-lg transform transition ease-in-out duration-500 sm:duration-700 translate-x-full" id="identityVerificationPanel">
                    <!-- Close button -->
                    <div class="absolute top-0 left-0 -ml-8 flex pt-4 pr-2 sm:-ml-10 sm:pr-4">
                        <button type="button" id="close-identity-modal-btn" class="relative rounded-md text-red-500 hover:text-red-700 focus-visible:ring-2 focus-visible:ring-red-500 focus-visible:outline-hidden">
                            <span class="absolute -inset-2.5"></span>
                            <span class="sr-only">Paneli kapat</span>
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" data-slot="icon" aria-hidden="true" class="size-6">
                                <path d="M6 18 18 6M6 6l12 12" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </button>
                    </div>

                    <div class="flex h-full flex-col overflow-y-auto bg-white dark:bg-gray-800 py-6 shadow-xl">
                        <div class="px-4 sm:px-6">
                            <h2 id="identity-verification-modal-title" class="text-base font-semibold text-gray-900 dark:text-white">
                                <i class="fas fa-id-card mr-2"></i>
                                Kimlik Doğrulama
                            </h2>
                            <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                                T.C. kimlik bilgilerinizi girerek kimliğinizi doğrulayın
                            </p>
                        </div>
                        
                        <div class="relative mt-6 flex-1 px-4 sm:px-6">
                            <!-- Success Message -->
                            <div id="identitySuccessMessage" class="hidden mb-4 p-4 bg-green-100 dark:bg-green-900 border border-green-400 dark:border-green-600 text-green-700 dark:text-green-300 rounded-md">
                                <div class="flex">
                                    <i class="fas fa-check-circle mr-2 mt-0.5"></i>
                                    <span>Kimlik başarıyla doğrulandı!</span>
                                </div>
                            </div>

                            <!-- Error Message -->
                            <div id="identityErrorMessage" class="hidden mb-4 p-4 bg-red-100 dark:bg-red-900 border border-red-400 dark:border-red-600 text-red-700 dark:text-red-300 rounded-md">
                                <div class="flex">
                                    <i class="fas fa-exclamation-triangle mr-2 mt-0.5"></i>
                                    <span id="identityErrorText">Bir hata oluştu!</span>
                                </div>
                            </div>

                            <!-- Form -->
                            <form id="identity-verification-form" class="space-y-6">
                                @csrf
                                
                                <!-- TC Identity Number -->
                                <div>
                                    <label for="tc_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        T.C. Kimlik Numarası <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="tc_no" 
                                           name="tc_no" 
                                           required
                                           maxlength="11"
                                           pattern="[0-9]{11}"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="12345678901">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        11 haneli T.C. kimlik numaranızı girin
                                    </p>
                                </div>

                                <!-- First Name -->
                                <div>
                                    <label for="first_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Ad <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="first_name" 
                                           name="first_name" 
                                           value="{{ $user->first_name }}"
                                           required
                                           maxlength="50"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="Adınız">
                                </div>

                                <!-- Last Name -->
                                <div>
                                    <label for="last_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Soyad <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" 
                                           id="last_name" 
                                           name="last_name" 
                                           value="{{ $user->last_name }}"
                                           required
                                           maxlength="50"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="Soyadınız">
                                </div>

                                <!-- Birth Year -->
                                <div>
                                    <label for="birth_year" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        Doğum Yılı <span class="text-red-500">*</span>
                                    </label>
                                    <input type="number" 
                                           id="birth_year" 
                                           name="birth_year" 
                                           value="{{ $user->birth_date ? $user->birth_date->format('Y') : '' }}"
                                           required
                                           min="1900"
                                           max="2010"
                                           class="mt-1 block w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md shadow-sm placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:text-white sm:text-sm"
                                           placeholder="1990">
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">
                                        <i class="fas fa-info-circle mr-1"></i>
                                        Doğum yılınızı 4 haneli olarak girin
                                    </p>
                                </div>

                                <!-- Submit Button -->
                                <div class="pt-4">
                                    <button type="submit" 
                                            id="identitySubmitBtn"
                                            class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 disabled:opacity-50 disabled:cursor-not-allowed transition-colors duration-200">
                                        <span id="identitySubmitText">
                                            <i class="fas fa-shield-alt mr-2"></i>
                                            Kimliği Doğrula
                                        </span>
                                        <span id="identityLoadingText" class="hidden">
                                            <i class="fas fa-spinner fa-spin mr-2"></i>
                                            Doğrulanıyor...
                                        </span>
                                    </button>
                                </div>

                                <!-- Info Box -->
                                <div class="mt-6 p-4 bg-blue-50 dark:bg-blue-900/20 border border-blue-200 dark:border-blue-800 rounded-md">
                                    <div class="flex">
                                        <div class="flex-shrink-0">
                                            <i class="fas fa-info-circle text-blue-400"></i>
                                        </div>
                                        <div class="ml-3">
                                            <h3 class="text-sm font-medium text-blue-800 dark:text-blue-200">
                                                Kimlik Doğrulama Hakkında
                                            </h3>
                                            <div class="mt-2 text-sm text-blue-700 dark:text-blue-300">
                                                <ul class="list-disc list-inside space-y-1">
                                                    <li>Bilgileriniz NVI (Nüfus ve Vatandaşlık İşleri) sistemi ile doğrulanır</li>
                                                    <li>T.C. kimlik numaranız şifreli olarak saklanır</li>
                                                    <li>Doğrulama işlemi güvenli ve hızlıdır</li>
                                                    <li>Kimlik doğrulaması profil güvenilirliğinizi artırır</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection