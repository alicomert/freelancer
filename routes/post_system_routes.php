<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Post System Routes - Optimized for 50M+ Data
|--------------------------------------------------------------------------
*/

// Ana Post Rotaları
Route::prefix('posts')->name('posts.')->group(function () {
    
    // Listeleme rotaları - Cache friendly
    Route::get('/', 'PostController@index')->name('index');
    Route::get('/trending', 'PostController@trending')->name('trending');
    Route::get('/category/{category}', 'PostController@byCategory')->name('category');
    Route::get('/tag/{tag}', 'PostController@byTag')->name('tag');
    Route::get('/user/{user}', 'PostController@byUser')->name('user');
    
    // Detay sayfası - SEO friendly
    Route::get('/{post:slug}', 'PostController@show')->name('show');
    
    // CRUD işlemleri
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'PostController@create')->name('create');
        Route::post('/', 'PostController@store')->name('store');
        Route::get('/{post}/edit', 'PostController@edit')->name('edit');
        Route::put('/{post}', 'PostController@update')->name('update');
        Route::delete('/{post}', 'PostController@destroy')->name('destroy');
    });
    
    // Etkileşim rotaları
    Route::middleware('auth')->group(function () {
        Route::post('/{post}/like', 'PostInteractionController@like')->name('like');
        Route::post('/{post}/unlike', 'PostInteractionController@unlike')->name('unlike');
        Route::post('/{post}/save', 'PostInteractionController@save')->name('save');
        Route::post('/{post}/share', 'PostInteractionController@share')->name('share');
        Route::post('/{post}/report', 'PostInteractionController@report')->name('report');
    });
});

// Hizmet İlanları
Route::prefix('services')->name('services.')->group(function () {
    Route::get('/', 'ServiceController@index')->name('index');
    Route::get('/category/{category}', 'ServiceController@byCategory')->name('category');
    Route::get('/price-range/{min}/{max}', 'ServiceController@byPriceRange')->name('price-range');
    Route::get('/{service:slug}', 'ServiceController@show')->name('show');
    
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'ServiceController@create')->name('create');
        Route::post('/', 'ServiceController@store')->name('store');
        Route::get('/{service}/edit', 'ServiceController@edit')->name('edit');
        Route::put('/{service}', 'ServiceController@update')->name('update');
        Route::post('/{service}/order', 'ServiceController@order')->name('order');
    });
});

// Açık Artırmalar
Route::prefix('auctions')->name('auctions.')->group(function () {
    Route::get('/', 'AuctionController@index')->name('index');
    Route::get('/ending-soon', 'AuctionController@endingSoon')->name('ending-soon');
    Route::get('/category/{category}', 'AuctionController@byCategory')->name('category');
    Route::get('/{auction:slug}', 'AuctionController@show')->name('show');
    
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'AuctionController@create')->name('create');
        Route::post('/', 'AuctionController@store')->name('store');
        Route::post('/{auction}/bid', 'AuctionController@placeBid')->name('bid');
        Route::post('/{auction}/buy-now', 'AuctionController@buyNow')->name('buy-now');
    });
});

// Anketler
Route::prefix('polls')->name('polls.')->group(function () {
    Route::get('/', 'PollController@index')->name('index');
    Route::get('/active', 'PollController@active')->name('active');
    Route::get('/{poll:slug}', 'PollController@show')->name('show');
    
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'PollController@create')->name('create');
        Route::post('/', 'PollController@store')->name('store');
        Route::post('/{poll}/vote', 'PollController@vote')->name('vote');
        Route::get('/{poll}/results', 'PollController@results')->name('results');
    });
});

// Portfolyo
Route::prefix('portfolio')->name('portfolio.')->group(function () {
    Route::get('/', 'PortfolioController@index')->name('index');
    Route::get('/category/{category}', 'PortfolioController@byCategory')->name('category');
    Route::get('/technology/{tech}', 'PortfolioController@byTechnology')->name('technology');
    Route::get('/{portfolio:slug}', 'PortfolioController@show')->name('show');
    
    Route::middleware('auth')->group(function () {
        Route::get('/create', 'PortfolioController@create')->name('create');
        Route::post('/', 'PortfolioController@store')->name('store');
        Route::get('/{portfolio}/edit', 'PortfolioController@edit')->name('edit');
        Route::put('/{portfolio}', 'PortfolioController@update')->name('update');
    });
});

