<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}

if (isset($_GET['title']) && isset($_GET['author']) && isset($_GET['pages']) && isset($_GET['genre'])) {
    $user_id = $_SESSION['user_id'];
    $title = $_GET['title'];
    $author = $_GET['author'];
    $pages = $_GET['pages'];
    $genre = $_GET['genre'];  // Ambil genre dari form

    $check_query = "SELECT * FROM books WHERE user_id = ? AND title = ?";
    $stmt = $conn->prepare($check_query);
    $stmt->bind_param("is", $user_id, $title);
    $stmt->execute();
    $check_result = $stmt->get_result();

    if ($check_result->num_rows == 0) {
        $insert_query = "INSERT INTO books (user_id, title, author, pages, genre, status) VALUES (?, ?, ?, ?, ?, 'sedang dibaca')";
        $stmt = $conn->prepare($insert_query);
        $stmt->bind_param("issis", $user_id, $title, $author, $pages, $genre);
        $stmt->execute();

        echo "<script>alert('Buku berhasil ditambahkan!'); 
        window.location.href='../public/library.php';
        </script>";
    } else {
        echo "<script>alert('Buku sudah ada di library Anda!'); 
        window.location.href='../public/library.php';
        </script>";
    }
}
?>
