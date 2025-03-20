<?php
include 'config.php';

// Kiểm tra xem có mã sinh viên trên URL không
if (!isset($_GET['MaSV'])) {
    die("Không có mã sinh viên!");
}

$MaSV = $_GET['MaSV'];

// Lấy thông tin sinh viên cần chỉnh sửa
$sql = "SELECT * FROM SinhVien WHERE MaSV = '$MaSV'";
$result = $conn->query($sql);

if ($result->num_rows == 0) {
    die("Không tìm thấy sinh viên!");
}

$row = $result->fetch_assoc();

// Xử lý khi người dùng nhấn nút cập nhật
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $GioiTinh = $_POST['GioiTinh'];
    $NgaySinh = $_POST['NgaySinh'];
    $Hinh = $_POST['Hinh'];
    $MaNganh = $_POST['MaNganh'];

    $update_sql = "UPDATE SinhVien 
                   SET HoTen='$HoTen', GioiTinh='$GioiTinh', NgaySinh='$NgaySinh', Hinh='$Hinh', MaNganh='$MaNganh' 
                   WHERE MaSV='$MaSV'";

    if ($conn->query($update_sql) === TRUE) {
        echo "<script>alert('Cập nhật thành công!'); window.location='index.php';</script>";
    } else {
        echo "Lỗi: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chỉnh Sửa Sinh Viên</title>
</head>
<body>

<h2>Chỉnh Sửa Sinh Viên</h2>
<a href="index.php">Quay lại</a>

<form method="POST">
    <label>Họ Tên:</label> <input type="text" name="HoTen" value="<?= $row['HoTen'] ?>" required><br><br>
    <label>Giới Tính:</label>
    <select name="GioiTinh">
        <option value="Nam" <?= ($row['GioiTinh'] == 'Nam') ? 'selected' : '' ?>>Nam</option>
        <option value="Nữ" <?= ($row['GioiTinh'] == 'Nữ') ? 'selected' : '' ?>>Nữ</option>
    </select><br><br>
    <label>Ngày Sinh:</label> <input type="date" name="NgaySinh" value="<?= $row['NgaySinh'] ?>" required><br><br>
    <label>Hình Ảnh (URL):</label> <input type="text" name="Hinh" value="<?= $row['Hinh'] ?>"><br><br>
    <label>Ngành Học:</label>
    <select name="MaNganh">
        <?php
        $nganhQuery = "SELECT * FROM NganhHoc";
        $nganhResult = $conn->query($nganhQuery);
        while ($nganhRow = $nganhResult->fetch_assoc()) {
            $selected = ($row['MaNganh'] == $nganhRow['MaNganh']) ? 'selected' : '';
            echo "<option value='{$nganhRow['MaNganh']}' $selected>{$nganhRow['TenNganh']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Cập Nhật</button>
</form>

</body>
</html>
