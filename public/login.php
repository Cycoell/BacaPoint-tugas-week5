<?php
session_start();
if (isset($_SESSION['user_id'])) {
    header("Location: public/dashboard.php");
    exit();
} 
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>    
    <link rel="stylesheet" href="../assets/styles.css">

</head>
<body>
    <div class="navbar">Baca Point</div>
    
    <div class="login-container">
        <div class="login-box">
            <h2>Login</h2>
            <form action="process_login.php" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <input type="password" name="password" placeholder="Password" required>
                <button type="submit">Login</button>
            </form>
        </div>
    </div>
</body>
</html>

