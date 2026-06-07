<?php
session_start();
include 'koneksi.php';

// Periksa session untuk halaman internal
$basename = basename($_SERVER['PHP_SELF']);
$halaman_internal = ['dashboard.php', 'index.php', 'tambah.php', 'edit.php', 'print.php', 'logout.php'];

if (in_array($basename, $halaman_internal) && !isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventaris Lab RPL</title>
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    
    <!-- Google Fonts: Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --bg-dark: #0f172a;
            --bg-card: #1e293b;
            --text-light: #f1f5f9;
            --neon-blue: #00d2ff;
            --neon-green: #00ff87;
            --neon-red: #ff3333;
            --kaca: rgba(30, 41, 59, 0.7);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--bg-dark);
            background-image: radial-gradient(circle at 15% 50%, rgba(0, 210, 255, 0.05), transparent 25%), 
                              radial-gradient(circle at 85% 30%, rgba(0, 255, 135, 0.05), transparent 25%);
            color: var(--text-light);
            min-height: 100vh;
        }

        .glass-panel {
            background: var(--kaca);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 8px 32px 0 rgba(0, 0, 0, 0.37);
        }

        .text-neon-blue { color: var(--neon-blue); text-shadow: 0 0 10px rgba(0, 210, 255, 0.5); }
        .text-neon-green { color: var(--neon-green); text-shadow: 0 0 10px rgba(0, 255, 135, 0.5); }
        
        .btn-cyber {
            background: transparent;
            border: 1px solid var(--neon-blue);
            color: var(--neon-blue);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
        }
        .btn-cyber:hover {
            background: var(--neon-blue);
            color: #000;
            box-shadow: 0 0 20px var(--neon-blue);
        }

        .btn-cyber-danger {
            border-color: var(--neon-red);
            color: var(--neon-red);
        }
        .btn-cyber-danger:hover {
            background: var(--neon-red);
            color: white;
            box-shadow: 0 0 20px var(--neon-red);
        }

        .form-control-dark {
            background: rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
        }
        .form-control-dark:focus {
            background: rgba(0, 0, 0, 0.4);
            border-color: var(--neon-blue);
            color: white;
            box-shadow: 0 0 10px rgba(0, 210, 255, 0.2);
        }

        .navbar-dark-cyber {
            background: rgba(15, 23, 42, 0.95);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }

        .table-dark-cyber {
            --bs-table-bg: transparent;
            --bs-table-color: var(--text-light);
            border-color: rgba(255, 255, 255, 0.1);
        }
        .table-dark-cyber > thead {
            background: rgba(0, 0, 0, 0.3);
            color: var(--neon-blue);
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 1px;
        }
        .table-dark-cyber > tbody > tr {
            transition: all 0.2s ease;
        }
        .table-dark-cyber > tbody > tr:hover {
            background: rgba(0, 210, 255, 0.05);
            transform: translateX(5px);
        }

        @media print {
            body { background: white !important; color: black !important; }
            .no-print { display: none !important; }
            .card { box-shadow: none !important; border: 1px solid #ddd; background: white; }
            table { color: black; }
            a { text-decoration: none; color: black; }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <?php if(isset($_SESSION['user_id'])): ?>
    <nav class="navbar navbar-expand-lg navbar-dark navbar-dark-cyber sticky-top glass-panel">
        <div class="container">
            <a class="navbar-brand fw-bold text-neon-blue" href="#">
                <i class="bi bi-cpu-fill me-2"></i>LAB RPL INVENTORY
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link <?= ($basename=='dashboard.php')?'active text-neon-blue':'' ?>" href="dashboard.php"><i class="bi bi-speedometer2 me-1"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link <?= ($basename=='index.php')?'active text-neon-blue':'' ?>" href="index.php"><i class="bi bi-box-seam me-1"></i> Data Barang</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-light" href="#" role="button" data-bs-toggle="dropdown">
                            <i class="bi bi-person-circle me-1"></i> <?= htmlspecialchars($_SESSION['name']); ?>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark glass-panel">
                            <li><a class="dropdown-item text-danger" href="logout.php"><i class="bi bi-box-arrow-right me-2"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <?php endif; ?>

    <main class="pb-5">