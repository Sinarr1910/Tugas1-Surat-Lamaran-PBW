<?php

session_start();
include 'koneksi_db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $username = $_POST['username'];
    $password = $_POST['password'];


    $stmt = $conn->prepare("SELECT id, nama, katasandi FROM pengguna WHERE nama = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();


        if ($password === $user['katasandi']) {


            $_SESSION['id']             = $user['id'];
            $_SESSION['nama']           = $user['nama'];
            $_SESSION['login_Un51k4']   = true;

            header("Location: index.php");
            exit;

        } else {
            header("Location: login.php?message=" . urlencode("Password salah!"));
            exit;
        }

    } else {
        header("Location: login.php?message=" . urlencode("Username tidak ditemukan!"));
        exit;
    }

    $stmt->close();
}
?>