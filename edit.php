<?php 
include 'header.php'; 
include 'koneksi.php';

$id = $_GET['id'];
$user_id = $_SESSION['user_id'];

// Cek kepemilikan data
$query = "SELECT * FROM barang WHERE id = '$id' AND user_id = '$user_id'";
$result = $connect->query($query);
$row = $result->fetch_assoc();

if(!$row) {
    echo "<script>window.location='index.php';</script>";
    exit;
}
?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card glass-panel animate__animated animate__fadeInUp">
                <div class="card-header bg-transparent border-bottom border-secondary py-3">
                    <h4 class="mb-0 text-warning"><i class="bi bi-pencil-square"></i> EDIT BARANG</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="proses_edit.php">
                        <input type="hidden" name="id" value="<?= $row['id']; ?>">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white-50">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control form-control-dark" value="<?= htmlspecialchars($row['kode_barang']); ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white-50">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control form-control-dark" value="<?= htmlspecialchars($row['nama_barang']); ?>" required>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label text-white-50">Kategori</label>
                                <select name="kategori" class="form-select form-control-dark" required>
                                    <option value="Hardware" <?= ($row['kategori']=='Hardware')?'selected':''; ?>>Hardware</option>
                                    <option value="Software" <?= ($row['kategori']=='Software')?'selected':''; ?>>Software</option>
                                    <option value="Peripheral" <?= ($row['kategori']=='Peripheral')?'selected':''; ?>>Peripheral</option>
                                    <option value="Furniture" <?= ($row['kategori']=='Furniture')?'selected':''; ?>>Furniture</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white-50">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control form-control-dark" min="1" value="<?= $row['jumlah']; ?>" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white-50">Kondisi</label>
                                <select name="kondisi" class="form-select form-control-dark" required>
                                    <option value="Baik" <?= ($row['kondisi']=='Baik')?'selected':''; ?>>Baik</option>
                                    <option value="Rusak" <?= ($row['kondisi']=='Rusak')?'selected':''; ?>>Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-white-50">Lokasi Penyimpanan</label>
                                <input type="text" name="lokasi" class="form-control form-control-dark" value="<?= htmlspecialchars($row['lokasi']); ?>" required>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-cyber w-100"><i class="bi bi-save"></i> UPDATE DATA</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>