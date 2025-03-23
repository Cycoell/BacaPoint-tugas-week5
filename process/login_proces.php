<?php
session_start();
include '../config/database.php';

// Ambil data dari form login
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Cek apakah data tidak kosong
if (empty($username) || empty($password)) {
    echo "Username dan Password wajib diisi!";
    exit();
}

// Query cek user di database
$query = "SELECT * FROM users WHERE username = ? LIMIT 1";
$stmt = $conn->prepare($query);
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();

    // Verifikasi password (pastikan di database simpan password ter-hash)
    if (password_verify($password, $user['password'])) {
        // Login berhasil, simpan ke session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

        // Redirect ke dashboard
        header("Location: ../public/dashboard.php");
        exit();
    } else {
        echo "Password salah!";
    }
} else {
    echo "Username tidak ditemukan!";
}
?>
