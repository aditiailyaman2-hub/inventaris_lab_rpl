<?php
session_start();
include 'koneksi.php';
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Cek apakah email kosong
    if(empty($email) || empty($password)) {
        $error = "Email dan Password wajib diisi!";
    } else {
        // Pakai prepared statement atau最少 escape
        $email_escaped = $connect->real_escape_string($email);
        $result = $connect->query("SELECT * FROM users WHERE email = '$email_escaped'");

        if (!$result) {
            $error = "Error Query: " . $connect->error;
        } elseif ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Login Berhasil
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['name'] = $row['name'];
                $_SESSION['email'] = $row['email'];
                
                header("Location: dashboard.php");
                exit;
            } else {
                $error = "Password yang Anda masukkan salah!";
            }
        } else {
            $error = "Email belum terdaftar dalam sistem.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Lab RPL Inventory</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        :root { --bg-dark: #0f172a; --neon-blue: #00d2ff; --glass: rgba(30, 41, 59, 0.7); }
        body { background-color: var(--bg-dark); font-family: 'Inter', sans-serif; color: white; height: 100vh; display: flex; align-items: center; justify-content: center; background-image: radial-gradient(circle at center, rgba(0, 210, 255, 0.1), transparent 70%); }
        .login-card { background: var(--glass); backdrop-filter: blur(15px); border: 1px solid rgba(255,255,255,0.1); padding: 2rem; border-radius: 15px; width: 100%; max-width: 400px; box-shadow: 0 0 30px rgba(0, 210, 255, 0.1); }
        .form-control { background: rgba(0,0,0,0.3); border: 1px solid rgba(255,255,255,0.1); color: white; padding: 10px; }
        .form-control:focus { border-color: var(--neon-blue); box-shadow: 0 0 10px rgba(0,210,255,0.3); background: rgba(0,0,0,0.5); color: white; }
        .btn-neon { background: var(--neon-blue); color: #000; font-weight: bold; border: none; width: 100%; padding: 10px; transition: 0.3s; }
        .btn-neon:hover { box-shadow: 0 0 20px var(--neon-blue); transform: scale(1.02); }
        .text-neon { color: var(--neon-blue); text-shadow: 0 0 5px var(--neon-blue); }
    </style>
</head>
<body>

<div class="login-card animate__animated animate__fadeInUp">
    <div class="text-center mb-4">
        <h2 class="fw-bold text-neon"><i class="bi bi-cpu-fill"></i> LAB RPL</h2>
        <p class="small text-muted">SYSTEM LOGIN</p>
    </div>

    <?php if($error): ?>
    <div class="alert alert-danger bg-transparent border-danger text-danger" role="alert">
        <i class="bi bi-exclamation-triangle-fill"></i> <?= $error; ?>
    </div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label text-white-50">Email Address</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-envelope"></i></span>
                <input type="email" name="email" class="form-control" placeholder="name@example.com" required>
            </div>
        </div>
        <div class="mb-4">
            <label class="form-label text-white-50">Password</label>
            <div class="input-group">
                <span class="input-group-text bg-transparent border-secondary text-secondary"><i class="bi bi-key"></i></span>
                <input type="password" name="password" class="form-control" placeholder="********" required>
            </div>
        </div>
        <button type="submit" class="btn btn-neon">ENTER SYSTEM</button>
    </form>
    
    <div class="mt-3 text-center">
        <small class="text-muted">Belum punya akun? <a href="register.php" class="text-neon-blue text-decoration-none">Registrasi Baru</a></small>
    </div>
</div>

</body>
</html>