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
    <title>Login - BacaPoint</title>
    <link rel="stylesheet" href="../assets/styles.css">
</head>
<body>

<div class="container">
    <div class="form-box">
        <h2>Login ke BacaPoint</h2>
        <form action="../process/login_proces.php" method="POST">
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" class="button">Login</button>
        </form>
        <p>Belum punya akun? <a href="register.php">Daftar</a></p>
    </div>
</div>

</body>
</html>
