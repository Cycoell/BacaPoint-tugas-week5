<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di Baca Point</title>
</head>
<body>
    <h2>Selamat Datang di Baca Point</h2>
    <p>Silakan login untuk mengakses perpustakaan Anda.</p>
    <a href="public/login.php">Login</a>
    <a href="public/register.php">Register</a>
</body>
</html>
