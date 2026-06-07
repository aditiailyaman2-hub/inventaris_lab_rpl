<?php
include 'koneksi.php';
$msg = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $connect->real_escape_string($_POST['name']);
    $email = $connect->real_escape_string($_POST['email']);
    $pass = $_POST['password'];
    $pass_conf = $_POST['password_conf'];

    if ($pass !== $pass_conf) {
        $msg = "Konfirmasi password tidak cocok!";
    } else {
        $hash = password_hash($pass, PASSWORD_DEFAULT);
        
        $insert = $connect->query("INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$hash')");
        
        if ($insert) {
            echo "<script>alert('Registrasi Berhasil! Silakan Login.'); window.location='login.php';</script>";
        } else {
            $msg = "Email telah terdaftar atau terjadi kesalahan.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - Lab RPL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root { --bg-dark: #0f172a; --neon-blue: #00d2ff; }
        body { background-color: var(--bg-dark); font-family: 'Inter', sans-serif; color: white; height: 100vh; display: flex; align-items: center; justify-content: center; background-image: radial-gradient(circle at center, #1e293b 0%, #0f172a 100%); }
        .glass-card { background: rgba(30, 41, 59, 0.8); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); padding: 2rem; border-radius: 15px; width: 100%; max-width: 400px; }
        .form-control { background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; }
        .form-control:focus { border-color: var(--neon-blue); box-shadow: 0 0 10px rgba(0,210,255,0.3); background: rgba(0,0,0,0.5); color: white; }
        .btn-neon { background: var(--neon-blue); color: #000; font-weight: bold; width: 100%; }
    </style>
</head>
<body>
    <div class="glass-card animate__animated animate__fadeInUp">
        <h3 class="text-center text-neon-blue mb-3"><i class="bi bi-shield-lock"></i> DAFTAR AKUN</h3>
        
        <?php if($msg): ?>
        <div class="alert alert-danger text-danger border-danger"><?= $msg; ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nama Lengkap</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konfirmasi Password</label>
                <input type="password" name="password_conf" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-neon">REGISTRASI</button>
        </form>
        <div class="mt-3 text-center">
            <small class="text-muted">Sudah punya akun? <a href="login.php" class="text-neon-blue text-decoration-none">Login Sekarang</a></small>
        </div>
    </div>
</body>
</html>