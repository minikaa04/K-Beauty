<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $conn->real_escape_string($_POST['email']);
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");
    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user['password'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['full_name'];
            header("Location: index.php");
            exit();
        } else {
            $error = "Hatalı şifre!";
        }
    } else {
        $error = "Kullanıcı bulunamadı!";
    }
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap - K-Beauty</title>
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
        <h3>Tekrar Hoşgeldin!</h3>
        <?php if(isset($_GET['registered'])): ?>
            <div class="alert alert-success">Kayıt başarılı! Şimdi giriş yapabilirsiniz.</div>
        <?php endif; ?>
        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>
        <form method="POST">
            <div class="mb-3">
                <label>E-posta</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-4">
                <label>Şifre</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-custom">Müşteri Girişi</button>
            <div class="text-center mt-3">
                Hesabınız yok mu? <a href="register.php" style="color: #ffb6c1;">Yeni Kayıt Ol</a>
            </div>
            <div class="text-center mt-3">
                <a href="index.php" class="text-muted text-decoration-none small">Ana Sayfaya Dön</a>
            </div>
        </form>
    </div>
</body>
</html>
