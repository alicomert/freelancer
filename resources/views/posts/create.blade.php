@extends('layouts.app')

@section('title', 'Yeni Gönderi Oluştur')

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
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-blue-500 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-"white mb-1">Yeni Gönderi Oluştur</h1>
                    <p class="text-gray-600 dark:text-gray-400">Hizmet ilanı, açık artırma, anket, portfolyo veya normal gönderi oluşturabilirsiniz.</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('posts.store') }}" method="POST" id="postForm" class="space-y-6">
            @csrf
            
            <!-- Post Tipi Seçimi -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                    <div class="w-8 h-8 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                        <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                        </svg>
                    </div>
                    Gönderi Tipi
                </h2>
                <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-6 gap-4">
                    <label class="post-type-option cursor-pointer group">
                        <input type="radio" name="post_type" value="1" class="sr-only" checked>
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-md group-hover:scale-105">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">Normal Post</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Genel paylaşım</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer group">
                        <input type="radio" name="post_type" value="2" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center hover:border-green-500 dark:hover:border-green-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-md group-hover:scale-105">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900/30 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">Hizmet İlanı</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Hizmet sat</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer group">
                        <input type="radio" name="post_type" value="3" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center hover:border-orange-500 dark:hover:border-orange-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-md group-hover:scale-105">
                            <div class="w-10 h-10 bg-orange-100 dark:bg-orange-900/30 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">Açık Artırma</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Teklif al</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer group">
                        <input type="radio" name="post_type" value="4" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center hover:border-purple-500 dark:hover:border-purple-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-md group-hover:scale-105">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900/30 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">Anket</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Oy topla</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer group">
                        <input type="radio" name="post_type" value="5" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center hover:border-indigo-500 dark:hover:border-indigo-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-md group-hover:scale-105">
                            <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">Portfolyo</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Çalışma göster</div>
                        </div>
                    </label>
                    
                    <label class="post-type-option cursor-pointer group">
                        <input type="radio" name="post_type" value="6" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-4 text-center hover:border-teal-500 dark:hover:border-teal-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-md group-hover:scale-105">
                            <div class="w-10 h-10 bg-teal-100 dark:bg-teal-900/30 rounded-lg flex items-center justify-center mx-auto mb-3">
                                <svg class="w-5 h-5 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div class="font-medium text-gray-900 dark:text-white text-sm">Freelance Proje</div>
                            <div class="text-xs text-gray-500 dark:text-gray-400 mt-1">Proje ara</div>
                        </div>
                    </label>
                </div>
            </div>

            <!-- Temel Bilgiler -->
            <div id="basic-info-section" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">📝</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Temel Bilgiler</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Gönderinizin temel bilgilerini girin</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Başlık -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Başlık <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200" 
                               placeholder="Gönderiniz için açıklayıcı bir başlık yazın" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="category_id" name="category_id" 
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 appearance-none transition-all duration-200">
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
                            <div class="absolute inset-y-0 right-0 flex items-center pr-3 pointer-events-none">
                                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                </svg>
                            </div>
                        </div>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
                        @enderror
                    </div>

                    <!-- İçerik -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            İçerik <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content-textarea" style="display: none;" required>{{ old('content', '') }}</textarea>
                        <div id="content-editor" class="border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 transition-all duration-200" style="min-height: 300px;">
                            {!! old('content', '') !!}
                        </div>
                        @error('content')
                            <p class="mt-2 text-sm text-red-600 flex items-center">
                                <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                </svg>
                                {{ $message }}
                            </p>
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
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 tag-input"
                                       placeholder="Etiket ekleyin (örn: web tasarım, php, laravel...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-6 py-3 bg-gradient-to-r from-blue-600 to-blue-700 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-sm hover:shadow-md add-tag-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <!-- Hidden input for form submission -->
                        <input type="hidden" id="tags" name="tags" value="{{ old('tags') }}">
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400 flex items-center">
                            <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Gönderinizi daha kolay bulunabilir hale getirmek için etiketler ekleyin. (Maksimum 10 etiket)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Freelance Proje Alt Kategorileri -->
            <div id="freelance-sub-types" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
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
                        <input type="radio" name="freelance_type" value="buyer_request" class="sr-only">
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-purple-300 dark:hover:border-purple-600 transition-all duration-200 hover:shadow-md bg-gradient-to-br from-purple-50 to-indigo-50 dark:from-purple-900/20 dark:to-indigo-900/20">
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
                        <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 hover:border-blue-300 dark:hover:border-blue-600 transition-all duration-200 hover:shadow-md bg-gradient-to-br from-blue-50 to-cyan-50 dark:from-blue-900/20 dark:to-cyan-900/20">
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
            <div id="buyer-request-details" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
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
                                       placeholder="0.00" data-required-when-buyer-request>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Maksimum Bütçe (₺) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="max_budget" min="0" step="0.01" 
                                       class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="0.00" data-required-when-buyer-request>
                            </div>
                        </div>
                    </div>

                    <!-- Proje Süresi -->
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-blue-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">⏱</div>
                            Proje Süresi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Süre Birimi
                                </label>
                                <select name="project_duration_unit" class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                    <option value="day">Gün</option>
                                    <option value="week">Hafta</option>
                                    <option value="month">Ay</option>
                                    <option value="flexible">Esnek</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Süre
                                </label>
                                <input type="number" name="project_duration" min="1" 
                                       class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="1">
                            </div>
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
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ücret Türü <span class="text-red-500">*</span>
                                </label>
                                <select name="salary_type" class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100" data-required-when-job-posting>
                                    <option value="">Seçiniz</option>
                                    <option value="hourly">Saatlik</option>
                                    <option value="daily">Günlük</option>
                                    <option value="weekly">Haftalık</option>
                                    <option value="monthly">Aylık</option>
                                    <option value="project">Proje Bazlı</option>
                                </select>
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                    Ücret Miktarı (₺) <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="salary_amount" min="0" step="0.01" 
                                       class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="0.00" data-required-when-job-posting>
                            </div>
                        </div>
                    </div>

                    <!-- Teslim Süresi -->
                    <div class="bg-gray-50 dark:bg-gray-800 rounded-xl p-6 border border-gray-100 dark:border-gray-700">
                        <h3 class="text-lg font-medium text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                            <div class="w-6 h-6 bg-purple-600 text-white rounded-full flex items-center justify-center text-xs mr-3 shadow-sm">⏰</div>
                            Teslim Süresi
                        </h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="delivery_time" value="few_days" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Birkaç gün içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">1-3 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="delivery_time" value="one_week" class="text-purple-600 focus:ring-purple-500" checked>
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Bir hafta içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">7 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="delivery_time" value="one_month" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">Bir ay içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">30 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="delivery_time" value="one_to_three_months" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">1-3 ay içinde</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">30-90 gün</span>
                                </div>
                            </label>
                            <label class="flex items-center p-4 bg-white dark:bg-gray-900 border border-gray-200 dark:border-gray-700 rounded-lg cursor-pointer hover:bg-purple-50 dark:hover:bg-purple-900/30 transition-colors">
                                <input type="radio" name="delivery_time" value="more_than_three_months" class="text-purple-600 focus:ring-purple-500">
                                <div class="ml-3">
                                    <span class="text-sm font-medium text-gray-900 dark:text-white">3 aydan daha fazla</span>
                                    <span class="block text-xs text-gray-500 dark:text-gray-400">90+ gün</span>
                                </div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hizmet İlanı Alanları -->
            <div id="service-fields" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
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
                                <div class="bg-yellow-50 rounded-lg p-4 border border-yellow-200">
                                    <div class="flex items-center mb-3">
                                        <input type="checkbox" name="service_items[0][has_discount]" value="1" 
                                               class="rounded border-gray-300 text-yellow-600 shadow-sm focus:border-yellow-300 focus:ring focus:ring-yellow-200 focus:ring-opacity-50 discount-checkbox"
                                               data-index="0"
                                               id="discount-checkbox-0">
                                        <label for="discount-checkbox-0" class="ml-3 text-sm font-medium text-gray-700 flex items-center cursor-pointer">
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
            <div id="auction-fields" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-orange-500 to-red-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">🔨</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Açık Artırma Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Açık artırma ayarlarınızı belirleyin</p>
                    </div>
                </div>
                
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
            <div id="poll-fields" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-green-500 to-emerald-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">📊</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Anket Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Anket sorularınızı ve seçeneklerinizi oluşturun</p>
                    </div>
                </div>
                
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
            <div id="portfolio-fields" class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700 hidden">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-indigo-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">💼</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Portfolyo Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Projenizin detaylarını ve kullandığınız teknolojileri belirtin</p>
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
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md border border-gray-100 dark:border-gray-700 p-6">
                <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                    <a href="{{ route('home') }}" class="inline-flex items-center px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors duration-200">
                        <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        İptal
                    </a>
                    
                    <div class="flex flex-col sm:flex-row gap-3">
                        <button type="button" class="inline-flex items-center px-6 py-3 border border-gray-300 dark:border-gray-600 text-gray-700 dark:text-gray-300 bg-white dark:bg-gray-800 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3-3m0 0l-3 3m3-3v12"></path>
                            </svg>
                            Taslak Kaydet
                        </button>
                        <button type="submit" class="inline-flex items-center px-8 py-3 bg-gradient-to-br from-purple-500 to-blue-500 text-white rounded-lg hover:from-blue-700 hover:to-blue-800 transition-all duration-200 shadow-md hover:shadow-lg transform hover:-translate-y-0.5">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                            </svg>
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

    // Temel Bilgiler bölümü
    const basicInfoSection = document.getElementById('basic-info-section');
    const freelanceSubTypes = document.getElementById('freelance-sub-types');
    
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
            if (freelanceSubTypes) freelanceSubTypes.classList.add('hidden');
            
            // Freelance subcategory fields'ları da gizle
            const buyerRequestDetails = document.getElementById('buyer-request-details');
            const jobPostingDetails = document.getElementById('job-posting-details');
            if (buyerRequestDetails) buyerRequestDetails.classList.add('hidden');
            if (jobPostingDetails) jobPostingDetails.classList.add('hidden');
            
            // Tüm required attributelarını kaldır
            document.querySelectorAll('[data-required-when-service], [data-required-when-auction], [data-required-when-poll], [data-required-when-portfolio], [data-required-when-buyer-request]').forEach(field => {
                field.removeAttribute('required');
            });
            
            // Temel Bilgiler bölümünü kontrol et
            if (basicInfoSection) {
                if (this.value === '4' || this.value === '5' || this.value === '6') { // Anket, Portfolio veya Freelance Proje
                    basicInfoSection.classList.add('hidden');
                } else {
                    basicInfoSection.classList.remove('hidden');
                }
            }
            
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
                case '6': // Freelance Proje
                    if (freelanceSubTypes) freelanceSubTypes.classList.remove('hidden');
                    // Freelance type listener'larını yeniden başlat
                    setTimeout(() => {
                        initFreelanceTypeListeners();
                    }, 100);
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

    // Alıcı İsteği için beceri ekleme fonksiyonları
    const skillInput = document.getElementById('skill-input');
    const addSkillBtn = document.getElementById('add-skill-btn');
    const skillsDisplay = document.getElementById('skills-display');
    const skillsHiddenInput = document.getElementById('required-skills');
    
    let skills = [];
    
    if (addSkillBtn && skillInput) {
        addSkillBtn.addEventListener('click', function() {
            addSkill();
        });
        
        skillInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addSkill();
            }
        });
    }
    
    function addSkill() {
        const value = skillInput.value.trim();
        
        if (value === '') {
            alert('Lütfen bir beceri girin.');
            return;
        }
        
        if (skills.length >= 10) {
            alert('Maksimum 10 beceri ekleyebilirsiniz.');
            return;
        }
        
        if (skills.includes(value)) {
            alert('Bu beceri zaten eklenmiş.');
            return;
        }
        
        skills.push(value);
        updateSkillsDisplay();
        updateSkillsHiddenInput();
        skillInput.value = '';
    }
    
    function removeSkill(index) {
        skills.splice(index, 1);
        updateSkillsDisplay();
        updateSkillsHiddenInput();
    }
    
    function updateSkillsDisplay() {
        if (!skillsDisplay) return;
        
        skillsDisplay.innerHTML = '';
        
        skills.forEach((skill, index) => {
            const skillElement = document.createElement('span');
            skillElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-green-100 text-green-800 border border-green-200';
            skillElement.innerHTML = `
                ${skill}
                <button type="button" class="ml-2 text-green-600 hover:text-green-800" onclick="removeSkill(${index})">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            skillsDisplay.appendChild(skillElement);
        });
        
        if (skills.length === 0) {
            const placeholder = document.createElement('span');
            placeholder.className = 'text-gray-400 text-sm';
            placeholder.textContent = 'Henüz beceri eklenmedi';
            skillsDisplay.appendChild(placeholder);
        }
    }
    
    function updateSkillsHiddenInput() {
        if (skillsHiddenInput) {
            skillsHiddenInput.value = JSON.stringify(skills);
        }
    }
    
    // Global fonksiyon olarak tanımla
    window.removeSkill = removeSkill;

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

    // Etiket ekleme/çıkarma işlemleri
    const tagInput = document.querySelector('.tag-input');
    const addTagBtn = document.querySelector('.add-tag-btn');
    const tagsDisplay = document.getElementById('tags-display');
    const tagsHiddenInput = document.getElementById('tags');
    
    let tags = [];
    
    // Eski değerleri yükle
    if (tagsHiddenInput && tagsHiddenInput.value) {
        try {
            // Virgülle ayrılmış string'i array'e çevir
            const oldTags = tagsHiddenInput.value.split(',').map(tag => tag.trim()).filter(tag => tag);
            tags = oldTags;
            updateTagsDisplay();
        } catch (e) {
            tags = [];
        }
    }
    
    if (addTagBtn && tagInput) {
        addTagBtn.addEventListener('click', function() {
            addTag();
        });
        
        tagInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                addTag();
            }
        });
    }
    
    function addTag() {
        const value = tagInput.value.trim();
        
        if (value === '') {
            alert('Lütfen bir etiket girin.');
            return;
        }
        
        if (tags.length >= 10) {
            alert('Maksimum 10 etiket ekleyebilirsiniz.');
            return;
        }
        
        if (tags.includes(value)) {
            alert('Bu etiket zaten eklenmiş.');
            return;
        }
        
        tags.push(value);
        updateTagsDisplay();
        updateTagsHiddenInput();
        tagInput.value = '';
    }
    
    function removeTag(index) {
        tags.splice(index, 1);
        updateTagsDisplay();
        updateTagsHiddenInput();
    }
    
    function updateTagsDisplay() {
        if (!tagsDisplay) return;
        
        tagsDisplay.innerHTML = '';
        
        tags.forEach((tag, index) => {
            const tagElement = document.createElement('span');
            tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-blue-100 dark:bg-blue-900 text-blue-800 dark:text-blue-200 border border-blue-200 dark:border-blue-700';
            tagElement.innerHTML = `
                ${tag}
                <button type="button" class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100" onclick="removeTag(${index})">
                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            `;
            tagsDisplay.appendChild(tagElement);
        });
        
        if (tags.length === 0) {
            const placeholder = document.createElement('span');
            placeholder.className = 'text-gray-400 dark:text-gray-500 text-sm';
            placeholder.textContent = 'Henüz etiket eklenmedi';
            tagsDisplay.appendChild(placeholder);
        }
    }
    
    function updateTagsHiddenInput() {
        if (tagsHiddenInput) {
            tagsHiddenInput.value = tags.join(', ');
        }
    }
    
    // Global fonksiyon olarak tanımla
    window.removeTag = removeTag;

    // Freelance Proje alt kategorileri için event listener'lar
    function initFreelanceTypeListeners() {
        const freelanceTypeInputs = document.querySelectorAll('input[name="freelance_type"]');
        const buyerRequestDetails = document.getElementById('buyer-request-details');
        const jobPostingDetails = document.getElementById('job-posting-details');
        
        console.log('initFreelanceTypeListeners çalıştı');
        console.log('buyerRequestDetails:', buyerRequestDetails);
        console.log('jobPostingDetails:', jobPostingDetails);
        
        freelanceTypeInputs.forEach(input => {
            input.addEventListener('change', function() {
                console.log('Freelance type changed:', this.value); // Debug için
                
                // Tüm seçeneklerin görsel feedback'ini sıfırla
                document.querySelectorAll('.freelance-type-option div').forEach(div => {
                    div.classList.remove('border-purple-500', 'border-blue-500', 'bg-purple-50', 'bg-blue-50');
                    div.classList.add('border-gray-200');
                });
                
                // Seçili seçeneğe görsel feedback ekle
                const parentDiv = this.closest('.freelance-type-option').querySelector('div');
                parentDiv.classList.remove('border-gray-200');
                
                // Tüm detay alanlarını gizle
                if (buyerRequestDetails) {
                    buyerRequestDetails.classList.add('hidden');
                    console.log('Buyer request details hidden');
                } else {
                    console.log('buyerRequestDetails element bulunamadı!');
                }
                
                if (jobPostingDetails) {
                    jobPostingDetails.classList.add('hidden');
                    console.log('Job posting details hidden');
                } else {
                    console.log('jobPostingDetails element bulunamadı!');
                }
                
                if (this.value === 'buyer_request') {
                    parentDiv.classList.add('border-purple-500', 'bg-purple-50');
                    // Alıcı İsteği detaylarını göster
                    if (buyerRequestDetails) {
                        buyerRequestDetails.classList.remove('hidden');
                        console.log('Buyer request details shown');
                    }
                } else if (this.value === 'job_posting') {
                    parentDiv.classList.add('border-blue-500', 'bg-blue-50');
                    // İş İlanı detaylarını göster
                    if (jobPostingDetails) {
                        jobPostingDetails.classList.remove('hidden');
                        console.log('Job posting details shown');
                    }
                }
            });
        });
    }

    // Freelance type listener'larını başlat
    setTimeout(() => {
        initFreelanceTypeListeners();
    }, 500); // 500ms bekle

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