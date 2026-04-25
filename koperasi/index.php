<?php

require_once 'koneksi.php';


$per_page = 5;
$page     = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset   = ($page - 1) * $per_page;


$search = isset($_GET['search']) ? trim($_GET['search']) : '';


if ($search !== '') {
    $keyword = '%' . $search . '%';


    $stmt_count = $pdo->prepare(
        "SELECT COUNT(*) FROM transaksi
         WHERE nama_mahasiswa LIKE ? OR nama_produk LIKE ?"
    );
    $stmt_count->execute([$keyword, $keyword]);
    $total_rows = $stmt_count->fetchColumn();


    $stmt = $pdo->prepare(
        "SELECT * FROM transaksi
         WHERE nama_mahasiswa LIKE ? OR nama_produk LIKE ?
         ORDER BY id ASC
         LIMIT ? OFFSET ?"
    );
    $stmt->execute([$keyword, $keyword, $per_page, $offset]);
} else {
    $stmt_count = $pdo->prepare("SELECT COUNT(*) FROM transaksi");
    $stmt_count->execute();
    $total_rows = $stmt_count->fetchColumn();

    $stmt = $pdo->prepare(
        "SELECT * FROM transaksi
         ORDER BY id ASC
         LIMIT ? OFFSET ?"
    );
    $stmt->execute([$per_page, $offset]);
}

$transaksi  = $stmt->fetchAll();
$total_pages = ceil($total_rows / $per_page);


session_start();
$notif       = $_SESSION['notif']       ?? null;
$notif_type  = $_SESSION['notif_type']  ?? 'success';
unset($_SESSION['notif'], $_SESSION['notif_type']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Transaksi Koperasi</title>
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body        { background-color: #f0f4f8; }
        .navbar     { background: linear-gradient(135deg, #1a3c6e, #2563eb); }
        .card       { border: none; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,.08); }
        .table thead{ background: #1a3c6e; color: #fff; }
        .badge-id   { background: #e8f0fe; color: #1a3c6e; font-weight: 700;
                      padding: 4px 10px; border-radius: 20px; font-size:.8rem; }
        .btn-sm     { border-radius: 6px; }
        .page-link  { color: #2563eb; }
        .page-item.active .page-link { background:#2563eb; border-color:#2563eb; }
        .search-box { max-width: 380px; }
    </style>
</head>
<body>

<!-- Navbar -->
<nav class="navbar navbar-dark py-3 mb-4">
    <div class="container">
        <a class="navbar-brand fw-bold fs-5" href="index.php">
            <i class="bi bi-shop me-2"></i>Koperasi Mahasiswa Universitas Singaperbangsa Karawang
        </a>
        <span class="text-white-50 small"><i class="bi bi-calendar3 me-1"></i><?= date('d M Y') ?></span>
    </div>
</nav>

<div class="container pb-5">

    <!-- Notifikasi -->
    <?php if ($notif): ?>
    <div class="alert alert-<?= htmlspecialchars($notif_type) ?> alert-dismissible fade show" role="alert">
        <i class="bi bi-<?= $notif_type === 'success' ? 'check-circle' : 'exclamation-triangle' ?> me-2"></i>
        <?= htmlspecialchars($notif) ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    </div>
    <?php endif; ?>

    <!-- Card Utama -->
    <div class="card p-4">
        <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
            <h5 class="mb-0 fw-bold text-primary">
                <i class="bi bi-table me-2"></i>Data Transaksi
                <span class="badge bg-secondary ms-1"><?= $total_rows ?> data</span>
            </h5>
            <a href="tambah.php" class="btn btn-success btn-sm px-3">
                <i class="bi bi-plus-circle me-1"></i>Tambahkan Transaksi
            </a>
        </div>

        <!-- Form Pencarian -->
        <form method="GET" action="index.php" class="mb-3">
            <div class="input-group search-box">
                <span class="input-group-text bg-white"><i class="bi bi-search text-muted"></i></span>
                <input type="text" name="search" class="form-control"
                       placeholder="Cari mahasiswa atau produk..."
                       value="<?= htmlspecialchars($search) ?>">
                <button class="btn btn-primary" type="submit">Cari</button>
                <?php if ($search): ?>
                <a href="index.php" class="btn btn-outline-secondary">Reset</a>
                <?php endif; ?>
            </div>
        </form>

        <!-- Tabel Data -->
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width:60px">#</th>
                        <th><i class="bi bi-person me-1"></i>Mahasiswa</th>
                        <th><i class="bi bi-box-seam me-1"></i>Produk</th>
                        <th><i class="bi bi-person-badge me-1"></i>Pegawai</th>
                        <th class="text-center">Jumlah</th>
                        <th><i class="bi bi-calendar me-1"></i>Tanggal</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php if (count($transaksi) > 0): ?>
                    <?php foreach ($transaksi as $row): ?>
                    <tr>
                        <td class="text-center">
                            <span class="badge-id"><?= $row['id'] ?></span>
                        </td>
                        <td><?= htmlspecialchars($row['nama_mahasiswa']) ?></td>
                        <td><?= htmlspecialchars($row['nama_produk']) ?></td>
                        <td><?= htmlspecialchars($row['nama_pegawai']) ?></td>
                        <td class="text-center">
                            <span class="badge bg-info text-dark"><?= $row['jumlah_beli'] ?></span>
                        </td>
                        <td><?= date('d M Y', strtotime($row['tanggal_transaksi'])) ?></td>
                        <td class="text-center">
                            <a href="edit.php?id=<?= $row['id'] ?>"
                               class="btn btn-warning btn-sm me-1" title="Edit">
                                <i class="bi bi-pencil-fill"></i>
                            </a>
                            <a href="hapus.php?id=<?= $row['id'] ?>"
                               class="btn btn-danger btn-sm"
                               title="Hapus"
                               onclick="return confirm('Yakin ingin menghapus transaksi ini?')">
                                <i class="bi bi-trash-fill"></i>
                            </a>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">
                            <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                            <?= $search ? 'Tidak ada hasil untuk pencarian "<strong>' . htmlspecialchars($search) . '</strong>"' : 'Belum ada data transaksi.' ?>
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <?php if ($total_pages > 1): ?>
        <nav class="mt-3 d-flex justify-content-between align-items-center">
            <small class="text-muted">
                Halaman <?= $page ?> dari <?= $total_pages ?>
            </small>
            <ul class="pagination pagination-sm mb-0">
                <li class="page-item <?= $page <= 1 ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page - 1 ?>&search=<?= urlencode($search) ?>">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                <li class="page-item <?= $i === $page ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>&search=<?= urlencode($search) ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>
                <li class="page-item <?= $page >= $total_pages ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= $page + 1 ?>&search=<?= urlencode($search) ?>">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>