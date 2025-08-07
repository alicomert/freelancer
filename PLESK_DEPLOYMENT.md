# 🚀 Plesk Paylaşımlı Hosting Deployment Rehberi

## 📋 Ön Hazırlık (Yerel Bilgisayarınızda)

### 1. Production Build Oluşturun
```bash
# Tüm dependencies'leri yükle
npm install

# Production build oluştur
npm run build:plesk
```

### 2. Laravel Optimizasyonları
```bash
# Config cache
php artisan config:cache

# Route cache
php artisan route:cache

# View cache
php artisan view:cache

# Autoloader optimize
composer install --optimize-autoloader --no-dev
```

## 📁 Plesk'e Yüklenecek Dosyalar

### ✅ Yüklenecek Dosyalar/Klasörler:
```
├── app/                    # Laravel uygulama dosyaları
├── bootstrap/              # Laravel bootstrap
├── config/                 # Konfigürasyon dosyaları
├── database/               # Migration ve seeder'lar
├── public/                 # Web root (httpdocs'a gidecek)
│   ├── build/             # Vite build çıktıları (ÖNEMLİ!)
│   ├── .htaccess          # Optimize edilmiş .htaccess
│   └── index.php          # Laravel entry point
├── resources/              # Blade template'ler
├── routes/                 # Route dosyaları
├── storage/                # Storage klasörü
├── vendor/                 # Composer dependencies
├── .env                    # Production environment
├── composer.json
└── composer.lock
```

### ❌ Yüklenmeyecek Dosyalar:
```
├── node_modules/           # NPM packages (gerekli değil)
├── resources/js/           # Source JS (build'de dahil)
├── resources/css/          # Source CSS (build'de dahil)
├── .env.example
├── package.json            # Opsiyonel
├── vite.config.js          # Opsiyonel
└── tailwind.config.js      # Opsiyonel
```

## 🔧 Plesk Panel Ayarları

### 1. Domain Ayarları
- **Document Root**: `public` klasörünü seçin
- **PHP Version**: PHP 8.1 veya üzeri

### 2. Database Ayarları
- MySQL database oluşturun
- Database bilgilerini `.env` dosyasına ekleyin

### 3. Environment Dosyası (.env)
```env
APP_NAME="FreelancerHub"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://yourdomain.com

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=your_database_name
DB_USERNAME=your_database_user
DB_PASSWORD=your_database_password

# Cache ayarları (Plesk için optimize)
CACHE_DRIVER=file
SESSION_DRIVER=file
QUEUE_CONNECTION=sync

# Mail ayarları (Plesk SMTP)
MAIL_MAILER=smtp
MAIL_HOST=your-plesk-mail-server
MAIL_PORT=587
MAIL_USERNAME=your-email@yourdomain.com
MAIL_PASSWORD=your-email-password
MAIL_ENCRYPTION=tls
```

## 📤 Upload Süreci

### 1. FTP/SFTP ile Upload
```
1. Tüm dosyaları Plesk'teki domain klasörüne yükleyin
2. public/ klasörünün içeriğini httpdocs/ klasörüne taşıyın
3. Diğer Laravel dosyalarını httpdocs'un dışında tutun
```

### 2. Dosya İzinleri (Plesk File Manager'da)
```bash
# Storage klasörü yazılabilir olmalı
chmod -R 775 storage/
chmod -R 775 bootstrap/cache/
```

### 3. Database Migration
```bash
# Plesk SSH Terminal'de (eğer varsa) veya cPanel'de
php artisan migrate --force
php artisan db:seed --force
```

## ⚡ Performance Optimizasyonları

### 1. Vite Assets
- `public/build/` klasörü otomatik olarak cache edilir
- CSS/JS dosyaları 1 yıl cache'lenir
- Gzip compression aktif

### 2. Laravel Cache
```bash
# Production'da cache'leri aktif tutun
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 3. Database Optimizasyonu
- Index'leri kontrol edin
- Query optimizasyonu yapın
- N+1 problem'lerini çözün

## 🔒 Güvenlik Ayarları

### 1. .htaccess Güvenlik
- XSS koruması aktif
- CSRF koruması aktif
- Frame options set edildi

### 2. Laravel Güvenlik
```env
APP_DEBUG=false
APP_ENV=production
```

### 3. File Permissions
```
Folders: 755
Files: 644
storage/: 775
bootstrap/cache/: 775
```

## 🚨 Troubleshooting

### 1. 500 Internal Server Error
- `.env` dosyası doğru mu?
- Storage izinleri 775 mi?
- `APP_KEY` generate edildi mi?

### 2. CSS/JS Yüklenmiyor
- `public/build/` klasörü yüklendi mi?
- `.htaccess` dosyası doğru mu?
- Vite manifest.json var mı?

### 3. Database Bağlantı Hatası
- Database bilgileri doğru mu?
- Database kullanıcısı oluşturuldu mu?
- Host bilgisi localhost mi?

## 📞 Destek

Herhangi bir sorun yaşarsanız:
1. Plesk error log'larını kontrol edin
2. Laravel log'larını kontrol edin (`storage/logs/`)
3. Browser developer tools'da network tab'ını kontrol edin

## 🎯 Son Kontrol Listesi

- [ ] `npm run build:plesk` çalıştırıldı
- [ ] `public/build/` klasörü oluşturuldu
- [ ] `.env` dosyası production için hazırlandı
- [ ] Database oluşturuldu ve migrate edildi
- [ ] File permissions ayarlandı
- [ ] Domain document root `public` olarak ayarlandı
- [ ] SSL sertifikası aktif
- [ ] Cache'ler temizlendi ve yeniden oluşturuldu

Bu rehberi takip ederek projenizi Plesk paylaşımlı hosting'e başarıyla deploy edebilirsiniz! 🚀