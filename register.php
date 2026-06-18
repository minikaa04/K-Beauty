<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($check->num_rows > 0) {
        $error = "Bu e-posta adresi zaten kullanılıyor.";
    } else {
        $insert = $conn->query("INSERT INTO users (full_name, email, password) VALUES ('$name', '$email', '$password')");
        if ($insert) {
            header("Location: login.php?registered=1");
            exit();
        } else {
            $error = "Kayıt olurken bir hata oluştu.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kayıt Ol - K-Beauty</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { font-family: 'Poppins', sans-serif; background-color: #fff0f5; display: flex; align-items: center; justify-content: center; height: 100vh; }
        .auth-card { width: 100%; max-width: 450px; padding: 2.5rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(255, 182, 193, 0.4); background: white; }
        .auth-card h3 { color: #ffb6c1; text-align: center; margin-bottom: 2rem; font-weight: 600; }
        .btn-custom { background-color: #ffb6c1; border: none; color: white; width: 100%; padding: 12px; border-radius: 10px; font-weight: 500;}
        .btn-custom:hover { background-color: #ff9fb0; color: white; }
        .form-control { border-radius: 10px; padding: 10px 15px; }
        .form-control:focus { border-color: #ffb6c1; box-shadow: 0 0 0 0.25rem rgba(255, 182, 193, 0.25); }
    </style>
</head>
<body>
    <div class="auth-card">
        <h3>Aramıza Katıl</h3>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>Ad Soyad</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>E-posta</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom">Müşteri Olarak Kayıt Ol</button>
            <div class="text-center mt-3">
                Mevcut hesabınız var mı? <a href="login.php" style="color: #ffb6c1;">Giriş Yap</a>
            </div>
            <div class="text-center mt-3">
                <a href="index.php" class="text-muted text-decoration-none small">Ana Sayfaya Dön</a>
            </div>
        </form>
    </div>
</body>
</html>
