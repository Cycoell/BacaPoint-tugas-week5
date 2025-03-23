<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Register - BacaPoint</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<div class="container">
    <div class="form-box">
        <h2>Daftar ke BacaPoint</h2>
        <form action="../process/register_process.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="button secondary">Daftar</button>
        </form>
        <p>Sudah punya akun? <a href="login.php">Login</a></p>
    </div>
</div>

</body>
</html>
