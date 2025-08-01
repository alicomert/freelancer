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
            
            <!-- Anket Detayları -->
            <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
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
                    <!-- Anket Sorusu (Title) -->
                    <div>
                        <label for="title" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anket Sorusu <span class="text-red-500">*</span></label>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" 
                               class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" 
                               placeholder="Anket sorunuzu yazın" required>
                        @error('title')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Kategori -->
                    <div>
                        <label for="category_id" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Kategori <span class="text-red-500">*</span></label>
                        <select id="category_id" name="category_id" 
                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" required>
                            <option value="">Kategori seçin</option>
                            @foreach($postCategories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Anket Seçenekleri -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anket Seçenekleri <span class="text-red-500">*</span></label>
                        <div id="poll-options">
                            <div class="flex mb-2">
                                <input type="text" name="poll_options[]" value="{{ old('poll_options.0') }}" 
                                       class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" 
                                       placeholder="Seçenek 1" required>
                            </div>
                            <div class="flex mb-2">
                                <input type="text" name="poll_options[]" value="{{ old('poll_options.1') }}" 
                                       class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" 
                                       placeholder="Seçenek 2" required>
                            </div>
                        </div>
                        <button type="button" id="add-poll-option" class="text-blue-600 hover:text-blue-800 text-sm">+ Seçenek Ekle</button>
                        @error('poll_options')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="poll_type" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Anket Tipi</label>
                            <select id="poll_type" name="poll_type" 
                                    class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                                <option value="single" {{ old('poll_type') == 'single' ? 'selected' : '' }}>Tek Seçim</option>
                                <option value="multiple" {{ old('poll_type') == 'multiple' ? 'selected' : '' }}>Çoklu Seçim</option>
                            </select>
                        </div>
                        
                        <div>
                            <label for="poll_expires_at" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Bitiş Tarihi</label>
                            <input type="datetime-local" id="poll_expires_at" name="poll_expires_at" value="{{ old('poll_expires_at') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100">
                        </div>
                    </div>
                    
                    <div>
                        <label class="flex items-center">
                            <input type="checkbox" name="poll_anonymous" value="1" {{ old('poll_anonymous') ? 'checked' : '' }} 
                                   class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                            <span class="ml-2 text-sm text-gray-700 dark:text-gray-300">Anonim oylama</span>
                        </label>
                    </div>

                    <!-- Etiketler -->
                    <div>
                        <label class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">Etiketler</label>
                        <div class="flex gap-2 mb-2">
                            <input type="text" class="tag-input flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100" 
                                   placeholder="Etiket ekleyin...">
                            <button type="button" class="add-tag-btn px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700 transition-colors">
                                Ekle
                            </button>
                        </div>
                        <div id="tags-display" class="flex flex-wrap gap-2 mb-2">
                            <span class="text-gray-400 dark:text-gray-500 text-sm">Henüz etiket eklenmedi</span>
                        </div>
                        <input type="hidden" name="tags" id="tags" value="{{ old('tags') }}">
                        <p class="text-xs text-gray-500 dark:text-gray-400">En fazla 10 etiket ekleyebilirsiniz</p>
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
<script>
document.addEventListener('DOMContentLoaded', function() {

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
    
    function updateOptionCount() {
        optionCount = document.querySelectorAll('#poll-options > div').length;
        const addButton = document.getElementById('add-poll-option');
        if (optionCount >= maxOptions) {
            addButton.style.display = 'none';
        } else {
            addButton.style.display = 'inline-block';
        }
    }
    
    document.getElementById('add-poll-option').addEventListener('click', function() {
        if (optionCount >= maxOptions) return;
        
        const container = document.getElementById('poll-options');
        const newOption = document.createElement('div');
        newOption.className = 'flex mb-2';
        newOption.innerHTML = `
            <input type="text" name="poll_options[]" 
                   class="flex-1 px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-800 text-gray-900 dark:text-gray-100"
                   placeholder="Seçenek ${optionCount + 1}">
            <button type="button" class="ml-2 text-red-500 hover:text-red-700 px-2 text-lg font-bold" onclick="removeOption(this)">×</button>
        `;
        
        container.appendChild(newOption);
        updateOptionCount();
    });
    
    window.removeOption = function(button) {
        button.parentElement.remove();
        updateOptionCount();
        // Placeholder'ları güncelle
        const options = document.querySelectorAll('#poll-options input[name="poll_options[]"]');
        options.forEach((input, index) => {
            input.placeholder = `Seçenek ${index + 1}`;
        });
    };
    
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