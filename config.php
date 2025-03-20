<?php
$serverName = "localhost";  // Nếu dùng hosting, thay bằng tên server
$username = "root";  // Nếu dùng XAMPP, user mặc định là "root"
$password = "";  // XAMPP mặc định không có mật khẩu, nếu có thì điền vào
$database = "Test1"; // Đổi lại tên đúng của database bạn đã tạo

// Kết nối đến MySQL
$conn = new mysqli($serverName, $username, $password, $database);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}
?>
