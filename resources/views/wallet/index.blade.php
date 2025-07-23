@extends('layouts.app')

@section('title', 'Cüzdan - ' . ($siteSettings['site_name'] ?? 'FreelancerHub'))

@section('content')
<!-- Content Area -->
<div class="container mx-auto px-4 py-6">
    <div class="flex flex-col lg:flex-row gap-6">
        <!-- Left Sidebar (Mobile Hidden) -->
        <div class="hidden lg:block lg:w-1/4">
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4 mb-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Kısayollar</h3>
                <div class="space-y-2">
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-blue-100 dark:bg-blue-900 flex items-center justify-center">
                            <i class="fas fa-chart-line text-blue-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Gelir Raporu</span>
                    </a>
                    <a href="#" class="flex items-center space-x-3 p-2 rounded-lg hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors">
                        <div class="w-8 h-8 rounded-md bg-purple-100 dark:bg-purple-900 flex items-center justify-center">
                            <i class="fas fa-file-invoice text-purple-500"></i>
                        </div>
                        <span class="text-gray-700 dark:text-gray-300">Faturalar</span>
                    </a>
                </div>
            </div>
            
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                <h3 class="font-semibold text-lg mb-3 text-gray-900 dark:text-white">Hızlı İstatistikler</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Bu Ay Kazanç</span>
                        <span class="font-semibold text-green-600 dark:text-green-400">₺8,450</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Toplam Proje</span>
                        <span class="font-semibold text-blue-600 dark:text-blue-400">23</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Aktif Hizmet</span>
                        <span class="font-semibold text-purple-600 dark:text-purple-400">7</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-gray-600 dark:text-gray-400">Ortalama Puan</span>
                        <span class="font-semibold text-yellow-600 dark:text-yellow-400">4.8</span>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Main Wallet Area -->
        <div class="w-full lg:w-3/4">
            <!-- Wallet Header -->
            <div class="bg-gradient-to-r from-blue-500 to-purple-600 rounded-lg shadow-sm p-6 mb-6 text-white">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center">
                    <div>
                        <h1 class="text-2xl font-bold mb-2">Cüzdanım</h1>
                        <p class="text-blue-100">Gelirlerinizi takip edin ve ödemelerinizi yönetin</p>
                    </div>
                    <div class="mt-4 md:mt-0 text-right">
                        <div class="text-3xl font-bold">₺24,750.50</div>
                        <div class="text-blue-100">Toplam Bakiye</div>
                    </div>
                </div>
            </div>

            <!-- Balance Cards -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Mevcut Bakiye</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">₺24,750.50</p>
                        </div>
                        <div class="w-12 h-12 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-wallet text-green-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm">
                        <span class="text-green-500">+12.5%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">geçen aya göre</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Bekleyen Ödeme</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">₺3,200.00</p>
                        </div>
                        <div class="w-12 h-12 bg-yellow-100 dark:bg-yellow-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-clock text-yellow-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm">
                        <span class="text-gray-500 dark:text-gray-400">5 proje beklemede</span>
                    </div>
                </div>

                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-4">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 dark:text-gray-400 text-sm">Bu Ay Kazanç</p>
                            <p class="text-2xl font-bold text-gray-900 dark:text-white">₺8,450.00</p>
                        </div>
                        <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                            <i class="fas fa-chart-line text-blue-500 text-xl"></i>
                        </div>
                    </div>
                    <div class="mt-2 flex items-center text-sm">
                        <span class="text-blue-500">+8.2%</span>
                        <span class="text-gray-500 dark:text-gray-400 ml-1">geçen aya göre</span>
                    </div>
                </div>
            </div>

            <!-- Earnings Chart -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Aylık Gelir Grafiği</h3>
                        <p class="text-gray-600 dark:text-gray-400">Son 12 ayın gelir analizi</p>
                    </div>
                    <div class="flex space-x-2 mt-4 md:mt-0">
                        <button class="px-4 py-2 bg-blue-100 dark:bg-blue-900 text-blue-600 dark:text-blue-300 rounded-lg font-medium chart-filter active" data-period="12">
                            12 Ay
                        </button>
                        <button class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg chart-filter" data-period="6">
                            6 Ay
                        </button>
                        <button class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 rounded-lg chart-filter" data-period="3">
                            3 Ay
                        </button>
                    </div>
                </div>
                
                <!-- Chart Container -->
                <div class="relative h-80">
                    <canvas id="earningsChart" class="w-full h-full"></canvas>
                </div>
                
                <!-- Chart Legend -->
                <div class="flex flex-wrap justify-center mt-4 space-x-6">
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-blue-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Proje Gelirleri</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-green-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Hizmet Satışları</span>
                    </div>
                    <div class="flex items-center">
                        <div class="w-3 h-3 bg-purple-500 rounded-full mr-2"></div>
                        <span class="text-sm text-gray-600 dark:text-gray-400">Bonus Ödemeler</span>
                    </div>
                </div>
            </div>

            <!-- Recent Transactions -->
            <div class="bg-white dark:bg-gray-800 rounded-lg shadow-sm p-6 mb-6">
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">Son İşlemler</h3>
                    <button class="text-blue-500 hover:text-blue-700 font-medium">Tümünü Gör</button>
                </div>
                
                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-green-100 dark:bg-green-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-plus text-green-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Web Tasarım Projesi</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Zeynep Arslan tarafından ödeme</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">2 saat önce</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold text-green-600 dark:text-green-400">+₺2,500.00</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">Tamamlandı</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-shopping-cart text-blue-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Logo Tasarım Hizmeti</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Hizmet satışı</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">5 saat önce</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold text-green-600 dark:text-green-400">+₺750.00</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">Tamamlandı</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-red-100 dark:bg-red-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-minus text-red-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Para Çekme</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Banka hesabına transfer</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">1 gün önce</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold text-red-600 dark:text-red-400">-₺5,000.00</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">İşleniyor</div>
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 border border-gray-200 dark:border-gray-700 rounded-lg">
                        <div class="flex items-center space-x-4">
                            <div class="w-10 h-10 bg-purple-100 dark:bg-purple-900 rounded-lg flex items-center justify-center">
                                <i class="fas fa-gift text-purple-500"></i>
                            </div>
                            <div>
                                <h4 class="font-medium text-gray-900 dark:text-white">Bonus Ödeme</h4>
                                <p class="text-sm text-gray-600 dark:text-gray-400">Mükemmel değerlendirme bonusu</p>
                                <p class="text-xs text-gray-500 dark:text-gray-500">2 gün önce</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <div class="font-semibold text-green-600 dark:text-green-400">+₺200.00</div>
                            <div class="text-xs text-gray-500 dark:text-gray-500">Tamamlandı</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .chart-filter.active {
        background-color: #dbeafe;
        color: #2563eb;
    }
    
    .dark .chart-filter.active {
        background-color: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
    }
