<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Library - BacaPoint</title>
</head>
<body>
    <h2>Library Anda</h2>
    <a href="dashboard.php">Kembali ke Dashboard</a> | 
    <a href="../process/logout.php">Logout</a>

    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Halaman</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
        <?php
        $query = "SELECT * FROM books WHERE user_id = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("i", $user_id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['pages']}</td>
                <td>{$row['status']}</td>
                <td><a href='../process/delete_book.php?book_id={$row['id']}'>Hapus</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
