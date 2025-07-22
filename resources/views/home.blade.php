@extends('layouts.app')

@section('title', 'ProConnect | Ana Sayfa')

@section('content')
<div class="flex">
    <!-- Left Sidebar -->
    <div class="hidden lg:block w-80 p-4 space-y-4">
        <!-- Shortcuts -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">Kısayollar</h3>
            <div class="space-y-2">
                <a href="{{ route('projects.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-plus-circle text-blue-500"></i>
                    <span class="text-sm">Proje Oluştur</span>
                </a>
                <a href="{{ route('community.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-users text-purple-500"></i>
                    <span class="text-sm">Topluluk Oluştur</span>
                </a>
                <a href="{{ route('posts.create') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-edit text-green-500"></i>
                    <span class="text-sm">Gönderi Yaz</span>
                </a>
                <a href="{{ route('freelancers.index') }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                    <i class="fas fa-search text-orange-500"></i>
                    <span class="text-sm">Freelancer Bul</span>
                </a>
            </div>
        </div>

        <!-- Followed Communities -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">Takip Edilen Topluluklar</h3>
            <div class="space-y-3">
                @foreach($categories->take(5) as $category)
                <a href="{{ route('categories.show', $category->slug) }}" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-100">
                    <div class="w-8 h-8 bg-{{ $category->color ?? 'blue' }}-100 rounded-full flex items-center justify-center">
                        <i class="{{ $category->icon ?? 'fas fa-folder' }} text-{{ $category->color ?? 'blue' }}-600 text-sm"></i>
                    </div>
                    <div class="flex-1">
                        <p class="text-sm font-medium">{{ $category->name }}</p>
                        <p class="text-xs text-gray-500">{{ $category->posts_count ?? 0 }} gönderi</p>
                    </div>
                </a>
                @endforeach
                <a href="{{ route('categories.index') }}" class="text-blue-600 text-sm hover:underline">Tümünü gör</a>
            </div>
        </div>
    </div>

    <!-- Main Feed -->
    <div class="flex-1 max-w-2xl mx-auto p-4 space-y-4">
        <!-- Post Creation -->
        @auth
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center space-x-3 mb-4">
                <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name) }}" 
                     alt="Profile" class="w-10 h-10 rounded-full">
                <div class="flex-1 bg-gray-100 rounded-full px-4 py-2 cursor-pointer" onclick="openPostModal()">
                    <span class="text-gray-500">Ne düşünüyorsun {{ auth()->user()->first_name }}?</span>
                </div>
            </div>
            <div class="flex items-center justify-between">
                <div class="flex space-x-4">
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600">
                        <i class="fas fa-image"></i>
                        <span class="text-sm">Fotoğraf</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-green-600">
                        <i class="fas fa-briefcase"></i>
                        <span class="text-sm">Proje</span>
                    </button>
                    <button class="flex items-center space-x-2 text-gray-600 hover:text-purple-600">
                        <i class="fas fa-poll"></i>
                        <span class="text-sm">Anket</span>
                    </button>
                </div>
            </div>
        </div>
        @endauth

        <!-- Post Filters -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <div class="flex items-center space-x-4">
                <button class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-medium">
                    <i class="fas fa-fire mr-1"></i>Popüler
                </button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-full text-sm">
                    <i class="fas fa-clock mr-1"></i>En Yeni
                </button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-full text-sm">
                    <i class="fas fa-heart mr-1"></i>Takip Edilenler
                </button>
                <button class="px-4 py-2 text-gray-600 hover:bg-gray-100 rounded-full text-sm">
                    <i class="fas fa-briefcase mr-1"></i>Projeler
                </button>
            </div>
        </div>

        <!-- Posts Feed -->
        @foreach($recentPosts as $post)
        <article class="bg-white rounded-lg shadow-sm hover:shadow-md transition-shadow post-card">
            <!-- Post Header -->
            <div class="p-4 border-b border-gray-100">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-3">
                        <img src="{{ $post->user->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($post->user->first_name) }}" 
                             alt="Profile" class="w-10 h-10 rounded-full">
                        <div>
                            <h4 class="font-semibold">{{ $post->user->first_name }} {{ $post->user->last_name }}</h4>
                            <div class="flex items-center space-x-2 text-sm text-gray-500">
                                <span>{{ $post->user->title ?? 'Freelancer' }}</span>
                                <span>•</span>
                                <span>{{ $post->created_at->diffForHumans() }}</span>
                                @if($post->category)
                                <span>•</span>
                                <span class="text-blue-600">#{{ $post->category->name }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <button class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-ellipsis-h"></i>
                    </button>
                </div>
            </div>

            <!-- Post Content -->
            <div class="p-4">
                <h3 class="font-semibold text-lg mb-2">{{ $post->title }}</h3>
                <p class="text-gray-700 mb-4">{{ Str::limit($post->content, 200) }}</p>
                
                @if($post->image)
                <img src="{{ $post->image }}" alt="Post image" class="w-full h-64 object-cover rounded-lg mb-4">
                @endif

                @if($post->type === 'project')
                <div class="bg-green-50 border border-green-200 rounded-lg p-3 mb-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <span class="text-green-600 font-medium">Proje Bütçesi</span>
                            <p class="text-lg font-bold text-green-700">${{ number_format($post->budget ?? 0) }}</p>
                        </div>
                        <button class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                            Teklif Ver
                        </button>
                    </div>
                </div>
                @endif
            </div>

            <!-- Post Actions -->
            <div class="px-4 pb-4">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-6">
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-red-600">
                            <i class="far fa-heart"></i>
                            <span class="text-sm">{{ $post->likes_count ?? 0 }}</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-blue-600">
                            <i class="far fa-comment"></i>
                            <span class="text-sm">{{ $post->comments_count ?? 0 }}</span>
                        </button>
                        <button class="flex items-center space-x-2 text-gray-600 hover:text-green-600">
                            <i class="far fa-share-square"></i>
                            <span class="text-sm">Paylaş</span>
                        </button>
                    </div>
                    <div class="flex items-center space-x-2 text-sm text-gray-500">
                        <i class="fas fa-eye"></i>
                        <span>{{ $post->views_count ?? 0 }} görüntüleme</span>
                    </div>
                </div>
            </div>
        </article>
        @endforeach

        <!-- Load More -->
        <div class="text-center py-8">
            <button class="bg-blue-600 text-white px-6 py-3 rounded-lg hover:bg-blue-700">
                Daha Fazla Yükle
            </button>
        </div>
    </div>

    <!-- Right Sidebar -->
    <div class="hidden xl:block w-80 p-4 space-y-4">
        <!-- Top Freelancers -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">En İyi Freelancerlar</h3>
            <div class="space-y-3">
                @foreach($topFreelancers->take(5) as $freelancer)
                <div class="flex items-center space-x-3">
                    <img src="{{ $freelancer->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode($freelancer->first_name) }}" 
                         alt="Profile" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <h4 class="font-medium text-sm">{{ $freelancer->first_name }} {{ $freelancer->last_name }}</h4>
                        <p class="text-xs text-gray-500">{{ $freelancer->title ?? 'Freelancer' }}</p>
                        <div class="flex items-center space-x-1">
                            <div class="flex text-yellow-400">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= ($freelancer->rating ?? 0) ? '' : 'text-gray-300' }} text-xs"></i>
                                @endfor
                            </div>
                            <span class="text-xs text-gray-500">({{ $freelancer->total_reviews ?? 0 }})</span>
                        </div>
                    </div>
                    <button class="text-blue-600 text-xs hover:underline">Takip Et</button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- Recent Projects -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">Son Projeler</h3>
            <div class="space-y-3">
                @foreach($recentProjects->take(3) as $project)
                <div class="border border-gray-200 rounded-lg p-3">
                    <h4 class="font-medium text-sm mb-1">{{ Str::limit($project->title, 40) }}</h4>
                    <p class="text-xs text-gray-600 mb-2">{{ Str::limit($project->description, 60) }}</p>
                    <div class="flex items-center justify-between">
                        <span class="text-green-600 font-medium text-sm">${{ number_format($project->budget) }}</span>
                        <span class="text-xs text-gray-500">{{ $project->created_at->diffForHumans() }}</span>
                    </div>
                </div>
                @endforeach
                <a href="{{ route('projects.index') }}" class="text-blue-600 text-sm hover:underline">Tüm projeleri gör</a>
            </div>
        </div>

        <!-- Trending Topics -->
        <div class="bg-white rounded-lg shadow-sm p-4">
            <h3 class="font-semibold text-gray-800 mb-3">Trend Konular</h3>
            <div class="space-y-2">
                <div class="flex items-center justify-between">
                    <span class="text-sm">#WebTasarım</span>
                    <span class="text-xs text-gray-500">1.2k gönderi</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm">#ReactJS</span>
                    <span class="text-xs text-gray-500">856 gönderi</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm">#Freelance</span>
                    <span class="text-xs text-gray-500">743 gönderi</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm">#MobilUygulama</span>
                    <span class="text-xs text-gray-500">621 gönderi</span>
                </div>
                <div class="flex items-center justify-between">
                    <span class="text-sm">#GraphicDesign</span>
                    <span class="text-xs text-gray-500">534 gönderi</span>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Post Creation Modal -->
