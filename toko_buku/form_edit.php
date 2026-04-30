<?php

session_start();
if (!isset($_SESSION['login_Un51k4'])) {
    header("Location: login.php?message=" . urlencode("Silahkan login terlebih dahulu!"));
    exit;
}

include 'koneksi_db.php';


$id = $_GET['id'] ?? 0;


if (!is_numeric($id) || $id <= 0) {
    header("Location: index.php");
    exit;
}


$stmt = $conn->prepare("SELECT * FROM buku WHERE ID = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row    = $result->fetch_assoc();


if (!$row) {
    header("Location: index.php");
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
    <title>Edit Buku</title>
</head>
<body>

    <div class="container mt-4">
        <h2>Edit Data Buku</h2>

        <form method="post" action="proses_edit.php">

            <!-- Field tersembunyi untuk menyimpan ID buku yang sedang diedit -->
            <!-- ID tidak ditampilkan ke user, tapi tetap dikirim saat form disubmit -->
            <input type="hidden" name="id" value="<?= $row['ID'] ?>">

            <div class="mb-3">
                <label for="judul" class="form-label">Judul Buku</label>
                <!-- value diisi dari data $row yang diambil dari DB -->
                <input type="text" class="form-control" id="judul" name="judul"
                       value="<?= htmlspecialchars($row['Judul']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" class="form-control" id="penulis" name="penulis"
                       value="<?= htmlspecialchars($row['Penulis']) ?>" required>
            </div>
            <div class="mb-3">
                <label for="tahun_terbit" class="form-label">Tahun Terbit</label>
                <input type="number" class="form-control" id="tahun_terbit" name="tahun_terbit"
                       value="<?= $row['Tahun_Terbit'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="harga" class="form-label">Harga (Rp)</label>
                <input type="number" class="form-control" id="harga" name="harga"
                       value="<?= $row['Harga'] ?>" step="500" min="0" required>
            </div>
            <div class="mb-3">
                <label for="stok" class="form-label">Stok</label>
                <input type="number" class="form-control" id="stok" name="stok"
                       value="<?= $row['Stok'] ?>" min="0" required>
            </div>

            <a href="index.php" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-success">Simpan Perubahan</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>