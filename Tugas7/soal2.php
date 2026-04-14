<head>
    <title>Menu :</title>
</head>

<?php include "menu.php"; ?>

<h3>For Loop - Bilangan Genap</h3>

<form method="post">
    Dari: <input type="number" name="awal" min="1" max="100">
    Sampai: <input type="number" name="akhir" min="1" max="100">
    <button type="submit">Tampilkan Bilangan</button>
</form>

<?php
if(isset($_POST['awal']) && isset($_POST['akhir'])){
    $awal = $_POST['awal'];
    $akhir = $_POST['akhir'];

    for($i = $awal; $i <= $akhir; $i++){
        if($i % 2 == 0){
            echo $i . "<br>";
        }
    }
}
?>