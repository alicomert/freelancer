@extends('layouts.app')

@section('title', 'Freelance Proje Oluştur')

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
                <div class="w-12 h-12 bg-gradient-to-br from-teal-500 to-teal-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-1">Freelance Proje Oluştur</h1>
                    <p class="text-gray-600 dark:text-gray-400">İş ilanı verin veya proje talebi oluşturun.</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('posts.store') }}" method="POST" id="freelanceForm" class="space-y-6">
            @csrf
            <input type="hidden" name="post_type" value="5">
            
            <!-- Temel Bilgiler -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">📝</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Temel Bilgiler</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Freelance projenizin temel bilgilerini girin</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Başlık -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Proje Başlığı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200" 
                               placeholder="Freelance projeniz için açıklayıcı bir başlık yazın" required>
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
                            Proje Kategorisi <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="category_id" name="category_id" 
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 appearance-none transition-all duration-200" required>
                                <option value="">Kategori seçin</option>
                                @foreach($projectCategories as $category)
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
                            Proje Açıklaması <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content-textarea" rows="4" placeholder="Proje açıklamanızı yazın..." class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-white dark:bg-gray-900 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 resize-none transition-all duration-200" required>{{ old('content', '') }}</textarea>
                        <div id="content-editor" class="border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 transition-all duration-200 hidden" style="min-height: 300px;">
                            {!! old('content', '') !!}
                        </div>
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
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-teal-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 tag-input"
                                       placeholder="Etiket ekleyin (örn: freelance, proje, iş...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-6 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white rounded-lg hover:from-teal-700 hover:to-teal-800 transition-all duration-200 shadow-sm hover:shadow-md add-tag-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <input type="hidden" id="tags" name="tags" value="{{ old('tags') }}">
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Projenizi daha kolay bulunabilir hale getirmek için etiketler ekleyin. (Maksimum 10 etiket)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Freelance Proje Alt Kategorileri -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">💼</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Proje Türü Seçin</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Freelance projenizin türünü belirleyin</p>
                    </div>
                </div>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Alıcı İsteği -->
                    <label class="freelance-type-option cursor-pointer">
                        <input type="radio" name="freelance_type" value="buyer_request" class="sr-only" checked>
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-purple-300 dark:hover:border-purple-600 transition-all duration-200 hover:shadow-md bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20 freelance-card">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">Alıcı İsteği</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">İhtiyacınız olan hizmeti talep edin</p>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Freelancer'lardan teklif alın
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Bütçenizi belirleyin
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    En uygun freelancer'ı seçin
                                </div>
                            </div>
                        </div>
                    </label>

                    <!-- İş İlanı Oluştur -->
                    <label class="freelance-type-option cursor-pointer">
                        <input type="radio" name="freelance_type" value="job_posting" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-200 hover:shadow-md bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20 freelance-card">
                            <div class="flex items-center mb-4">
                                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center mr-4">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900 dark:text-white">İş İlanı Oluştur</h3>
                                    <p class="text-sm text-gray-500 dark:text-gray-400">Detaylı iş ilanı yayınlayın</p>
                                </div>
                            </div>
                            <div class="space-y-2 text-sm text-gray-600 dark:text-gray-300">
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Detaylı iş tanımı yapın
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Gerekli becerileri belirtin
                                </div>
                                <div class="flex items-center">
                                    <svg class="w-4 h-4 text-green-500 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                    </svg>
                                    Başvuruları değerlendirin
                                </div>
                            </div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Alıcı İsteği Alanları -->
            <div id="buyer-request-details" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Alıcı İsteği Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">İhtiyacınız olan hizmet için detayları belirtin</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- Bütçe Aralığı -->
                    <div class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6 border border-purple-100 dark:border-purple-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">₺</div>
                            Bütçe Aralığı
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Minimum Bütçe (₺) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="min_budget" min="0" step="0.01" 
                                       class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="0.00" value="{{ old('min_budget') }}">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Maksimum Bütçe (₺) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="max_budget" min="0" step="0.01" 
                                       class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="0.00" value="{{ old('max_budget') }}">
                            </div>
                        </div>
                    </div>

                    <!-- İş Türü -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-100 dark:border-blue-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">💼</div>
                            İş Türü
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors">
                                <input type="radio" name="buyer_request_job_type" value="time_based" class="text-blue-600 focus:ring-blue-500" checked>
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Süre Bazlı</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Belirli süre ile çalışma</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors">
                                <input type="radio" name="buyer_request_job_type" value="project_based" class="text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Proje Bazlı</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Proje tamamlanana kadar</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Çalışma Süresi / Teslim Süresi (Dinamik) -->
                    <div id="buyer-request-work-duration-section" class="bg-orange-50 dark:bg-orange-900/20 rounded-xl p-6 border border-orange-100 dark:border-orange-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-orange-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">⏰</div>
                            Çalışma Süresi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-orange-50 dark:hover:bg-orange-900/30 transition-colors">
                                <input type="radio" name="buyer_request_work_duration_type" value="hourly" class="text-orange-600 focus:ring-orange-500" checked>
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Saatlik</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Saat bazında çalışma</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-orange-50 dark:hover:bg-orange-900/30 transition-colors">
                                <input type="radio" name="buyer_request_work_duration_type" value="daily" class="text-orange-600 focus:ring-orange-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Günlük</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Gün bazında çalışma</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <div id="buyer-request-delivery-time-section" class="bg-purple-50 dark:bg-purple-900/20 rounded-xl p-6 border border-purple-100 dark:border-purple-700 hidden">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">⏰</div>
                            Teslim Süresi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="buyer_request_delivery_time" value="few_days" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Birkaç gün içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">1-3 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="buyer_request_delivery_time" value="one_week" class="text-purple-600 focus:ring-purple-500" checked>
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Bir hafta içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">7 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="buyer_request_delivery_time" value="one_month" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Bir ay içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">30 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="buyer_request_delivery_time" value="one_to_three_months" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">1-3 ay içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">30-90 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="buyer_request_delivery_time" value="more_than_three_months" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">3 aydan daha fazla</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">90+ gün</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Gerekli Beceriler -->
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">🎯</div>
                            Gerekli Beceriler
                        </h3>
                        <div class="space-y-4">
                            <div class="flex gap-3">
                                <input type="text" id="skill-input" 
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="Beceri ekleyin (örn: PHP, Laravel, JavaScript)">
                                <button type="button" id="add-skill-btn" 
                                        class="px-6 py-3 bg-green-600 text-white font-medium rounded-lg hover:bg-green-700 transition-all duration-200 shadow-sm hover:shadow-md">
                                    Ekle
                                </button>
                            </div>
                            <div id="skills-display" class="flex flex-wrap gap-2 min-h-[2rem] p-3 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg">
                                <span class="text-gray-400 dark:text-gray-500 text-sm">Henüz beceri eklenmedi</span>
                            </div>
                            <input type="hidden" name="required_skills" id="skills-hidden-input">
                        </div>
                    </div>
                </div>
            </div>

            <!-- İş İlanı Alanları -->
            <div id="job-posting-details" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-blue-500 to-blue-600 rounded-lg flex items-center justify-center mr-3 shadow-sm">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                        </svg>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">İş İlanı Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Detaylı iş ilanı bilgilerini girin</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <!-- İş Türü -->
                    <div class="bg-blue-50 dark:bg-blue-900/20 rounded-xl p-6 border border-blue-100 dark:border-blue-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">💼</div>
                            İş Türü
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <label class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors">
                                <input type="radio" name="job_type" value="time_based" class="text-blue-600 focus:ring-blue-500" checked>
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Süre Bazlı</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Belirli süre ile çalışma</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-800 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-blue-50 dark:hover:bg-blue-900/30 transition-colors">
                                <input type="radio" name="job_type" value="project_based" class="text-blue-600 focus:ring-blue-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Proje Bazlı</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">Proje tamamlanana kadar</span>
                                </div>
                            </label>
                        </div>
                    </div>

                    <!-- Maaş/Ücret Bilgisi -->
                    <div class="bg-green-50 dark:bg-green-900/20 rounded-xl p-6 border border-green-100 dark:border-green-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-green-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">₺</div>
                            Ücret Bilgisi
                        </h3>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                Ücret Miktarı (₺) <span class="text-red-500">*</span>
                            </label>
                            <input type="number" name="salary_amount" min="0" step="0.01" 
                                   class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                   placeholder="0.00" value="{{ old('salary_amount') }}">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('posts.create') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200">
                    ← Geri Dön
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-teal-600 to-teal-700 text-white rounded-lg hover:from-teal-700 hover:to-teal-800 transition-all duration-200 shadow-sm hover:shadow-md">
                    Freelance Projeyi Yayınla
                </button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
