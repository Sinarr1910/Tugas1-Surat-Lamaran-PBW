<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Nilai Mahasiswa </title>
    <style>
        body { 
            font-family: Arial, sans-serif; 
            margin: 20px; 
        }


        .tabel-hasil {
            border-collapse: collapse; 
            width: 350px; 
            font-family: "Times New Roman", Times, serif; 
            font-size: 18px; 
            margin-top: 20px; 
        }
        
        .tabel-hasil th, .tabel-hasil td {
            border: 1px solid black; 
            padding: 12px; 
            text-align: left; 
        }

        .tabel-hasil th {
            text-align: center; 
            font-size: 20px;
        }


        .tabel-hasil td:first-child {
            width: 40%;
        }
    </style>
</head>
<body>


    <a href="index.php">&laquo; Kembali ke Beranda</a>
    <hr>

    <h2>Form Input Nilai Mahasiswa</h2>
    
    
    <form method="post" action="">
        Nama: <input type="text" name="nama" required><br><br>
        Nilai: <input type="number" name="nilai" required><br><br>
        <input type="submit" name="proses" value="Proses">
    </form>

    <?php
    
    if (isset($_POST['proses'])) {
        
        $nama = $_POST['nama'];
        $nilai = $_POST['nilai'];
        
        $predikat = "";
        $status = "";

        
        if ($nilai >= 85 && $nilai <= 100) {
            $predikat = "A";
            $status = "Lulus";
        } elseif ($nilai >= 75 && $nilai <= 84) {
            $predikat = "B";
            $status = "Lulus";
        } elseif ($nilai >= 65 && $nilai <= 74) {
            $predikat = "C";
            $status = "Lulus";
        } elseif ($nilai >= 50 && $nilai <= 64) {
            $predikat = "D";
            $status = "Tidak Lulus";
        } elseif ($nilai >= 0 && $nilai <= 49) {
            $predikat = "E";
            $status = "Tidak Lulus";
        } else {
            $predikat = "Tidak valid";
            $status = "Tidak valid";
        }

        
        ?>
        
        <table class="tabel-hasil">
            <tr>
                <th colspan="2">Laporan Nilai Mahasiswa</th>
            </tr>
            <tr>
                <td>Nama</td>
                <td>: <?php echo htmlspecialchars($nama); ?></td>
            </tr>
            <tr>
                <td>Nilai</td>
                <td>: <?php echo htmlspecialchars($nilai); ?></td>
            </tr>
            <tr>
                <td>Predikat</td>
                <td>: <?php echo $predikat; ?></td>
            </tr>
            <tr>
                <td>Status</td>
                <td>: <?php echo $status; ?></td>
            </tr>
        </table>

        <?php
        
    }
    ?>

</body>
</html>