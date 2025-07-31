# Design Document

## Overview

Bu tasarım, mevcut tek sayfalık gönderi oluşturma sistemini, her gönderi tipi için ayrı sayfalara bölen bir yapıya dönüştürmeyi amaçlamaktadır. Sistem, kullanıcı deneyimini iyileştirmek ve her gönderi tipine özel optimizasyonlar sağlamak için tasarlanmıştır.

## Architecture

### URL Structure
```
/posts/create -> Ana seçim sayfası (gönderi tipi seçimi)
/posts/create/post -> Normal post oluşturma
/posts/create/service -> Hizmet ilanı oluşturma
/posts/create/auction -> Açık artırma oluşturma
/posts/create/poll -> Anket oluşturma
/posts/create/portfolio -> Portfolyo oluşturma
/posts/create/freelance -> Freelance proje oluşturma
```

### Route Structure
```php
Route::prefix('posts')->name('posts.')->group(function () {
    Route::get('/create', [PostController::class, 'create'])->name('create');
    Route::get('/create/post', [PostController::class, 'createPost'])->name('create.post');
    Route::get('/create/service', [PostController::class, 'createService'])->name('create.service');
    Route::get('/create/auction', [PostController::class, 'createAuction'])->name('create.auction');
    Route::get('/create/poll', [PostController::class, 'createPoll'])->name('create.poll');
    Route::get('/create/portfolio', [PostController::class, 'createPortfolio'])->name('create.portfolio');
    Route::get('/create/freelance', [PostController::class, 'createFreelance'])->name('create.freelance');
    Route::post('/', [PostController::class, 'store'])->name('store');
});
```

## Components and Interfaces

### 1. Main Selection Page (`/posts/create`)
**Dosya:** `resources/views/posts/create.blade.php`

Bu sayfa, kullanıcının hangi tür gönderi oluşturmak istediğini seçmesini sağlar:
- 6 farklı gönderi tipi kartı
- Her kart, ilgili sayfaya yönlendiren link
- Responsive tasarım
- Görsel ikonlar ve açıklamalar

### 2. Post Type Specific Pages

#### Normal Post Page (`/posts/create/post`)
**Dosya:** `resources/views/posts/create/post.blade.php`
- Başlık alanı
- Forum kategorileri dropdown
- Quill.js editör
- Etiket sistemi
- Basit ve temiz arayüz

#### Service Page (`/posts/create/service`)
**Dosya:** `resources/views/posts/create/service.blade.php`
- Hizmet kategorileri dropdown
- Hizmet öğeleri yönetimi
- Fiyatlandırma alanları
- Teslimat süreleri
- Özellik ekleme sistemi

#### Auction Page (`/posts/create/auction`)
**Dosya:** `resources/views/posts/create/auction.blade.php`
- Hizmet kategorileri dropdown
- Başlangıç fiyatı
- Rezerv fiyat
- Bitiş tarihi seçici
- Otomatik uzatma seçeneği

#### Poll Page (`/posts/create/poll`)
**Dosya:** `resources/views/posts/create/poll.blade.php`
- Forum kategorileri dropdown
- Anket sorusu alanı
- Dinamik seçenek ekleme
- Anket ayarları (tek/çoklu seçim, anonim)
- Bitiş tarihi

#### Portfolio Page (`/posts/create/portfolio`)
**Dosya:** `resources/views/posts/create/portfolio.blade.php`
- Portfolyo kategorileri dropdown
- Proje başlığı ve açıklaması
- Proje URL'si
- Kullanılan teknolojiler
- Tamamlanma tarihi

#### Freelance Page (`/posts/create/freelance`)
**Dosya:** `resources/views/posts/create/freelance.blade.php`
- Alt tip seçimi (Alıcı İsteği / İş İlanı)
- Dinamik form alanları
- Bütçe aralığı
- Beceri gereksinimleri
- İş türü seçimi

### 3. Controller Methods

#### PostController Genişletmeleri
```php
public function create() // Ana seçim sayfası
public function createPost() // Normal post formu
public function createService() // Hizmet ilanı formu
public function createAuction() // Açık artırma formu
public function createPoll() // Anket formu
public function createPortfolio() // Portfolyo formu
public function createFreelance() // Freelance proje formu
public function store(Request $request) // Mevcut store metodu korunur
```

## Data Models

