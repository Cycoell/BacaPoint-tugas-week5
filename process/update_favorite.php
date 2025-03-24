<?php
require_once '../config/database.php';

if (isset($_GET['id'])) {
    $book_id = $_GET['id'];
    $favorite = $_GET['favorite']; // nilai 1 atau 0

    $stmt = $conn->prepare("UPDATE books SET favorite = ? WHERE id = ?");
    $stmt->bind_param("ii", $favorite, $book_id);
    
    if ($stmt->execute()) {
        header("Location: ../public/library.php");
    } else {
        echo "Gagal update favorite!";
    }
} else {
    echo "ID tidak ditemukan!";
}
?>
