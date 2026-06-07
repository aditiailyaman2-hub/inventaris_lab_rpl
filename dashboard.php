<?php include 'header.php'; ?>

<div class="container mt-4">
    <div class="row mb-4 animate__animated animate__fadeInDown">
        <div class="col-12">
            <h4 class="text-white fw-bold"><i class="bi bi-speedometer2 text-neon-blue"></i> DASHBOARD</h4>
            <p class="text-muted">Selamat datang, <?= htmlspecialchars($_SESSION['name']); ?>. Berikut ringkasan inventaris Anda.</p>
        </div>
    </div>

    <?php
    $user_id = $_SESSION['user_id'];
    
    // Total Stok
    $total = $connect->query("SELECT SUM(jumlah) as total FROM barang WHERE user_id = '$user_id'")->fetch_assoc();
    $total_stok = $total['total'] ? $total['total'] : 0;

    // Kondisi Baik
    $baik = $connect->query("SELECT SUM(jumlah) as total FROM barang WHERE kondisi='Baik' AND user_id = '$user_id'")->fetch_assoc();
    $stok_baik = $baik['total'] ? $baik['total'] : 0;

    // Kondisi Rusak
    $rusak = $connect->query("SELECT SUM(jumlah) as total FROM barang WHERE kondisi='Rusak' AND user_id = '$user_id'")->fetch_assoc();
    $stok_rusak = $rusak['total'] ? $rusak['total'] : 0;
    ?>

    <!-- Cards Stats -->
    <div class="row g-4">
        <div class="col-md-4">
            <div class="card glass-panel h-100 border-start border-5 border-white">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase">Total Stok</h6>
                            <h2 class="fw-bold text-white"><?= $total_stok; ?></h2>
                        </div>
                        <div class="display-4 text-white-50"><i class="bi bi-box-seam"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card glass-panel h-100 border-start border-5 border-success">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase">Kondisi Baik</h6>
                            <h2 class="fw-bold text-neon-green"><?= $stok_baik; ?></h2>
                        </div>
                        <div class="display-4 text-success opacity-50"><i class="bi bi-check-circle-fill"></i></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card glass-panel h-100 border-start border-5 border-danger">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="text-muted text-uppercase">Kondisi Rusak</h6>
                            <h2 class="fw-bold text-danger"><?= $stok_rusak; ?></h2>
                        </div>
                        <div class="display-4 text-danger opacity-50"><i class="bi bi-x-circle-fill"></i></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Action -->
    <div class="row mt-5">
        <div class="col-12">
            <div class="card glass-panel">
                <div class="card-header bg-transparent border-0">
                    <h5 class="text-neon-blue"><i class="bi bi-lightning-charge-fill"></i> Aksi Cepat</h5>
                </div>
                <div class="card-body">
                    <a href="tambah.php" class="btn btn-cyber me-2 mb-2"><i class="bi bi-plus-circle"></i> Tambah Barang</a>
                    <a href="index.php" class="btn btn-outline-light mb-2"><i class="bi bi-table"></i> Kelola Data</a>
                    <a href="print.php" class="btn btn-outline-info mb-2"><i class="bi bi-printer"></i> Cetak Laporan</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>