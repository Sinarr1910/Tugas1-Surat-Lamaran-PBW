<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran UKT Mahasiswa</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7f6;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 600px;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            margin: auto;
        }
        h2 {
            text-align: center;
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input[type="text"], input[type="number"] {
            width: 100%;
            padding: 8px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 4px;
            font-size: 16px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .hasil-box {
            margin-top: 30px;
            padding: 20px;
            border: 2px dashed #007bff;
            background-color: #f8f9fa;
            border-radius: 8px;
        }
        .hasil-box p {
            margin: 8px 0;
            font-size: 16px;
        }
        .hasil-box span {
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Menu Pembayaran UKT Mahasiswa</h2>
    
    <!-- Input Data -->
    <form method="POST" action="">
        <div class="form-group">
            <label for="npm">NPM :</label>
            <input type="text" id="npm" name="npm" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama :</label>
            <input type="text" id="nama" name="nama" required>
        </div>
        <div class="form-group">
            <label for="prodi">Prodi :</label>
            <input type="text" id="prodi" name="prodi" required>
        </div>
        <div class="form-group">
            <label for="semester">Semester :</label>
            <input type="number" id="semester" name="semester" min="1" required>
        </div>
        <div class="form-group">
            <label for="biaya_ukt">Biaya UKT :</label>
            <input type="number" id="biaya_ukt" name="biaya_ukt" min="0" required>
        </div>
        <button type="submit" name="hitung">Hitung Diskon</button>
    </form>

    <?php
    // Logika PHP untuk memproses data
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['hitung'])) {
        // Mengambil inputan dari form
        $npm = $_POST['npm'];
        $nama = strtoupper($_POST['nama']); // strtoupper agar nama huruf besar semua
        $prodi = strtoupper($_POST['prodi']); // strtoupper agar prodi huruf besar semua
        $semester = (int)$_POST['semester'];
        $biaya_ukt = (float)$_POST['biaya_ukt'];

        $persen_diskon = 0;

        // Aturan Penentuan Diskon
        if ($biaya_ukt >= 5000000 && $semester > 8) {
            $persen_diskon = 15;
        } elseif ($biaya_ukt >= 5000000) {
            $persen_diskon = 10;
        } else {
            $persen_diskon = 0; // Tidak ada diskon jika UKT di bawah 5 juta
        }

        // Perhitungan
        $nominal_diskon = ($persen_diskon / 100) * $biaya_ukt;
        $total_bayar = $biaya_ukt - $nominal_diskon;

        // Menampilkan Output Sesuai Modul
        echo "<div class='hasil-box'>";
        echo "<h3>Total Pembayaran</h3>";
        echo "<p>NPM : <span>" . htmlspecialchars($npm) . "</span></p>";
        echo "<p>NAMA : <span>" . htmlspecialchars($nama) . "</span></p>";
        echo "<p>PRODI : <span>" . htmlspecialchars($prodi) . "</span></p>";
        echo "<p>SEMESTER : <span>" . $semester . "</span></p>";
        echo "<p>BIAYA UKT : <span>Rp. " . number_format($biaya_ukt, 0, ',', '.') . ",-</span></p>";
        echo "<p>DISKON : <span>" . $persen_diskon . "% </span></p>";
        echo "<p>YANG HARUS DIBAYAR : <span>Rp. " . number_format($total_bayar, 0, ',', '.') . ",-</span></p>";
        echo "</div>";
    }
    ?>
</div>

</body>
</html>