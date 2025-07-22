@extends('layouts.app')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-6xl mx-auto">
        <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6 transition-colors duration-300">
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Site Ayarları</h1>
                <div class="flex space-x-2">
                    <button onclick="clearCache()" class="bg-yellow-500 hover:bg-yellow-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-sync-alt mr-2"></i>Cache Temizle
                    </button>
                    <button onclick="saveSettings()" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition-colors">
                        <i class="fas fa-save mr-2"></i>Kaydet
                    </button>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">
                <!-- Sidebar -->
                <div class="lg:col-span-1">
                    <div class="bg-gray-50 dark:bg-gray-700 rounded-lg p-4 transition-colors duration-300">
                        <h3 class="font-semibold text-gray-900 dark:text-white mb-4">Kategoriler</h3>
                        <nav class="space-y-2">
                            <button onclick="showGroup('general')" class="group-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition-colors active" data-group="general">
                                <i class="fas fa-cog mr-2"></i>Genel Ayarlar
                            </button>
                            <button onclick="showGroup('appearance')" class="group-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition-colors" data-group="appearance">
                                <i class="fas fa-palette mr-2"></i>Görünüm
                            </button>
                            <button onclick="showGroup('social')" class="group-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition-colors" data-group="social">
                                <i class="fas fa-share-alt mr-2"></i>Sosyal Medya
                            </button>
                            <button onclick="showGroup('platform')" class="group-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition-colors" data-group="platform">
                                <i class="fas fa-cogs mr-2"></i>Platform
                            </button>
                            <button onclick="showGroup('contact')" class="group-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition-colors" data-group="contact">
                                <i class="fas fa-address-book mr-2"></i>İletişim
                            </button>
                            <button onclick="showGroup('seo')" class="group-btn w-full text-left px-3 py-2 rounded-lg hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-700 dark:text-gray-300 transition-colors" data-group="seo">
                                <i class="fas fa-search mr-2"></i>SEO & Analytics
                            </button>
                        </nav>
                    </div>
                </div>

                <!-- Content -->
                <div class="lg:col-span-3">
                    <form id="settingsForm">
                        @foreach($settings as $group => $groupSettings)
                        <div class="setting-group {{ $group === 'general' ? '' : 'hidden' }}" data-group="{{ $group }}">
                            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 capitalize">
                                @switch($group)
                                    @case('general') Genel Ayarlar @break
                                    @case('appearance') Görünüm Ayarları @break
                                    @case('social') Sosyal Medya @break
                                    @case('platform') Platform Ayarları @break
                                    @case('contact') İletişim Bilgileri @break
                                    @case('seo') SEO & Analytics @break
                                    @default {{ ucfirst($group) }}
                                @endswitch
                            </h2>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                @foreach($groupSettings->sortBy('sort_order') as $setting)
                                <div class="space-y-2">
                                    <label for="{{ $setting->key }}" class="block text-sm font-medium text-gray-700 dark:text-gray-300">
                                        {{ $setting->label }}
                                        @if($setting->description)
                                        <span class="text-xs text-gray-500 dark:text-gray-400 block">{{ $setting->description }}</span>
                                        @endif
                                    </label>
                                    
                                    @switch($setting->type)
                                        @case('textarea')
                                            <textarea 
                                                id="{{ $setting->key }}" 
                                                name="{{ $setting->key }}" 
                                                rows="3"
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                                placeholder="{{ $setting->label }}"
                                            >{{ $setting->value }}</textarea>
                                            @break
                                        
                                        @case('number')
                                            <input 
                                                type="number" 
                                                id="{{ $setting->key }}" 
                                                name="{{ $setting->key }}" 
                                                value="{{ $setting->value }}"
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                                placeholder="{{ $setting->label }}"
                                            >
                                            @break
                                        
                                        @case('email')
                                            <input 
                                                type="email" 
                                                id="{{ $setting->key }}" 
                                                name="{{ $setting->key }}" 
                                                value="{{ $setting->value }}"
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                                placeholder="{{ $setting->label }}"
                                            >
                                            @break
                                        
                                        @case('url')
                                            <input 
                                                type="url" 
                                                id="{{ $setting->key }}" 
                                                name="{{ $setting->key }}" 
                                                value="{{ $setting->value }}"
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                                placeholder="{{ $setting->label }}"
                                            >
                                            @break
                                        
                                        @case('boolean')
                                            <div class="flex items-center">
                                                <input 
                                                    type="checkbox" 
                                                    id="{{ $setting->key }}" 
                                                    name="{{ $setting->key }}" 
                                                    value="1"
                                                    {{ $setting->value ? 'checked' : '' }}
                                                    class="w-4 h-4 text-blue-600 bg-gray-100 dark:bg-gray-700 border-gray-300 dark:border-gray-600 rounded focus:ring-blue-500 focus:ring-2"
                                                >
                                                <label for="{{ $setting->key }}" class="ml-2 text-sm text-gray-700 dark:text-gray-300">Aktif</label>
                                            </div>
                                            @break
                                        
                                        @default
                                            <input 
                                                type="text" 
                                                id="{{ $setting->key }}" 
                                                name="{{ $setting->key }}" 
                                                value="{{ $setting->value }}"
                                                class="w-full px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white dark:bg-gray-700 text-gray-900 dark:text-white transition-colors"
                                                placeholder="{{ $setting->label }}"
                                            >
                                    @endswitch
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function showGroup(groupName) {
    // Hide all groups
    document.querySelectorAll('.setting-group').forEach(group => {
        group.classList.add('hidden');
    });
    
    // Show selected group
    document.querySelector(`[data-group="${groupName}"]`).classList.remove('hidden');
    
    // Update active button
    document.querySelectorAll('.group-btn').forEach(btn => {
        btn.classList.remove('active', 'bg-blue-500', 'text-white');
        btn.classList.add('text-gray-700', 'dark:text-gray-300');
    });
    
    const activeBtn = document.querySelector(`[data-group="${groupName}"]`);
    activeBtn.classList.add('active', 'bg-blue-500', 'text-white');
    activeBtn.classList.remove('text-gray-700', 'dark:text-gray-300');
}

function saveSettings() {
    const form = document.getElementById('settingsForm');
    const formData = new FormData(form);
    const settings = [];
    
    for (let [key, value] of formData.entries()) {
        settings.push({ key, value });
    }
    
    // Handle checkboxes that aren't checked
    document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
        if (!checkbox.checked) {
            settings.push({ key: checkbox.name, value: '0' });
        }
    });
    
    fetch('{{ route("admin.site-settings.update") }}', {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        body: JSON.stringify({ settings })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Ayarlar başarıyla güncellendi!', 'success');
        } else {
            showNotification('Hata: ' + data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Bir hata oluştu: ' + error.message, 'error');
    });
}

function clearCache() {
    fetch('{{ route("admin.site-settings.clear-cache") }}', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('Cache başarıyla temizlendi!', 'success');
        } else {
            showNotification('Hata: ' + data.message, 'error');
        }
    })
    .catch(error => {
        showNotification('Bir hata oluştu: ' + error.message, 'error');
    });
}

function showNotification(message, type) {
    const notification = document.createElement('div');
    notification.className = `fixed top-4 right-4 z-50 p-4 rounded-lg shadow-lg transition-all duration-300 ${
        type === 'success' ? 'bg-green-500 text-white' : 'bg-red-500 text-white'
    }`;
    notification.textContent = message;
    
    document.body.appendChild(notification);
    
    setTimeout(() => {
        notification.remove();
    }, 3000);
}
</script>
@endsection