</style>
@endpush

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Earnings Chart
    const ctx = document.getElementById('earningsChart').getContext('2d');
    
    // Sample data for the last 12 months
    const monthlyData = {
        labels: ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'],
        datasets: [
            {
                label: 'Proje Gelirleri',
                data: [3200, 4100, 3800, 5200, 4800, 6100, 5500, 7200, 6800, 8100, 7500, 8450],
                backgroundColor: 'rgba(59, 130, 246, 0.1)',
                borderColor: 'rgba(59, 130, 246, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            },
            {
                label: 'Hizmet Satışları',
                data: [1800, 2200, 2600, 2100, 3200, 2800, 3500, 3100, 4200, 3800, 4100, 3900],
                backgroundColor: 'rgba(34, 197, 94, 0.1)',
                borderColor: 'rgba(34, 197, 94, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            },
            {
                label: 'Bonus Ödemeler',
                data: [200, 150, 300, 250, 400, 350, 300, 450, 400, 500, 350, 400],
                backgroundColor: 'rgba(168, 85, 247, 0.1)',
                borderColor: 'rgba(168, 85, 247, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }
        ]
    };

    const chart = new Chart(ctx, {
        type: 'line',
        data: monthlyData,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    mode: 'index',
                    intersect: false,
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    titleColor: 'white',
                    bodyColor: 'white',
                    borderColor: 'rgba(255, 255, 255, 0.1)',
                    borderWidth: 1,
                    callbacks: {
                        label: function(context) {
                            return context.dataset.label + ': ₺' + context.parsed.y.toLocaleString();
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280'
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: document.documentElement.classList.contains('dark') ? '#374151' : '#F3F4F6'
                    },
                    ticks: {
                        color: document.documentElement.classList.contains('dark') ? '#9CA3AF' : '#6B7280',
                        callback: function(value) {
                            return '₺' + value.toLocaleString();
                        }
                    }
                }
            },
            interaction: {
                mode: 'nearest',
                axis: 'x',
                intersect: false
            }
        }
    });

    // Chart filter buttons
    const filterBtns = document.querySelectorAll('.chart-filter');
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Remove active class from all buttons
            filterBtns.forEach(b => {
                b.classList.remove('active', 'bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
                b.classList.add('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            });
            
            // Add active class to clicked button
            this.classList.add('active', 'bg-blue-100', 'dark:bg-blue-900', 'text-blue-600', 'dark:text-blue-300');
            this.classList.remove('text-gray-600', 'dark:text-gray-400', 'hover:bg-gray-100', 'dark:hover:bg-gray-700');
            
            // Update chart data based on selected period
            const period = this.getAttribute('data-period');
            updateChartData(period);
        });
    });

    function updateChartData(period) {
        let newLabels, newData1, newData2, newData3;
        
        switch(period) {
            case '3':
                newLabels = ['Eki', 'Kas', 'Ara'];
                newData1 = [8100, 7500, 8450];
                newData2 = [3800, 4100, 3900];
                newData3 = [500, 350, 400];
                break;
            case '6':
                newLabels = ['Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'];
                newData1 = [5500, 7200, 6800, 8100, 7500, 8450];
                newData2 = [3500, 3100, 4200, 3800, 4100, 3900];
                newData3 = [300, 450, 400, 500, 350, 400];
                break;
            default: // 12 months
                newLabels = ['Oca', 'Şub', 'Mar', 'Nis', 'May', 'Haz', 'Tem', 'Ağu', 'Eyl', 'Eki', 'Kas', 'Ara'];
                newData1 = [3200, 4100, 3800, 5200, 4800, 6100, 5500, 7200, 6800, 8100, 7500, 8450];
                newData2 = [1800, 2200, 2600, 2100, 3200, 2800, 3500, 3100, 4200, 3800, 4100, 3900];
                newData3 = [200, 150, 300, 250, 400, 350, 300, 450, 400, 500, 350, 400];
        }
        
        chart.data.labels = newLabels;
        chart.data.datasets[0].data = newData1;
        chart.data.datasets[1].data = newData2;
        chart.data.datasets[2].data = newData3;
        chart.update();
    }
});
</script>
@endpush