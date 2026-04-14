<head>
    <title>Menu :</title>
</head>

<?php include "menu.php"; ?>

<h3>Ternary Operator - Genap atau Ganjil</h3>

<form method="post">
    Masukkan angka : <input type="number" name="angka">
    <button type="submit">Cek Hasil</button>
</form>

<?php
if(isset($_POST['angka'])){
    $angka = $_POST['angka'];

    $hasil = ($angka % 2 == 0) ? "Genap" : "Ganjil";

    echo $hasil;
}
?>