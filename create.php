<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaSV = $_POST['MaSV'];
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh']; // Lưu đường dẫn ảnh
    $MaNganh = $_POST['MaNganh'];

    $sql = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
            VALUES ('$MaSV', '$HoTen', '$GioiTinh', '$NgaySinh', '$Hinh', '$MaNganh')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Thêm sinh viên thành công!'); window.location='index.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Sinh Viên</title>
</head>
<body>

<h2>Thêm Sinh Viên</h2>
<a href="index.php">Quay lại</a>

<form method="POST">
    <label>Mã SV:</label> <input type="text" name="MaSV" required><br><br>
    <label>Họ Tên:</label> <input type="text" name="HoTen" required><br><br>
    <label>Giới Tính:</label> 
    <select name="GioiTinh">
        <option value="Nam">Nam</option>
        <option value="Nữ">Nữ</option>
    </select><br><br>
    <label>Ngày Sinh:</label> <input type="date" name="NgaySinh" required><br><br>
    <label>Hình Ảnh (URL):</label> <input type="text" name="Hinh"><br><br>
    <label>Ngành Học:</label>
    <select name="MaNganh">
        <?php
        $nganhQuery = "SELECT * FROM NganhHoc";
        $nganhResult = $conn->query($nganhQuery);
        while ($row = $nganhResult->fetch_assoc()) {
            echo "<option value='{$row['MaNganh']}'>{$row['TenNganh']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Thêm</button>
</form>

</body>
</html>
