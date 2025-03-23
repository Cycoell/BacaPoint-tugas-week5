<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}

if (isset($_GET['title']) && isset($_GET['author']) && isset($_GET['pages'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_GET['title'];
    $author = $_GET['author'];
    $pages = $_GET['pages'];

    // Cek apakah buku sudah ada di tabel books untuk user ini
    $check_query = "SELECT * FROM books WHERE user_id = ? AND title = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("is", $user_id, $title);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows == 0) {
        // Tambahkan buku ke tabel books
        $insert_query = "INSERT INTO books (user_id, title, author, pages, status) VALUES (?, ?, ?, ?, 'sedang dibaca')";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("issi", $user_id, $title, $author, $pages);
        
        if ($stmt->execute()) {
            echo "Buku berhasil ditambahkan! <a href='../public/library.php'>Kembali</a>";
        } else {
            echo "Gagal menambahkan buku!";
        }
    } else {
        echo "Buku sudah ada di library Anda! <a href='../public/library.php'>Kembali</a>";
    }
}
?>
