<?php
session_start();
$_SESSION['test'] = "Session Berjalan!";
echo "Coba refresh halaman ini. <br>";
echo "Session: " . ($_SESSION['test'] ?? 'Session Tidak Ada');
?>
