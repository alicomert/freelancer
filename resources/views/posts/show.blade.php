@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="max-w-4xl mx-auto">
        <!-- Post Header -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-start justify-between mb-4">
                <div class="flex items-center space-x-3">
                    <img src="{{ $post->user->avatar ? asset('storage/' . $post->user->avatar) : asset('images/default-avatar.svg') }}" 
                         alt="{{ $post->user->first_name }}" class="w-12 h-12 rounded-full">
                    <div>
                        <h3 class="font-semibold text-gray-900">{{ $post->user->first_name }} {{ $post->user->last_name }}</h3>
                        <p class="text-sm text-gray-500">{{ $post->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                
                <!-- Post Type Badge -->
                <span class="px-3 py-1 text-xs font-medium rounded-full
                    @switch($post->post_type)
                        @case(1) bg-gray-100 text-gray-800 @break
                        @case(2) bg-blue-100 text-blue-800 @break
                        @case(3) bg-yellow-100 text-yellow-800 @break
                        @case(4) bg-green-100 text-green-800 @break
                        @case(5) bg-purple-100 text-purple-800 @break
                        @case(6) bg-red-100 text-red-800 @break
                    @endswitch
                ">
                    @switch($post->post_type)
                        @case(1) Normal Post @break
                        @case(2) Hizmet İlanı @break
                        @case(3) Açık Artırma @break
                        @case(4) Anket @break
                        @case(5) Portfolyo @break
                        @case(6) Freelance Proje @break
                    @endswitch
                </span>
            </div>
            
            <h1 class="text-2xl font-bold text-gray-900 mb-2">{{ $post->title }}</h1>
            
            @if($post->category && $post->category->name)
                <span class="inline-block px-2 py-1 text-xs bg-gray-100 text-gray-600 rounded">
                    {{ $post->category->name }}
                </span>
            @endif
        </div>

        <!-- Post Content -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="prose max-w-none">
                {!! nl2br(e($post->content)) !!}
            </div>
        </div>

        <!-- Post Type Specific Content -->
        @switch($post->post_type)
            @case(2)
                <!-- Hizmet İlanı Detayları -->
                @include('posts.partials.service-details', ['postId' => $post->id])
                @break
            @case(3)
                <!-- Açık Artırma Detayları -->
                @include('posts.partials.auction-details', ['postId' => $post->id])
                @break
            @case(4)
                <!-- Anket Detayları -->
                @include('posts.partials.poll-details', ['postId' => $post->id])
                @break
            @case(5)
                <!-- Portfolyo Detayları -->
                @include('posts.partials.portfolio-details', ['postId' => $post->id])
                @break
        @endswitch

        <!-- Post Stats -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6 mb-6">
            <div class="flex items-center justify-between">
                <div class="flex items-center space-x-6">
                    <div class="flex items-center space-x-2">
                        <button class="flex items-center space-x-1 text-gray-500 hover:text-blue-600 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                            </svg>
                            <span>{{ $post->likes_count ?? 0 }}</span>
                        </button>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
                        </svg>
                        <span class="text-gray-500">{{ $post->comments_count ?? 0 }} Yorum</span>
                    </div>
                    
                    <div class="flex items-center space-x-2">
                        <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="text-gray-500">{{ $post->views_count ?? 0 }} Görüntülenme</span>
                    </div>
                </div>
                
                <div class="flex items-center space-x-2">
                    <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.367 2.684 3 3 0 00-5.367-2.684z"></path>
                        </svg>
                    </button>
                    
                    <button class="p-2 text-gray-400 hover:text-gray-600 transition-colors">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>

        <!-- Comments Section -->
        <div class="bg-white rounded-lg shadow-sm border border-gray-200 p-6">
            <h3 class="text-lg font-semibold text-gray-900 mb-4">Yorumlar</h3>
            
            <!-- Comment Form -->
            @auth
            <div class="mb-6">
                <div class="flex space-x-3">
                    <img src="{{ auth()->user()->avatar ? asset('storage/' . auth()->user()->avatar) : asset('images/default-avatar.svg') }}" 
                         alt="{{ auth()->user()->first_name }}" class="w-10 h-10 rounded-full">
                    <div class="flex-1">
                        <textarea class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent" 
                                  rows="3" placeholder="Yorumunuzu yazın..."></textarea>
                        <div class="mt-2 flex justify-end">
                            <button class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 transition-colors">
                                Yorum Yap
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            @endauth
            
            <!-- Comments List -->
            <div class="space-y-4">
                <div class="text-center text-gray-500 py-8">
                    Henüz yorum yapılmamış. İlk yorumu siz yapın!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection