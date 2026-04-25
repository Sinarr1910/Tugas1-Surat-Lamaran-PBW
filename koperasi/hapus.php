<?php

session_start();
require_once 'koneksi.php';


$id = isset($_GET['id']) && is_numeric($_GET['id']) ? (int)$_GET['id'] : 0;

if ($id <= 0) {
    $_SESSION['notif']      = 'ID transaksi tidak valid.';
    $_SESSION['notif_type'] = 'danger';
    header('Location: index.php');
    exit;
}


$stmt_check = $pdo->prepare("SELECT id FROM transaksi WHERE id = ?");
$stmt_check->execute([$id]);

if (!$stmt_check->fetch()) {
    $_SESSION['notif']      = "Transaksi dengan ID #{$id} tidak ditemukan.";
    $_SESSION['notif_type'] = 'warning';
    header('Location: index.php');
    exit;
}


try {
    $stmt = $pdo->prepare("DELETE FROM transaksi WHERE id = ?");
    $stmt->execute([$id]);

    $_SESSION['notif']      = "Transaksi ID #{$id} berhasil dihapus.";
    $_SESSION['notif_type'] = 'success';
} catch (PDOException $e) {
    $_SESSION['notif']      = 'Gagal menghapus transaksi: ' . $e->getMessage();
    $_SESSION['notif_type'] = 'danger';
}

header('Location: index.php');
exit;