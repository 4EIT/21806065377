<?php
session_start();

// Cấu hình database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Test1"; // ✅ Đúng với database của bạn

// Kết nối MySQL
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Kiểm tra nếu có dữ liệu từ form đăng nhập
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['ma_sinh_vien']) && !empty($_POST['ma_sinh_vien'])) {
        $ma_sinh_vien = trim($_POST['ma_sinh_vien']);

        // Sửa tên cột đúng với database (MaSV)
        $sql = "SELECT * FROM SinhVien WHERE MaSV = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $ma_sinh_vien);
        $stmt->execute();
        $result = $stmt->get_result();

        // Kiểm tra tài khoản
        if ($result->num_rows > 0) {
            $_SESSION['MaSV'] = $ma_sinh_vien;
            header("Location: dashboard.php"); // ✅ Chuyển hướng sau khi đăng nhập thành công
            exit();
        } else {
            $_SESSION['error'] = "Mã sinh viên không tồn tại!";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Vui lòng nhập mã sinh viên!";
        header("Location: login.php");
        exit();
    }
} else {
    header("Location: login.php");
    exit();
}

$conn->close();
?>
