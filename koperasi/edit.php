<?php

session_start();
require_once 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mahasiswa    = trim($_POST['nama_mahasiswa']    ?? '');
    $nama_produk       = trim($_POST['nama_produk']       ?? '');
    $nama_pegawai      = trim($_POST['nama_pegawai']      ?? '');
    $jumlah_beli       = (int)($_POST['jumlah_beli']      ?? 0);
    $tanggal_transaksi = trim($_POST['tanggal_transaksi'] ?? '');
    $post_id           = (int)($_POST['id']               ?? 0);

    if ($nama_mahasiswa && $nama_produk && $nama_pegawai && $jumlah_beli > 0 && $tanggal_transaksi && $post_id > 0) {
        try {
            $stmt = $pdo->prepare(
                "UPDATE transaksi
                 SET nama_mahasiswa    = ?,
                     nama_produk       = ?,
                     nama_pegawai      = ?,
                     jumlah_beli       = ?,
                     tanggal_transaksi = ?
                 WHERE id = ?"
            );
            $stmt->execute([$nama_mahasiswa, $nama_produk, $nama_pegawai, $jumlah_beli, $tanggal_transaksi, $post_id]);

            $_SESSION['notif']      = "Transaksi ID #{$post_id} berhasil diperbarui!";
            $_SESSION['notif_type'] = 'success';
        } catch (PDOException $e) {
            $_SESSION['notif']      = 'Gagal memperbarui transaksi: ' . $e->getMessage();
            $_SESSION['notif_type'] = 'danger';
        }
    } else {
        $_SESSION['notif']      = 'Semua field wajib diisi dengan benar!';
        $_SESSION['notif_type'] = 'warning';
    }

    header('Location: index.php');
    exit;
}


$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['notif']      = 'ID transaksi tidak valid.';
    $_SESSION['notif_type'] = 'danger';
    header('Location: index.php');
    exit;
}


$stmt = $pdo->prepare("SELECT * FROM transaksi WHERE id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    $_SESSION['notif']      = "Transaksi dengan ID #{$id} tidak ditemukan.";
    $_SESSION['notif_type'] = 'warning';
    header('Location: index.php');
    exit;
}

$pegawai_list = ['Siti Rahma', 'Ahmad Fauzi', 'Rudi Hartono'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Transaksi #<?= $id ?> — Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body     { background-color: #f0f4f8; }
        .navbar  { background: linear-gradient(135deg, #1a3c6e, #2563eb); }
        .card    { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .form-control:focus, .form-select:focus { border-color: #f59e0b; box-shadow: 0 0 0 .2rem rgba(245,158,11,.2); }
        .badge-id { background:#fef3c7; color:#92400e; font-weight:700;
                    padding:4px 12px; border-radius:20px; }
    </style>
</head>
<body>

<nav class="navbar navbar-dark py-3 mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold" href="index.php">
            <i class="bi bi-shop me-2"></i>Koperasi Mahasiswa Universitas Singaperbangsa Karawang
        </a>
    </div>
</nav>

<div class="container pb-5" style="max-width:640px">
    <div class="card p-4">
        <h5 class="fw-bold text-warning mb-1">
            <i class="bi bi-pencil-square me-2"></i>Edit Transaksi
        </h5>
        <p class="text-muted small mb-4">
            Mengubah data untuk transaksi <span class="badge-id">ID #<?= $id ?></span>
        </p>

        <form method="POST" action="edit.php" novalidate>
            <!-- Hidden field untuk kirim ID -->
            <input type="hidden" name="id" value="<?= $id ?>">

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control"
                       value="<?= htmlspecialchars($data['nama_mahasiswa']) ?>"
                       required maxlength="100">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk Barang</label>
                <input type="text" name="nama_produk" class="form-control"
                       value="<?= htmlspecialchars($data['nama_produk']) ?>"
                       required maxlength="150">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pegawai</label>
                <select name="nama_pegawai" class="form-select" required>
                    <option value="" disabled>— Pilih Pegawai —</option>
                    <?php foreach ($pegawai_list as $p): ?>
                    <option value="<?= $p ?>" <?= $data['nama_pegawai'] === $p ? 'selected' : '' ?>>
                        <?= $p ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Jumlah Beli</label>
                <input type="number" name="jumlah_beli" class="form-control"
                       value="<?= (int)$data['jumlah_beli'] ?>"
                       min="1" max="9999" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" class="form-control"
                       value="<?= htmlspecialchars($data['tanggal_transaksi']) ?>" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-warning px-4 text-white">
                    <i class="bi bi-check-circle me-1"></i>Simpan Perubahan
                </button>
                <a href="index.php" class="btn btn-outline-secondary">
                    <i class="bi bi-arrow-left me-1"></i>Batal
                </a>
            </div>
        </form>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>