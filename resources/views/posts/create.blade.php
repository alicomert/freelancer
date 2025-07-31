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
                    <h1 class="text-3xl font-bold text-gray-900 dark:text-white mb-1">Yeni Gönderi Oluştur</h1>
                    <p class="text-gray-600 dark:text-gray-400">Hangi tür gönderi oluşturmak istiyorsunuz? Aşağıdan seçiminizi yapın.</p>
                </div>
            </div>
        </div>

        <!-- Gönderi Tipi Seçimi -->
        <div class="bg-white dark:bg-gray-900 rounded-xl shadow-md p-6 border border-gray-100 dark:border-gray-700">
            <h2 class="text-xl font-semibold text-gray-900 dark:text-white mb-6 flex items-center">
                <div class="w-8 h-8 bg-gray-100 dark:bg-gray-800 rounded-lg flex items-center justify-center mr-3">
                    <svg class="w-4 h-4 text-gray-600 dark:text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zM21 5a2 2 0 00-2-2h-4a2 2 0 00-2 2v12a4 4 0 004 4h4a2 2 0 002-2V5z"></path>
                    </svg>
                </div>
                Gönderi Tipi Seçin
            </h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Normal Post -->
                <a href="{{ route('posts.create.post') }}" class="post-type-card group">
                    <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-blue-500 dark:hover:border-blue-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-lg group-hover:scale-105 cursor-pointer">
                        <div class="w-16 h-16 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">Normal Post</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Genel paylaşım, soru sorma veya tartışma başlatma</p>
                    </div>
                </a>
                
                <!-- Hizmet İlanı -->
                <a href="{{ route('posts.create.service') }}" class="post-type-card group">
                    <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-green-500 dark:hover:border-green-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-lg group-hover:scale-105 cursor-pointer">
                        <div class="w-16 h-16 bg-green-100 dark:bg-green-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-green-600 dark:text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">Hizmet İlanı</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Hizmetinizi satın ve müşteri bulun</p>
                    </div>
                </a>
                
                <!-- Açık Artırma -->
                <a href="{{ route('posts.create.auction') }}" class="post-type-card group">
                    <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-orange-500 dark:hover:border-orange-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-lg group-hover:scale-105 cursor-pointer">
                        <div class="w-16 h-16 bg-orange-100 dark:bg-orange-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">Açık Artırma</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Hizmetiniz için en iyi teklifi alın</p>
                    </div>
                </a>
                
                <!-- Anket -->
                <a href="{{ route('posts.create.poll') }}" class="post-type-card group">
                    <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-purple-500 dark:hover:border-purple-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-lg group-hover:scale-105 cursor-pointer">
                        <div class="w-16 h-16 bg-purple-100 dark:bg-purple-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">Anket</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Topluluktan görüş alın ve oy toplayın</p>
                    </div>
                </a>
                
                <!-- Portfolyo -->
                <a href="{{ route('posts.create.portfolio') }}" class="post-type-card group">
                    <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-indigo-500 dark:hover:border-indigo-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-lg group-hover:scale-105 cursor-pointer">
                        <div class="w-16 h-16 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">Portfolyo</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">Çalışmalarınızı sergileyin ve yeteneklerinizi gösterin</p>
                    </div>
                </a>
                
                <!-- Freelance Proje -->
                <a href="{{ route('posts.create.freelance') }}" class="post-type-card group">
                    <div class="border-2 border-gray-200 dark:border-gray-700 rounded-xl p-6 text-center hover:border-teal-500 dark:hover:border-teal-400 transition-all duration-200 bg-gray-50 dark:bg-gray-800 hover:shadow-lg group-hover:scale-105 cursor-pointer">
                        <div class="w-16 h-16 bg-teal-100 dark:bg-teal-900/30 rounded-xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-teal-600 dark:text-teal-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <h3 class="font-semibold text-gray-900 dark:text-white text-lg mb-2">Freelance Proje</h3>
                        <p class="text-gray-600 dark:text-gray-400 text-sm">İş ilanı verin veya proje talebi oluşturun</p>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>

<style>
.post-type-card:hover .w-16 {
    transform: translateY(-2px);
}
</style>
@endsection