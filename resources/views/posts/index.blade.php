@extends('layouts.app')

@section('title', 'Tüm Gönderiler')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-600 to-purple-600 rounded-xl shadow-lg p-8 mb-8 text-white">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-4xl font-bold mb-2">Tüm Gönderiler</h1>
                <p class="text-blue-100">Topluluktan en son paylaşımları keşfedin</p>
            </div>
            <div class="hidden md:block">
                <svg class="w-16 h-16 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="bg-white dark:bg-gray-800 rounded-xl shadow-lg p-6 mb-8">
        <div class="flex flex-wrap gap-4 items-center">
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Tür:</label>
                <select class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="">Tümü</option>
                    <option value="1">Gönderi</option>
                    <option value="2">Freelance İlanı</option>
                    <option value="3">Hizmet</option>
                    <option value="4">Açık Artırma</option>
                    <option value="5">Anket</option>
                    <option value="6">Portfolyo</option>
                    <option value="7">Alıcı Talebi</option>
                </select>
            </div>
            
            <div class="flex items-center space-x-2">
                <label class="text-sm font-medium text-gray-700 dark:text-gray-300">Sıralama:</label>
                <select class="px-3 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
                    <option value="latest">En Yeni</option>
                    <option value="popular">En Popüler</option>
                    <option value="trending">Trend</option>
                </select>
            </div>
            
            <div class="flex-1">
                <input type="text" placeholder="Ara..." class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg focus:ring-2 focus:ring-blue-500 dark:bg-gray-700 dark:text-white">
            </div>
        </div>
    </div>

    <!-- Posts Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="posts-container">
        <!-- Posts will be loaded here via AJAX -->
        <div class="col-span-full text-center py-12">
            <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
            <p class="text-gray-500 dark:text-gray-400">Gönderiler yükleniyor...</p>
        </div>
    </div>

    <!-- Load More Button -->
    <div class="text-center mt-8">
        <button id="load-more-btn" class="hidden px-8 py-3 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition-colors">
            Daha Fazla Yükle
        </button>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentPage = 1;
    let loading = false;
    let hasMore = true;
    
    const postsContainer = document.getElementById('posts-container');
    const loadMoreBtn = document.getElementById('load-more-btn');
    
    // Load posts function
    function loadPosts(page = 1, append = false) {
        if (loading) return;
        
        loading = true;
        
        // Show loading state
        if (!append) {
            postsContainer.innerHTML = `
                <div class="col-span-full text-center py-12">
                    <div class="animate-spin rounded-full h-12 w-12 border-b-2 border-blue-600 mx-auto mb-4"></div>
                    <p class="text-gray-500 dark:text-gray-400">Gönderiler yükleniyor...</p>
                </div>
            `;
        }
        
        // Get filter values
        const postType = document.querySelector('select').value;
        const sortBy = document.querySelectorAll('select')[1].value;
        const search = document.querySelector('input[type="text"]').value;
        
        // Simulate API call (replace with actual API endpoint)
        setTimeout(() => {
            const mockPosts = generateMockPosts(page);
            
            if (!append) {
                postsContainer.innerHTML = '';
            }
            
            if (mockPosts.length === 0) {
                if (page === 1) {
                    postsContainer.innerHTML = `
                        <div class="col-span-full text-center py-12">
                            <svg class="w-16 h-16 text-gray-400 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                            <h3 class="text-lg font-medium text-gray-900 dark:text-white mb-2">Henüz gönderi yok</h3>
                            <p class="text-gray-500 dark:text-gray-400">İlk gönderiyi siz paylaşın!</p>
                        </div>
                    `;
                }
                hasMore = false;
                loadMoreBtn.classList.add('hidden');
            } else {
                mockPosts.forEach(post => {
                    postsContainer.appendChild(createPostCard(post));
                });
                
                if (mockPosts.length < 9) {
                    hasMore = false;
                    loadMoreBtn.classList.add('hidden');
                } else {
                    loadMoreBtn.classList.remove('hidden');
                }
            }
            
            loading = false;
        }, 1000);
    }
    
    // Generate mock posts (replace with actual API data)
    function generateMockPosts(page) {
        const posts = [];
        const postTypes = [
            { id: 1, name: 'Gönderi', color: 'blue', icon: 'fas fa-file-text' },
            { id: 2, name: 'Freelance', color: 'green', icon: 'fas fa-briefcase' },
            { id: 3, name: 'Hizmet', color: 'purple', icon: 'fas fa-cogs' },
            { id: 4, name: 'Açık Artırma', color: 'red', icon: 'fas fa-gavel' },
            { id: 5, name: 'Anket', color: 'yellow', icon: 'fas fa-poll' },
            { id: 6, name: 'Portfolyo', color: 'indigo', icon: 'fas fa-portfolio' }
        ];
        
        for (let i = 0; i < 9; i++) {
            const postType = postTypes[Math.floor(Math.random() * postTypes.length)];
            posts.push({
                id: (page - 1) * 9 + i + 1,
                title: `Örnek ${postType.name} Başlığı ${(page - 1) * 9 + i + 1}`,
                excerpt: 'Bu bir örnek açıklama metnidir. Gerçek veriler API\'den gelecektir.',
                author: 'Kullanıcı ' + (Math.floor(Math.random() * 100) + 1),
                created_at: new Date(Date.now() - Math.random() * 30 * 24 * 60 * 60 * 1000).toLocaleDateString('tr-TR'),
                views: Math.floor(Math.random() * 1000),
                likes: Math.floor(Math.random() * 100),
                comments: Math.floor(Math.random() * 50),
                type: postType,
                tags: ['tag1', 'tag2', 'tag3'].slice(0, Math.floor(Math.random() * 3) + 1)
            });
        }
        
        return page > 3 ? [] : posts; // Simulate end of data after 3 pages
    }
    
    // Create post card element
    function createPostCard(post) {
        const card = document.createElement('div');
        card.className = 'bg-white dark:bg-gray-800 rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1';
        
        card.innerHTML = `
            <div class="p-6">
                <!-- Post Type Badge -->
                <div class="flex items-center justify-between mb-4">
                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-${post.type.color}-100 text-${post.type.color}-800 dark:bg-${post.type.color}-900 dark:text-${post.type.color}-200">
                        <i class="${post.type.icon} mr-1"></i>
                        ${post.type.name}
                    </span>
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <i class="fas fa-eye mr-1"></i>
                        ${post.views}
                    </div>
                </div>
                
                <!-- Title -->
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white mb-2 line-clamp-2">
                    ${post.title}
                </h3>
                
                <!-- Excerpt -->
                <p class="text-gray-600 dark:text-gray-300 text-sm mb-4 line-clamp-3">
                    ${post.excerpt}
                </p>
                
                <!-- Tags -->
                <div class="flex flex-wrap gap-2 mb-4">
                    ${post.tags.map(tag => `
                        <span class="inline-block px-2 py-1 bg-gray-100 dark:bg-gray-700 text-gray-700 dark:text-gray-300 text-xs rounded">
                            #${tag}
                        </span>
                    `).join('')}
                </div>
                
                <!-- Footer -->
                <div class="flex items-center justify-between pt-4 border-t border-gray-200 dark:border-gray-700">
                    <div class="flex items-center text-sm text-gray-500 dark:text-gray-400">
                        <div class="w-6 h-6 bg-gray-300 dark:bg-gray-600 rounded-full mr-2"></div>
                        ${post.author}
                    </div>
                    <div class="flex items-center space-x-4 text-sm text-gray-500 dark:text-gray-400">
                        <span class="flex items-center">
                            <i class="fas fa-heart mr-1"></i>
                            ${post.likes}
                        </span>
                        <span class="flex items-center">
                            <i class="fas fa-comment mr-1"></i>
                            ${post.comments}
                        </span>
                    </div>
                </div>
                
                <!-- Date -->
                <div class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                    ${post.created_at}
                </div>
            </div>
        `;
        
        return card;
    }
    
    // Event listeners
    loadMoreBtn.addEventListener('click', function() {
        currentPage++;
        loadPosts(currentPage, true);
    });
    
    // Filter change events
    document.querySelectorAll('select, input[type="text"]').forEach(element => {
        element.addEventListener('change', function() {
            currentPage = 1;
            hasMore = true;
            loadPosts(1, false);
        });
    });
    
    // Search input with debounce
    let searchTimeout;
    document.querySelector('input[type="text"]').addEventListener('input', function() {
        clearTimeout(searchTimeout);
        searchTimeout = setTimeout(() => {
            currentPage = 1;
            hasMore = true;
            loadPosts(1, false);
        }, 500);
    });
    
    // Initial load
    loadPosts(1, false);
});
</script>
@endpush

@push('styles')
<style>
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}
</style>
@endpush
@endsection