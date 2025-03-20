<?php
session_start();
if (!isset($_SESSION['ma_sinh_vien'])) {
    header("Location: login.php");
    exit();
}

echo "<h2>Chào mừng sinh viên: " . $_SESSION['ma_sinh_vien'] . "</h2>";
echo "<a href='logout.php'>Đăng xuất</a>";
?>
