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
    <title>Dashboard - BacaPoint</title>
</head>
<body>
    <h2>Selamat datang, <?php echo $_SESSION['username']; ?>!</h2>
    <a href="library.php">Lihat Library</a> | 
    <a href="../process/logout.php">Logout</a>
    
    <h3>Daftar Buku</h3>
    <form method="GET">
        <input type="text" name="search" placeholder="Cari buku...">
        <button type="submit">Cari</button>
    </form>

    <table border="1">
        <tr>
            <th>Judul</th>
            <th>Penulis</th>
            <th>Halaman</th>
            <th>Aksi</th>
        </tr>
        <?php
        $search = $_GET['search'] ?? '';
        $query = "SELECT * FROM book_list WHERE title LIKE ?";
        $stmt = $conn->prepare($query);
        $search_param = "%$search%";
        $stmt->bind_param("s", $search_param);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['title']}</td>
                <td>{$row['author']}</td>
                <td>{$row['pages']}</td>
                <td><a href='../process/add_book.php?title={$row['title']}&author={$row['author']}&pages={$row['pages']}'>Tambah ke Library</a></td>
            </tr>";
        }
        ?>
    </table>
</body>
</html>
