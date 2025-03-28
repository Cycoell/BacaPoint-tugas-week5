<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
include '../config/database.php';

// Ambil data buku dari tabel book_list
$result = $conn->query("SELECT * FROM book_list");
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - BacaPoint</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<div class="navbar">BacaPoint - Dashboard</div>

<div class="dashboard-container">

    <div class="dashboard-header">
        <h2>Daftar Buku</h2>
        <div class="menu-container">
            <a href="library.php" class="btn">Library</a>
            <a href="../process/logout.php" class="btn">Logout</a>
        </div>
    </div>

    <table>
        <tr>
            <th>Title</th>
            <th>Author</th>
            <th>Pages</th>
            <th>Genre</th>
            <th>Aksi</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= htmlspecialchars($row['title']) ?></td>
                <td><?= htmlspecialchars($row['author']) ?></td>
                <td><?= htmlspecialchars($row['pages']) ?></td>
                <td><?= htmlspecialchars($row['genre']) ?></td>
                <td>
                <a href="../process/add_book.php?title=<?= urlencode($row['title']) ?>&author=<?= urlencode($row['author']) ?>&pages=<?= $row['pages'] ?>&genre=<?= urlencode($row['genre']) ?>" class="action-button add-button">Tambahkan</a>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>
    
</body>
</html>
