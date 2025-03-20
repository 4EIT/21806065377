<?php
session_start();
include 'config.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
    header("Location: cart.php");
    exit();
}

$maSV = $_SESSION['MaSV'];
$ngayDK = date('Y-m-d');

// Tạo bản ghi trong bảng DangKy
$sql = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $ngayDK, $maSV);
$stmt->execute();
$maDK = $conn->insert_id;

// Chèn các học phần từ giỏ hàng vào ChiTietDangKy
foreach ($_SESSION['cart'] as $maHP) {
    $sql = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("is", $maDK, $maHP);
    $stmt->execute();
}

// Xóa giỏ hàng sau khi đăng ký thành công
unset($_SESSION['cart']);

header("Location: registered_courses.php");
exit();
?>
