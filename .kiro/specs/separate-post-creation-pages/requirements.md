# Requirements Document

## Introduction

Bu özellik, mevcut tek sayfalık gönderi oluşturma formunu, her gönderi tipi için ayrı sayfalara bölerek daha temiz ve kullanıcı dostu bir deneyim sunmayı amaçlamaktadır. Her gönderi tipi (normal post, hizmet ilanı, açık artırma, anket, portfolyo, freelance proje) için özel URL'ler ve formlar oluşturulacaktır.

## Requirements

### Requirement 1

**User Story:** Bir kullanıcı olarak, gönderi oluştururken hangi tür gönderi yapmak istediğimi önceden seçebilmek ve o türe özel bir sayfaya yönlendirilmek istiyorum, böylece sadece ilgili alanları görerek daha kolay form doldurabilirim.

#### Acceptance Criteria

1. WHEN kullanıcı ana gönderi oluşturma sayfasına gittiğinde THEN sistem 6 farklı gönderi tipi seçeneği sunmalıdır
2. WHEN kullanıcı "Normal Post" seçeneğine tıkladığında THEN sistem `/posts/create/post` URL'sine yönlendirmeli
3. WHEN kullanıcı "Hizmet İlanı" seçeneğine tıkladığında THEN sistem `/posts/create/service` URL'sine yönlendirmeli
4. WHEN kullanıcı "Açık Artırma" seçeneğine tıkladığında THEN sistem `/posts/create/auction` URL'sine yönlendirmeli
5. WHEN kullanıcı "Anket" seçeneğine tıkladığında THEN sistem `/posts/create/poll` URL'sine yönlendirmeli
6. WHEN kullanıcı "Portfolyo" seçeneğine tıkladığında THEN sistem `/posts/create/portfolio` URL'sine yönlendirmeli
7. WHEN kullanıcı "Freelance Proje" seçeneğine tıkladığında THEN sistem `/posts/create/freelance` URL'sine yönlendirmeli

### Requirement 2

**User Story:** Bir kullanıcı olarak, seçtiğim gönderi tipine özel bir sayfada sadece o tür için gerekli alanları görmek istiyorum, böylece karmaşık olmayan ve odaklanmış bir form deneyimi yaşayabilirim.

#### Acceptance Criteria

1. WHEN kullanıcı normal post sayfasına gittiğinde THEN sistem sadece başlık, kategori, içerik ve etiket alanlarını göstermeli
2. WHEN kullanıcı hizmet ilanı sayfasına gittiğinde THEN sistem hizmet öğeleri, fiyatlandırma ve teslimat bilgilerini göstermeli
3. WHEN kullanıcı açık artırma sayfasına gittiğinde THEN sistem başlangıç fiyatı, rezerv fiyat ve bitiş tarihi alanlarını göstermeli
4. WHEN kullanıcı anket sayfasına gittiğinde THEN sistem anket sorusu, seçenekler ve anket ayarları alanlarını göstermeli
5. WHEN kullanıcı portfolyo sayfasına gittiğinde THEN sistem proje detayları, görseller ve teknoloji bilgilerini göstermeli
6. WHEN kullanıcı freelance proje sayfasına gittiğinde THEN sistem alıcı isteği ve iş ilanı alt seçeneklerini göstermeli

### Requirement 3

**User Story:** Bir kullanıcı olarak, her gönderi tipi sayfasında o türe uygun kategori seçeneklerini görmek istiyorum, böylece yanlış kategoride gönderi oluşturmam.

#### Acceptance Criteria

1. WHEN kullanıcı normal post veya anket sayfasında olduğunda THEN sistem forum kategorilerini göstermeli
2. WHEN kullanıcı hizmet ilanı veya açık artırma sayfasında olduğunda THEN sistem hizmet kategorilerini göstermeli
3. WHEN kullanıcı portfolyo veya freelance proje sayfasında olduğunda THEN sistem portfolyo kategorilerini göstermeli
4. WHEN kullanıcı kategori seçtiğinde THEN sistem seçilen kategoriyi form gönderiminde doğru şekilde işlemeli

### Requirement 4

**User Story:** Bir kullanıcı olarak, her sayfada tutarlı bir navigasyon ve tasarım deneyimi yaşamak istiyorum, böylece hangi gönderi tipinde olursam olayım aynı kalitede deneyim yaşayabilirim.

#### Acceptance Criteria

1. WHEN kullanıcı herhangi bir gönderi oluşturma sayfasında olduğunda THEN sistem tutarlı header ve navigasyon göstermeli
2. WHEN kullanıcı form doldururken THEN sistem aynı stil ve renk şemasını kullanmalı
3. WHEN kullanıcı hata mesajı aldığında THEN sistem tutarlı hata gösterimi sağlamalı
4. WHEN kullanıcı başarılı gönderi oluşturduğunda THEN sistem tutarlı başarı mesajı göstermeli

### Requirement 5

**User Story:** Bir kullanıcı olarak, freelance proje sayfasında alıcı isteği ve iş ilanı arasında seçim yapabilmek istiyorum, böylece ihtiyacıma göre doğru formu doldurabilirim.

#### Acceptance Criteria

1. WHEN kullanıcı freelance proje sayfasına gittiğinde THEN sistem önce "Alıcı İsteği" ve "İş İlanı Oluştur" seçeneklerini göstermeli
2. WHEN kullanıcı "Alıcı İsteği" seçtiğinde THEN sistem alıcı isteği formunu göstermeli
3. WHEN kullanıcı "İş İlanı Oluştur" seçtiğinde THEN sistem iş ilanı formunu göstermeli
4. WHEN kullanıcı seçimini değiştirdiğinde THEN sistem formu dinamik olarak güncellemeli

### Requirement 6

**User Story:** Bir geliştirici olarak, mevcut form işlevselliğinin korunmasını istiyorum, böylece kullanıcılar aynı özelliklerle gönderi oluşturmaya devam edebilsin.

#### Acceptance Criteria

1. WHEN kullanıcı herhangi bir formda gönderi oluşturduğunda THEN sistem mevcut validasyon kurallarını uygulamalı
2. WHEN form gönderildiğinde THEN sistem mevcut post oluşturma mantığını kullanmalı
3. WHEN hata oluştuğunda THEN sistem mevcut hata yönetimi sistemini kullanmalı
4. WHEN gönderi başarıyla oluşturulduğunda THEN sistem mevcut yönlendirme mantığını kullanmalı