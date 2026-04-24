<?php

include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    $conn->begin_transaction();

    try {
        $pelanggan_id    = $_POST['pelanggan_id'];
        $tanggal_pesanan = date('Y-m-d'); 
        $total_harga     = 0;


        $stmt = $conn->prepare("INSERT INTO pesanan
                                (Tanggal_Pesanan, Pelanggan_ID, Total_Harga)
                                VALUES (?, ?, ?)");
        $stmt->bind_param("sid", $tanggal_pesanan, $pelanggan_id, $total_harga);
        $stmt->execute();


        $pesanan_id = $conn->insert_id;


        foreach ($_POST['buku'] as $buku) {
            $buku_id   = $buku['id'];
            $kuantitas = $buku['kuantitas'];


            $stmt = $conn->prepare("SELECT Harga, Stok FROM buku WHERE ID = ?");
            $stmt->bind_param("i", $buku_id);
            $stmt->execute();
            $stmt->bind_result($harga_per_satuan, $stok);
            $stmt->fetch();
            $stmt->close();


            if ($stok < $kuantitas) {
                throw new Exception("Stok buku tidak mencukupi. Stok tersisa: $stok");
            }


            $stmt = $conn->prepare("INSERT INTO detail_pesanan
                                    (Pesanan_ID, Buku_ID, Kuantitas, Harga_Per_Satuan)
                                    VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiid", $pesanan_id, $buku_id, $kuantitas, $harga_per_satuan);
            $stmt->execute();


            $total_harga += $kuantitas * $harga_per_satuan;


            $stmt = $conn->prepare("UPDATE buku SET Stok = Stok - ? WHERE ID = ?");
            $stmt->bind_param("ii", $kuantitas, $buku_id);
            $stmt->execute();
        }


        $stmt = $conn->prepare("UPDATE pesanan SET Total_Harga = ? WHERE ID = ?");
        $stmt->bind_param("di", $total_harga, $pesanan_id);
        $stmt->execute();


        $conn->commit();

        header("Location: transaksi.php?message=" .
               urlencode("Pesanan berhasil dibuat! Total: Rp " .
               number_format($total_harga, 0, ',', '.')));
        exit;

    } catch (Exception $e) {

 
        $conn->rollback();

        header("Location: transaksi.php?message=" .
               urlencode("Gagal: " . $e->getMessage()));
        exit;
    }

} else {
    header("Location: transaksi.php");
    exit;
}
?>