<?php
session_start();
require 'config.php'; // Kết nối database

if (!isset($_SESSION['ma_sinh_vien'])) {
    die("Bạn cần đăng nhập trước!");
}

$ma_sinh_vien = $_SESSION['ma_sinh_vien'];

if (!isset($_POST['hoc_phan']) || empty($_POST['hoc_phan'])) {
    die("Không có học phần nào được chọn!");
}

$conn->begin_transaction();

try {
    // Thêm vào bảng DangKy
    $sql = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $ma_sinh_vien);
    $stmt->execute();
    $ma_dk = $stmt->insert_id;

    // Thêm vào bảng ChiTietDangKy
    $sql_ct = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES (?, ?)";
    $stmt_ct = $conn->prepare($sql_ct);

    foreach ($_POST['hoc_phan'] as $ma_hp) {
        $stmt_ct->bind_param("is", $ma_dk, $ma_hp);
        $stmt_ct->execute();
    }

    $conn->commit();
    $_SESSION['cart'] = []; // Xóa giỏ hàng sau khi lưu thành công
    echo "Đăng ký học phần thành công!";
} catch (Exception $e) {
    $conn->rollback();
    echo "Lỗi khi đăng ký: " . $e->getMessage();
}
?>
