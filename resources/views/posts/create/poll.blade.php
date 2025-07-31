@extends('layouts.app')

@section('title', 'Anket Oluştur')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
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
                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-purple-600 rounded-xl flex items-center justify-center mr-4 shadow-lg">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-1">Anket Oluştur</h1>
                    <p class="text-gray-600 dark:text-gray-400">Topluluktan görüş alın ve oy toplayın.</p>
                </div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('posts.store') }}" method="POST" id="pollForm" class="space-y-6">
            @csrf
            <input type="hidden" name="post_type" value="4">
            
            <!-- Temel Bilgiler -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-gray-500 to-gray-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">📝</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Temel Bilgiler</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Anketinizin temel bilgilerini girin</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Başlık -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                            Anket Başlığı <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200" 
                               placeholder="Anketiniz için açıklayıcı bir başlık yazın" required>
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
                            Kategori <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="category_id" name="category_id" 
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 appearance-none transition-all duration-200" required>
                                <option value="">Kategori seçin</option>
                                @foreach($postCategories as $category)
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
                            Anket Açıklaması <span class="text-red-500">*</span>
                        </label>
                        <textarea name="content" id="content-textarea" style="display: none;" required>{{ old('content', '') }}</textarea>
                        <div id="content-editor" class="border border-gray-200 dark:border-gray-700 rounded-lg bg-white dark:bg-gray-900 transition-all duration-200" style="min-height: 200px;">
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
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200 tag-input"
                                       placeholder="Etiket ekleyin (örn: anket, görüş, tartışma...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-6 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200 shadow-sm hover:shadow-md add-tag-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <input type="hidden" id="tags" name="tags" value="{{ old('tags') }}">
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Anketinizi daha kolay bulunabilir hale getirmek için etiketler ekleyin. (Maksimum 10 etiket)
                        </p>
                    </div>
                </div>
            </div>

            <!-- Anket Detayları -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
                <div class="flex items-center mb-6">
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-500 to-purple-600 rounded-full flex items-center justify-center mr-3 shadow-sm">
                        <span class="text-white text-lg">📊</span>
                    </div>
                    <div>
                        <h2 class="text-xl font-semibold text-gray-900 dark:text-white">Anket Detayları</h2>
                        <p class="text-sm text-gray-500 dark:text-gray-400">Anket sorularınızı ve seçeneklerinizi oluşturun</p>
                    </div>
                </div>
                
                <div class="space-y-6">
                    <!-- Anket Sorusu -->
                    <div>
                        <label for="poll_question" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            Anket Sorusu <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="poll_question" name="poll_question" value="{{ old('poll_question') }}" 
                               class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                               placeholder="Anket sorunuzu yazın" required>
                        @error('poll_question')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Anket Seçenekleri -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                            <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v10a2 2 0 002 2h8a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path>
                            </svg>
                            Anket Seçenekleri <span class="text-red-500">*</span>
                        </label>
                        <div id="poll-options" class="space-y-3">
                            <div class="flex items-center gap-3 poll-option">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 text-sm font-medium">1</div>
                                <input type="text" name="poll_options[]" value="{{ old('poll_options.0') }}" 
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="Seçenek 1" required>
                                <button type="button" class="remove-option text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-2 hidden transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                            <div class="flex items-center gap-3 poll-option">
                                <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 text-sm font-medium">2</div>
                                <input type="text" name="poll_options[]" value="{{ old('poll_options.1') }}" 
                                       class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                                       placeholder="Seçenek 2" required>
                                <button type="button" class="remove-option text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-2 hidden transition-colors duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <button type="button" id="add-poll-option" class="mt-3 inline-flex items-center px-4 py-2 bg-purple-600 text-white text-sm font-medium rounded-lg hover:bg-purple-700 transition-all duration-200 shadow-sm hover:shadow-md">
                            <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Seçenek Ekle
                        </button>
                        @error('poll_options')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <!-- Anket Ayarları -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="poll_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Anket Tipi
                            </label>
                            <select id="poll_type" name="poll_type" 
                                    class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 appearance-none transition-all duration-200">
                                <option value="single" {{ old('poll_type') == 'single' ? 'selected' : '' }}>Tek Seçim</option>
                                <option value="multiple" {{ old('poll_type') == 'multiple' ? 'selected' : '' }}>Çoklu Seçim</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="poll_expires_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2 flex items-center">
                                <svg class="w-4 h-4 mr-2 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                Bitiş Tarihi
                            </label>
                            <input type="datetime-local" id="poll_expires_at" name="poll_expires_at" value="{{ old('poll_expires_at') }}" 
                                   class="w-full px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 transition-all duration-200">
                            <p class="mt-1 text-xs text-gray-500 dark:text-gray-400">İsteğe bağlı - Boş bırakılırsa süresiz olur</p>
                        </div>
                    </div>
                    
                    <!-- Anonim Oylama -->
                    <div class="bg-purple-50 dark:bg-purple-900/20 rounded-lg p-4 border border-purple-200 dark:border-purple-700">
                        <label class="flex items-center">
                            <input type="checkbox" name="poll_anonymous" value="1" {{ old('poll_anonymous') ? 'checked' : '' }}
                                   class="rounded border-gray-300 text-purple-600 shadow-sm focus:border-purple-300 focus:ring focus:ring-purple-200 focus:ring-opacity-50">
                            <div class="ml-3">
                                <span class="text-sm font-medium text-gray-900 dark:text-white">Anonim oylama</span>
                                <p class="text-xs text-gray-600 dark:text-gray-400 mt-1">Oylayanların kimliği gizli kalır</p>
                            </div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Submit Button -->
            <div class="flex justify-between items-center">
                <a href="{{ route('posts.create') }}" class="px-6 py-3 bg-gray-500 text-white rounded-lg hover:bg-gray-600 transition-all duration-200">
                    ← Geri Dön
                </a>
                <button type="submit" class="px-8 py-3 bg-gradient-to-r from-purple-600 to-purple-700 text-white rounded-lg hover:from-purple-700 hover:to-purple-800 transition-all duration-200 shadow-sm hover:shadow-md">
                    Anketi Yayınla
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
        placeholder: 'Anketinizin detaylı açıklamasını yazın...',
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
            tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-purple-100 dark:bg-purple-900 text-purple-800 dark:text-purple-200';
            tagElement.innerHTML = `
                ${tag}
                <button type="button" class="ml-2 text-purple-600 dark:text-purple-300 hover:text-purple-800 dark:hover:text-purple-100" onclick="removeTag(${index})">
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

    // Poll Options Management
    let optionCount = 2;
    const maxOptions = 10;
    
    function updateOptionNumbers() {
        const options = document.querySelectorAll('.poll-option');
        options.forEach((option, index) => {
            const numberDiv = option.querySelector('div');
            numberDiv.textContent = index + 1;
            
            const input = option.querySelector('input');
            input.placeholder = `Seçenek ${index + 1}`;
        });
    }
    
    function updateRemoveButtons() {
        const options = document.querySelectorAll('.poll-option');
        options.forEach((option, index) => {
            const removeBtn = option.querySelector('.remove-option');
            if (options.length > 2) {
                removeBtn.classList.remove('hidden');
            } else {
                removeBtn.classList.add('hidden');
            }
        });
    }
    
    document.getElementById('add-poll-option').addEventListener('click', function() {
        if (optionCount >= maxOptions) return;
        
        const container = document.getElementById('poll-options');
        const newOption = document.createElement('div');
        newOption.className = 'flex items-center gap-3 poll-option';
        newOption.innerHTML = `
            <div class="w-8 h-8 bg-purple-100 dark:bg-purple-900 rounded-full flex items-center justify-center text-purple-600 dark:text-purple-400 text-sm font-medium">${optionCount + 1}</div>
            <input type="text" name="poll_options[]" 
                   class="flex-1 px-4 py-3 border border-gray-200 dark:border-gray-700 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent bg-gray-50 dark:bg-gray-800 text-gray-900 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500 transition-all duration-200"
                   placeholder="Seçenek ${optionCount + 1}" required>
            <button type="button" class="remove-option text-red-500 hover:text-red-700 dark:text-red-400 dark:hover:text-red-300 p-2 transition-colors duration-200">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                </svg>
            </button>
        `;
        
        container.appendChild(newOption);
        optionCount++;
        
        // Add remove event listener
        newOption.querySelector('.remove-option').addEventListener('click', function() {
            newOption.remove();
            optionCount--;
            updateOptionNumbers();
            updateRemoveButtons();
        });
        
        updateRemoveButtons();
        
        if (optionCount >= maxOptions) {
            document.getElementById('add-poll-option').style.display = 'none';
        }
    });
    
    // Add remove event listeners to existing options
    document.querySelectorAll('.remove-option').forEach(btn => {
        btn.addEventListener('click', function() {
            this.closest('.poll-option').remove();
            optionCount--;
            updateOptionNumbers();
            updateRemoveButtons();
            
            if (optionCount < maxOptions) {
                document.getElementById('add-poll-option').style.display = 'inline-flex';
            }
        });
    });
    
    updateRemoveButtons();
    
    // Set minimum date to now
    const now = new Date();
    now.setMinutes(now.getMinutes() - now.getTimezoneOffset());
    document.getElementById('poll_expires_at').min = now.toISOString().slice(0, 16);
    
    // Load existing tags
    const existingTags = document.getElementById('tags').value;
    if (existingTags) {
        tags = existingTags.split(',').filter(tag => tag.trim());
        updateTagsDisplay();
    }
});
</script>
@endpush
@endsection