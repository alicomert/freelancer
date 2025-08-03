@extends('layouts.app')

@section('title', 'Hizmet İlanı Oluştur')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-5xl">
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
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
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-8 mb-8 border border-gray-100 dark:border-gray-700">
            <div class="flex items-center mb-4">
                <div class="w-12 h-12 bg-gradient-to-br from-green-500 to-green-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-1">Hizmet İlanı Oluştur</h1>
                    <p class="text-gray-600 dark:text-gray-400">Hizmetinizi satın ve müşteri bulun.</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('posts.store') }}" method="POST" id="serviceForm" class="space-y-6">
            @csrf
            <input type="hidden" name="post_type" value="2">
            
            <!-- Temel Bilgiler -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">📝</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Temel Bilgiler</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Hizmetinizin temel bilgilerini girin</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Başlık -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Hizmet Başlığı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200" 
                               placeholder="Hizmetiniz için açıklayıcı bir başlık yazın" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Hizmet Kategorisi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="category_id" name="category_id" 
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 appearance-none transition-all duration-200" required>
                                <option value="">Kategori seçin</option>
                                @foreach($serviceCategories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- İçerik -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Hizmet Açıklaması <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content-textarea" rows="4" placeholder="Hizmetiniz hakkında ne düşünüyorsunuz?" class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 resize-none transition-all duration-200" required>{{ old('content', '') }}</textarea>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Etiketler -->
                    <div>
                        <label for="tags" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Etiketler
                        </label>
                        
                        <div class="tags-container">
                            <div class="flex flex-wrap gap-2 mb-2 min-h-[40px] p-3 border border-gray-200 dark:border-gray-700 rounded-lg bg-gray-50 dark:bg-gray-800" id="tags-display">
                                <!-- Eklenen etiketler burada görünecek -->
                            </div>
                            <div class="flex gap-2">
                                <input type="text" 
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 tag-input"
                                       placeholder="Etiket ekleyin (örn: web tasarım, logo, grafik...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-6 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-sm hover:shadow-md add-tag-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <input type="hidden" id="tags" name="tags" value="{{ old('tags') }}">
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Hizmetinizi daha kolay bulunabilir hale getirmek için etiketler ekleyin. (Maksimum 10 etiket)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Hizmet Öğeleri -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">🛠️</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Hizmet Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Hizmetinizin temel bilgilerini ve öğelerini tanımlayın</p>
                    </div>
                </div>

                <!-- Hizmet Öğeleri -->
                <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center justify-between mb-6">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 flex items-center">
                            <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">1</div>
                            Hizmet Öğeleri
                        </h3>
                        <button type="button" id="add-service-item" 
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg hover:bg-blue-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Öğe Ekle
                        </button>
                    </div>

                    <div id="service-items-container" class="space-y-6">
                        <!-- İlk hizmet öğesi -->
                        <div class="service-item bg-white dark:bg-gray-900 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm">
                            <!-- Başlık -->
                            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                                <div class="flex justify-between items-center">
                                    <h4 class="font-medium text-gray-800 dark:text-gray-200 flex items-center">
                                        <div class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">1</div>
                                        Hizmet Öğesi #1
                                    </h4>
                                    <button type="button" class="remove-service-item text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium hidden transition-colors duration-200">
                                        Kaldır
                                    </button>
                                </div>
                            </div>

                            <!-- İçerik -->
                            <div class="p-6 space-y-6">
                                <!-- Başlık ve Fiyat -->
                                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            Başlık <span class="text-red-500">*</span>
                                        </label>
                                        <input type="text" name="service_items[0][title]" 
                                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                               placeholder="Örn: Temel Logo Tasarımı" data-required-when-service>
                                    </div>

                                    <div>
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                            </svg>
                                            Fiyat (₺) <span class="text-red-500">*</span>
                                        </label>
                                        <input type="number" name="service_items[0][price]" 
                                               min="0" step="0.01" class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                               placeholder="0.00" data-required-when-service>
                                    </div>
                                </div>

                                <!-- İndirim Fiyatı -->
                                <div class="bg-yellow-50 dark:bg-yellow-900/20 rounded-lg p-4 border border-yellow-200 dark:border-yellow-700">
                                    <div class="flex items-center mb-3">
                                        <input type="checkbox" name="service_items[0][has_discount]" value="1" 
                                               class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 discount-checkbox"
                                               data-index="0"
                                               id="discount-checkbox-0">
                                        <label for="discount-checkbox-0" class="ml-3 text-sm font-medium text-gray-700 dark:text-gray-300 flex items-center cursor-pointer">
                                            <svg class="w-4 h-4 text-yellow-600 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                            </svg>
                                            İndirimli Fiyat Var
                                        </label>
                                    </div>
                                    <div class="discount-price-field hidden">
                                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                            İndirimli Fiyat (₺)
                                        </label>
                                        <input type="number" name="service_items[0][discount_price]" 
                                               min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-yellow-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                               placeholder="0.00">
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">İndirimli fiyat normal fiyattan düşük olmalıdır</p>
                                    </div>
                                </div>

                                <div>
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Açıklama
                                    </label>
                                    <textarea name="service_items[0][description]" rows="3"
                                              class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                              placeholder="Bu hizmet öğesinin detaylarını açıklayın..."></textarea>
                                </div>

                                <!-- Teslimat Süresi -->
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                        Teslimat Süresi
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <div>
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Birim</label>
                                            <select name="service_items[0][delivery_time_unit]" class="delivery-time-unit w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100">
                                                <option value="instant">Anında</option>
                                                <option value="hour" selected>Saat</option>
                                                <option value="day">Gün</option>
                                                <option value="week">Hafta</option>
                                                <option value="month">Ay</option>
                                            </select>
                                        </div>
                                        <div class="delivery-time-input">
                                            <label class="block text-xs font-medium text-gray-600 dark:text-gray-400 mb-1">Süre</label>
                                            <input type="number" name="service_items[0][delivery_time]" min="1" 
                                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100"
                                                   placeholder="1">
                                        </div>
                                    </div>
                                </div>

                                <!-- Satış Tipi -->
                                <div class="bg-gray-50 dark:bg-gray-800 rounded-lg p-3">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">
                                        Satış Tipi
                                    </label>
                                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                        <label class="flex items-center p-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                            <input type="radio" name="service_items[0][sale_type]" value="internal" checked 
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Site İçi Satış</span>
                                                <span class="block text-xs text-gray-500 dark:text-gray-400">Platform üzerinden satış</span>
                                            </div>
                                        </label>
                                        <label class="flex items-center p-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                            <input type="radio" name="service_items[0][sale_type]" value="external" 
                                                   class="text-blue-600 focus:ring-blue-500">
                                            <div class="ml-3">
                                                <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Site Dışı Satış</span>
                                                <span class="block text-xs text-gray-500 dark:text-gray-400">Harici link ile yönlendirme</span>
                                            </div>
                                        </label>
                                    </div>
                                </div>

                                <!-- Harici URL (Gizli) -->
                                <div class="external-url-field hidden">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Harici URL <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <input type="url" name="service_items[0][external_url]" 
                                               class="w-full px-3 py-2 pl-10 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                               placeholder="https://example.com/urun">
                                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                            <svg class="h-4 w-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                            </svg>
                                        </div>
                                    </div>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Müşteriler bu URL'ye yönlendirilecek</p>
                                </div>

                                <!-- Özellikler -->
                                <div class="mt-4">
                                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Özellikler
                                    </label>
                                    <div class="features-container" data-item-index="0">
                                        <div class="flex flex-wrap gap-2 mb-2 min-h-[40px] p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-800" id="features-display-0">
                                            <!-- Eklenen özellikler burada görünecek -->
                                        </div>
                                        <div class="flex gap-2">
                                            <input type="text" 
                                                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 feature-input"
                                                   placeholder="Özellik ekleyin (örn: 99% Uptime, Cpanel, Plesk...)"
                                                   maxlength="50">
                                            <button type="button" 
                                                    class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors add-feature-btn"
                                                    data-item-index="0">
                                                Ekle
                                            </button>
                                        </div>
                                        <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Maksimum 5 özellik ekleyebilirsiniz</p>
                                        <!-- Hidden input to store features as JSON -->
                                        <input type="hidden" name="service_items[0][features]" class="features-input" value="">
                                    </div>
                                </div>

                                <!-- Otomatik Teslimat -->
                                <div class="mt-4">
                                    <label class="flex items-center">
                                        <input type="checkbox" name="service_items[0][auto_delivery]" value="1" 
                                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Otomatik teslimat</span>
                                    </label>
                                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Bu hizmet öğesi otomatik olarak teslim edilsin mi?</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('posts.create') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200">
                    ← Geri Dön
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-green-600 to-green-700 text-white rounded-lg hover:from-green-700 hover:to-green-800 transition-all duration-200 shadow-sm hover:shadow-md">
                    Hizmet İlanını Yayınla
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Quill kaldırıldı --}}
{{-- <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script> --}}
{{-- <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet"> --}}

<script>
document.addEventListener('DOMContentLoaded', function() {
    /*
    // Quill Editor disabled
    var quill = new Quill('#content-editor', {
        theme: 'snow',
        placeholder: 'Hizmetinizin detaylı açıklamasını yazın...',
        modules: {
            toolbar: [
                ['bold', 'italic', 'underline', 'strike'],
                ['blockquote', 'code-block'],
                [{ 'header': 1 }, { 'header': 2 }],
                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                ['link', 'image'],
                ['clean']
            ]
        }
    });

    quill.on('text-change', function() {
        document.getElementById('content-textarea').value = quill.root.innerHTML;
    });
    */
    
        // Tag System
        let tags = [];
        const maxTags = 10;
        
        function updateTagsDisplay() {
            const tagsDisplay = document.getElementById('tags-display');
            tagsDisplay.innerHTML = '';
            
            if (tags.length === 0) {
                tagsDisplay.innerHTML = '<span class="text-gray-400 dark:text-gray-500 text-sm">Henüz etiket eklenmedi</span>';
                return;
            }
            
            tags.forEach((tag, index) => {
                const tagElement = document.createElement('span');
                tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200';
                tagElement.innerHTML = `
                    ${tag}
                    <button type="button" class="ml-2 text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-100" onclick="removeTag(${index})">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                    </svg>
                </button>
            `;
            tagsDisplay.appendChild(tagElement);
        });
        
        document.getElementById('tags').value = tags.join(',');
    }
    
    window.removeTag = function(index) {
        tags.splice(index, 1);
        updateTagsDisplay();
    };
    
    document.querySelector('.add-tag-btn').addEventListener('click', function() {
        const input = document.querySelector('.tag-input');
        const tag = input.value.trim();
        
        if (tag && !tags.includes(tag) && tags.length < maxTags) {
            tags.push(tag);
            input.value = '';
            updateTagsDisplay();
        }
    });
    
    document.querySelector('.tag-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('.add-tag-btn').click();
        }
    });

    // Service Items Management
    let serviceItemCount = 1;
    
    document.getElementById('add-service-item').addEventListener('click', function() {
        const container = document.getElementById('service-items-container');
        const newItem = createServiceItem(serviceItemCount);
        container.appendChild(newItem);
        serviceItemCount++;
        updateRemoveButtons();
    });
    
    function createServiceItem(index) {
        const div = document.createElement('div');
        div.className = 'service-item bg-white dark:bg-gray-800 rounded-xl border border-gray-200 dark:border-gray-700 overflow-hidden shadow-sm';
        div.innerHTML = `
            <div class="bg-gradient-to-r from-blue-50 to-indigo-50 dark:from-blue-900/20 dark:to-indigo-900/20 px-6 py-4 border-b border-gray-200 dark:border-gray-700">
                <div class="flex justify-between items-center">
                    <h4 class="font-medium text-gray-800 dark:text-gray-200 flex items-center">
                        <div class="w-5 h-5 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">${index + 1}</div>
                        Hizmet Öğesi #${index + 1}
                    </h4>
                    <button type="button" class="remove-service-item text-red-600 hover:text-red-800 dark:text-red-400 dark:hover:text-red-300 text-sm font-medium transition-colors duration-200">
                        Kaldır
                    </button>
                </div>
            </div>
            <div class="p-6 space-y-6">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Başlık <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="service_items[${index}][title]" 
                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                               placeholder="Örn: Premium Logo Tasarımı" required>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            Fiyat (₺) <span class="text-red-500">*</span>
                        </label>
                        <input type="number" name="service_items[${index}][price]" 
                               min="0" step="0.01" class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                               placeholder="0.00" required>
                    </div>
                </div>
                
                <!-- İndirim Fiyatı -->
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                    <div>
                        <label class="flex items-center mb-3">
                            <input type="checkbox" class="discount-checkbox rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm font-medium text-gray-700 dark:text-gray-300">İndirimli fiyat uygula</span>
                        </label>
                    </div>
                    <div class="discount-price-field hidden">
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                            İndirimli Fiyat (₺)
                        </label>
                        <input type="number" name="service_items[${index}][discount_price]" 
                               min="0" step="0.01" class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                               placeholder="0.00">
                    </div>
                </div>
                <div>
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Açıklama</label>
                    <textarea name="service_items[${index}][description]" rows="3"
                              class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                              placeholder="Bu hizmet öğesinin detaylarını açıklayın..."></textarea>
                </div>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Teslimat Süresi</label>
                        <div class="flex gap-2">
                            <input type="number" name="service_items[${index}][delivery_time]" min="1" 
                                   class="delivery-time-input flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                                   placeholder="1" value="1">
                            <select name="service_items[${index}][delivery_time_unit]" class="delivery-time-unit px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                <option value="instant">Anında</option>
                                <option value="hour">Saat</option>
                                <option value="day" selected>Gün</option>
                                <option value="week">Hafta</option>
                                <option value="month">Ay</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-3">Satış Tipi</label>
                        <div class="space-y-2">
                            <label class="flex items-center p-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                <input type="radio" name="service_items[${index}][sale_type]" value="internal" checked 
                                       class="text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Site İçi Satış</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Platform üzerinden satış</span>
                                </div>
                            </label>
                            <label class="flex items-center p-3 bg-white dark:bg-gray-700 border border-gray-200 dark:border-gray-600 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/20 transition-colors">
                                <input type="radio" name="service_items[${index}][sale_type]" value="external" 
                                       class="text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-gray-100">Site Dışı Satış</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Harici link ile yönlendirme</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
                
                <!-- Harici URL (Gizli) -->
                <div class="external-url-field hidden">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                        Harici URL <span class="text-red-500">*</span>
                    </label>
                    <div class="relative">
                        <input type="url" name="service_items[${index}][external_url]" 
                               class="w-full px-4 py-3 pl-12 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                               placeholder="https://example.com/urun">
                        <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                            <svg class="h-5 w-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                            </svg>
                        </div>
                    </div>
                    <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">Müşteriler bu URL'ye yönlendirilecek</p>
                </div>
                <div class="features-container" data-item-index="${index}">
                    <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Özellikler</label>
                    <div class="flex flex-wrap gap-2 mb-2 min-h-[40px] p-2 border border-gray-300 dark:border-gray-600 rounded-md bg-gray-50 dark:bg-gray-800" id="features-display-${index}">
                        <!-- Eklenen özellikler burada görünecek -->
                    </div>
                    <div class="flex gap-2">
                        <input type="text" 
                               class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 feature-input"
                               placeholder="Özellik ekleyin (örn: Revizyon, Hızlı teslimat...)"
                               maxlength="50">
                        <button type="button" 
                                class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors add-feature-btn"
                                data-item-index="${index}">
                            Ekle
                        </button>
                    </div>
                    <input type="hidden" name="service_items[${index}][features]" class="features-input" value="">
                </div>
                <div>
                    <label class="flex items-center">
                        <input type="checkbox" name="service_items[${index}][auto_delivery]" value="1" 
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Otomatik teslimat</span>
                    </label>
                </div>
            </div>
        `;
        
        // Add event listeners for the new item
        div.querySelector('.remove-service-item').addEventListener('click', function() {
            div.remove();
            updateRemoveButtons();
        });
        
        // Satış tipi event listener'ı ekle
        const saleTypeInputs = div.querySelectorAll('input[name*="[sale_type]"]');
        const externalUrlField = div.querySelector('.external-url-field');
        
        saleTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'external') {
                    externalUrlField.classList.remove('hidden');
                    externalUrlField.querySelector('input').setAttribute('required', '');
                } else {
                    externalUrlField.classList.add('hidden');
                    externalUrlField.querySelector('input').removeAttribute('required');
                }
            });
        });

        // İndirim checkbox event listener'ı ekle
        const discountCheckbox = div.querySelector('.discount-checkbox');
        const discountField = div.querySelector('.discount-price-field');
        
        discountCheckbox.addEventListener('change', function() {
            if (this.checked) {
                discountField.classList.remove('hidden');
            } else {
                discountField.classList.add('hidden');
                discountField.querySelector('input').value = '';
            }
        });

        // Teslimat süresi event listener'ı ekle
        const deliveryTimeUnit = div.querySelector('.delivery-time-unit');
        const deliveryTimeInput = div.querySelector('.delivery-time-input');
        
        deliveryTimeUnit.addEventListener('change', function() {
            if (this.value === 'instant') {
                deliveryTimeInput.classList.add('hidden');
            } else {
                deliveryTimeInput.classList.remove('hidden');
            }
        });
        
        setupFeatureSystem(div, index);
        
        return div;
    }
    
    function updateRemoveButtons() {
        const items = document.querySelectorAll('.service-item');
        items.forEach((item, index) => {
            const removeBtn = item.querySelector('.remove-service-item');
            if (items.length > 1) {
                removeBtn.classList.remove('hidden');
            } else {
                removeBtn.classList.add('hidden');
            }
        });
    }
    
    function setupFeatureSystem(container, index) {
        const features = [];
        const maxFeatures = 5;
        
        function updateFeaturesDisplay() {
            const featuresDisplay = container.querySelector(`#features-display-${index}`);
            featuresDisplay.innerHTML = '';
            
            if (features.length === 0) {
                featuresDisplay.innerHTML = '<span class="text-gray-400 dark:text-gray-500 text-sm">Henüz özellik eklenmedi</span>';
                return;
            }
            
            features.forEach((feature, featureIndex) => {
                const featureElement = document.createElement('span');
                featureElement.className = 'inline-flex items-center px-2 py-1 rounded-full text-xs bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200';
                featureElement.innerHTML = `
                    ${feature}
                    <button type="button" class="ml-1 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100" onclick="removeFeature(${index}, ${featureIndex})">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                `;
                featuresDisplay.appendChild(featureElement);
            });
            
            container.querySelector('.features-input').value = JSON.stringify(features);
        }
        
        window[`removeFeature${index}`] = function(featureIndex) {
            features.splice(featureIndex, 1);
            updateFeaturesDisplay();
        };
        
        container.querySelector('.add-feature-btn').addEventListener('click', function() {
            const input = container.querySelector('.feature-input');
            const feature = input.value.trim();
            
            if (feature && !features.includes(feature) && features.length < maxFeatures) {
                features.push(feature);
                input.value = '';
                updateFeaturesDisplay();
            }
        });
        
        container.querySelector('.feature-input').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                container.querySelector('.add-feature-btn').click();
            }
        });
    }
    
    // Setup feature system for first item
    setupFeatureSystem(document.querySelector('.service-item'), 0);
    
    // Setup remove button for first item
    document.querySelector('.remove-service-item').addEventListener('click', function() {
        this.closest('.service-item').remove();
        updateRemoveButtons();
    });
    
    // İlk hizmet öğesi için event listener'ları ekle
    const firstItem = document.querySelector('.service-item');
    if (firstItem) {
        // Satış tipi event listener'ı
        const firstSaleTypeInputs = firstItem.querySelectorAll('input[name*="[sale_type]"]');
        const firstExternalUrlField = firstItem.querySelector('.external-url-field');
        
        firstSaleTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                if (this.value === 'external') {
                    firstExternalUrlField.classList.remove('hidden');
                    firstExternalUrlField.querySelector('input').setAttribute('required', '');
                } else {
                    firstExternalUrlField.classList.add('hidden');
                    firstExternalUrlField.querySelector('input').removeAttribute('required');
                }
            });
        });

        // İndirim checkbox event listener'ı
        const firstDiscountCheckbox = firstItem.querySelector('.discount-checkbox');
        const firstDiscountField = firstItem.querySelector('.discount-price-field');
        
        if (firstDiscountCheckbox) {
            firstDiscountCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    firstDiscountField.classList.remove('hidden');
                } else {
                    firstDiscountField.classList.add('hidden');
                    firstDiscountField.querySelector('input').value = '';
                }
            });
        }

        // Teslimat süresi event listener'ı
        const firstDeliveryTimeUnit = firstItem.querySelector('.delivery-time-unit');
        const firstDeliveryTimeInput = firstItem.querySelector('.delivery-time-input');
        
        if (firstDeliveryTimeUnit) {
            firstDeliveryTimeUnit.addEventListener('change', function() {
                if (this.value === 'instant') {
                    firstDeliveryTimeInput.classList.add('hidden');
                } else {
                    firstDeliveryTimeInput.classList.remove('hidden');
                }
            });
        }
    }
    
    updateRemoveButtons();
    
    // Load existing tags
    const existingTags = document.getElementById('tags').value;
    if (existingTags) {
        tags = existingTags.split(',').filter(tag => tag.trim());
        updateTagsDisplay();
    }
});
</script>

@endsection