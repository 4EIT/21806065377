<?php
session_start();
include 'config.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['MaHP'])) {
    $maSV = $_SESSION['MaSV'];
    $maHP = $_GET['MaHP'];

    $sql = "DELETE ctdk FROM ChiTietDangKy ctdk
            JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
            WHERE dk.MaSV = ? AND ctdk.MaHP = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $maSV, $maHP);
    $stmt->execute();
}

header("Location: registered_courses.php");
exit();
?>
