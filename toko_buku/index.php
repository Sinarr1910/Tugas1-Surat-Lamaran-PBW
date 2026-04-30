<?php include 'proses_index.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Buku</title>
</head>
<body>

    <?php include 'nav.php'; ?>

    <div class="container mt-4">
        <!-- Notifikasi status operasi -->
         <?php if (isset($_GET['status'])): ?>
            <?php if ($_GET['status'] == 'hapus_sukses'): ?>
                <div class="alert alert-success alert-dismissible fade show">
                    Buku berhasil dihapus!
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                <?php elseif ($_GET['status'] == 'edit_sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show">
                        Data buku berhasil diperbarui!
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    </div>
                    <?php elseif ($_GET['status'] == 'hapus_gagal'): ?>
                        <div class="alert alert-danger">Gagal menghapus buku.</div>
                        <?php endif; ?>
                        <?php endif; ?>

        <h2>Daftar Buku</h2>

        <!-- Form Pencarian -->
        <form method="get" class="row g-3 mb-4">
            <div class="col-md-5">
                <label for="judul" class="form-label">Cari Berdasarkan Judul</label>
                <input type="text" class="form-control" id="judul" name="judul"
                    placeholder="Masukkan judul buku"
                    value="<?php echo htmlspecialchars($search_judul); ?>">
            </div>
            <div class="col-md-3">
                <label for="tahun_terbit" class="form-label">Cari Berdasarkan Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                    placeholder="Contoh: 2023"
                    value="<?php echo htmlspecialchars($search_tahun); ?>">
            </div>
            <div class="col-md-2 align-self-end">
                <button type="submit" class="btn btn-primary w-100">Cari</button>
            </div>
            <div class="col-md-2 align-self-end">
                <a href="index.php" class="btn btn-secondary w-100">Reset</a>
            </div>
        </form>

        <!-- Tabel Daftar Buku -->
        <table class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Judul</th>
                    <th>Penulis</th>
                    <th>Tahun Terbit</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['ID']; ?></td>
                        <td><?php echo htmlspecialchars($row['Judul']); ?></td>
                        <td><?php echo htmlspecialchars($row['Penulis']); ?></td>
                        <td><?php echo $row['Tahun_Terbit']; ?></td>
                        <td>Rp <?php echo number_format($row['Harga'], 0, ',', '.'); ?></td>
                        <td><?php echo $row['Stok']; ?></td>
                        <td>
                            <a href="form_edit.php?id=<?php echo $row['ID']; ?>"
                               class="btn btn-sm btn-warning">Edit</a>
                            <a href="proses_hapus.php?id=<?php echo $row['ID']; ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Yakin ingin menghapus buku ini?')">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted">
                            Tidak ada data buku ditemukan.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>