
<?php include 'header.php'; ?>


<?php
include 'config.php';
session_start();

// Lấy danh sách học phần
$sql = "SELECT * FROM HocPhan";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Học Phần</title>
</head>
<body>

<h2>Danh Sách Học Phần</h2>
<a href="index.php">Quay lại</a>
<table border="1" cellpadding="10">
    <tr>
        <th>Mã Học Phần</th>
        <th>Tên Học Phần</th>
        <th>Số Tín Chỉ</th>
        <th>Đăng Ký</th>
    </tr>
    <?php while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MaHP'] ?></td>
            <td><?= $row['TenHP'] ?></td>
            <td><?= $row['SoTinChi'] ?></td>
            <td>
                <form method="POST" action="dangky_hocphan.php">
                    <input type="hidden" name="MaHP" value="<?= $row['MaHP'] ?>">
                    <button type="submit">Đăng Ký</button>
                </form>
            </td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
