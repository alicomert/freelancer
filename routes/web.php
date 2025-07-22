<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteSettingController;

// Ana sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search
Route::get('/ara', function () { 
    $query = request('q');
    return view('search.index', compact('query')); 
})->name('search');

// Projeler
Route::prefix('projeler')->name('projects.')->group(function () {
    Route::get('/', function () { return view('projects.index'); })->name('index');
    Route::get('/olustur', function () { return view('projects.create'); })->name('create');
    Route::get('/kategori/{category}', function () { return view('projects.category'); })->name('category');
    Route::get('/{project}', function () { return view('projects.show'); })->name('show');
});

// Hizmetler
Route::prefix('hizmetler')->name('services.')->group(function () {
    Route::get('/', function () { return view('services.index'); })->name('index');
});

// Topluluk
Route::prefix('topluluk')->name('community.')->group(function () {
    Route::get('/', function () { return view('community.index'); })->name('index');
    Route::get('/olustur', function () { return view('community.create'); })->name('create');
    Route::get('/gonderi/{post}', function () { return view('community.post'); })->name('post');
});

// Posts (Gönderiler)
Route::prefix('gonderiler')->name('posts.')->group(function () {
    Route::get('/', function () { return view('posts.index'); })->name('index');
    Route::get('/olustur', function () { return view('community.create'); })->name('create');
    Route::post('/', function () { return redirect()->back(); })->name('store');
    Route::get('/{post}', function () { return view('posts.show'); })->name('show');
});

// Categories
Route::prefix('kategoriler')->name('categories.')->group(function () {
    Route::get('/', function () { return view('categories.index'); })->name('index');
    Route::get('/{category}', function () { return view('categories.show'); })->name('show');
});

// Messages
Route::prefix('mesajlar')->name('messages.')->group(function () {
    Route::get('/', function () { return view('messages.index'); })->name('index');
});

// Notifications
Route::prefix('bildirimler')->name('notifications.')->group(function () {
    Route::get('/', function () { return view('notifications.index'); })->name('index');
});

// Wallet
Route::prefix('cuzdan')->name('wallet.')->group(function () {
    Route::get('/', function () { return view('wallet.index'); })->name('index');
});

// Settings
Route::prefix('ayarlar')->name('settings.')->group(function () {
    Route::get('/', function () { return view('settings.index'); })->name('index');
});

// Freelancerlar
Route::prefix('freelancerlar')->name('freelancers.')->group(function () {
    Route::get('/', function () { return view('freelancers.index'); })->name('index');
    Route::get('/{user}', function () { return view('freelancers.show'); })->name('show');
});

// Kullanıcı profili ve ayarları
Route::middleware('auth')->group(function () {
    Route::get('/profil', function () { return view('profile.show'); })->name('profile.show');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

// Auth routes
Route::get('/giris', [AuthController::class, 'showLogin'])->name('login');
Route::post('/giris', [AuthController::class, 'login']);
Route::get('/kayit', [AuthController::class, 'showRegister'])->name('register');
Route::post('/kayit', [AuthController::class, 'register']);
Route::post('/cikis', [AuthController::class, 'logout'])->name('logout');

// Site Settings API Routes
Route::prefix('api/site-settings')->name('api.site-settings.')->group(function () {
    Route::get('/public', [SiteSettingController::class, 'getPublicSettings'])->name('public');
    Route::get('/{key}', [SiteSettingController::class, 'show'])->name('show');
});

// Admin Site Settings Routes (require authentication)
Route::middleware('auth')->prefix('admin/site-settings')->name('admin.site-settings.')->group(function () {
    Route::get('/', [SiteSettingController::class, 'index'])->name('index');
    Route::post('/', [SiteSettingController::class, 'store'])->name('store');
    Route::put('/update', [SiteSettingController::class, 'update'])->name('update');
    Route::delete('/{key}', [SiteSettingController::class, 'destroy'])->name('destroy');
    Route::post('/clear-cache', [SiteSettingController::class, 'clearCache'])->name('clear-cache');
});
