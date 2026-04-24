<?php
include 'koneksi_db.php';


$pelanggan_list = [];
$res_pelanggan  = $conn->query("SELECT ID, Nama FROM pelanggan ORDER BY Nama ASC");
if ($res_pelanggan && $res_pelanggan->num_rows > 0) {
    while ($row = $res_pelanggan->fetch_assoc()) {
        $pelanggan_list[] = $row;
    }
}


$buku_list = [];
$res_buku  = $conn->query("SELECT ID, Judul, Harga, Stok FROM buku WHERE Stok > 0 ORDER BY Judul ASC");
if ($res_buku && $res_buku->num_rows > 0) {
    while ($row = $res_buku->fetch_assoc()) {
        $buku_list[] = $row;
    }
}
?>

<?php include 'nav.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Buat Pesanan</title>
</head>
<body>

<div class="container mt-4">
    <h2>Buat Pesanan Baru</h2>

    <?php if (isset($_GET['message'])): ?>
        <div class="alert alert-info alert-dismissible fade show">
            <?= htmlspecialchars($_GET['message']) ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    <?php endif; ?>

    <?php if (empty($pelanggan_list)): ?>
        <!-- Tampilkan peringatan jika tidak ada pelanggan -->
        <div class="alert alert-warning">
            Belum ada data pelanggan. Silakan tambah pelanggan dulu ke database.
        </div>
    <?php endif; ?>

    <?php if (empty($buku_list)): ?>
        <div class="alert alert-warning">
           Tidak ada buku dengan stok tersedia.
        </div>
    <?php endif; ?>

    <form method="post" action="proses_transaksi.php">

        <!-- Pilih Pelanggan -->
        <div class="mb-3">
            <label for="pelanggan_id" class="form-label fw-bold">Pilih Pelanggan</label>
            <select class="form-select" name="pelanggan_id" id="pelanggan_id" required>
                <option value="">-- Pilih Pelanggan --</option>
                <?php foreach ($pelanggan_list as $pelanggan): ?>
                    <option value="<?= $pelanggan['ID'] ?>">
                        <?= htmlspecialchars($pelanggan['Nama']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            <?php if (empty($pelanggan_list)): ?>
                <small class="text-danger">Tidak ada pelanggan tersedia.</small>
            <?php endif; ?>
        </div>

        <!-- Pilih Buku -->
        <div class="card p-3 mb-3">
            <h5 class="mb-3">Pilih Buku</h5>

            <div class="mb-3">
                <label class="form-label fw-bold">Buku</label>
                <select class="form-select" name="buku[1][id]" required>
                    <option value="">-- Pilih Buku --</option>
                    <?php foreach ($buku_list as $buku): ?>
                        <option value="<?= $buku['ID'] ?>">
                            <?= htmlspecialchars($buku['Judul']) ?>
                            (Stok: <?= $buku['Stok'] ?> |
                            Rp <?= number_format($buku['Harga'], 0, ',', '.') ?>)
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (empty($buku_list)): ?>
                    <small class="text-danger">Tidak ada buku dengan stok tersedia.</small>
                <?php endif; ?>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Jumlah</label>
                <input type="number" class="form-control" name="buku[1][kuantitas]"
                       min="1" placeholder="Masukkan jumlah" required>
            </div>
        </div>

        <a href="index.php" class="btn btn-secondary">Kembali</a>
        <button type="submit" class="btn btn-primary"
                <?= (empty($pelanggan_list) || empty($buku_list)) ? 'disabled' : '' ?>>
            Buat Pesanan
        </button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>