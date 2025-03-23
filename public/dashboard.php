<?php
session_start();
include_once("../config/database.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../index.php"); // ini bener
    exit();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Baca Point</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>

    <a href="library.php">Library</a>
    <a href="../process/logout.php">Logout</a>
</body>
</html>
