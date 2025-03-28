<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../public/login.php");
    exit();
}

if (isset($_GET['book_id'])) {
    $user_id = $_SESSION['user_id'];
    $book_id = $_GET['book_id'];

    // Hapus buku hanya jika milik user yang sedang login
    $delete_query = "DELETE FROM books WHERE id = ? AND user_id = ?";
    $stmt = $conn->prepare($delete_query);
    $stmt->bind_param("ii", $book_id, $user_id);
    
    if ($stmt->execute()) {
        echo "<script>
                alert('Buku berhasil dihapus!');
                window.location.href = '../public/library.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menghapus buku!');
                window.location.href = '../public/library.php';
              </script>";
    }
}
?>
