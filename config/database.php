<?php
$host = "localhost";
$user = "root";  // Ganti sesuai database kalian
$pass = "";      // Ganti sesuai database kalian
$dbname = "baca_point";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>
