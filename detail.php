<?php include 'header.php'; ?>


<?php
include 'config.php';

// Kiểm tra xem có mã sinh viên trên URL không
if (!isset($_GET['MaSV'])) {
    die("Không có mã sinh viên để xem chi tiết!");
}

$MaSV = $_GET['MaSV'];

// Lấy thông tin sinh viên
$sql = "SELECT SinhVien.*, NganhHoc.TenNganh FROM SinhVien 
        INNER JOIN NganhHoc ON SinhVien.MaNganh = NganhHoc.MaNganh 
        WHERE MaSV = '$MaSV'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Không tìm thấy sinh viên!");
}

$row = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi Tiết Sinh Viên</title>
</head>
<body>

<h2>Thông Tin Chi Tiết Sinh Viên</h2>
<a href="index.php">Quay lại</a>

<table border="1" cellpadding="10">
    <tr>
        <th>Mã Sinh Viên</th>
        <td><?= $row['MaSV'] ?></td>
    </tr>
    <tr>
        <th>Họ Tên</th>
        <td><?= $row['HoTen'] ?></td>
    </tr>
    <tr>
        <th>Giới Tính</th>
        <td><?= $row['GioiTinh'] ?></td>
    </tr>
    <tr>
        <th>Ngày Sinh</th>
        <td><?= $row['NgaySinh'] ?></td>
    </tr>
    <tr>
        <th>Hình Ảnh</th>
        <td><img src="<?= $row['Hinh'] ?>" alt="Hình Sinh Viên" width="150"></td>
    </tr>
    <tr>
        <th>Ngành Học</th>
        <td><?= $row['TenNganh'] ?></td>
    </tr>
</table>

</body>
</html>
