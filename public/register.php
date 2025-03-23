<?php
include_once("../config/database.php");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi | Baca Point</title>
</head>
<body>
    <h2>Registrasi</h2>
    <form action="../process/register_process.php" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit" >Daftar</button>
    </form>
</body>
</html>
