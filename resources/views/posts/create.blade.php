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
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- İçerik -->
                    <div>
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">İçerik *</label>
                        <textarea id="content" name="content" rows="6" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Gönderinizin detaylarını yazın..." required>{{ old('content') }}</textarea>
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
            <div id="service-fields" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hidden">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Hizmet Detayları</h2>
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="service_price" class="block text-sm font-medium text-gray-700 mb-2">Fiyat (₺)</label>
                        <input type="number" id="service_price" name="service_price" value="{{ old('service_price') }}" 
                               min="0" step="0.01" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="0.00">
                    </div>
                    
                    <div>
                        <label for="service_delivery_time" class="block text-sm font-medium text-gray-700 mb-2">Teslimat Süresi (Gün)</label>
                        <input type="number" id="service_delivery_time" name="service_delivery_time" value="{{ old('service_delivery_time') }}" 
                               min="1" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="7">
                    </div>
                </div>
                
                <div class="mt-4">
                    <label class="flex items-center">
                        <input type="checkbox" name="service_auto_delivery" value="1" {{ old('service_auto_delivery') ? 'checked' : '' }}
                               class="rounded border-gray-300 text-blue-600 shadow-sm focus:border-blue-300 focus:ring focus:ring-blue-200 focus:ring-opacity-50">
                        <span class="ml-2 text-sm text-gray-700">Otomatik teslimat</span>
                    </label>
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
                               placeholder="0.00">
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
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
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
                                       placeholder="Seçenek 1">
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
            <div id="portfolio-fields" class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 hidden">
                <h2 class="text-lg font-semibold text-gray-900 mb-4">Portfolyo Detayları</h2>
                
                <div class="space-y-4">
                    <div>
                        <label for="portfolio_project_title" class="block text-sm font-medium text-gray-700 mb-2">Proje Başlığı <span class="text-red-500">*</span></label>
                        <input type="text" id="portfolio_project_title" name="portfolio_project_title" value="{{ old('portfolio_project_title') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="Proje başlığını yazın" required>
                    </div>
                    
                    <div>
                        <label for="portfolio_project_description" class="block text-sm font-medium text-gray-700 mb-2">Proje Açıklaması <span class="text-red-500">*</span></label>
                        <textarea id="portfolio_project_description" name="portfolio_project_description" rows="4" 
                                  class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                  placeholder="Proje hakkında detaylı açıklama yazın..." required>{{ old('portfolio_project_description') }}</textarea>
                    </div>
                    
                    <div>
                        <label for="portfolio_project_url" class="block text-sm font-medium text-gray-700 mb-2">Proje URL'si</label>
                        <input type="url" id="portfolio_project_url" name="portfolio_project_url" value="{{ old('portfolio_project_url') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="https://example.com">
                    </div>
                    
                    <div>
                        <label for="portfolio_technologies" class="block text-sm font-medium text-gray-700 mb-2">Kullanılan Teknolojiler</label>
                        <input type="text" id="portfolio_technologies" name="portfolio_technologies" value="{{ old('portfolio_technologies') }}" 
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                               placeholder="PHP, Laravel, MySQL, JavaScript">
                    </div>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="portfolio_completion_date" class="block text-sm font-medium text-gray-700 mb-2">Tamamlanma Tarihi</label>
                            <input type="date" id="portfolio_completion_date" name="portfolio_completion_date" value="{{ old('portfolio_completion_date') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent">
                        </div>
                        
                        <div>
                            <label for="portfolio_client_name" class="block text-sm font-medium text-gray-700 mb-2">Müşteri Adı</label>
                            <input type="text" id="portfolio_client_name" name="portfolio_client_name" value="{{ old('portfolio_client_name') }}" 
                                   class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                                   placeholder="Müşteri adı (isteğe bağlı)">
                        </div>
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
    
    // Post tipi değişikliklerini dinle
    postTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            // Tüm alanları gizle
            serviceFields.classList.add('hidden');
            auctionFields.classList.add('hidden');
            pollFields.classList.add('hidden');
            portfolioFields.classList.add('hidden');
            
            // Seçili tipe göre alanları göster
            switch(this.value) {
                case '2': // Hizmet ilanı
                    serviceFields.classList.remove('hidden');
                    break;
                case '3': // Açık artırma
                    auctionFields.classList.remove('hidden');
                    break;
                case '4': // Anket
                    pollFields.classList.remove('hidden');
                    break;
                case '5': // Portfolyo
                    portfolioFields.classList.remove('hidden');
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
    
    // Anket seçeneği ekleme
    document.getElementById('add-poll-option').addEventListener('click', function() {
        const pollOptions = document.getElementById('poll-options');
        const optionCount = pollOptions.children.length + 1;
        
        const newOption = document.createElement('div');
        newOption.className = 'flex mb-2';
        newOption.innerHTML = `
            <input type="text" name="poll_options[]" 
                   class="flex-1 px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                   placeholder="Seçenek ${optionCount}">
            <button type="button" class="ml-2 px-3 py-2 text-red-600 hover:text-red-800" onclick="this.parentElement.remove()">
                ✕
            </button>
        `;
        
        pollOptions.appendChild(newOption);
    });
    
    // İlk yükleme için varsayılan seçimi aktif et
    document.querySelector('input[name="post_type"]:checked').dispatchEvent(new Event('change'));
});
</script>
@endsection