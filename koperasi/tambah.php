<?php

session_start();
require_once 'koneksi.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_mahasiswa    = trim($_POST['nama_mahasiswa']    ?? '');
    $nama_produk       = trim($_POST['nama_produk']       ?? '');
    $nama_pegawai      = trim($_POST['nama_pegawai']      ?? '');
    $jumlah_beli       = (int)($_POST['jumlah_beli']      ?? 0);
    $tanggal_transaksi = trim($_POST['tanggal_transaksi'] ?? '');


    if ($nama_mahasiswa && $nama_produk && $nama_pegawai && $jumlah_beli > 0 && $tanggal_transaksi) {
        try {
            $stmt = $pdo->prepare(
                "INSERT INTO transaksi
                    (nama_mahasiswa, nama_produk, nama_pegawai, jumlah_beli, tanggal_transaksi)
                 VALUES (?, ?, ?, ?, ?)"
            );
            $stmt->execute([$nama_mahasiswa, $nama_produk, $nama_pegawai, $jumlah_beli, $tanggal_transaksi]);

            $_SESSION['notif']      = 'Transaksi berhasil ditambahkan!';
            $_SESSION['notif_type'] = 'success';
        } catch (PDOException $e) {
            $_SESSION['notif']      = 'Gagal menambahkan transaksi: ' . $e->getMessage();
            $_SESSION['notif_type'] = 'danger';
        }
    } else {
        $_SESSION['notif']      = 'Semua field wajib diisi dengan benar!';
        $_SESSION['notif_type'] = 'warning';
    }

    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Transaksi — Koperasi</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body     { background-color: #f0f4f8; }
        .navbar  { background: linear-gradient(135deg, #1a3c6e, #2563eb); }
        .card    { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .form-control:focus, .form-select:focus { border-color: #2563eb; box-shadow: 0 0 0 .2rem rgba(37,99,235,.2); }
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
        <h5 class="fw-bold text-success mb-4">
            <i class="bi bi-plus-circle me-2"></i>Tambah Transaksi Baru
        </h5>

        <form method="POST" action="tambah.php" novalidate>
            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Mahasiswa</label>
                <input type="text" name="nama_mahasiswa" class="form-control"
                       placeholder="Contoh: Budi Santoso" required maxlength="100">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Produk Barang</label>
                <input type="text" name="nama_produk" class="form-control"
                       placeholder="Contoh: Buku Tulis A4" required maxlength="150">
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Nama Pegawai</label>
                <select name="nama_pegawai" class="form-select" required>
                    <option value="" disabled selected>— Pilih Pegawai —</option>
                    <option value="Siti Rahma">Siti Rahma</option>
                    <option value="Ahmad Fauzi">Ahmad Fauzi</option>
                    <option value="Rudi Hartono">Rudi Hartono</option>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label fw-semibold">Jumlah Beli</label>
                <input type="number" name="jumlah_beli" class="form-control"
                       placeholder="Contoh: 3" min="1" max="9999" required>
            </div>

            <div class="mb-4">
                <label class="form-label fw-semibold">Tanggal Transaksi</label>
                <input type="date" name="tanggal_transaksi" class="form-control"
                       value="<?= date('Y-m-d') ?>" required>
            </div>

            <div class="d-flex gap-2">
                <button type="submit" class="btn btn-success px-4">
                    <i class="bi bi-save me-1"></i>Simpan Transaksi
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