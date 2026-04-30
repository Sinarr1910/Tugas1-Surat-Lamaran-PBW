<?php

<?php
session_start();
if (!isset($_SESSION['login_Un51k4'])) {
    header("Location: login.php?message=" . urlencode("Silahkan login terlebih dahulu!"));
    exit;
}

include 'koneksi_db.php';


$query = "
    SELECT
        p.ID AS Pesanan_ID,
        pl.Nama AS Nama_Pelanggan,
        p.Tanggal_Pesanan,
        p.Total_Harga,
        GROUP_CONCAT(b.Judul SEPARATOR ', ') AS Judul_Buku,
        SUM(dp.Kuantitas) AS Total_Item
    FROM pesanan p
    JOIN pelanggan pl ON p.Pelanggan_ID = pl.ID
    JOIN detail_pesanan dp ON p.ID = dp.Pesanan_ID
    JOIN buku b ON dp.Buku_ID = b.ID
    GROUP BY p.ID
    ORDER BY p.Tanggal_Pesanan DESC
";

$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Daftar Pesanan</title>
</head>
<body>

<?php include 'nav.php'; ?>

<div class="container mt-4">
    <h2>Riwayat Pesanan</h2>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID Pesanan</th>
                <th>Pelanggan</th>
                <th>Buku Dipesan</th>
                <th>Total Item</th>
                <th>Tanggal</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?= $row['Pesanan_ID'] ?></td>
                    <td><?= htmlspecialchars($row['Nama_Pelanggan']) ?></td>
                    <td><?= htmlspecialchars($row['Judul_Buku']) ?></td>
                    <td><?= $row['Total_Item'] ?></td>
                    <td><?= $row['Tanggal_Pesanan'] ?></td>
                    <td>Rp <?= number_format($row['Total_Harga'], 0, ',', '.') ?></td>
                </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="text-center text-muted">
                        Belum ada pesanan.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>