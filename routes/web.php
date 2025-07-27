<?php

use App\Http\Controllers\SkillController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\SiteSettingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FollowController;

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
    Route::get('/', [App\Http\Controllers\NotificationController::class, 'index'])->name('index');
    Route::post('/{id}/read', [App\Http\Controllers\NotificationController::class, 'markAsRead'])->name('mark-read');
    Route::post('/mark-all-read', [App\Http\Controllers\NotificationController::class, 'markAllAsRead'])->name('mark-all-read');
    Route::delete('/{id}', [App\Http\Controllers\NotificationController::class, 'delete'])->name('delete');
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
    Route::get('/dashboard', function () { return view('dashboard'); })->name('dashboard');
});

// Profile route - redirect to user's own profile or login
Route::get('/profile', function () {
    if (auth()->check()) {
        return redirect('/' . auth()->user()->username);
    }
    return redirect('/')->with('openLoginModal', true);
})->name('profile');

// Auth routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register-step1', [AuthController::class, 'registerStep1'])->name('register.step1');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Follow/Block routes (require authentication)
Route::middleware('auth')->prefix('api')->group(function () {
    Route::post('/follow/{userId}', [FollowController::class, 'follow'])->name('follow');
    Route::delete('/follow/{userId}', [FollowController::class, 'unfollow'])->name('unfollow');
    Route::post('/block/{userId}', [FollowController::class, 'block'])->name('block');
    Route::delete('/block/{userId}', [FollowController::class, 'unblock'])->name('unblock');
    Route::get('/follow-status/{userId}', [FollowController::class, 'checkStatus'])->name('follow.status');
    Route::get('/followers/{userId}', [FollowController::class, 'getFollowers'])->name('followers.list');
    Route::get('/following/{userId}', [FollowController::class, 'getFollowing'])->name('following.list');
});

// Protected routes that require authentication and account status check
Route::middleware(['auth', 'check.account.status'])->prefix('profile')->group(function () {
    Route::post('/verify-identity', [ProfileController::class, 'verifyIdentity'])->name('profile.verify-identity');
    Route::post('/update-bio', [ProfileController::class, 'updateBio'])->name('profile.update.bio');
    Route::put('/update/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/skills/search', [SkillController::class, 'search'])->name('skills.search');
    Route::get('/skills', [SkillController::class, 'index'])->name('skills.index');
    Route::post('/skills', [SkillController::class, 'store'])->name('skills.store');
    Route::put('/skills/{skill}', [SkillController::class, 'update'])->name('skills.update');
    Route::delete('/skills/{skill}', [SkillController::class, 'destroy'])->name('skills.destroy');
    Route::post('/skills/sort', [SkillController::class, 'sort'])->name('skills.sort');
    Route::post('/skills/update-order', [SkillController::class, 'updateOrder'])->name('skills.updateOrder');
    
    // Education routes
    Route::get('/educations', [EducationController::class, 'index'])->name('educations.index');
    Route::post('/educations', [EducationController::class, 'store'])->name('educations.store');
    Route::put('/educations/{education}', [EducationController::class, 'update'])->name('educations.update');
    Route::delete('/educations/{education}', [EducationController::class, 'destroy'])->name('educations.destroy');
    Route::post('/educations/sort', [EducationController::class, 'sort'])->name('educations.sort');
});

// Site Settings API Routes
Route::prefix('api/site-settings')->name('api.site-settings.')->group(function () {
    Route::get('/public', [SiteSettingController::class, 'getPublicSettings'])->name('public');
    Route::get('/{key}', [SiteSettingController::class, 'show'])->name('show');
});

// Education API Routes (require authentication)
Route::middleware(['auth', 'web'])->prefix('api')->group(function () {
    Route::post('/education', [App\Http\Controllers\EducationController::class, 'store'])->name('education.store');
    Route::get('/education/{id}', [App\Http\Controllers\EducationController::class, 'show'])->name('education.show');
    Route::put('/education/{id}', [App\Http\Controllers\EducationController::class, 'update'])->name('education.update');
    Route::delete('/education/{id}', [App\Http\Controllers\EducationController::class, 'destroy'])->name('education.destroy');
    Route::post('/education/update-order', [App\Http\Controllers\EducationController::class, 'updateOrder'])->name('education.update-order');
    
    // Skills API Routes
    Route::put('/skills', [App\Http\Controllers\SkillController::class, 'update'])->name('skills.update');
});

// Admin Site Settings Routes (require authentication)
Route::middleware('auth')->prefix('admin/site-settings')->name('admin.site-settings.')->group(function () {
    Route::get('/', [SiteSettingController::class, 'index'])->name('index');
    Route::post('/', [SiteSettingController::class, 'store'])->name('store');
    Route::put('/update', [SiteSettingController::class, 'update'])->name('update');
    Route::delete('/{key}', [SiteSettingController::class, 'destroy'])->name('destroy');
    Route::post('/clear-cache', [SiteSettingController::class, 'clearCache'])->name('clear-cache');
});

// Username-based profile route (must be at the end to avoid conflicts)
Route::get('/{username}', [ProfileController::class, 'show'])->name('user.profile');
