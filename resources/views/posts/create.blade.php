@extends('layouts.app')

@section('title', 'Yeni Gönderi Oluştur')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Hata/Başarı Mesajları -->
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Hata:</strong> {{ session('error') }}
            </div>
        @endif

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
                <strong>Başarılı:</strong> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                <strong>Hatalar:</strong>
                <ul class="mt-2 list-disc list-inside">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Başlık -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <h1 class="text-2xl font-bold text-gray-900 mb-2">Yeni Gönderi Oluştur</h1>
            <p class="text-gray-600">Hizmet ilanı, açık artırma, anket, portfolyo veya normal gönderi oluşturabilirsiniz.</p>
        </div>

        <!-- Form -->
        <form action="{{ route('posts.store') }}" method="POST" id="postForm" class="space-y-6">
            @csrf
            
            <!-- Post Tipi Seçimi -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Gönderi Tipi</h2>
                <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                    <label class="post-type-option cursor-pointer">
                        <input type="radio" name="post_type" value="1" class="sr-only" checked>
                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                            <div class="text-2xl mb-2">📝</div>
                            <div class="font-medium">Normal Post</div>
                            <div class="text-sm text-gray-500">Genel paylaşım</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer">
                        <input type="radio" name="post_type" value="2" class="sr-only">
                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                            <div class="text-2xl mb-2">💼</div>
                            <div class="font-medium">Hizmet İlanı</div>
                            <div class="text-sm text-gray-500">Hizmet sat</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer">
                        <input type="radio" name="post_type" value="3" class="sr-only">
                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                            <div class="text-2xl mb-2">🔨</div>
                            <div class="font-medium">Açık Artırma</div>
                            <div class="text-sm text-gray-500">Teklif al</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer">
                        <input type="radio" name="post_type" value="4" class="sr-only">
                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                            <div class="text-2xl mb-2">📊</div>
                            <div class="font-medium">Anket</div>
                            <div class="text-sm text-gray-500">Oy topla</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer">
                        <input type="radio" name="post_type" value="5" class="sr-only">
                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                            <div class="text-2xl mb-2">🎨</div>
                            <div class="font-medium">Portfolyo</div>
                            <div class="text-sm text-gray-500">Çalışma göster</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer">
                        <input type="radio" name="post_type" value="6" class="sr-only">
                        <div class="border-2 border-gray-200 rounded-lg p-4 text-center hover:border-blue-500 transition-colors">
                            <div class="text-2xl mb-2">🚀</div>
                            <div class="font-medium">Freelance Proje</div>
                            <div class="text-sm text-gray-500">Proje ara</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Temel Bilgiler -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Temel Bilgiler</h2>
                
                <div class="space-y-4">
                    <!-- Başlık -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Başlık *</label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Gönderiniz için açıklayıcı bir başlık yazın" required>
                        @error('title')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori *</label>
                        <select id="category_id" name="category_id" 
                                class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" required>
                            <option value="">Kategori seçin</option>
                            <!-- Forum kategorileri (Normal Post ve Anket için) -->
                            <optgroup label="Forum Kategorileri" id="forum-categories" style="display: none;">
                                @foreach($postCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                            <!-- Hizmet kategorileri (Hizmet İlanı ve Açık Artırma için) -->
                            <optgroup label="Hizmet Kategorileri" id="service-categories" style="display: none;">
                                @foreach($serviceCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                            <!-- Proje kategorileri (Portfolyo ve Freelance Proje için) -->
                            <optgroup label="Proje Kategorileri" id="project-categories" style="display: none;">
                                @foreach($projectCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </optgroup>
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- İçerik -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">İçerik *</label>
                        <textarea name="content" id="content-textarea" style="display: none;" required>{{ old('content', '') }}</textarea>
                        <div id="content-editor" style="min-height: 300px;">
                            {!! old('content', '') !!}
                        </div>
                        @error('content')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Etiketler -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Etiketler</label>
                        <input type="text" id="tags" name="tags" value="{{ old('tags') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Etiketleri virgülle ayırın (örn: web tasarım, php, laravel)">
                        <p class="mt-1 text-sm text-gray-500">Gönderinizi daha kolay bulunabilir hale getirmek için etiketler ekleyin.</p>
                    </div>
                </div>
            </div>

            <!-- Hizmet İlanı Alanları -->
            <div id="service-fields" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hidden">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-blue-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 13.255A23.931 23.931 0 0112 15c-3.183 0-6.22-.62-9-1.745M16 6V4a2 2 0 00-2-2h-4a2 2 0 00-2-2v2m8 0V6a2 2 0 012 2v6M8 6V4a2 2 0 012-2h4a2 2 0 012 2v2M8 6v10a2 2 0 002 2h4a2 2 0 002-2V6"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Hizmet Detayları</h2>
                        <p class="text-sm text-gray-500">Hizmetinizin temel bilgilerini ve öğelerini tanımlayın</p>
                    </div>
                </div>
                


                <!-- Hizmet Öğeleri -->
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex items-center justify-between mb-4">
                        <h3 class="text-lg font-medium text-gray-800 flex items-center">
                            <span class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-2">1</span>
                            Hizmet Öğeleri
                        </h3>
                        <button type="button" id="add-service-item" 
                                class="inline-flex items-center px-3 py-2 bg-blue-600 text-white text-sm font-medium rounded-md hover:bg-blue-700 transition-colors">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Öğe Ekle
                        </button>
                    </div>

                    <div id="service-items-container" class="space-y-4">
                        <!-- İlk hizmet öğesi -->
                        <div class="service-item bg-white rounded-lg border border-gray-200 overflow-hidden">
                            <!-- Başlık -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-200">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-medium text-gray-800 flex items-center">
                                        <span class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-2">1</span>
                                        Hizmet Öğesi #1
                                    </h4>
                                    <button type="button" class="remove-service-item text-red-600 hover:text-red-800 text-sm font-medium hidden">
                                        Kaldır
                                    </button>
                                </div>
                            </div>

                            <!-- İçerik -->
                            <div class="p-4 space-y-4">
                                <!-- Başlık ve Fiyat -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Başlık <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="service_items[0][title]" 
                                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="Örn: Temel Logo Tasarımı" data-required-when-service>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            Fiyat (₺) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="service_items[0][price]" 
                                               min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="0.00" data-required-when-service>
                                    </div>
                                </div>

                                <!-- İndirim Fiyatı -->
                                <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                                    <div class="flex items-center mb-3">
                                        <input type="checkbox" name="service_items[0][has_discount]" value="1" 
                                               class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 discount-checkbox"
                                               data-index="0">
                                        <label class="ml-3 text-sm font-medium text-gray-700 flex items-center cursor-pointer">
                                            <svg class="w-4 h-4 text-yellow-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            İndirimli Fiyat Var
                                        </label>
                                    </div>
                                    <div class="discount-price-field hidden">
                                        <label class="block text-sm font-medium text-gray-700 mb-2">
                                            İndirimli Fiyat (₺)
                                        </label>
                                        <input type="number" name="service_items[0][discount_price]" 
                                               min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                               placeholder="0.00">
                                        <p class="mt-1 text-xs text-gray-500">İndirimli fiyat normal fiyattan düşük olmalıdır</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Açıklama
                                    </label>
                                    <textarea name="service_items[0][description]" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                              placeholder="Bu hizmet öğesinin detaylarını açıklayın..."></textarea>
                                </div>

                                <!-- Teslimat Süresi -->
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Teslimat Süresi
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Birim</label>
                                            <select name="service_items[0][delivery_time_unit]" class="delivery-time-unit w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                                <option value="instant">Anında</option>
                                                <option value="hour" selected>Saat</option>
                                                <option value="day">Gün</option>
                                                <option value="week">Hafta</option>
                                                <option value="month">Ay</option>
                                            </select>
                                        </div>
                                        <div class="delivery-time-input">
                                            <label class="block text-xs font-medium text-gray-600 mb-1">Süre</label>
                                            <input type="number" name="service_items[0][delivery_time]" min="1" 
                                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                                   placeholder="1">
                                        </div>
                                    </div>
                                </div>

                                <!-- Satış Tipi -->
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <label class="block text-sm font-medium text-gray-700 mb-3">
                                        Satış Tipi
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <label class="flex items-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
                                            <input type="radio" name="service_items[0][sale_type]" value="internal" checked 
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900">Site İçi Satış</span>
                                                <span class="block text-xs text-gray-500">Platform üzerinden satış</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
                                            <input type="radio" name="service_items[0][sale_type]" value="external" 
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900">Site Dışı Satış</span>
                                                <span class="block text-xs text-gray-500">Harici link ile yönlendirme</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Harici URL (Gizli) -->
                                <div class="external-url-field hidden">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Harici URL <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="url" name="service_items[0][external_url]" 
                                               class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                               placeholder="https://example.com/urun">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500">Müşteriler bu URL'ye yönlendirilecek</p>
                                </div>

                                <!-- Özellikler -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 mb-2">
                                        Özellikler
                                    </label>
                                    <div class="features-container" data-item-index="0">
                                        <div class="flex flex-wrap gap-2 mb-2 min-h-[40px] p-2 border border-gray-300 rounded-md bg-gray-50" id="features-display-0">
                                            <!-- Eklenen özellikler burada görünecek -->
                                        </div>
                                        <div class="flex gap-2">
                                            <input type="text" 
                                                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent feature-input"
                                                   placeholder="Özellik ekleyin (örn: 99% Uptime, Cpanel, Plesk...)"
                                                   maxlength="50">
                                            <button type="button" 
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors add-feature-btn"
                                                    data-item-index="0">
                                                Ekle
                                            </button>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500">Maksimum 5 özellik ekleyebilirsiniz</p>
                                        <!-- Hidden input to store features as JSON -->
                                        <input type="hidden" name="service_items[0][features]" class="features-input" value="">
                                    </div>
                                </div>

                                <!-- Otomatik Teslimat -->
                                <div class="mt-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="service_items[0][auto_delivery]" value="1" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700">Otomatik teslimat</span>
                                    </label>
                                    <p class="mt-1 text-xs text-gray-500">Bu hizmet öğesi otomatik olarak teslim edilsin mi?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Açık Artırma Alanları -->
            <div id="auction-fields" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hidden">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Açık Artırma Detayları</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="auction_starting_price" class="block text-sm font-medium text-gray-700 mb-2">Başlangıç Fiyatı (₺)</label>
                        <input type="number" id="auction_starting_price" name="auction_starting_price" value="{{ old('auction_starting_price') }}" 
                                   min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0.00" data-required-when-auction>
                    </div>
                    
                    <div>
                        <label for="auction_reserve_price" class="block text-sm font-medium text-gray-700 mb-2">Rezerv Fiyat (₺)</label>
                        <input type="number" id="auction_reserve_price" name="auction_reserve_price" value="{{ old('auction_reserve_price') }}" 
                               min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="0.00">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label for="auction_end_time" class="block text-sm font-medium text-gray-700 mb-2">Bitiş Tarihi</label>
                    <input type="datetime-local" id="auction_end_time" name="auction_end_time" value="{{ old('auction_end_time') }}" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" data-required-when-auction>
                </div>
                
                <div class="mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="auction_auto_extend" value="1" {{ old('auction_auto_extend') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Otomatik süre uzatma</span>
                    </label>
                </div>
            </div>

            <!-- Anket Alanları -->
            <div id="poll-fields" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hidden">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Anket Detayları</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="poll_question" class="block text-sm font-medium text-gray-700 mb-2">Anket Sorusu</label>
                        <input type="text" id="poll_question" name="poll_question" value="{{ old('poll_question') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Anket sorunuzu yazın">
                    </div>
                    
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">Anket Seçenekleri</label>
                        <div id="poll-options">
                            <div class="flex mb-2">
                                <input type="text" name="poll_options[]" value="{{ old('poll_options.0') }}" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Seçenek 1" data-required-when-poll>
                            </div>
                            <div class="flex mb-2">
                                <input type="text" name="poll_options[]" value="{{ old('poll_options.1') }}" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="Seçenek 2">
                            </div>
                        </div>
                        <button type="button" id="add-poll-option" class="text-blue-600 hover:text-blue-800 text-sm">+ Seçenek Ekle</button>
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="poll_type" class="block text-sm font-medium text-gray-700 mb-2">Anket Tipi</label>
                            <select id="poll_type" name="poll_type" 
                                    class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                <option value="single" {{ old('poll_type') == 'single' ? 'selected' : '' }}>Tek Seçim</option>
                                <option value="multiple" {{ old('poll_type') == 'multiple' ? 'selected' : '' }}>Çoklu Seçim</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="poll_expires_at" class="block text-sm font-medium text-gray-700 mb-2">Bitiş Tarihi</label>
                            <input type="datetime-local" id="poll_expires_at" name="poll_expires_at" value="{{ old('poll_expires_at') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="poll_anonymous" value="1" {{ old('poll_anonymous') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Anonim oylama</span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Portfolyo Alanları -->
            <div id="portfolio-fields" class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 hidden">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-purple-100 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900">Portfolyo Detayları</h2>
                        <p class="text-sm text-gray-500">Projenizin detaylarını ve kullandığınız teknolojileri belirtin</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <div>
                        <label for="portfolio_project_title" class="block text-sm font-medium text-gray-700 mb-2">Proje Başlığı <span class="text-red-500">*</span></label>
                        <input type="text" id="portfolio_project_title" name="portfolio_project_title" value="{{ old('portfolio_project_title') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                               placeholder="Proje başlığını yazın" data-required-when-portfolio>
                    </div>
                    
                    <div>
                        <label for="portfolio_project_description" class="block text-sm font-medium text-gray-700 mb-2">Proje Açıklaması <span class="text-red-500">*</span></label>
                        <textarea id="portfolio_project_description" name="portfolio_project_description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                  placeholder="Proje hakkında detaylı açıklama yazın..." data-required-when-portfolio>{{ old('portfolio_project_description') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="portfolio_project_url" class="block text-sm font-medium text-gray-700 mb-2">Proje URL'si</label>
                        <div class="relative">
                            <input type="url" id="portfolio_project_url" name="portfolio_project_url" value="{{ old('portfolio_project_url') }}" 
                                   class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent"
                                   placeholder="https://example.com">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Projenizin canlı linkini paylaşın (isteğe bağlı)</p>
                    </div>
                    
                    <!-- Kullanılan Teknolojiler -->
                    <div class="bg-gray-50 rounded-lg p-4">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Kullanılan Teknolojiler
                        </label>
                        <div class="technologies-container">
                            <div class="flex flex-wrap gap-2 mb-2 min-h-[40px] p-2 border border-gray-300 rounded-md bg-white" id="technologies-display">
                                <!-- Eklenen teknolojiler burada görünecek -->
                            </div>
                            <div class="flex gap-2">
                                <input type="text" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent technology-input"
                                       placeholder="Teknoloji ekleyin (örn: PHP, Laravel, MySQL, JavaScript...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors add-technology-btn">
                                    Ekle
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Maksimum 10 teknoloji ekleyebilirsiniz</p>
                            <!-- Hidden input to store technologies as JSON -->
                            <input type="hidden" name="portfolio_technologies" class="technologies-input" value="{{ old('portfolio_technologies', '[]') }}">
                        </div>
                    </div>
                    
                    <div>
                        <label for="portfolio_completion_date" class="block text-sm font-medium text-gray-700 mb-2">Tamamlanma Tarihi</label>
                        <input type="date" id="portfolio_completion_date" name="portfolio_completion_date" value="{{ old('portfolio_completion_date') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <p class="mt-1 text-xs text-gray-500">Projenin tamamlandığı tarihi belirtin (isteğe bağlı)</p>
                    </div>
                </div>
            </div>

            <!-- Form Butonları -->
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
                <div class="flex justify-between items-center">
                    <a href="{{ route('home') }}" class="px-4 py-2 text-gray-600 hover:text-gray-800 transition-colors">
                        İptal
                    </a>
                    
                    <div class="space-x-3">
                        <button type="button" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-md hover:bg-gray-50 transition-colors">
                            Taslak Kaydet
                        </button>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                            Yayınla
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const postTypeInputs = document.querySelectorAll('input[name="post_type"]');
    const serviceFields = document.getElementById('service-fields');
    const auctionFields = document.getElementById('auction-fields');
    const pollFields = document.getElementById('poll-fields');
    const portfolioFields = document.getElementById('portfolio-fields');
    
    // Kategori filtreleme için elementler
    const forumCategories = document.getElementById('forum-categories');
    const serviceCategories = document.getElementById('service-categories');
    const projectCategories = document.getElementById('project-categories');
    const categorySelect = document.getElementById('category_id');
    
    let serviceItemCounter = 1;

    // Kategori filtreleme fonksiyonu
    function filterCategories(postType) {
        // Önce tüm kategorileri gizle
        forumCategories.style.display = 'none';
        serviceCategories.style.display = 'none';
        projectCategories.style.display = 'none';
        
        // Kategori seçimini sıfırla
        categorySelect.value = '';
        
        // Post tipine göre kategorileri göster
        if (postType === '1' || postType === '4') { // Normal Post veya Anket (post kategorileri)
            forumCategories.style.display = 'block';
        } else if (postType === '2' || postType === '3') { // Hizmet İlanı veya Açık Artırma (service kategorileri)
            serviceCategories.style.display = 'block';
        } else if (postType === '5' || postType === '6') { // Portfolyo veya Freelance Proje (project kategorileri)
            projectCategories.style.display = 'block';
        } else {
            // Diğer post tipleri için forum kategorilerini göster
            forumCategories.style.display = 'block';
        }
    }

    // Post tipi değişikliklerini dinle
    postTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Kategori filtreleme
            filterCategories(this.value);
            
            // Tüm alanları gizle ve required attributelarını kaldır
            serviceFields.classList.add('hidden');
            auctionFields.classList.add('hidden');
            pollFields.classList.add('hidden');
            portfolioFields.classList.add('hidden');
            
            // Tüm required attributelarını kaldır
            document.querySelectorAll('[data-required-when-service], [data-required-when-auction], [data-required-when-poll], [data-required-when-portfolio]').forEach(field => {
                field.removeAttribute('required');
            });
            
            // Seçili tipe göre alanları göster ve required ekle
            switch(this.value) {
                case '2': // Hizmet ilanı
                    serviceFields.classList.remove('hidden');
                    document.querySelectorAll('#service-fields [data-required-when-service]').forEach(field => field.setAttribute('required', ''));
                    break;
                case '3': // Açık artırma
                    auctionFields.classList.remove('hidden');
                    document.querySelectorAll('#auction-fields [data-required-when-auction]').forEach(field => field.setAttribute('required', ''));
                    break;
                case '4': // Anket
                    pollFields.classList.remove('hidden');
                    document.querySelectorAll('#poll-fields [data-required-when-poll]').forEach(field => field.setAttribute('required', ''));
                    break;
                case '5': // Portfolyo
                    portfolioFields.classList.remove('hidden');
                    document.querySelectorAll('#portfolio-fields [data-required-when-portfolio]').forEach(field => field.setAttribute('required', ''));
                    break;
            }
            
            // Görsel feedback
            document.querySelectorAll('.post-type-option div').forEach(div => {
                div.classList.remove('border-blue-500', 'bg-blue-50');
                div.classList.add('border-gray-200');
            });
            
            this.closest('.post-type-option').querySelector('div').classList.remove('border-gray-200');
            this.closest('.post-type-option').querySelector('div').classList.add('border-blue-500', 'bg-blue-50');
        });
    });

    // Sayfa yüklendiğinde varsayılan olarak Normal Post seçili olduğu için forum kategorilerini göster
    filterCategories('1');

    // Hizmet alanları için event listener'lar
    if (serviceFields) {
        let serviceItemCounter = 1;

        // Ana hizmet satış tipi kontrolü
        const serviceSaleTypeInputs = document.querySelectorAll('input[name="service_sale_type"]');
        const serviceExternalUrlField = document.getElementById('service-external-url-field');
        
        serviceSaleTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'external') {
                    serviceExternalUrlField.classList.remove('hidden');
                    serviceExternalUrlField.querySelector('input').setAttribute('required', '');
                } else {
                    serviceExternalUrlField.classList.add('hidden');
                    serviceExternalUrlField.querySelector('input').removeAttribute('required');
                }
            });
        });

        // Teslimat süresi kontrolü
        // Hizmet öğesi ekleme
        const addServiceItemBtn = document.getElementById('add-service-item');
        const serviceItemsContainer = document.getElementById('service-items-container');

        // Mevcut hizmet öğeleri için indirim checkbox event listener'ları ekle
        const existingDiscountCheckboxes = serviceItemsContainer.querySelectorAll('.discount-checkbox');
        existingDiscountCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                const discountField = this.closest('.service-item').querySelector('.discount-price-field');
                if (this.checked) {
                    discountField.classList.remove('hidden');
                } else {
                    discountField.classList.add('hidden');
                    discountField.querySelector('input').value = '';
                }
            });
        });

        // Mevcut hizmet öğeleri için teslimat süresi event listener'ları ekle
        const existingDeliveryTimeUnits = serviceItemsContainer.querySelectorAll('.delivery-time-unit');
        existingDeliveryTimeUnits.forEach(select => {
            select.addEventListener('change', function() {
                const deliveryTimeInput = this.closest('.service-item').querySelector('.delivery-time-input');
                if (this.value === 'instant') {
                    deliveryTimeInput.classList.add('hidden');
                } else {
                    deliveryTimeInput.classList.remove('hidden');
                }
            });
        });

        // Mevcut hizmet öğeleri için satış tipi event listener'ları ekle
        const existingSaleTypeInputs = serviceItemsContainer.querySelectorAll('input[name*="[sale_type]"]');
        existingSaleTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                const externalUrlField = this.closest('.service-item').querySelector('.external-url-field');
                if (this.value === 'external') {
                    externalUrlField.classList.remove('hidden');
                    externalUrlField.querySelector('input').setAttribute('required', '');
                } else {
                    externalUrlField.classList.add('hidden');
                    externalUrlField.querySelector('input').removeAttribute('required');
                }
            });
        });

        addServiceItemBtn.addEventListener('click', function() {
            const newItem = document.createElement('div');
            newItem.className = 'service-item bg-white rounded-lg border border-gray-200 overflow-hidden';
            newItem.innerHTML = `
                <!-- Başlık -->
                <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-4 py-3 border-b border-gray-200">
                    <div class="flex justify-between items-center">
                        <h4 class="font-medium text-gray-800 flex items-center">
                            <span class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-2">${serviceItemCounter + 1}</span>
                            Hizmet Öğesi #${serviceItemCounter + 1}
                        </h4>
                        <button type="button" class="remove-service-item text-red-600 hover:text-red-800 text-sm font-medium">
                            Kaldır
                        </button>
                    </div>
                </div>

                <!-- İçerik -->
                <div class="p-4 space-y-4">
                    <!-- Başlık ve Fiyat -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Başlık <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="service_items[${serviceItemCounter}][title]" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Örn: Temel Logo Tasarımı" data-required-when-service>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                Fiyat (₺) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="service_items[${serviceItemCounter}][price]" 
                                   min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="0.00" data-required-when-service>
                        </div>
                    </div>

                    <!-- İndirim Fiyatı -->
                    <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                        <div class="flex items-center mb-3">
                            <input type="checkbox" name="service_items[${serviceItemCounter}][has_discount]" value="1" 
                                   class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 discount-checkbox"
                                   data-index="${serviceItemCounter}">
                            <label class="ml-3 text-sm font-medium text-gray-700 flex items-center cursor-pointer">
                                <svg class="w-4 h-4 text-yellow-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                                İndirimli Fiyat Var
                            </label>
                        </div>
                        <div class="discount-price-field hidden">
                            <label class="block text-sm font-medium text-gray-700 mb-2">
                                İndirimli Fiyat (₺)
                            </label>
                            <input type="number" name="service_items[${serviceItemCounter}][discount_price]" 
                                   min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent"
                                   placeholder="0.00">
                            <p class="mt-1 text-xs text-gray-500">İndirimli fiyat normal fiyattan düşük olmalıdır</p>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Açıklama
                        </label>
                        <textarea name="service_items[${serviceItemCounter}][description]" rows="3"
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Bu hizmet öğesinin detaylarını açıklayın..."></textarea>
                    </div>

                    <!-- Teslimat Süresi -->
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Teslimat Süresi
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-600 mb-1">Birim</label>
                                <select name="service_items[${serviceItemCounter}][delivery_time_unit]" class="delivery-time-unit w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                                    <option value="instant">Anında</option>
                                    <option value="hour" selected>Saat</option>
                                    <option value="day">Gün</option>
                                    <option value="week">Hafta</option>
                                    <option value="month">Ay</option>
                                </select>
                            </div>
                            <div class="delivery-time-input">
                                <label class="block text-xs font-medium text-gray-600 mb-1">Süre</label>
                                <input type="number" name="service_items[${serviceItemCounter}][delivery_time]" min="1" 
                                       class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                       placeholder="1">
                            </div>
                        </div>
                    </div>

                    <!-- Satış Tipi -->
                    <div class="bg-gray-50 rounded-lg p-3">
                        <label class="block text-sm font-medium text-gray-700 mb-3">
                            Satış Tipi
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="flex items-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
                                <input type="radio" name="service_items[${serviceItemCounter}][sale_type]" value="internal" checked 
                                       class="text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">Site İçi Satış</span>
                                    <span class="block text-xs text-gray-500">Platform üzerinden satış</span>
                                </div>
                            </label>
                            <label class="flex items-center p-3 bg-white border border-gray-200 rounded-lg cursor-pointer hover:bg-blue-50 transition-colors">
                                <input type="radio" name="service_items[${serviceItemCounter}][sale_type]" value="external" 
                                       class="text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900">Site Dışı Satış</span>
                                    <span class="block text-xs text-gray-500">Harici link ile yönlendirme</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Harici URL (Gizli) -->
                    <div class="external-url-field hidden">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Harici URL <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <input type="url" name="service_items[${serviceItemCounter}][external_url]" 
                                   class="w-full px-3 py-2 pl-10 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="https://example.com/urun">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                            </div>
                        </div>
                        <p class="mt-1 text-xs text-gray-500">Müşteriler bu URL'ye yönlendirilecek</p>
                    </div>

                    <!-- Özellikler -->
                    <div class="mt-4">
                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Özellikler
                        </label>
                        <div class="features-container" data-item-index="${serviceItemCounter}">
                            <div class="flex flex-wrap gap-2 mb-2 min-h-[40px] p-2 border border-gray-300 rounded-md bg-gray-50" id="features-display-${serviceItemCounter}">
                                <!-- Eklenen özellikler burada görünecek -->
                            </div>
                            <div class="flex gap-2">
                                <input type="text" 
                                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent feature-input"
                                       placeholder="Özellik ekleyin (örn: 99% Uptime, Cpanel, Plesk...)"
                                       maxlength="50">
                                <button type="button" 
                                        class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors add-feature-btn"
                                        data-item-index="${serviceItemCounter}">
                                    Ekle
                                </button>
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Maksimum 5 özellik ekleyebilirsiniz</p>
                            <!-- Hidden input to store features as JSON -->
                            <input type="hidden" name="service_items[${serviceItemCounter}][features]" class="features-input" value="">
                        </div>
                    </div>

                    <!-- Otomatik Teslimat -->
                    <div class="mt-4">
                        <label class="flex items-center">
                            <input type="checkbox" name="service_items[${serviceItemCounter}][auto_delivery]" value="1" 
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700">Otomatik teslimat</span>
                        </label>
                        <p class="mt-1 text-xs text-gray-500">Bu hizmet öğesi otomatik olarak teslim edilsin mi?</p>
                    </div>
                </div>
            `;

            serviceItemsContainer.appendChild(newItem);
            
            // Yeni eklenen öğe için satış tipi event listener'ı ekle
            const newSaleTypeInputs = newItem.querySelectorAll('input[name*="[sale_type]"]');
            const newExternalUrlField = newItem.querySelector('.external-url-field');
            
            newSaleTypeInputs.forEach(input => {
                input.addEventListener('change', function() {
                    if (this.value === 'external') {
                        newExternalUrlField.classList.remove('hidden');
                        newExternalUrlField.querySelector('input').setAttribute('required', '');
                    } else {
                        newExternalUrlField.classList.add('hidden');
                        newExternalUrlField.querySelector('input').removeAttribute('required');
                    }
                });
            });

            // Yeni eklenen öğe için indirim checkbox event listener'ı ekle
            const newDiscountCheckbox = newItem.querySelector('.discount-checkbox');
            const newDiscountField = newItem.querySelector('.discount-price-field');
            
            newDiscountCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    newDiscountField.classList.remove('hidden');
                } else {
                    newDiscountField.classList.add('hidden');
                    newDiscountField.querySelector('input').value = '';
                }
            });

            // Yeni eklenen öğe için teslimat süresi event listener'ı ekle
            const newDeliveryTimeUnit = newItem.querySelector('.delivery-time-unit');
            const newDeliveryTimeInput = newItem.querySelector('.delivery-time-input');
            
            newDeliveryTimeUnit.addEventListener('change', function() {
                if (this.value === 'instant') {
                    newDeliveryTimeInput.classList.add('hidden');
                } else {
                    newDeliveryTimeInput.classList.remove('hidden');
                }
            });

            // Yeni eklenen öğe için özellik ekleme event listener'ı ekle
            setupFeatureHandlers(newItem);
            
            serviceItemCounter++;
            updateRemoveButtons();
        });

        // Hizmet öğesi kaldırma
        serviceItemsContainer.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-service-item')) {
                e.target.closest('.service-item').remove();
                updateRemoveButtons();
            }
        });

        // İlk hizmet öğesi için özellik handler'larını ayarla
        const firstServiceItem = serviceItemsContainer.querySelector('.service-item');
        if (firstServiceItem) {
            setupFeatureHandlers(firstServiceItem);
        }

        function setupFeatureHandlers(serviceItem) {
            const addFeatureBtn = serviceItem.querySelector('.add-feature-btn');
            const featureInput = serviceItem.querySelector('.feature-input');
            const featuresDisplay = serviceItem.querySelector('[id^="features-display-"]');
            const featuresHiddenInput = serviceItem.querySelector('.features-input');
            const itemIndex = addFeatureBtn.getAttribute('data-item-index');
            
            let features = [];

            // Özellik ekleme
            function addFeature() {
                const featureText = featureInput.value.trim();
                if (featureText && features.length < 5 && !features.includes(featureText)) {
                    features.push(featureText);
                    updateFeaturesDisplay();
                    featureInput.value = '';
                    updateFeaturesInput();
                }
            }

            // Özellik görünümünü güncelle
            function updateFeaturesDisplay() {
                featuresDisplay.innerHTML = '';
                features.forEach((feature, index) => {
                    const featureTag = document.createElement('span');
                    featureTag.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 text-blue-800';
                    featureTag.innerHTML = `
                        ${feature}
                        <button type="button" class="ml-2 text-blue-600 hover:text-blue-800" onclick="removeFeature(${itemIndex}, ${index})">
                            ×
                        </button>
                    `;
                    featuresDisplay.appendChild(featureTag);
                });
                
                // Maksimum 5 özellik kontrolü
                if (features.length >= 5) {
                    featureInput.disabled = true;
                    addFeatureBtn.disabled = true;
                    featureInput.placeholder = 'Maksimum 5 özellik eklenmiştir';
                } else {
                    featureInput.disabled = false;
                    addFeatureBtn.disabled = false;
                    featureInput.placeholder = 'Özellik ekleyin (örn: 99% Uptime, Cpanel, Plesk...)';
                }
            }

            // Hidden input'u güncelle
            function updateFeaturesInput() {
                featuresHiddenInput.value = JSON.stringify(features);
            }

            // Global fonksiyon olarak özellik kaldırma
            window.removeFeature = function(itemIndex, featureIndex) {
                const targetServiceItem = document.querySelector(`[data-item-index="${itemIndex}"]`).closest('.service-item');
                const targetFeatures = JSON.parse(targetServiceItem.querySelector('.features-input').value || '[]');
                targetFeatures.splice(featureIndex, 1);
                
                // İlgili service item'ın features array'ini güncelle
                const targetAddBtn = targetServiceItem.querySelector('.add-feature-btn');
                const targetItemIndex = targetAddBtn.getAttribute('data-item-index');
                
                if (targetItemIndex == itemIndex) {
                    features = targetFeatures;
                    updateFeaturesDisplay();
                    updateFeaturesInput();
                }
            };

            // Event listener'lar
            addFeatureBtn.addEventListener('click', addFeature);
            
            featureInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter') {
                    e.preventDefault();
                    addFeature();
                }
            });
        }

        function updateRemoveButtons() {
            const items = serviceItemsContainer.querySelectorAll('.service-item');
            items.forEach((item, index) => {
                const removeBtn = item.querySelector('.remove-service-item');
                if (items.length > 1) {
                    removeBtn.classList.remove('hidden');
                } else {
                    removeBtn.classList.add('hidden');
                }
                
                // Başlık numarasını güncelle
                const title = item.querySelector('h4');
                title.textContent = `Hizmet Öğesi #${index + 1}`;
            });
        }
    }
    
    // Anket seçeneği ekleme
    const addPollOptionBtn = document.getElementById('add-poll-option');
    if (addPollOptionBtn) {
        addPollOptionBtn.addEventListener('click', function() {
            const pollOptions = document.getElementById('poll-options');
            const optionCount = pollOptions.children.length + 1;
            
            const newOption = document.createElement('div');
            newOption.className = 'flex mb-2';
            newOption.innerHTML = `
                <input type="text" name="poll_options[]" 
                       class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                       placeholder="Seçenek ${optionCount}" data-required-when-poll>
                <button type="button" class="ml-2 px-3 py-2 text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
                    ✕
                </button>
            `;
            
            pollOptions.appendChild(newOption);
        });
    }

    // Form gönderimi öncesi doğrulama
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const selectedType = document.querySelector('input[name="post_type"]:checked').value;
        
        if (selectedType === '5') { // Portfolio
            const portfolioTitle = document.getElementById('portfolio_project_title').value.trim();
            const portfolioDescription = document.getElementById('portfolio_project_description').value.trim();
            
            if (!portfolioTitle || !portfolioDescription) {
                e.preventDefault();
                alert('Portfolio için proje başlığı ve açıklaması zorunludur.');
                return false;
            }
        }
        
        if (selectedType === '2') { // Hizmet
            const serviceItems = document.querySelectorAll('.service-item');
            let hasValidItem = false;
            
            serviceItems.forEach(item => {
                const title = item.querySelector('input[name*="[title]"]').value.trim();
                if (title) {
                    hasValidItem = true;
                }
            });
            
            if (!hasValidItem) {
                e.preventDefault();
                alert('En az bir hizmet öğesi başlığı gereklidir.');
                return false;
            }
        }
    });
    
    // Teknoloji ekleme/çıkarma işlemleri (Portfolio için)
    const technologyInput = document.querySelector('.technology-input');
    const addTechnologyBtn = document.querySelector('.add-technology-btn');
    const technologiesDisplay = document.getElementById('technologies-display');
    const technologiesHiddenInput = document.querySelector('.technologies-input');
    
    let technologies = [];
    
    // Eski değerleri yükle
    if (technologiesHiddenInput && technologiesHiddenInput.value) {
        try {
            technologies = JSON.parse(technologiesHiddenInput.value);
            updateTechnologiesDisplay();
        } catch (e) {
            technologies = [];
        }
    }
    
    if (addTechnologyBtn && technologyInput) {
        addTechnologyBtn.addEventListener('click', function() {
            addTechnology();
        });
        
        technologyInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTechnology();
            }
        });
    }
    
    function addTechnology() {
        const value = technologyInput.value.trim();
        
        if (value === '') {
            alert('Lütfen bir teknoloji adı girin.');
            return;
        }
        
        if (technologies.length >= 10) {
            alert('Maksimum 10 teknoloji ekleyebilirsiniz.');
            return;
        }
        
        if (technologies.includes(value)) {
            alert('Bu teknoloji zaten eklenmiş.');
            return;
        }
        
        technologies.push(value);
        updateTechnologiesDisplay();
        updateHiddenInput();
        technologyInput.value = '';
    }
    
    function removeTechnology(index) {
        technologies.splice(index, 1);
        updateTechnologiesDisplay();
        updateHiddenInput();
    }
    
    function updateTechnologiesDisplay() {
        if (!technologiesDisplay) return;
        
        technologiesDisplay.innerHTML = '';
        
        technologies.forEach((tech, index) => {
            const techElement = document.createElement('span');
            techElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 text-purple-800 border border-purple-200';
            techElement.innerHTML = `
                ${tech}
                <button type="button" class="ml-2 text-purple-600 hover:text-purple-800" onclick="removeTechnology(${index})">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            technologiesDisplay.appendChild(techElement);
        });
        
        if (technologies.length === 0) {
            const placeholder = document.createElement('span');
            placeholder.className = 'text-gray-400 text-sm';
            placeholder.textContent = 'Henüz teknoloji eklenmedi';
            technologiesDisplay.appendChild(placeholder);
        }
    }
    
    function updateHiddenInput() {
        if (technologiesHiddenInput) {
            technologiesHiddenInput.value = JSON.stringify(technologies);
        }
    }
    
    // Global fonksiyon olarak tanımla
    window.removeTechnology = removeTechnology;

    // İlk yükleme için varsayılan seçimi aktif et
    const checkedInput = document.querySelector('input[name="post_type"]:checked');
    if (checkedInput) {
        checkedInput.dispatchEvent(new Event('change'));
    }
});
</script>

<!-- Quill.js CSS -->
<link href="{{ asset('js/quill/quill.snow.css') }}" rel="stylesheet">

<!-- Quill.js Script -->
<script src="{{ asset('js/quill/quill.js') }}"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Gizli textarea ve editör div'ini al
    const hiddenTextarea = document.getElementById('content-textarea');
    const editorDiv = document.getElementById('content-editor');
    
    // Quill editörünü başlat
    const quill = new Quill('#content-editor', {
        theme: 'snow',
        placeholder: 'İçeriğinizi buraya yazın...',
        modules: {
            toolbar: [
                [{ 'header': [1, 2, 3, false] }],
                ['bold', 'italic', 'underline', 'strike'],
                [{ 'color': [] }, { 'background': [] }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                [{ 'align': [] }],
                ['blockquote', 'code-block'],
                ['link'],
                ['clean']
            ]
        },
        formats: [
            'header', 'bold', 'italic', 'underline', 'strike',
            'color', 'background', 'list', 'bullet', 'align',
            'blockquote', 'code-block', 'link'
        ]
    });

    // Quill içeriği değiştiğinde gizli textarea'yı güncelle
    quill.on('text-change', function() {
        const content = quill.root.innerHTML;
        const cleanContent = sanitizeHTML(content);
        hiddenTextarea.value = cleanContent;
        
        // Otomatik kaydetme (localStorage)
        clearTimeout(window.autoSaveTimer);
        window.autoSaveTimer = setTimeout(function() {
            localStorage.setItem('quill-autosave-content', cleanContent);
        }, 2000);
    });

    // Sayfa yüklendiğinde mevcut içeriği Quill'e yükle
    const initialContent = hiddenTextarea.value;
    if (initialContent && initialContent.trim() !== '') {
        quill.root.innerHTML = initialContent;
    }

    // Sayfa yüklendiğinde otomatik kaydedilen içeriği geri yükle (eğer form boşsa)
    const savedContent = localStorage.getItem('quill-autosave-content');
    if (savedContent && (!initialContent || initialContent.trim() === '') && quill.root.innerHTML.trim() === '<p><br></p>') {
        quill.root.innerHTML = savedContent;
        hiddenTextarea.value = savedContent;
    }

    // Form gönderildiğinde son kez güncelle ve otomatik kaydetmeyi temizle
    const form = document.querySelector('form');
    form.addEventListener('submit', function(e) {
        const content = quill.root.innerHTML;
        const cleanContent = sanitizeHTML(content);
        hiddenTextarea.value = cleanContent;
        localStorage.removeItem('quill-autosave-content');
    });

    // Basit HTML sanitizer fonksiyonu
    function sanitizeHTML(html) {
        // Güvenlik için sadece güvenli HTML etiketlerine izin ver
        const allowedTags = ['p', 'br', 'strong', 'em', 'u', 's', 'ol', 'ul', 'li', 'a', 'blockquote', 'h1', 'h2', 'h3', 'pre', 'span'];
        const allowedAttributes = {
            'a': ['href', 'target'],
            'span': ['style'],
            'p': ['style'],
            'h1': ['style'],
            'h2': ['style'],
            'h3': ['style']
        };
        
        const div = document.createElement('div');
        div.innerHTML = html;
        
        // Sadece izin verilen etiketleri tut
        const walker = document.createTreeWalker(
            div,
            NodeFilter.SHOW_ELEMENT,
            null,
            false
        );
        
        const nodesToRemove = [];
        let node;
        
        while (node = walker.nextNode()) {
            if (!allowedTags.includes(node.tagName.toLowerCase())) {
                nodesToRemove.push(node);
            } else {
                // İzin verilen attributeları kontrol et
                const allowedAttrs = allowedAttributes[node.tagName.toLowerCase()] || [];
                const attrs = Array.from(node.attributes);
                
                attrs.forEach(attr => {
                    if (!allowedAttrs.includes(attr.name)) {
                        node.removeAttribute(attr.name);
                    }
                });
            }
        }
        
        // İzin verilmeyen etiketleri kaldır
        nodesToRemove.forEach(node => {
            if (node.parentNode) {
                // İçeriği koru, sadece etiketi kaldır
                while (node.firstChild) {
                    node.parentNode.insertBefore(node.firstChild, node);
                }
                node.parentNode.removeChild(node);
            }
        });
        
        return div.innerHTML;
    }
});
</script>
@endsection