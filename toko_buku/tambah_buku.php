<?php

session_start();
if (!isset($_SESSION['login_Un51k4'])) {
    header("Location: login.php?message=" . urlencode("Silahkan login terlebih dahulu!"));
    exit;
}
?>

<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Tambah Buku</title>
</head>
<body>

    <div class="container mt-4">
        <h2>Tambah Buku Baru</h2>

        <!-- Pesan sukses/gagal dari proses sebelumnya -->
        <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
            <div class="alert alert-success">Buku berhasil ditambahkan!</div>
        <?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
            <div class="alert alert-danger">Gagal menambahkan buku silahkan coba lagi.</div>
        <?php endif; ?>

        <form method="post" action="proses_tambah_buku.php">
            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <input type="text" class="form-control" id="judul"
                       name="judul" placeholder="Masukkan judul buku" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis"
                       name="penulis" placeholder="Masukkan nama penulis" required>
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit"
                       name="tahun_terbit" placeholder="Contoh: 2024"
                       min="1900" max="2100" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga"
                       name="harga" placeholder="Contoh: 85000"
                       step="500" min="0" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok"
                       name="stok" placeholder="Jumlah stok tersedia"
                       min="0" required>
            </div>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
            <button type="submit" class="btn btn-primary">Tambah Buku</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>