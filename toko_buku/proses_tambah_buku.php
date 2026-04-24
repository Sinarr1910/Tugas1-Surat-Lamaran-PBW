<?php

include 'koneksi_db.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  
    $judul        = $_POST['judul'];
    $penulis      = $_POST['penulis'];
    $tahun_terbit = $_POST['tahun_terbit'];
    $harga        = $_POST['harga'];
    $stok         = $_POST['stok'];


    $stmt = $conn->prepare("INSERT INTO buku (Judul, Penulis, Tahun_Terbit, Harga, Stok)
                            VALUES (?, ?, ?, ?, ?)");


    $stmt->bind_param("ssiid", $judul, $penulis, $tahun_terbit, $harga, $stok);

    if ($stmt->execute()) {

        header("Location: tambah_buku.php?status=sukses");
    } else {

        header("Location: tambah_buku.php?status=gagal");
    }

    $stmt->close();
    $conn->close();

} else {

    header("Location: tambah_buku.php");
}

exit;

?>