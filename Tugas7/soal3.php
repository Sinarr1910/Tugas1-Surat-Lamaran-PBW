<?php include "menu.php"; ?>

<h3>Masukan 5 Nama Hewan</h3>

<form method="post">
    <?php
    for($i = 1; $i <= 5; $i++){
        echo "Hewan ke-$i: <input type='text' name='hewan[]'><br>";
    }
    ?>
    <br>
    <button type="submit" name="simpan">Tampilkan Hewan</button>
</form>

<?php
if(isset($_POST['simpan'])){
    $hewan = $_POST['hewan'];

    $no = 1;
    foreach($hewan as $h){
        echo "No.$no " . $h . "<br>";
        $no++;
    }
}
?>
