<?php include 'header.php'; ?>


<?php
include 'config.php';

// Kiểm tra xem có mã sinh viên trên URL không
if (!isset($_GET['MaSV'])) {
    die("Không có mã sinh viên để xóa!");
}

$MaSV = $_GET['MaSV'];

// Xóa sinh viên
$sql = "DELETE FROM SinhVien WHERE MaSV = '$MaSV'";

if ($conn->query($sql) === TRUE) {
    echo "<script>alert('Xóa sinh viên thành công!'); window.location='index.php';</script>";
} else {
    echo "Lỗi khi xóa: " . $conn->error;
}
?>
