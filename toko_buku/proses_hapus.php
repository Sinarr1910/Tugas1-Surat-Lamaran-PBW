<?php

include 'koneksi_db.php';


if (isset($_GET['id']) && is_numeric($_GET['id'])) {

    $id = $_GET['id'];


    $stmt = $conn->prepare("DELETE FROM buku WHERE ID = ?");
    $stmt->bind_param("i", $id); 

    if ($stmt->execute()) {

        if ($stmt->affected_rows > 0) {
            header("Location: index.php?status=hapus_sukses");
        } else {

            header("Location: index.php?status=tidak_ditemukan");
        }
    } else {
        header("Location: index.php?status=hapus_gagal");
    }

    $stmt->close();

} else {

    header("Location: index.php");
}

$conn->close();
exit;

?>