<link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Quill Editor
    var quill = new Quill('#content-editor', {
        theme: 'snow',
        placeholder: 'Freelance projenizin detaylı açıklamasını yazın...',
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
            tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-teal-100 dark:bg-teal-900 text-teal-800 dark:text-teal-200';
            tagElement.innerHTML = `
                ${tag}
                <button type="button" class="ml-2 text-teal-600 dark:text-teal-300 hover:text-teal-800 dark:hover:text-teal-100" onclick="removeTag(${index})">
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

    // Freelance Type Selection
    const freelanceTypeOptions = document.querySelectorAll('input[name="freelance_type"]');
    const buyerRequestDetails = document.getElementById('buyer-request-details');
    const jobPostingDetails = document.getElementById('job-posting-details');
    
    function updateFreelanceType() {
        const selectedType = document.querySelector('input[name="freelance_type"]:checked').value;
        
        // Update card styles
        document.querySelectorAll('.freelance-card').forEach(card => {
            card.classList.remove('border-purple-500', 'border-blue-500', 'bg-purple-100', 'bg-blue-100');
            card.classList.add('border-gray-200');
        });
        
        if (selectedType === 'buyer_request') {
            buyerRequestDetails.classList.remove('hidden');
            jobPostingDetails.classList.add('hidden');
            document.querySelector('input[value="buyer_request"]').closest('.freelance-card').classList.add('border-purple-500');
        } else {
            buyerRequestDetails.classList.add('hidden');
            jobPostingDetails.classList.remove('hidden');
            document.querySelector('input[value="job_posting"]').closest('.freelance-card').classList.add('border-blue-500');
        }
    }
    
    freelanceTypeOptions.forEach(option => {
        option.addEventListener('change', updateFreelanceType);
    });
    
    // Job Type Change Handler
    const jobTypeRadios = document.querySelectorAll('input[name="buyer_request_job_type"]');
    const workDurationSection = document.getElementById('buyer-request-work-duration-section');
    const deliveryTimeSection = document.getElementById('buyer-request-delivery-time-section');
    
    function updateJobType() {
        const selectedJobType = document.querySelector('input[name="buyer_request_job_type"]:checked').value;
        
        if (selectedJobType === 'time_based') {
            workDurationSection.classList.remove('hidden');
            deliveryTimeSection.classList.add('hidden');
        } else {
            workDurationSection.classList.add('hidden');
            deliveryTimeSection.classList.remove('hidden');
        }
    }
    
    jobTypeRadios.forEach(radio => {
        radio.addEventListener('change', updateJobType);
    });

    // Skills Management
    let skills = [];
    const maxSkills = 20;
    
    function updateSkillsDisplay() {
        const skillsDisplay = document.getElementById('skills-display');
        skillsDisplay.innerHTML = '';
        
        if (skills.length === 0) {
            skillsDisplay.innerHTML = '<span class="text-gray-400 dark:text-gray-500 text-sm">Henüz beceri eklenmedi</span>';
            return;
        }
        
        skills.forEach((skill, index) => {
            const skillElement = document.createElement('span');
            skillElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200';
            skillElement.innerHTML = `
                ${skill}
                <button type="button" class="ml-2 text-green-600 dark:text-green-300 hover:text-green-800 dark:hover:text-green-100" onclick="removeSkill(${index})">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            `;
            skillsDisplay.appendChild(skillElement);
        });
        
        document.getElementById('skills-hidden-input').value = skills.join(',');
    }
    
    window.removeSkill = function(index) {
        skills.splice(index, 1);
        updateSkillsDisplay();
    };
    
    document.getElementById('add-skill-btn').addEventListener('click', function() {
        const input = document.getElementById('skill-input');
        const skill = input.value.trim();
        
        if (skill && !skills.includes(skill) && skills.length < maxSkills) {
            skills.push(skill);
            input.value = '';
            updateSkillsDisplay();
        }
    });
    
    document.getElementById('skill-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.getElementById('add-skill-btn').click();
        }
    });
    
    // Initialize
    updateFreelanceType();
    updateJobType();
    
    // Load existing tags
    const existingTags = document.getElementById('tags').value;
    if (existingTags) {
        tags = existingTags.split(',').filter(tag => tag.trim());
        updateTagsDisplay();
    }
    
    // Load existing skills
    const existingSkills = document.getElementById('skills-hidden-input').value;
    if (existingSkills) {
        skills = existingSkills.split(',').filter(skill => skill.trim());
        updateSkillsDisplay();
    }
});
</script>
@endpush
@endsection