### Mevcut Veri Modelleri Korunur
- `posts_optimized` tablosu ana tablo olarak kalır
- `post_services`, `post_auctions`, `post_polls`, `post_portfolios`, `post_buyer_requests` tabloları korunur
- Kategori sistemi mevcut haliyle kullanılır

### Category Filtering Logic
```php
// Normal Post ve Anket için
$postCategories = Category::where('category_type', 'post')->get();

// Hizmet İlanı ve Açık Artırma için
$serviceCategories = Category::where('category_type', 'service')->get();

// Portfolyo ve Freelance için
$portfolioCategories = Category::where('category_type', 'portfolio')->get();
```

## Error Handling

### Validation Strategy
- Her sayfa için özel validation kuralları
- Mevcut `PostController::store()` metodundaki validation mantığı korunur
- Sayfa bazında client-side validation eklenir

### Error Display
- Her sayfada tutarlı hata gösterimi
- Form alanlarının altında inline hatalar
- Üst kısımda genel hata mesajları
- Başarılı işlemler için success mesajları

## Testing Strategy

### Unit Tests
- Her controller metodunun ayrı testleri
- Validation kurallarının testleri
- Kategori filtreleme mantığının testleri

### Integration Tests
- Form gönderimi end-to-end testleri
- Sayfa yönlendirmelerinin testleri
- Veri kaydının doğruluğunun testleri

### Browser Tests
- Her sayfanın görsel testleri
- Form etkileşimlerinin testleri
- Responsive tasarım testleri

## Implementation Phases

### Phase 1: Route ve Controller Genişletmeleri
- Yeni route'ların eklenmesi
- Controller metodlarının oluşturulması
- Temel view dosyalarının hazırlanması

### Phase 2: View Dosyalarının Oluşturulması
- Ana seçim sayfasının tasarımı
- Her gönderi tipi için özel sayfaların oluşturulması
- Mevcut form bileşenlerinin ayrıştırılması

### Phase 3: JavaScript ve CSS Optimizasyonları
- Sayfa bazında JavaScript dosyaları
- Ortak bileşenlerin ayrıştırılması
- Performance optimizasyonları

### Phase 4: Testing ve Debugging
- Tüm sayfaların test edilmesi
- Mevcut işlevselliğin korunduğunun doğrulanması
- Bug fix'lerin yapılması

## Shared Components

### Common Form Elements
- Başlık input komponenti
- Kategori dropdown komponenti
- Etiket sistemi komponenti
- Quill.js editör komponenti
- Hata gösterimi komponenti

### JavaScript Modules
```javascript
// resources/js/components/post-creation/
├── common/
│   ├── title-input.js
│   ├── category-selector.js
│   ├── tag-system.js
│   └── editor.js
├── service/
│   ├── service-items.js
│   └── pricing.js
├── auction/
│   └── auction-settings.js
├── poll/
│   └── poll-options.js
└── freelance/
    └── freelance-types.js
```

### CSS Structure
```scss
// resources/sass/pages/post-creation/
├── _common.scss
├── _post.scss
├── _service.scss
├── _auction.scss
├── _poll.scss
├── _portfolio.scss
└── _freelance.scss
```

## Performance Considerations

### Page Load Optimization
- Her sayfa sadece gerekli CSS/JS dosyalarını yükler
- Lazy loading için hazırlık
- Minimal DOM manipülasyonu

### Caching Strategy
- Kategori verilerinin cache'lenmesi
- View cache'leme stratejisi
- Static asset'lerin optimize edilmesi

## Security Considerations

### CSRF Protection
- Tüm formlarda CSRF token korunur
- Mevcut middleware yapısı korunur

### Input Validation
- Server-side validation öncelikli
- Client-side validation yardımcı olarak
- XSS koruması için HTML purification

### Authorization
- Mevcut auth middleware korunur
- Sayfa bazında yetki kontrolleri

## Migration Strategy

### Backward Compatibility
- Mevcut `/posts/create` URL'si ana seçim sayfasına yönlendirir
- Eski form submission'lar çalışmaya devam eder
- Mevcut API endpoint'ler korunur

### Gradual Rollout
1. Yeni sayfalar oluşturulur
2. Ana sayfa yeni seçim sayfasına dönüştürülür
3. Eski form kaldırılır
4. Cleanup işlemleri yapılır