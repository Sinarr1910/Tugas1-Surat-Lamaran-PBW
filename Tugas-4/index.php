<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tugas 4</title>
    <style>

        .kotak-hasil {
            border: 2px solid black;
            padding: 20px;
            width: 450px;
            font-family: "Times New Roman", Times, serif;
            margin: 20px;
        }
        .judul {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }
        .garis {
            border: 0;
            border-top: 1.5px solid black;
            margin-bottom: 15px;
        }
        .teks {
            font-size: 16px;
            line-height: 1.5; 
        }
    </style>
</head>
<body>

<?php

define("PAJAK", 0.10); 


$barang =[
    "nama" => "Keyboard",
    "harga" => 150000
];


$jumlah_beli = 2;


$total_sebelum_pajak = $barang["harga"] * $jumlah_beli;


$nominal_pajak = $total_sebelum_pajak * PAJAK;


$total_bayar = $total_sebelum_pajak + $nominal_pajak;
?>


<div class="kotak-hasil">
    <div class="judul">Perhitungan Total Pembelian (Dengan Array)</div>
    <hr class="garis">
    
    <div class="teks">
        Nama Barang: <?php echo $barang["nama"]; ?><br>

        Harga Satuan: Rp <?php echo number_format($barang["harga"], 0, ',', '.'); ?><br>
        Jumlah Beli: <?php echo $jumlah_beli; ?><br>
        Total Harga (Sebelum Pajak): Rp <?php echo number_format($total_sebelum_pajak, 0, ',', '.'); ?><br>
        Pajak (10%): Rp <?php echo number_format($nominal_pajak, 0, ',', '.'); ?><br>
        <b>Total Bayar: Rp <?php echo number_format($total_bayar, 0, ',', '.'); ?></b>
    </div>
</div>

</body>
</html>