<div id="postModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden">
    <div class="flex items-center justify-center min-h-screen p-4">
        <div class="bg-white rounded-lg w-full max-w-lg">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h3 class="font-semibold">Gönderi Oluştur</h3>
                    <button onclick="closePostModal()" class="text-gray-400 hover:text-gray-600">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            </div>
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="p-4">
                    <div class="flex items-center space-x-3 mb-4">
                        @auth
                        <img src="{{ auth()->user()->avatar ?? 'https://ui-avatars.com/api/?name=' . urlencode(auth()->user()->first_name) }}" 
                             alt="Profile" class="w-10 h-10 rounded-full">
                        <div>
                            <h4 class="font-medium">{{ auth()->user()->first_name }} {{ auth()->user()->last_name }}</h4>
                            <select name="category_id" class="text-sm text-gray-600 border-none p-0">
                                <option value="">Kategori seç</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @endauth
                    </div>
                    <input type="text" name="title" placeholder="Başlık..." class="w-full border-none text-lg font-medium mb-2 focus:outline-none">
                    <textarea name="content" placeholder="Ne düşünüyorsun?" rows="4" class="w-full border-none resize-none focus:outline-none"></textarea>
                    <input type="file" name="image" accept="image/*" class="hidden" id="imageInput">
                </div>
                <div class="p-4 border-t border-gray-200">
                    <div class="flex items-center justify-between">
                        <div class="flex space-x-4">
                            <button type="button" onclick="document.getElementById('imageInput').click()" class="text-gray-600 hover:text-blue-600">
                                <i class="fas fa-image"></i>
                            </button>
                            <button type="button" class="text-gray-600 hover:text-green-600">
                                <i class="fas fa-briefcase"></i>
                            </button>
                            <button type="button" class="text-gray-600 hover:text-purple-600">
                                <i class="fas fa-poll"></i>
                            </button>
                        </div>
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-full hover:bg-blue-700">
                            Paylaş
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function openPostModal() {
    document.getElementById('postModal').classList.remove('hidden');
}

function closePostModal() {
    document.getElementById('postModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('postModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePostModal();
    }
});
</script>
@endpush