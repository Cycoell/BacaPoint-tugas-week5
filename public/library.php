<?php
session_start();
include '../config/database.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$user_id = $_SESSION['user_id'];
// Statistik genre buku yang sudah masuk ke library
$query = "SELECT genre, COUNT(*) as total FROM books WHERE user_id = ? GROUP BY genre";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$genres = [];
$totals = [];

while ($row = $result->fetch_assoc()) {
    $genres[] = $row['genre'];
    $totals[] = $row['total'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Library - BacaPoint</title>
    <link rel="stylesheet" href="../assets/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
<h2>Statistik Buku di Library</h2>
<canvas id="genreChart" width="400" height="200"></canvas>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>
    const genres = <?= json_encode($genres); ?>;
    const totals = <?= json_encode($totals); ?>;

    const ctx = document.getElementById('genreChart').getContext('2d');
    const genreChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: genres,
            datasets: [{
                label: 'Jumlah Buku per Genre',
                data: totals,
                backgroundColor: 'rgba(75, 192, 192, 0.5)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: { y: { beginAtZero: true } }
        }
    });
</script>


</body>
</html>
