<?php

include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

   
    $id           = $_POST['id'];
    $judul        = $_POST['judul'];
    $penulis      = $_POST['penulis'];
    $tahun        = $_POST['tahun_terbit'];
    $harga        = $_POST['harga'];
    $stok         = $_POST['stok'];


    $stmt = $conn->prepare("UPDATE buku
                            SET Judul=?, Penulis=?, Tahun_Terbit=?, Harga=?, Stok=?
                            WHERE ID=?");


    $stmt->bind_param("ssiidi", $judul, $penulis, $tahun, $harga, $stok, $id);

    if ($stmt->execute()) {
        header("Location: index.php?status=edit_sukses");
    } else {
        header("Location: index.php?status=edit_gagal");
    }

    $stmt->close();
    $conn->close();

} else {
    header("Location: index.php");
}

exit;

?>