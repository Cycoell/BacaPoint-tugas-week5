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
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<div class="navbar">BacaPoint - Library</div>

<div class="container">
    <h3>Library Anda</h3>
    <a class="button" href="dashboard.php">Kembali ke Dashboard</a>

    <table>
    <tr>
        <th>Title</th>
        <th>Author</th>
        <th>Pages</th>
        <th>Genre</th>
        <th>Aksi</th>
    </tr>
    <?php
    $query = "SELECT * FROM books WHERE user_id = ? ORDER BY favorite DESC";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        echo "<tr>
            <td>{$row['title']}</td>
            <td>{$row['author']}</td>
            <td>{$row['pages']}</td>
            <td>{$row['genre']}</td>
            <td>";

        // Tombol Favorite / Unfavorite di sini
        if ($row['favorite'] == 1) {
            echo "<b>❤️ Favorit</b> | <a class='button' href='../process/update_favorite.php?id={$row['id']}&favorite=0'>Unfavorite</a> ";
        } else {
            echo "<a class='button' href='../process/update_favorite.php?id={$row['id']}&favorite=1'>Favoritkan</a> ";
        }

        // Tombol Hapus
        echo "<a class='button' href='../process/delete_book.php?book_id={$row['id']}'>Hapus</a>";

        echo "</td>
        </tr>";
    }
    ?>
</table>

</div>

</body>
</html>
