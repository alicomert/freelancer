# 50 Milyon+ Veri İçin Optimize Edilmiş Post Sistemi

## Sistem Mimarisi

Bu sistem, post-sistemi.txt dosyasındaki önerilere göre tasarlanmış, 50 milyon+ veri ile çalışabilecek normalize edilmiş ve performans odaklı bir yapıdır.

## Ana Tablolar

### 1. posts_optimized (Ana Tablo)
- **Amaç**: Tüm post tiplerinin ortak alanları
- **Özellikler**: 
  - UUID ile public ID
  - Optimize edilmiş indeksler
  - Soft delete desteği
  - SEO alanları
  - Partitioning hazır yapı

### 2. Tip-Spesifik Tablolar
- **post_services**: Hizmet ilanları (fiyat, teslimat süresi)
- **post_auctions**: Açık artırmalar (başlangıç fiyatı, bitiş zamanı)
- **post_polls**: Anketler (sorular ve seçenekler)
- **post_portfolios**: Portfolyo projeleri

### 3. Medya ve İçerik
- **post_images**: Çoklu görsel desteği
- **tags**: Etiket sistemi
- **post_tags**: Post-etiket ilişkisi

### 4. Performans Tabloları
- **post_stats**: Günlük/saatlik istatistikler
- **trending_posts**: Trend algoritması
- **post_cache**: Sorgu önbelleği
- **post_search_index**: Arama optimizasyonu

## Kullanım Şekli

### 1. Migration Çalıştırma
```bash
php artisan migrate
```

### 2. Temel Post Oluşturma
```php
// Basit post
$post = DB::table('posts_optimized')->insert([
    'uuid' => Str::uuid(),
    'user_id' => 1,
    'post_type' => 1, // Post
    'title' => 'Başlık',
    'slug' => 'baslik',
    'content' => 'İçerik',
    'status' => 1,
    'published_at' => now(),
    'created_at' => now(),
    'updated_at' => now()
]);

// Hizmet ilanı
$servicePost = DB::table('posts_optimized')->insertGetId([...]);
DB::table('post_services')->insert([
    'post_id' => $servicePost,
    'price' => 100.00,
    'delivery_time' => 3,
    'auto_delivery' => false
]);
```

### 3. Performanslı Sorgular
```php
// Trend olan postlar
$trending = DB::table('posts_optimized')
    ->join('trending_posts', 'posts_optimized.id', '=', 'trending_posts.post_id')
    ->where('posts_optimized.status', 1)
    ->orderBy('trending_posts.trend_score', 'desc')
    ->limit(20)
    ->get();

// Kategori bazlı listeme
$categoryPosts = DB::table('posts_optimized')
    ->where('category_id', 5)
    ->where('status', 1)
    ->orderBy('is_featured', 'desc')
    ->orderBy('published_at', 'desc')
    ->paginate(20);

// Arama
$searchResults = DB::table('posts_optimized')
    ->whereRaw('MATCH(title, content, excerpt) AGAINST(? IN BOOLEAN MODE)', [$query])
    ->where('status', 1)
    ->orderByRaw('MATCH(title, content, excerpt) AGAINST(? IN BOOLEAN MODE) DESC', [$query])
    ->paginate(20);
```

### 4. İstatistik Güncelleme
```php
// Görüntülenme artırma (trigger otomatik çalışır)
DB::table('posts_optimized')
    ->where('id', $postId)
    ->increment('views_count');

// Manuel trend hesaplama
DB::statement('CALL CalculateTrendingScore(?)', [$postId]);
```

### 5. Önbellek Kullanımı
```php
// Önbellek kontrolü
$cacheKey = "post_list_category_{$categoryId}_page_{$page}";
$cached = DB::table('post_cache')
    ->where('cache_key', $cacheKey)
    ->where('expires_at', '>', now())
    ->first();

if ($cached) {
    return json_decode($cached->cache_data, true);
}

// Veri çek ve önbelleğe al
$data = // ... sorgu
DB::table('post_cache')->updateOrInsert(
    ['cache_key' => $cacheKey],
    [
        'cache_data' => json_encode($data),
        'expires_at' => now()->addMinutes(30),
        'updated_at' => now()
    ]
);
```

## Performans Optimizasyonları

### 1. İndeksleme Stratejisi
- **Composite Index**: Çoklu kolon sorguları için
- **Covering Index**: SELECT sorgularını hızlandırır
- **Partial Index**: Sadece aktif kayıtlar için
- **Fulltext Index**: Arama sorguları için

### 2. Partitioning (Manuel)
```sql
-- Tarih bazlı partitioning
ALTER TABLE posts_optimized PARTITION BY RANGE (YEAR(created_at)) (
    PARTITION p2024 VALUES LESS THAN (2025),
    PARTITION p2025 VALUES LESS THAN (2026),
    PARTITION p2026 VALUES LESS THAN (2027),
    PARTITION p_future VALUES LESS THAN MAXVALUE
);
```

### 3. Stored Procedures
- **CalculateTrendingScore**: Trend puanı hesaplama
- **Event Scheduler**: Otomatik trend güncelleme (15 dakikada bir)

### 4. Trigger'lar
- **update_post_stats_on_view**: Görüntülenme istatistikleri

## Ölçeklenebilirlik

### 1. Horizontal Scaling
- Read replica'lar için ayrı connection
- Master-slave yapısı
- Sharding hazır yapı

### 2. Caching Layers
- Redis/Memcached entegrasyonu
- Application level cache
- Database query cache

### 3. Archive Strategy
```php
// Eski verileri arşivleme
$oldPosts = DB::table('posts_optimized')
    ->where('created_at', '<', now()->subYears(2))
    ->where('status', 4) // deleted
    ->get();

// Archive tablosuna taşı
DB::table('posts_archive')->insert($oldPosts->toArray());
DB::table('posts_optimized')->where('created_at', '<', now()->subYears(2))->delete();
```

## Monitoring ve Analiz

### 1. Performance Tracking
```php
// Sorgu performansını logla
$startTime = microtime(true);
$result = DB::table('posts_optimized')->where(...)->get();
$executionTime = (microtime(true) - $startTime) * 1000;

DB::table('query_performance_log')->insert([
    'query_type' => 'post_list',
    'query_params' => json_encode($params),
    'execution_time' => $executionTime,
    'result_count' => $result->count(),
    'executed_at' => now()
]);
```

### 2. Quality Control
```php
// Kalite puanı hesaplama
$qualityScore = calculateQualityScore($post);
DB::table('post_quality_scores')->updateOrInsert(
    ['post_id' => $postId],
    [
        'quality_score' => $qualityScore,
        'last_calculated' => now()
    ]
);
```

Bu sistem 50 milyon+ veri ile sorunsuz çalışacak şekilde tasarlanmıştır. Normalize edilmiş yapı, optimize edilmiş indeksler ve gelişmiş önbellekleme stratejileri ile yüksek performans sağlar.