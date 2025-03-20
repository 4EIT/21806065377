<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (!isset($_SESSION['MaSV'])) {
        die("Vui lòng đăng nhập trước!");
    }

    $MaSV = $_SESSION['MaSV'];
    $MaHP = $_POST['MaHP'];

    // Kiểm tra sinh viên đã đăng ký học phần này chưa
    $check_sql = "SELECT * FROM ChiTietDangKy 
                  INNER JOIN DangKy ON ChiTietDangKy.MaDK = DangKy.MaDK 
                  WHERE DangKy.MaSV = '$MaSV' AND ChiTietDangKy.MaHP = '$MaHP'";

    $check_result = $conn->query($check_sql);
    if ($check_result->num_rows > 0) {
        echo "<script>alert('Bạn đã đăng ký học phần này!'); window.location='hocphan.php';</script>";
        exit;
    }

    // Thêm vào bảng DangKy nếu chưa có
    $insert_dangky = "INSERT INTO DangKy (NgayDK, MaSV) VALUES (NOW(), '$MaSV')";
    $conn->query($insert_dangky);
    $MaDK = $conn->insert_id;

    // Thêm vào bảng ChiTietDangKy
    $insert_ctdk = "INSERT INTO ChiTietDangKy (MaDK, MaHP) VALUES ('$MaDK', '$MaHP')";
    
    if ($conn->query($insert_ctdk) === TRUE) {
        echo "<script>alert('Đăng ký học phần thành công!'); window.location='hocphan.php';</script>";
    } else {
        echo "Lỗi khi đăng ký: " . $conn->error;
    }
}
?>
