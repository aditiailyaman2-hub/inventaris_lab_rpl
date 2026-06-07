<?php 
include 'koneksi.php'; 
include 'header.php'; 

$user_id = $_SESSION['user_id'];

// Query semua data user yang login
$query = "SELECT * FROM barang WHERE user_id = '$user_id' ORDER BY nama_barang ASC";
$result = $connect->query($query);

$total = 0;
$baik = 0;
$rusak = 0;
while($r = $result->fetch_assoc()) {
    $total += $r['jumlah'];
    if($r['kondisi'] == 'Baik') $baik += $r['jumlah'];
    else $rusak += $r['jumlah'];
}
$result->data_seek(0); // Reset pointer
?>

<div class="container mt-5 no-print">
    <div class="d-flex justify-content-between">
        <button onclick="window.print()" class="btn btn-cyber"><i class="bi bi-printer"></i> Cetak Sekarang</button>
        <a href="index.php" class="btn btn-outline-light">Kembali</a>
    </div>
</div>

<div class="container mt-4 p-4 bg-white text-dark" style="min-height: 800px;">
    <!-- Kop Surat -->
    <div class="border-bottom border-dark pb-3 mb-4">
        <h2 class="fw-bold text-uppercase text-center">Laporan Inventaris</h2>
        <h5 class="text-center text-muted">Laboratorium RPL</h5>
        <p class="text-center small mb-0">Tanggal Cetak: <?= date('d F Y'); ?></p>
    </div>

    <!-- Ringkasan Stats -->
    <div class="row mb-4 text-dark">
        <div class="col text-center border p-3">
            <h6 class="text-muted text-uppercase">Total Stok</h6>
            <h3 class="fw-bold"><?= $total; ?></h3>
        </div>
        <div class="col text-center border p-3">
            <h6 class="text-muted text-uppercase">Baik</h6>
            <h3 class="fw-bold text-success"><?= $baik; ?></h3>
        </div>
        <div class="col text-center border p-3">
            <h6 class="text-muted text-uppercase">Rusak</h6>
            <h3 class="fw-bold text-danger"><?= $rusak; ?></h3>
        </div>
    </div>

    <!-- Tabel Data -->
    <table class="table table-bordered table-sm text-dark">
        <thead class="table-light">
            <tr>
                <th class="text-center">No</th>
                <th>Kode</th>
                <th>Nama Barang</th>
                <th>Kategori</th>
                <th class="text-center">Jml</th>
                <th>Kondisi</th>
                <th>Lokasi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while($row = $result->fetch_assoc()):
            ?>
            <tr>
                <td class="text-center"><?= $no++; ?></td>
                <td><?= $row['kode_barang']; ?></td>
                <td><?= $row['nama_barang']; ?></td>
                <td><?= $row['kategori']; ?></td>
                <td class="text-center"><?= $row['jumlah']; ?></td>
                <td><?= $row['kondisi']; ?></td>
                <td><?= $row['lokasi']; ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <!-- Tanda Tangan -->
    <div class="mt-5 pt-5 d-flex justify-content-between">
        <div class="text-center">
            <p class="mb-5">Mengetahui,<br>Ka. Lab RPL</p>
            <div style="border-top: 1px solid black; width: 150px; display: inline-block;"></div>
        </div>
        <div class="text-center">
            <p class="mb-5">Hormat Kami,<br>Petugas Inventaris</p>
            <div style="border-top: 1px solid black; width: 150px; display: inline-block;"></div>
        </div>
    </div>
</div>
</body>
</html>