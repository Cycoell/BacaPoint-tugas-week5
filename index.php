<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: public/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Selamat Datang di BacaPoint</title>
    <link rel="stylesheet" href="assets/styles.css">
</head>
<body>

<div class="navbar">BacaPoint - Temukan Buku Favoritmu</div>

<div class="container">
    <h2>Baca Buku & Dapatkan Poin!</h2>
    <p>Jelajahi koleksi buku kami, kumpulkan poin, dan tukarkan dengan hadiah menarik!</p>
    <img src="assets/LOGO/BACAPOINT_ (1).png" alt="BacaPoint">
    <div>
        <a class="button" href="public/login.php">Login</a>
        <a class="button secondary" href="public/register.php">Daftar</a>
    </div>
</div>

</body>
</html>
