@extends('layouts.app')

@section('title', 'Yeni Gönderi Oluştur')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-4xl mx-auto px-4 py-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Yeni Gönderi Oluştur</h1>
            <p class="text-gray-600">Toplulukla bilgi, deneyim ve projelerini paylaş</p>
        </div>

        <!-- Post Creation Form -->
        <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
            <form action="#" method="POST" enctype="multipart/form-data">
                @csrf
                
                <!-- Post Type Selection -->
                <div class="mb-6">
                    <label class="block text-sm font-medium text-gray-700 mb-3">Gönderi Türü</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type" value="post" class="sr-only peer" checked>
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition-colors">
                                <i class="fas fa-edit text-2xl text-gray-400 peer-checked:text-blue-500 mb-2"></i>
                                <div class="text-sm font-medium text-gray-700">Genel</div>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type" value="question" class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition-colors">
                                <i class="fas fa-question-circle text-2xl text-gray-400 peer-checked:text-blue-500 mb-2"></i>
                                <div class="text-sm font-medium text-gray-700">Soru</div>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type" value="article" class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition-colors">
                                <i class="fas fa-newspaper text-2xl text-gray-400 peer-checked:text-blue-500 mb-2"></i>
                                <div class="text-sm font-medium text-gray-700">Makale</div>
                            </div>
                        </label>
                        
                        <label class="relative cursor-pointer">
                            <input type="radio" name="type" value="project" class="sr-only peer">
                            <div class="p-4 border-2 border-gray-200 rounded-lg text-center peer-checked:border-blue-500 peer-checked:bg-blue-50 hover:border-gray-300 transition-colors">
                                <i class="fas fa-code text-2xl text-gray-400 peer-checked:text-blue-500 mb-2"></i>
                                <div class="text-sm font-medium text-gray-700">Proje</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Title -->
                <div class="mb-6">
                    <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Başlık</label>
                    <input type="text" id="title" name="title" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Gönderiniz için açıklayıcı bir başlık yazın...">
                </div>

                <!-- Category -->
                <div class="mb-6">
                    <label for="category" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                    <select id="category" name="category_id" 
                            class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors">
                        <option value="">Kategori seçin...</option>
                        <option value="1">Web Geliştirme</option>
                        <option value="2">Mobil Uygulama</option>
                        <option value="3">Grafik Tasarım</option>
                        <option value="4">Dijital Pazarlama</option>
                        <option value="5">İçerik Yazımı</option>
                        <option value="6">SEO</option>
                    </select>
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label for="content" class="block text-sm font-medium text-gray-700 mb-2">İçerik</label>
                    <textarea id="content" name="content" rows="8"
                              class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors resize-none"
                              placeholder="Gönderinizin içeriğini yazın..."></textarea>
                </div>

                <!-- Image Upload -->
                <div class="mb-6">
                    <label for="image" class="block text-sm font-medium text-gray-700 mb-2">Görsel (Opsiyonel)</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-gray-400 transition-colors">
                        <input type="file" id="image" name="image" accept="image/*" class="hidden">
                        <label for="image" class="cursor-pointer">
                            <i class="fas fa-cloud-upload-alt text-3xl text-gray-400 mb-2"></i>
                            <div class="text-sm text-gray-600">
                                <span class="font-medium text-blue-600 hover:text-blue-500">Dosya seçin</span>
                                veya sürükleyip bırakın
                            </div>
                            <div class="text-xs text-gray-500 mt-1">PNG, JPG, GIF (max. 5MB)</div>
                        </label>
                    </div>
                </div>

                <!-- Tags -->
                <div class="mb-6">
                    <label for="tags" class="block text-sm font-medium text-gray-700 mb-2">Etiketler</label>
                    <input type="text" id="tags" name="tags" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Etiketleri virgülle ayırın (örn: react, javascript, frontend)">
                </div>

                <!-- Project Budget (shown only for project type) -->
                <div class="mb-6 hidden" id="budget-section">
                    <label for="budget" class="block text-sm font-medium text-gray-700 mb-2">Bütçe (TL)</label>
                    <input type="number" id="budget" name="budget" 
                           class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-colors"
                           placeholder="Proje bütçenizi girin...">
                </div>

                <!-- Action Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" 
                            class="flex-1 bg-blue-600 text-white px-6 py-3 rounded-lg font-medium hover:bg-blue-700 focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-paper-plane mr-2"></i>
                        Gönder
                    </button>
                    
                    <button type="button" 
                            class="flex-1 bg-gray-100 text-gray-700 px-6 py-3 rounded-lg font-medium hover:bg-gray-200 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-save mr-2"></i>
                        Taslak Olarak Kaydet
                    </button>
                    
                    <a href="{{ route('home') }}" 
                       class="flex-1 text-center bg-white text-gray-700 px-6 py-3 rounded-lg font-medium border border-gray-300 hover:bg-gray-50 focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors">
                        <i class="fas fa-times mr-2"></i>
                        İptal
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
// Show/hide budget section based on post type
document.addEventListener('DOMContentLoaded', function() {
    const typeRadios = document.querySelectorAll('input[name="type"]');
    const budgetSection = document.getElementById('budget-section');
    
    typeRadios.forEach(radio => {
        radio.addEventListener('change', function() {
            if (this.value === 'project') {
                budgetSection.classList.remove('hidden');
            } else {
                budgetSection.classList.add('hidden');
            }
        });
    });
});
</script>
@endsection