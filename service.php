<?php
session_start();
include 'config.php';

$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$query = $conn->query("SELECT * FROM services WHERE id = $id");
if (!$query || $query->num_rows == 0) {
    header("Location: index.php");
    exit();
}
$service = $query->fetch_assoc();

// Size Özel Diğer Teklifler (Random 3 Service)
$offers = [];
$offersQuery = $conn->query("SELECT * FROM services WHERE id != $id ORDER BY RAND() LIMIT 3");
if ($offersQuery) {
    while($r = $offersQuery->fetch_assoc()) {
        $offers[] = $r;
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($service['title']) ?> - K-Beauty</title>
    <!-- Sorunsuz çalışan Poppins fontu kullanımını eklendi -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fcfcfc; }
        .text-primary-custom { color: #ffb6c1; }
        .bg-primary-custom { background-color: #ffb6c1; }
        .btn-custom { background-color: #ffb6c1; border: none; color: white; padding: 10px 20px; border-radius: 8px; font-weight: 500; }
        .btn-custom:hover { background-color: #ff9fb0; color: white; }
        
        .service-header { height: 400px; background-size: cover; background-position: center; position: relative; border-radius: 20px; margin-top: 2rem; box-shadow: 0 10px 30px rgba(0,0,0,0.1); }
        .service-badge { position: absolute; top: 20px; right: 20px; background: white; color: #ffb6c1; font-weight: bold; padding: 10px 20px; border-radius: 30px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        
        .offer-card { border: none; border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; text-decoration: none; display: block; }
        .offer-card:hover { transform: translateY(-5px); box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .offer-img { height: 200px; object-fit: cover; width: 100%; }
        
        .top-nav { background: #fff; padding: 15px 0; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <!-- Header -->
    <div class="top-nav">
        <div class="container d-flex justify-content-between align-items-center">
            <a href="index.php" class="text-decoration-none">
                <h3 class="mb-0 fw-bold" style="color: #ffb6c1;">K-Beauty</h3>
            </a>
            <div>
                <?php if(isset($_SESSION['user_id'])): ?>
                    <span class="me-3 text-muted">Hoşgeldiniz, <?= htmlspecialchars($_SESSION['user_name']) ?></span>
                    <a href="logout.php" class="btn btn-outline-danger btn-sm rounded-pill">Çıkış Yap</a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-outline-dark btn-sm rounded-pill me-2">Giriş Yap</a>
                    <a href="register.php" class="btn btn-custom btn-sm rounded-pill">Kayıt Ol</a>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="container pb-5">
        
        <!-- Hizmet Detayı -->
        <div class="service-header" style="background-image: url('<?= htmlspecialchars($service['image']) ?>');">
            <div class="service-badge fs-5"><?= htmlspecialchars($service['price']) ?></div>
        </div>

        <div class="row mt-5">
            <div class="col-lg-8">
                <span class="badge bg-primary-custom mb-3 py-2 px-3 fw-normal"><?= htmlspecialchars($service['category']) ?></span>
                <h1 class="fw-bold mb-4"><?= htmlspecialchars($service['title']) ?></h1>
                <p class="lead text-muted" style="line-height: 1.8;">
                    <?= nl2br(htmlspecialchars($service['description'] ?? 'Bu benzersiz hizmetimiz ile güzelliğinizi ön plana çıkarın. Uzman kadromuzla tamamen size özel bir deneyime hazır olun.')) ?>
                </p>
                
                <h4 class="mt-5 mb-3 fw-bold">Neden Biz?</h4>
                <ul class="list-unstyled text-muted">
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary-custom me-2"></i> %100 Orijinal Kore Güzellik Ürünleri</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary-custom me-2"></i> Profesyonel ve Deneyimli Uzmanlar</li>
                    <li class="mb-2"><i class="bi bi-check-circle-fill text-primary-custom me-2"></i> Sterilize Edilmiş Hijyenik Araçlar</li>
                </ul>
            </div>
            
            <div class="col-lg-4">
                <div class="card p-4" style="border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(255, 182, 193, 0.15);">
                    <h4 class="fw-bold text-center mb-4">Hemen Randevu Alın</h4>
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <a href="index.php#booking-section" class="btn btn-custom w-100 py-3 mb-2 rounded-pill fs-5">Randevu Oluştur</a>
                        <p class="text-center text-muted small mt-3">Bugün müsaitlik durumumuz bulunuyor!</p>
                    <?php else: ?>
                        <p class="text-center text-muted mb-4">Randevu almak için öncelikle üye girişi yapmalısınız.</p>
                        <a href="login.php" class="btn btn-custom w-100 rounded-pill mb-2">Giriş Yap</a>
                        <a href="register.php" class="btn btn-outline-dark w-100 rounded-pill">Ücretsiz Kayıt Ol</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>

        <hr class="my-5" style="opacity: 0.1;">

        <!-- Benzer Teklifler -->
        <h3 class="fw-bold mb-4">Size Özel Diğer Teklifler / Hizmetler</h3>
        <div class="row">
            <?php foreach($offers as $offer): ?>
            <div class="col-md-4 mb-4">
                <a href="service.php?id=<?= $offer['id'] ?>" class="offer-card">
                    <img src="<?= htmlspecialchars($offer['image']) ?>" class="offer-img" alt="<?= htmlspecialchars($offer['title']) ?>">
                    <div class="p-4" style="background: white;">
                        <span class="badge text-dark bg-light mb-2 fw-normal border"><?= htmlspecialchars($offer['category']) ?></span>
                        <h5 class="text-dark fw-bold mb-3"><?= htmlspecialchars($offer['title']) ?></h5>
                        <div class="d-flex justify-content-between align-items-center">
                            <h6 class="text-primary-custom fw-bold mb-0"><?= htmlspecialchars($offer['price']) ?></h6>
                            <span class="btn btn-outline-secondary btn-sm rounded-pill" style="font-size: 0.8rem;">İncele <i class="bi bi-arrow-right"></i></span>
                        </div>
                    </div>
                </a>
            </div>
            <?php endforeach; ?>
        </div>

    </div>

    <!-- Footer -->
    <div style="background-color: #1a1a1a; padding: 40px 0;">
        <div class="container text-center">
            <h4 class="text-white mb-3" style="font-family: 'Poppins', sans-serif;">K-Beauty Salon</h4>
            <p style="color: #666;">Güzelliğin Yeni Adresi</p>
        </div>
    </div>

</body>
</html>
