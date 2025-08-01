@extends('layouts.app')

@section('title', 'Portfolyo Oluştur')

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

        <!-- Başlık ve Progress Bar -->
        <div class="bg-gradient-to-r from-indigo-500 to-purple-600 rounded-xl shadow-lg p-8 mb-8 text-white">
            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center">
                    <div class="w-12 h-12 bg-white bg-opacity-20 rounded-xl flex items-center justify-center mr-4 backdrop-blur-sm">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-3xl font-bold mb-1">Portfolyo Oluştur</h1>
                        <p class="text-white text-opacity-90">Çalışmalarınızı kolayca sergileyin</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-sm text-white text-opacity-75 mb-1">Adım</div>
                    <div class="text-2xl font-bold" id="step-counter">1 / 2</div>
                </div>
            </div>
            
            <!-- Progress Bar -->
            <div class="w-full bg-white bg-opacity-20 rounded-full h-2">
                <div class="bg-white rounded-full h-2 transition-all duration-500 ease-out" id="progress-bar" style="width: 50%"></div>
            </div>
        </div>

        <!-- Form -->
        <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="portfolio-form">
            @csrf
            <input type="hidden" name="post_type" value="6">

            <!-- Adım 1: Temel Bilgiler -->
            <div id="step-1" class="step-content">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">1</div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Temel Bilgiler</h2>
                    </div>

                    <!-- Başlık -->
                    <div class="mb-8">
                        <label for="title" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a2 2 0 012-2z"></path>
                                </svg>
                                Proje Başlığı
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <input type="text" 
                               id="portfolio_project_title" 
                               name="portfolio_project_title" 
                               value="{{ old('portfolio_project_title') }}" 
                               required 
                               placeholder="Örn: E-ticaret Web Sitesi Tasarımı"
                               class="w-full px-4 py-4 text-lg border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-all duration-200 shadow-sm">
                    </div>

                    <!-- Kategori -->
                    <div class="mb-8">
                        <label for="portfolio_category_id" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 0 1 0 2.828l-7 7a2 2 0 0 1-2.828 0l-7-7A1.994 1.994 0 0 1 3 12V7a2 2 0 0 1 2-2z"></path>
                                </svg>
                                Kategori
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <select id="portfolio_category_id" 
                                name="portfolio_category_id" 
                                required 
                                class="w-full px-4 py-4 text-lg border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-all duration-200 shadow-sm">
                            <option value="">Kategori seçin</option>
                            @foreach($projectCategories as $category)
                                <option value="{{ $category->id }}" {{ old('portfolio_category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Proje URL -->
                    <div class="mb-8">
                        <label for="project_url" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1"></path>
                                </svg>
                                Proje URL'si
                            </span>
                        </label>
                        <input type="url" 
                               id="portfolio_project_url" 
                               name="portfolio_project_url" 
                               value="{{ old('portfolio_project_url') }}" 
                               placeholder="https://example.com"
                               class="w-full px-4 py-4 text-lg border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-all duration-200 shadow-sm">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">İsteğe bağlı - Projenizin canlı linkini paylaşabilirsiniz</p>
                    </div>

                    <!-- Sonraki Adım Butonu -->
                    <div class="flex justify-end">
                        <button type="button" 
                                id="next-step-btn" 
                                class="px-8 py-4 bg-gradient-to-r from-indigo-500 to-purple-600 text-white font-semibold rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center">
                            Sonraki Adım
                            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

            <!-- Adım 2: Detaylar ve İçerik -->
            <div id="step-2" class="step-content hidden">
                <div class="bg-white dark:bg-gray-900 rounded-xl shadow-lg p-8 border border-gray-100 dark:border-gray-700">
                    <div class="flex items-center mb-6">
                        <div class="w-10 h-10 bg-gradient-to-r from-indigo-500 to-purple-600 rounded-full flex items-center justify-center text-white font-bold mr-4">2</div>
                        <h2 class="text-2xl font-bold text-gray-900 dark:text-white">Detaylar ve İçerik</h2>
                    </div>

                    <!-- İçerik -->
                    <div class="mb-8">
                        <label for="content" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                Proje Açıklaması
                                <span class="text-red-500 ml-1">*</span>
                            </span>
                        </label>
                        <div id="content-editor" style="height: 350px;" class="border border-gray-300 dark:border-gray-600 rounded-xl shadow-sm"></div>
                        <textarea name="portfolio_project_description" id="portfolio-project-description-textarea" style="display: none;" required>{{ old('portfolio_project_description', '') }}</textarea>
                    </div>

                    <!-- Kullanılan Teknolojiler -->
                    <div class="mb-8">
                        <label for="technologies_used" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"></path>
                                </svg>
                                Kullanılan Teknolojiler
                            </span>
                        </label>
                        
                        <div class="technologies-container">
                            <div class="flex flex-wrap gap-2 mb-3 min-h-[50px] p-4 border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-800" id="technologies-display">
                                <span class="text-gray-400 dark:text-gray-500 text-sm">Henüz teknoloji eklenmedi</span>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" 
                                       class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-all duration-200 technology-input"
                                       placeholder="Teknoloji ekleyin (örn: React, Node.js, MongoDB...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-sm hover:shadow-md add-technology-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <input type="hidden" id="portfolio_technologies" name="portfolio_technologies" value="{{ old('portfolio_technologies') }}">
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Projede kullandığınız teknolojileri ekleyin. (Maksimum 15 teknoloji)
                        </p>
                    </div>

                    <!-- Etiketler -->
                    <div class="mb-8">
                        <label for="tags" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a2 2 0 012-2z"></path>
                                </svg>
                                Etiketler
                            </span>
                        </label>
                        
                        <div class="tags-container">
                            <div class="flex flex-wrap gap-2 mb-3 min-h-[50px] p-4 border border-gray-300 dark:border-gray-600 rounded-xl bg-gray-50 dark:bg-gray-800" id="tags-display">
                                <span class="text-gray-400 dark:text-gray-500 text-sm">Henüz etiket eklenmedi</span>
                            </div>
                            <div class="flex gap-2">
                                <input type="text" 
                                       class="flex-1 px-4 py-3 border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-all duration-200 tag-input"
                                       placeholder="Etiket ekleyin (örn: web tasarım, portfolio, grafik...)"
                                       maxlength="30">
                                <button type="button" 
                                        class="px-6 py-3 bg-gradient-to-r from-indigo-500 to-purple-600 text-white rounded-xl hover:from-indigo-600 hover:to-purple-700 transition-all duration-200 shadow-sm hover:shadow-md add-tag-btn">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        
                        <input type="hidden" id="tags" name="tags" value="{{ old('tags') }}">
                        
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                            Portfolyonuzu daha kolay bulunabilir hale getirmek için etiketler ekleyin. (Maksimum 10 etiket)
                        </p>
                    </div>

                    <!-- Tamamlanma Tarihi -->
                    <div class="mb-8">
                        <label for="completion_date" class="block text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">
                            <span class="flex items-center">
                                <svg class="w-4 h-4 mr-2 text-indigo-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                Tamamlanma Tarihi
                            </span>
                        </label>
                        <input type="date" 
                               id="portfolio_completion_date" 
                               name="portfolio_completion_date" 
                               value="{{ old('portfolio_completion_date') }}" 
                               class="w-full px-4 py-4 text-lg border border-gray-300 dark:border-gray-600 rounded-xl focus:ring-2 focus:ring-indigo-500 focus:border-transparent dark:bg-gray-800 dark:text-white transition-all duration-200 shadow-sm">
                        <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">İsteğe bağlı - Projenin tamamlandığı tarihi belirtebilirsiniz</p>
                    </div>

                    <!-- Butonlar -->
                    <div class="flex justify-between items-center">
                        <button type="button" 
                                id="prev-step-btn" 
                                class="px-8 py-4 bg-gray-500 text-white font-semibold rounded-xl hover:bg-gray-600 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                            Önceki Adım
                        </button>
                        <button type="submit" 
                                class="px-8 py-4 bg-gradient-to-r from-green-500 to-green-600 text-white font-semibold rounded-xl hover:from-green-600 hover:to-green-700 transition-all duration-200 shadow-lg hover:shadow-xl transform hover:-translate-y-0.5 flex items-center">
                            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                            </svg>
                            Portfolyoyu Yayınla
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
<link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet">

<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 2;

    // Step Navigation
    function showStep(step) {
        // Hide all steps
        document.querySelectorAll('.step-content').forEach(el => {
            el.classList.add('hidden');
        });
        
        // Show current step
        document.getElementById(`step-${step}`).classList.remove('hidden');
        
        // Update progress
        const progress = (step / totalSteps) * 100;
        document.getElementById('progress-bar').style.width = progress + '%';
        document.getElementById('step-counter').textContent = `${step} / ${totalSteps}`;
        
        currentStep = step;
    }

    // Next Step Button
    document.getElementById('next-step-btn').addEventListener('click', function() {
        // Validate current step
        const title = document.getElementById('portfolio_project_title').value.trim();
        const category = document.getElementById('portfolio_category_id').value;
        
        if (!title) {
            alert('Lütfen proje başlığını girin.');
            document.getElementById('portfolio_project_title').focus();
            return;
        }
        
        if (!category) {
            alert('Lütfen bir kategori seçin.');
            document.getElementById('portfolio_category_id').focus();
            return;
        }
        
        if (currentStep < totalSteps) {
            showStep(currentStep + 1);
        }
    });

    // Previous Step Button
    document.getElementById('prev-step-btn').addEventListener('click', function() {
        if (currentStep > 1) {
            showStep(currentStep - 1);
        }
    });

    // Quill Editor
    var quill = new Quill('#content-editor', {
        theme: 'snow',
        placeholder: 'Portfolyo projenizin detaylı açıklamasını yazın...',
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

    // Use the newer text-change event handler
    quill.on('text-change', function(delta, oldDelta, source) {
        document.getElementById('portfolio-project-description-textarea').value = quill.getSemanticHTML();
    });

    // Technology System
    let technologies = [];
    const maxTechnologies = 15;
    
    function updateTechnologiesDisplay() {
        const technologiesDisplay = document.getElementById('technologies-display');
        technologiesDisplay.innerHTML = '';
        
        if (technologies.length === 0) {
            technologiesDisplay.innerHTML = '<span class="text-gray-400 dark:text-gray-500 text-sm">Henüz teknoloji eklenmedi</span>';
            return;
        }
        
        technologies.forEach((tech, index) => {
            const techElement = document.createElement('span');
            techElement.className = 'inline-flex items-center px-3 py-2 rounded-full text-sm bg-gradient-to-r from-blue-100 to-blue-200 dark:from-blue-900 dark:to-blue-800 text-blue-800 dark:text-blue-200 shadow-sm';
            techElement.innerHTML = `
                ${tech}
                <button type="button" class="ml-2 text-blue-600 dark:text-blue-300 hover:text-blue-800 dark:hover:text-blue-100 transition-colors" onclick="removeTechnology(${index})">
                    <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                    </svg>
                </button>
            `;
            technologiesDisplay.appendChild(techElement);
        });
        
        document.getElementById('portfolio_technologies').value = technologies.join(',');
    }
    
    window.removeTechnology = function(index) {
        technologies.splice(index, 1);
        updateTechnologiesDisplay();
    };
    
    document.querySelector('.add-technology-btn').addEventListener('click', function() {
        const input = document.querySelector('.technology-input');
        const tech = input.value.trim();
        
        if (tech && !technologies.includes(tech) && technologies.length < maxTechnologies) {
            technologies.push(tech);
            input.value = '';
            updateTechnologiesDisplay();
        } else if (technologies.length >= maxTechnologies) {
            alert('Maksimum 15 teknoloji ekleyebilirsiniz.');
        } else if (technologies.includes(tech)) {
            alert('Bu teknoloji zaten eklenmiş.');
        }
    });
    
    document.querySelector('.technology-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('.add-technology-btn').click();
        }
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
            tagElement.className = 'inline-flex items-center px-3 py-1 rounded-full text-sm bg-indigo-100 dark:bg-indigo-900 text-indigo-800 dark:text-indigo-200';
            tagElement.innerHTML = `
                ${tag}
                <button type="button" class="ml-2 text-indigo-600 dark:text-indigo-300 hover:text-indigo-800 dark:hover:text-indigo-100" onclick="removeTag(${index})">
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
        } else if (tags.length >= maxTags) {
            alert('Maksimum 10 etiket ekleyebilirsiniz.');
        } else if (tags.includes(tag)) {
            alert('Bu etiket zaten eklenmiş.');
        }
    });
    
    document.querySelector('.tag-input').addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            document.querySelector('.add-tag-btn').click();
        }
    });
    
    // Set maximum date to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('portfolio_completion_date').max = today;
    
    // Load existing technologies
    const existingTechnologies = document.getElementById('portfolio_technologies').value;
    if (existingTechnologies) {
        technologies = existingTechnologies.split(',').filter(tech => tech.trim());
        updateTechnologiesDisplay();
    }

    // Load existing tags
    const existingTags = document.getElementById('tags').value;
    if (existingTags) {
        tags = existingTags.split(',').filter(tag => tag.trim());
        updateTagsDisplay();
    }

    // Form validation before submit
    document.getElementById('portfolio-form').addEventListener('submit', function(e) {
        const content = quill.getText().trim();
        if (!content || content.length < 10) {
            e.preventDefault();
            alert('Lütfen proje açıklamasını girin (en az 10 karakter).');
            showStep(2);
            return false;
        }
        
        // Update the hidden textarea with content
        document.getElementById('portfolio-project-description-textarea').value = quill.getSemanticHTML();
    });

    // Initialize first step
    showStep(1);
});
</script>
@endpush
@endsection