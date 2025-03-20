<?php
session_start();
include 'config.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if (isset($_GET['MaHP'])) {
    $maHP = $_GET['MaHP'];
    if (!in_array($maHP, $_SESSION['cart'])) {
        $_SESSION['cart'][] = $maHP;
    }
}

$sql = "SELECT MaHP, TenHP, SoTinChi FROM HocPhan WHERE MaHP IN ('" . implode("','", $_SESSION['cart']) . "')";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Giỏ Hàng Học Phần</title>
</head>
<body>
    <h2>Giỏ Hàng Học Phần</h2>
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
                <td><a href="remove_from_cart.php?MaHP=<?php echo $row['MaHP']; ?>">Xóa</a></td>
            </tr>
        <?php } ?>
    </table>
    <br>
    <a href="confirm_registration.php">Xác nhận đăng ký</a>
</body>
</html>
