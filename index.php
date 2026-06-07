<?php include 'header.php'; ?>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeInUp">
        <h4 class="text-white fw-bold"><i class="bi bi-box-seam text-neon-blue"></i> DATA INVENTARIS</h4>
        <a href="tambah.php" class="btn btn-cyber"><i class="bi bi-plus-lg"></i> Tambah</a>
    </div>

    <!-- Filter/Search Form -->
    <div class="card glass-panel mb-4">
        <div class="card-body">
            <form method="GET" class="row g-3">
                <div class="col-md-6">
                    <input type="text" name="q" class="form-control form-control-dark" placeholder="Cari nama atau kode barang..." value="<?= isset($_GET['q']) ? htmlspecialchars($_GET['q']) : '' ?>">
                </div>
                <div class="col-md-3">
                    <select name="kategori" class="form-select form-control-dark">
                        <option value="">Semua Kategori</option>
                        <option value="Hardware">Hardware</option>
                        <option value="Software">Software</option>
                        <option value="Peripheral">Peripheral</option>
                        <option value="Furniture">Furniture</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-cyber w-100"><i class="bi bi-search"></i> Cari</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table Data -->
    <div class="card glass-panel animate__animated animate__fadeInUp">
        <div class="table-responsive">
            <table class="table table-dark-cyber table-hover mb-0">
                <thead>
                    <tr>
                        <th class="text-center">No</th>
                        <th>Kode</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th class="text-center">Jml</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $user_id = $_SESSION['user_id'];
                    
                    // Query with Filter
                    $where = "WHERE user_id = '$user_id'";
                    if(isset($_GET['q']) && $_GET['q']!=''){
                        $q = $connect->real_escape_string($_GET['q']);
                        $where .= " AND (nama_barang LIKE '%$q%' OR kode_barang LIKE '%$q%')";
                    }
                    if(isset($_GET['kategori']) && $_GET['kategori']!=''){
                        $kat = $connect->real_escape_string($_GET['kategori']);
                        $where .= " AND kategori = '$kat'";
                    }

                    $query = "SELECT * FROM barang $where ORDER BY id DESC";
                    $result = $connect->query($query);
                    $no = 1;

                    if($result->num_rows > 0):
                        while($row = $result->fetch_assoc()):
                    ?>
                    <tr>
                        <td class="text-center"><?= $no++; ?></td>
                        <td class="text-white-50"><?= htmlspecialchars($row['kode_barang']); ?></td>
                        <td class="fw-bold text-white"><?= htmlspecialchars($row['nama_barang']); ?></td>
                        <td><span class="badge bg-secondary"><?= htmlspecialchars($row['kategori']); ?></span></td>
                        <td class="text-center"><?= $row['jumlah']; ?></td>
                        <td class="text-center">
                            <?php if($row['kondisi'] == 'Baik'): ?>
                                <span class="badge bg-success">Baik</span>
                            <?php else: ?>
                                <span class="badge bg-danger">Rusak</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-white-50"><i class="bi bi-geo-alt"></i> <?= htmlspecialchars($row['lokasi']); ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-warning"><i class="bi bi-pencil-square"></i></a>
                            <a href="hapus.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Yakin hapus?')"><i class="bi bi-trash"></i></a>
                        </td>
                    </tr>
                    <?php 
                        endwhile;
                    else:
                    ?>
                    <tr>
                        <td colspan="8" class="text-center py-5 text-muted">Data tidak ditemukan.</td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>