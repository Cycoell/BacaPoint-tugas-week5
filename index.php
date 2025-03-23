<?php
session_start();
include_once("config/database.php");

// Jika pengguna sudah login, arahkan ke dashboard
if (isset($_SESSION['user_id'])) {
    header("Location: public/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selamat Datang di Baca Point</title>
    <link rel="stylesheet" href="assets/style.css"> <!-- Tambahkan CSS jika ada -->
</head>
<body>
    <h2>Selamat Datang di <span>Baca Point</span></h2>
    <p>Silakan login untuk mengakses perpustakaan Anda.</p>
    <a href="public/login.php">Login</a>
    <a href="public/register.php">Register</a>
</body>
</html>
