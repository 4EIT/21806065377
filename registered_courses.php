<?php include 'header.php'; ?>



<?php
session_start();
include 'config.php';

if (!isset($_SESSION['MaSV'])) {
    header("Location: login.php");
    exit();
}

$maSV = $_SESSION['MaSV'];

$sql = "SELECT hp.MaHP, hp.TenHP, hp.SoTinChi 
        FROM ChiTietDangKy ctdk
        JOIN HocPhan hp ON ctdk.MaHP = hp.MaHP
        JOIN DangKy dk ON ctdk.MaDK = dk.MaDK
        WHERE dk.MaSV = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $maSV);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Học Phần Đã Đăng Ký</title>
</head>
<body>
    <h2>Danh Sách Học Phần Đã Đăng Ký</h2>
    <table border="1">
        <tr>
            <th>Mã Học Phần</th>
            <th>Tên Học Phần</th>
            <th>Số Tín Chỉ</th>
            <th>Hành động</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $row['MaHP']; ?></td>
                <td><?php echo $row['TenHP']; ?></td>
                <td><?php echo $row['SoTinChi']; ?></td>
                <td><a href="remove_course.php?MaHP=<?php echo $row['MaHP']; ?>">Xóa</a></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="clear_registration.php">Xóa tất cả học phần</a>
</body>
</html>