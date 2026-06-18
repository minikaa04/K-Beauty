<?php
session_start();
include 'config.php';

// Veritabanından verileri çekme
$services = [];
$servicesQuery = $conn->query("SELECT * FROM services");
if ($servicesQuery) {
    while($row = $servicesQuery->fetch_assoc()) {
        $services[] = $row;
    }
}

$staff = [];
$staffQuery = $conn->query("SELECT * FROM staff");
if ($staffQuery) {
    while($row = $staffQuery->fetch_assoc()) {
        $staff[] = $row;
    }
}

// Form Gönderim İşlemi (Randevu)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['bb-name'])) {
    if (!isset($_SESSION['user_id'])) {
        $msg_error = "Randevu alabilmek için lütfen önce giriş yapın!";
    } else {
        $name = $conn->real_escape_string($_POST['bb-name']);
        $phone = $conn->real_escape_string($_POST['bb-phone']);
        $time = $conn->real_escape_string($_POST['bb-time']);
        $branch = $conn->real_escape_string($_POST['bb-branch']);
        $date = $conn->real_escape_string($_POST['bb-date']);
        $people = (int)$_POST['bb-number'];
        $message = $conn->real_escape_string($_POST['bb-message']);

        $insert = $conn->query("INSERT INTO appointments (name, phone, time, branch, date, people, message) VALUES ('$name', '$phone', '$time', '$branch', '$date', $people, '$message')");
        
        if($insert){
            $msg = "Randevunuz başarıyla oluşturuldu!";
        } else {
            $msg_error = "Bir hata oluştu.";
        }
    }
}
?>
<!doctype html>
<html lang="tr">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="En iyi K-Beauty Güzellik Salonu">
        <meta name="author" content="">

        <title>K-Beauty | Kore Tarzı Güzellik Salonu</title>

        <!-- CSS DOSYALARI (Font Problemi Poppins İle Giderildi) -->        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <!-- Unbounded yerine daha okunaklı ve estetik olan Poppins kullanıyoruz -->
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
        
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/bootstrap-icons.css" rel="stylesheet">
        <link href="css/templatemo-barber-shop.css" rel="stylesheet">
        
        <style>
            /* Kore temasını vurgulayan tatlı renk paleti ayarları */
            :root {
                --primary-color: #ffb6c1; /* Açık Pembe */
                --secondary-color: #ffe4e1;
                --text-color: #333333;
                --dark-color: #1a1a1a;
            }
            body, h1, h2, h3, h4, h5, h6, p, a, div, span {
                font-family: 'Poppins', sans-serif !important;
            }
            .custom-btn { background-color: var(--primary-color); border-color: var(--primary-color); color: white;}
            .custom-btn:hover { background-color: #ff9fb0; border-color: #ff9fb0; color: white;}
            .hero-section { background-image: url('images/salon-interior.jpg'); background-size: cover; background-position: center; }
            .bg-pink { background-color: #fff0f5; }
            h1, h2, h3, h4, h5, h6 { color: var(--dark-color); }
            h1 strong { color: var(--primary-color) !important; }
            .price-list-thumb-divider { border-bottom: 2px dotted #ffb6c1; }
            
            /* Add hover overlay to services */
            .service-link { display: block; text-decoration: none; border-radius: 15px; transition: transform 0.3s; }
            .service-link:hover { transform: translateY(-8px); box-shadow: 0 15px 30px rgba(255, 182, 193, 0.4); }
        </style>
    </head>
    
    <body>

        <div class="container-fluid">
            <div class="row">

                <button class="navbar-toggler d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Aç/Kapat">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Sol Menü -->
                <nav id="sidebarMenu" class="col-md-4 col-lg-3 d-md-block sidebar collapse p-0">
                    <div class="position-sticky sidebar-sticky d-flex flex-column justify-content-center align-items-center">
                        <a class="navbar-brand" href="index.php">
                            <h2 style="color:white; font-weight: 700;">K-Beauty</h2>
                        </a>

                        <ul class="nav flex-column text-center w-100">
                            <!-- Hoşgeldin Bölümü (Üyelik) -->
                            <?php if(isset($_SESSION['user_id'])): ?>
                                <li class="nav-item mb-3">
                                    <span class="text-white">Merhaba, <?= htmlspecialchars($_SESSION['user_name']) ?></span><br>
                                    <a class="btn btn-sm btn-outline-light mt-2 rounded-pill" href="logout.php">Çıkış Yap</a>
                                </li>
                            <?php else: ?>
                                <li class="nav-item mb-3 d-flex justify-content-center gap-2">
                                    <a class="btn btn-sm btn-light rounded-pill" href="login.php">Giriş Yap</a>
                                    <a class="btn btn-sm" style="background:#ffb6c1; color:white; border-radius:50px;" href="register.php">Üye Ol</a>
                                </li>
                            <?php endif; ?>
                            
                            <hr style="border-color: rgba(255,255,255,0.2); width:80%; margin:10px auto;">

                            <li class="nav-item"><a class="nav-link click-scroll" href="#section_1">Ana Sayfa</a></li>
                            <li class="nav-item"><a class="nav-link click-scroll" href="#section_2">Uzmanlarımız</a></li>
                            <li class="nav-item"><a class="nav-link click-scroll" href="#section_3" style="color: #ffb6c1; font-weight: bold;">Hizmetlerimiz (Detaylı İzle)</a></li>
                            <li class="nav-item"><a class="nav-link click-scroll" href="#section_4">Fiyat Listesi</a></li>
                            <li class="nav-item"><a class="nav-link click-scroll" href="#booking-section">Randevu Al</a></li>
                            <li class="nav-item mt-4 mt-lg-5"><a class="nav-link text-muted small" href="admin/">Admin Panel</a></li>
                        </ul>
                    </div>
                </nav>
                
                <div class="col-md-8 ms-sm-auto col-lg-9 p-0">
                    <!-- Hero Section -->
                    <section class="hero-section d-flex justify-content-center align-items-center" id="section_1">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-8 col-12">
                                        <h1 class="text-white mb-lg-3 mb-4"><strong style="text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">K-Beauty <em>Salon</em></strong></h1>
                                        <p class="text-white" style="font-size: 1.2rem; text-shadow: 1px 1px 2px rgba(0,0,0,0.8);">En şık Kore tarzı saç, makyaj ve tırnak hizmetleri.</p>
                                        <br>
                                        <a class="btn custom-btn custom-border-btn custom-btn-bg-white smoothscroll me-2 mb-2 rounded-pill" href="#section_2">Hakkımızda</a>
                                        <a class="btn custom-btn smoothscroll mb-2 rounded-pill" href="#section_3">Neler Yapıyoruz?</a>
                                    </div>
                                </div>
                            </div>
                    </section>

                    <!-- Hakkımızda & Uzmanlar (section_2) -->
                    <section class="about-section section-padding bg-pink" id="section_2">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-12 mx-auto">
                                    <h2 class="mb-4">En İyi Güzellik Uzmanları</h2>
                                    <div class="border-bottom pb-3 mb-5">
                                        <p>K-Beauty Salon olarak, size en son Kore trendlerini sunuyoruz. Deneyimli uzmanlarımızla saç kesimi, renklendirme, cilt bakımı hissi veren profesyonel makyaj ve eşsiz tırnak sanatı hizmetleriyle güzelliğinizi ortaya çıkarıyoruz.</p>
                                    </div>
                                </div>
                                <h6 class="mb-5">Stilistlerimizle Tanışın</h6>
                                
                                <div class="row">
                                <?php foreach($staff as $member): ?>
                                    <div class="col-lg-4 col-md-6 col-12 custom-block-bg-overlay-wrap mb-5">
                                        <img src="<?= htmlspecialchars($member['image']) ?>" class="custom-block-bg-overlay-image img-fluid" alt="<?= htmlspecialchars($member['name']) ?>" style="height:350px; object-fit:cover; border-radius:15px;">
                                        <div class="team-info d-flex align-items-center flex-wrap" style="background: rgba(255,255,255,0.9); border-radius: 0 0 15px 15px;">
                                            <div>
                                                <p class="mb-0 fw-bold"><?= htmlspecialchars($member['name']) ?></p>
                                                <small class="text-muted"><?= htmlspecialchars($member['role']) ?></small>
                                            </div>
                                            <ul class="social-icon ms-auto">
                                                <li class="social-icon-item"><a href="#" class="social-icon-link bi-instagram" style="color:var(--primary-color);"></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Hizmetler (Tıklanabilir İnceleme Kartları) -->
                    <section class="services-section section-padding" id="section_3">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-12 col-12">
                                    <h2 class="mb-5 text-center">Hizmetlerimiz İçin Detayları Keşfedin</h2>
                                    <p class="text-center text-muted mb-5">Hizmetin veya teklifin üzerine tıklayarak daha fazla detaya ulaşabilirsiniz.</p>
                                </div>

                                <?php foreach($services as $serv): ?>
                                <div class="col-lg-6 col-12 mb-4">
                                    <a href="service.php?id=<?= $serv['id'] ?>" class="service-link">
                                        <div class="services-thumb" style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                                            <img src="<?= htmlspecialchars($serv['image']) ?>" class="services-image img-fluid" alt="<?= htmlspecialchars($serv['title']) ?>" style="height:250px; width:100%; object-fit:cover;">
                                            <div class="services-info d-flex align-items-end" style="background: linear-gradient(transparent, rgba(0,0,0,0.8));">
                                                <div>
                                                    <span class="badge bg-light text-dark mb-2"><?= htmlspecialchars($serv['category']) ?></span>
                                                    <h4 class="mb-0 text-white"><?= htmlspecialchars($serv['title']) ?> <i class="bi bi-arrow-right-circle ms-2" style="font-size: 1.2rem; color: #ffb6c1;"></i></h4>
                                                </div>
                                                <strong class="services-thumb-price text-white fw-bold" style="background: var(--primary-color); padding: 5px 15px; border-radius: 20px;"><?= htmlspecialchars($serv['price']) ?></strong>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </section>

                    <!-- Randevu (booking-section) -->
                    <section class="booking-section section-padding bg-pink" id="booking-section">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-10 col-12 mx-auto">
                                <?php if(isset($msg)): ?>
                                    <div class="alert alert-success"><?= $msg ?></div>
                                <?php endif; ?>
                                <?php if(isset($msg_error)): ?>
                                    <div class="alert alert-danger"><?= $msg_error ?></div>
                                <?php endif; ?>
                                <form action="index.php#booking-section" method="post" class="custom-form booking-form p-5" id="bb-booking-form" style="background: white; border-radius: 20px; box-shadow: 0 10px 30px rgba(0,0,0,0.05);">
                                    <div class="text-center mb-5">
                                        <h2 class="mb-1">Randevu Al</h2>
                                        <p>Seçtiğiniz tarihe kolayca ajanda girişi yapın.</p>
                                    </div>
                                    <div class="booking-form-body">
                                        <?php if(isset($_SESSION['user_id'])): ?>
                                            <div class="row">
                                                <div class="col-lg-6 col-12"><input type="text" name="bb-name" class="form-control" placeholder="Adınız Soyadınız" value="<?= htmlspecialchars($_SESSION['user_name']) ?>" required></div>
                                                <div class="col-lg-6 col-12"><input type="tel" class="form-control" name="bb-phone" placeholder="Telefon 05XX XXX XX XX" required></div>
                                                <div class="col-lg-6 col-12"><input class="form-control" type="time" name="bb-time" value="10:00" /></div>
                                                <div class="col-lg-6 col-12">
                                                    <select class="form-select form-control" name="bb-branch" required>
                                                        <option value="" selected>Şube Seçin</option>
                                                        <option value="Kadıköy Merkez">Kadıköy Merkez</option>
                                                        <option value="Nişantaşı Şubesi">Nişantaşı Şubesi</option>
                                                    </select>
                                                </div>
                                                <div class="col-lg-6 col-12"><input type="date" name="bb-date" class="form-control" required></div>
                                                <div class="col-lg-6 col-12"><input type="number" name="bb-number" class="form-control" placeholder="Kişi Sayısı" required></div>
                                            </div>
                                            <textarea name="bb-message" rows="3" class="form-control" placeholder="Özel İstekleriniz (İsteğe Bağlı)"></textarea>
                                            <div class="col-lg-4 col-md-10 col-8 mx-auto mt-4">
                                                <button type="submit" class="form-control custom-btn fw-bold rounded-pill">Gönder</button>
                                            </div>
                                        <?php else: ?>
                                            <div class="text-center py-4">
                                                <div class="mb-4 text-muted">Randevu oluşturabilmek için sisteme kayıt olmanız gerekmektedir.</div>
                                                <a href="login.php" class="btn btn-custom px-5 py-2 rounded-pill fw-bold mb-3">Giriş Yap</a>
                                                <br>
                                                <a href="register.php" style="color: #ffb6c1; text-decoration: underline;">Üye Değil Misiniz? Yeni Kayıt!</a>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </section>

                    <!-- Fiyat Listesi Özet (section_4) -->
                    <section class="price-list-section section-padding" id="section_4">
                        <!-- ... -->
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-8 col-12">
                                    <div class="price-list-thumb-wrap">
                                        <div class="mb-4">
                                            <h2 class="mb-2">Fiyat Listesi</h2>
                                            <strong>En cazip fiyatlarla kaliteli hizmet.</strong>
                                        </div>
                                        <?php foreach($services as $serv): ?>
                                        <div class="price-list-thumb">
                                            <h6 class="d-flex">
                                                <?= htmlspecialchars($serv['title']) ?>
                                                <span class="price-list-thumb-divider"></span>
                                                <strong><?= htmlspecialchars($serv['price']) ?></strong>
                                            </h6>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-12 mt-5 mb-5 mb-lg-0 mt-lg-0 pt-3 pt-lg-0">
                                    <img src="images/salon-interior.jpg" class="img-fluid" alt="" style="border-radius:20px; box-shadow: 0 10px 30px rgba(0,0,0,0.1);">
                                </div>
                            </div>
                        </div>
                    </section>

                <footer class="site-footer" style="background-color: var(--dark-color);">
                    <!-- ... -->
                    <div class="container py-4">
                        <div class="row">
                            <div class="col-lg-12 col-12">
                                <h4 class="site-footer-title mb-4 text-white">Bizimle İletişime Geçin</h4>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="mb-1 text-white">Adres:</strong>
                                <p style="color:#aaa;">Moda Cad. No:1, Kadıköy, İstanbul</p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <strong class="mb-1 text-white">Telefon:</strong>
                                <p style="color:#aaa;">+90 212 000 0000</p>
                            </div>
                        </div>
                    </div>
                    <div class="site-footer-bottom border-top" style="border-color: #333 !important;">
                        <div class="container">
                            <div class="row align-items-center">
                                <div class="col-lg-8 col-12 mt-4">
                                    <p class="copyright-text mb-0" style="color:#aaa;">Copyright © 2026 K-Beauty Salon</p>
                                </div>
                                <div class="col-lg-2 col-md-3 col-3 mt-lg-4 ms-auto">
                                    <a href="#section_1" class="back-top-icon smoothscroll" title="Yukarı Çık" style="background:var(--primary-color); border-radius:50%;">
                                        <i class="bi-arrow-up-circle"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </footer>
            </div>
        </div>

        <script src="js/jquery.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/click-scroll.js"></script>
        <script src="js/custom.js"></script>
    </body>
</html>