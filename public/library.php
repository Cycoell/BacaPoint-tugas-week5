<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Query untuk mencari buku berdasarkan user_id
$query = "SELECT * FROM books WHERE user_id = ? AND title LIKE ?";
$stmt = $conn->prepare($query);
$search_param = "%$search%";
$stmt->bind_param("is", $user_id, $search_param);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Library | Baca Point</title>
</head>
<body>
    <h2>Library Saya</h2>
    <form method="GET" action="library.php">
        <input type="text" name="search" placeholder="Cari Buku..." value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Cari</button>
    </form>

    <h3>Hasil Pencarian:</h3>
    <ul>
        <?php while ($book = $result->fetch_assoc()): ?>
            <li>
                <?= htmlspecialchars($book['title']) ?> - <?= htmlspecialchars($book['author']) ?>
                <a href="../process/add_book.php?title=<?= urlencode($book['title']) ?>&author=<?= urlencode($book['author']) ?>&pages=<?= $book['pages'] ?>">Tambah ke Library</a>
            </li>
        <?php endwhile; ?>
    </ul>
    <li>
    <?= htmlspecialchars($book['title']) ?> - <?= htmlspecialchars($book['author']) ?>
    <a href="../process/delete_book.php?book_id=<?= $book['id'] ?>">Hapus</a>
    </li>

    <a href="dashboard.php">Kembali ke Dashboard</a>
</body>
</html>
