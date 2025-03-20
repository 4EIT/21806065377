<?php
session_start();
include 'config.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$maSV = $_SESSION['MaSV'];

$sql = "DELETE ctdk FROM ChiTietDangKy ctdk
        JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
        WHERE dk.MaSV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $maSV);
$stmt->execute();

header("Location: registered_courses.php");
exit();
?>
