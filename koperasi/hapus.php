<?php

session_start();
if (!isset($_SESSION['login_Un51k4'])) {
    header("Location: login.php?message=" . urlencode("Silahkan login terlebih dahulu"));
    exit;
}

include 'koneksi.php';

$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['notif']      = 'ID transaksi tidak valid.';
    $_SESSION['notif_type'] = 'danger';
    header('Location: index.php');
    exit;
}


$stmt_check = $conn->prepare("SELECT id FROM transaksi WHERE id = ?");
$stmt_check->bind_param("i", $id);
$stmt_check->execute();
$stmt_check->store_result();

if ($stmt_check->num_rows === 0) {
    $_SESSION['notif']      = "Transaksi ID No {$id} tidak ditemukan.";
    $_SESSION['notif_type'] = 'warning';
    $stmt_check->close();
    header('Location: index.php');
    exit;
}
$stmt_check->close();


$stmt = $conn->prepare("DELETE FROM transaksi WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    $_SESSION['notif']      = "Transaksi ID No {$id} berhasil dihapus.";
    $_SESSION['notif_type'] = 'success';
} else {
    $_SESSION['notif']      = 'Gagal menghapus transaksi.';
    $_SESSION['notif_type'] = 'danger';
}
$stmt->close();

header('Location: index.php');
exit;