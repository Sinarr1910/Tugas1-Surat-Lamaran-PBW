<head>
    <title>Menu :</title>
</head>

<?php include "menu.php"; ?>

<h3>Switch Case - Jenis Kendaraan</h3>

<form method="post">
    Jumlah roda : <input type="number" name="roda">
    <button type="submit">Cek Kendaraan</button>
</form>

<?php
if(isset($_POST['roda'])){
    $roda = $_POST['roda'];

    switch($roda){
        case 1: 
            echo "Ryno Motors";
            break;
        case 2:
            echo "Sepeda Listrik";
            break;
        case 3:
            echo "Bemo";
            break;
        case 4:
            echo "Mobil Pick-Up";
            break;
        case 6:
            echo "Truk Fuso";
            break; 
        default:
            echo "Tidak ditemukan";
    }
}
?>