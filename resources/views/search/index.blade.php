@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto p-4">
    <div class="bg-white rounded-lg shadow-sm p-6 mb-6">
        <h1 class="text-2xl font-bold mb-4">Arama Sonuçları</h1>
        
        @if($query)
            <p class="text-gray-600 mb-6">
                "<span class="font-semibold">{{ $query }}</span>" için arama sonuçları
            </p>
            
            <!-- Search Results Tabs -->
            <div class="border-b border-gray-200 mb-6">
                <nav class="-mb-px flex space-x-8">
                    <a href="#" class="border-b-2 border-blue-500 py-2 px-1 text-sm font-medium text-blue-600">
                        Tümü
                    </a>
                    <a href="#" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Gönderiler
                    </a>
                    <a href="#" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Projeler
                    </a>
                    <a href="#" class="border-b-2 border-transparent py-2 px-1 text-sm font-medium text-gray-500 hover:text-gray-700 hover:border-gray-300">
                        Kullanıcılar
                    </a>
                </nav>
            </div>
            
            <!-- Sample Search Results -->
            <div class="space-y-4">
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Ahmet+Yılmaz" alt="User" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg mb-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800">
                                    React.js ile Modern Web Uygulaması Geliştirme
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-2">
                                Modern web uygulamaları geliştirmek için React.js kullanımı hakkında detaylı bir rehber...
                            </p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>Ahmet Yılmaz</span>
                                <span>•</span>
                                <span>2 saat önce</span>
                                <span>•</span>
                                <span class="bg-blue-100 text-blue-800 px-2 py-1 rounded-full text-xs">Web Geliştirme</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Zeynep+Kaya" alt="User" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg mb-2">
                                <a href="#" class="text-green-600 hover:text-green-800">
                                    E-ticaret Sitesi Tasarımı - 5000₺
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-2">
                                Modern ve kullanıcı dostu bir e-ticaret sitesi tasarımı arıyoruz. Responsive tasarım şart...
                            </p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>Zeynep Kaya</span>
                                <span>•</span>
                                <span>1 gün önce</span>
                                <span>•</span>
                                <span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Proje</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-shadow">
                    <div class="flex items-start space-x-3">
                        <img src="https://ui-avatars.com/api/?name=Mehmet+Demir" alt="User" class="w-10 h-10 rounded-full">
                        <div class="flex-1">
                            <h3 class="font-semibold text-lg mb-2">
                                <a href="#" class="text-blue-600 hover:text-blue-800">
                                    JavaScript ES6+ Özellikleri Hakkında
                                </a>
                            </h3>
                            <p class="text-gray-600 mb-2">
                                JavaScript'in yeni özelliklerini öğrenmek isteyenler için kapsamlı bir kılavuz...
                            </p>
                            <div class="flex items-center space-x-4 text-sm text-gray-500">
                                <span>Mehmet Demir</span>
                                <span>•</span>
                                <span>3 gün önce</span>
                                <span>•</span>
                                <span class="bg-purple-100 text-purple-800 px-2 py-1 rounded-full text-xs">Programlama</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Pagination -->
            <div class="mt-8 flex justify-center">
                <nav class="flex items-center space-x-2">
                    <button class="px-3 py-2 text-sm text-gray-500 hover:text-gray-700 disabled:opacity-50" disabled>
                        Önceki
                    </button>
                    <button class="px-3 py-2 text-sm bg-blue-600 text-white rounded">1</button>
                    <button class="px-3 py-2 text-sm text-gray-700 hover:text-gray-900">2</button>
                    <button class="px-3 py-2 text-sm text-gray-700 hover:text-gray-900">3</button>
                    <button class="px-3 py-2 text-sm text-gray-700 hover:text-gray-900">
                        Sonraki
                    </button>
                </nav>
            </div>
        @else
            <div class="text-center py-12">
                <i class="fas fa-search text-6xl text-gray-300 mb-4"></i>
                <h2 class="text-xl font-semibold text-gray-600 mb-2">Arama yapmak için bir terim girin</h2>
                <p class="text-gray-500">Toplulukta gönderi, proje veya kullanıcı arayabilirsiniz.</p>
            </div>
        @endif
    </div>
</div>
@endsection