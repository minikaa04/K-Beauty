# Uygulama Planı (Implementation_plan.md)

1. **Adım 1: Analiz ve Hazırlık**
   - Veritabanının tespit edilmesi ve `config.php`/`database.php` gibi bir bağlantı dosyasının oluşturulması.
   - Adminator dashboard'unun indirilip `admin` klasörüne kurulması.

2. **Adım 2: Çeviri ve İçerik Düzenleme (Kore Güzellik Salonu)**
   - `index.html` dosyasındaki tüm İngilizce metinlerin Türkçe'ye çevrilmesi.
   - "Gentlemen's Barber Shop" konseptinden "Kore Tarzı Güzellik Salonu" (Saç, Makyaj, Tırnak vb.) temasına geçiş. 

3. **Adım 3: Görsel Güncellemesi (Resim Seçimi)**
   - İnternetten uygun, kaliteli Kore stili güzellik salonu, makyaj, saç şekillendirme ve tırnak sanatı (nail art) fotoğraflarının indirilmesi.
   - Bu fotoğrafların mevcut Barber Shop görselleriyle uyumlu başlıklar/isimler altında `images/` dizininde güncellenmesi.

4. **Adım 4: Dinamik Yapıya Geçiş (PHP'ye Çevirme)**
   - `index.html`'in `index.php` olarak revize edilmesi.
   - Hizmetler (Services), Randevu (Booking), Fiyatlar (Pricing) gibi kısımların statik yapıdan çıkarılıp veritabanından veri çeken dinamik PHP yapısına dönüştürülmesi.

5. **Adım 5: Admin Panel (Adminator) Düzenlemesi ve Entegrasyonu**
   - Adminator şablonunun Türkçe'ye çevrilmesi ve gereksiz dosyalarının temizlenmesi.
   - Güzellik salonu için Hizmet (Service) ekleme/çıkarma, Personel (Staff), Randevuları (Bookings) görme gibi temel CRUD tabanlı backend sayfalarının oluşturulması (`admin/index.php`, `admin/services.php`).

6. **Adım 6: Test ve Tasarım Rötuşları**
   - Sayfanın estetiğinin "çok şık" ve dinamik olması için CSS dosyalarında renk paletinin ve fontların düzenlenmesi.
   - Sitenin hem admin paneli hem de frontend taraflarında baştan sona test edilmesi.