// API Rotaları - Mobile App ve AJAX için
Route::prefix('api/v1')->name('api.')->group(function () {
    
    // Public API
    Route::get('/posts', 'Api\PostApiController@index')->name('posts.index');
    Route::get('/posts/trending', 'Api\PostApiController@trending')->name('posts.trending');
    Route::get('/posts/{post}', 'Api\PostApiController@show')->name('posts.show');
    Route::get('/posts/search', 'Api\PostApiController@search')->name('posts.search');
    
    // Authenticated API
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/posts', 'Api\PostApiController@store')->name('posts.store');
        Route::put('/posts/{post}', 'Api\PostApiController@update')->name('posts.update');
        Route::delete('/posts/{post}', 'Api\PostApiController@destroy')->name('posts.destroy');
        
        // Interactions
        Route::post('/posts/{post}/like', 'Api\PostInteractionApiController@like')->name('posts.like');
        Route::post('/posts/{post}/view', 'Api\PostInteractionApiController@recordView')->name('posts.view');
        Route::get('/posts/{post}/stats', 'Api\PostStatsApiController@show')->name('posts.stats');
    });
    
    // Admin API
    Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
        Route::get('/posts/analytics', 'Api\Admin\PostAnalyticsController@index')->name('admin.posts.analytics');
        Route::get('/posts/performance', 'Api\Admin\PostPerformanceController@index')->name('admin.posts.performance');
        Route::post('/posts/{post}/feature', 'Api\Admin\PostModerationController@feature')->name('admin.posts.feature');
        Route::post('/posts/{post}/pin', 'Api\Admin\PostModerationController@pin')->name('admin.posts.pin');
        Route::post('/posts/bulk-action', 'Api\Admin\PostModerationController@bulkAction')->name('admin.posts.bulk');
    });
});

// Arama Rotaları
Route::prefix('search')->name('search.')->group(function () {
    Route::get('/', 'SearchController@index')->name('index');
    Route::get('/posts', 'SearchController@posts')->name('posts');
    Route::get('/services', 'SearchController@services')->name('services');
    Route::get('/auctions', 'SearchController@auctions')->name('auctions');
    Route::get('/users', 'SearchController@users')->name('users');
    Route::get('/advanced', 'SearchController@advanced')->name('advanced');
    
    // AJAX arama
    Route::get('/autocomplete', 'SearchController@autocomplete')->name('autocomplete');
    Route::get('/suggestions', 'SearchController@suggestions')->name('suggestions');
});

// Feed Rotaları
Route::prefix('feed')->name('feed.')->middleware('auth')->group(function () {
    Route::get('/', 'FeedController@index')->name('index');
    Route::get('/following', 'FeedController@following')->name('following');
    Route::get('/saved', 'FeedController@saved')->name('saved');
    Route::get('/history', 'FeedController@history')->name('history');
    Route::get('/recommendations', 'FeedController@recommendations')->name('recommendations');
});

// Sitemap ve SEO
Route::get('/sitemap.xml', 'SitemapController@index')->name('sitemap');
Route::get('/sitemap/posts.xml', 'SitemapController@posts')->name('sitemap.posts');
Route::get('/sitemap/categories.xml', 'SitemapController@categories')->name('sitemap.categories');
Route::get('/sitemap/users.xml', 'SitemapController@users')->name('sitemap.users');

// RSS Feeds
Route::get('/rss', 'RssController@index')->name('rss');
Route::get('/rss/category/{category}', 'RssController@category')->name('rss.category');
Route::get('/rss/user/{user}', 'RssController@user')->name('rss.user');

// Cache Management (Admin)
Route::middleware(['auth', 'admin'])->prefix('admin/cache')->name('admin.cache.')->group(function () {
    Route::post('/clear', 'Admin\CacheController@clear')->name('clear');
    Route::post('/warm', 'Admin\CacheController@warm')->name('warm');
    Route::get('/stats', 'Admin\CacheController@stats')->name('stats');
});

/*
|--------------------------------------------------------------------------
| Route Model Binding Customizations
|--------------------------------------------------------------------------
*/

// Slug bazlı model binding
Route::bind('post', function ($value) {
    return \App\Models\Post::where('slug', $value)->firstOrFail();
});

Route::bind('service', function ($value) {
    return \App\Models\Post::whereHas('service')
        ->where('slug', $value)
        ->where('post_type', 2)
        ->firstOrFail();
});

Route::bind('auction', function ($value) {
    return \App\Models\Post::whereHas('auction')
        ->where('slug', $value)
        ->where('post_type', 3)
        ->firstOrFail();
});

Route::bind('poll', function ($value) {
    return \App\Models\Post::whereHas('poll')
        ->where('slug', $value)
        ->where('post_type', 4)
        ->firstOrFail();
});

Route::bind('portfolio', function ($value) {
    return \App\Models\Post::whereHas('portfolio')
        ->where('slug', $value)
        ->where('post_type', 5)
        ->firstOrFail();
});

/*
|--------------------------------------------------------------------------
| Rate Limiting
|--------------------------------------------------------------------------
*/

// API rate limiting
Route::middleware(['throttle:api'])->group(function () {
    // API rotaları burada
});

// Search rate limiting
Route::middleware(['throttle:search'])->group(function () {
    // Arama rotaları burada
});

// Upload rate limiting
Route::middleware(['throttle:uploads'])->group(function () {
    // Upload rotaları burada
});