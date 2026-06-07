<?php include 'header.php'; ?>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card glass-panel animate__animated animate__fadeInUp">
                <div class="card-header bg-transparent border-bottom border-secondary py-3">
                    <h4 class="mb-0 text-neon-blue"><i class="bi bi-plus-circle"></i> TAMBAH BARANG</h4>
                </div>
                <div class="card-body">
                    <?php
                    if(isset($_SESSION['msg_success'])) {
                        echo '<div class="alert alert-success bg-transparent border-success text-success">' . $_SESSION['msg_success'] . '</div>';
                        unset($_SESSION['msg_success']);
                    }
                    ?>
                    <!-- GANTI action BUKAN proses_tambah.php tapi proses_simpat.php ( typo?) - Pastikan nama file sama persis! -->
                    <form method="POST" action="proses_tambah.php">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label text-white-50">Kode Barang</label>
                                <input type="text" name="kode_barang" class="form-control form-control-dark" placeholder="BRG-001" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label text-white-50">Nama Barang</label>
                                <input type="text" name="nama_barang" class="form-control form-control-dark" placeholder="Nama item..." required>
                            </div>
                            
                            <div class="col-md-4">
                                <label class="form-label text-white-50">Kategori</label>
                                <select name="kategori" class="form-select form-control-dark" required>
                                    <option value="">Pilih...</option>
                                    <option value="Hardware">Hardware</option>
                                    <option value="Software">Software</option>
                                    <option value="Peripheral">Peripheral</option>
                                    <option value="Furniture">Furniture</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white-50">Jumlah</label>
                                <input type="number" name="jumlah" class="form-control form-control-dark" min="1" value="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label text-white-50">Kondisi</label>
                                <select name="kondisi" class="form-select form-control-dark" required>
                                    <option value="Baik">Baik</option>
                                    <option value="Rusak">Rusak</option>
                                </select>
                            </div>

                            <div class="col-md-12">
                                <label class="form-label text-white-50">Lokasi Penyimpanan</label>
                                <select name="lokasi" class="form-select form-control-dark" required>
                                    <option value="">Pilih Lokasi...</option>
                                    <option value="Rak 1">Rak 1</option>
                                    <option value="Rak 2">Rak 2</option>
                                    <option value="Rak 3">Rak 3</option>
                                    <option value="Rak 4">Rak 4</option>
                                    <option value="Ruang Lab RPL">Ruang Lab RPL</option>
                                    <option value="Ruang Kelas 1">Ruang Kelas 1</option>
                                    <option value="Ruang Kelas 2">Ruang Kelas 2</option>
                                    <option value="Gudang">Gudang</option>
                                </select>
                            </div>

                            <div class="col-12 mt-4">
                                <button type="submit" class="btn btn-cyber w-100"><i class="bi bi-save"></i> SIMPAN DATA</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>