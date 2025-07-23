<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteSettingController;

// Ana sayfa
Route::get('/', [HomeController::class, 'index'])->name('home');

// Search
Route::get('/search', function () { 
    $query = request('q');
    return view('search.index', compact('query')); 
})->name('search');

// Projects
Route::prefix('projects')->name('projects.')->group(function () {
    Route::get('/', function () { return view('projects.index'); })->name('index');
    Route::get('/create', function () { return view('projects.create'); })->name('create');
    Route::get('/category/{category}', function () { return view('projects.category'); })->name('category');
    Route::get('/{project}', function () { return view('projects.show'); })->name('show');
});

// Services
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', function () { return view('services.index'); })->name('index');
    Route::get('/create', function () { return view('services.create'); })->name('create');
    Route::get('/category/{category}', function () { return view('services.category'); })->name('category');
    Route::get('/{service}', function () { return view('services.show'); })->name('show');
});

// Community
Route::prefix('community')->name('community.')->group(function () {
    Route::get('/', function () { return view('community.index'); })->name('index');
    Route::get('/create', function () { return view('community.create'); })->name('create');
    Route::get('/post/{post}', function () { return view('community.post'); })->name('post');
});

// Posts
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/', function () { return view('posts.index'); })->name('index');
    Route::get('/create', function () { return view('posts.create'); })->name('create');
    Route::post('/', function () { return redirect()->back(); })->name('store');
    Route::get('/{post}', function () { return view('posts.show'); })->name('show');
});

// Categories
Route::prefix('categories')->name('categories.')->group(function () {
    Route::get('/', function () { return view('categories.index'); })->name('index');
    Route::get('/{category}', function () { return view('categories.show'); })->name('show');
});

// Messages
Route::prefix('messages')->name('messages.')->group(function () {
    Route::get('/', function () { return view('messages.index'); })->name('index');
});

// Notifications
Route::prefix('notifications')->name('notifications.')->group(function () {
    Route::get('/', function () { return view('notifications.index'); })->name('index');
});

// Wallet
Route::prefix('wallet')->name('wallet.')->group(function () {
    Route::get('/', function () { return view('wallet.index'); })->name('index');
});

// Auctions
Route::prefix('auctions')->name('auctions.')->group(function () {
    Route::get('/', function () { return view('auctions.index'); })->name('index');
    Route::get('/{id}', function () { return view('auctions.show'); })->name('show');
});

// Settings
Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('/', function () { return view('settings.index'); })->name('index');
});

// Freelancers
Route::prefix('freelancers')->name('freelancers.')->group(function () {
    Route::get('/', function () { return view('freelancers.index'); })->name('index');
    Route::get('/{user}', function () { return view('freelancers.show'); })->name('show');
});

// User profile and settings
Route::middleware('auth')->group(function () {
    Route::get('/profile', function () { return view('profile.index'); })->name('profile.show');
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register-step1', [AuthController::class, 'registerStep1'])->name('register.step1');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

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
