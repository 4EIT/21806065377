
<?php include 'header.php'; ?>



<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Sinh Viên</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        table, th, td { border: 1px solid black; padding: 8px; text-align: center; }
        img { width: 100px; height: auto; }
    </style>
</head>
<body>

<h2>Danh Sách Sinh Viên</h2>
<a href="create.php">Thêm Sinh Viên</a>
<table>
    <tr>
        <th>Mã SV</th>
        <th>Họ Tên</th>
        <th>Giới Tính</th>
        <th>Ngày Sinh</th>
        <th>Hình</th>
        <th>Ngành</th>
        <th>Hành động</th>
    </tr>

    <?php
    $sql = "SELECT * FROM SinhVien";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['MaSV']}</td>
                    <td>{$row['HoTen']}</td>
                    <td>{$row['GioiTinh']}</td>
                    <td>{$row['NgaySinh']}</td>
                    <td><img src='{$row['Hinh']}'></td>
                    <td>{$row['MaNganh']}</td>
                    <td>
                        <a href='edit.php?MaSV={$row['MaSV']}'>Sửa</a> | 
                        <a href='detail.php?MaSV={$row['MaSV']}'>Chi tiết</a> | 
                        <a href='delete.php?MaSV={$row['MaSV']}' onclick='return confirm(\"Xóa sinh viên này?\")'>Xóa</a>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='7'>Không có sinh viên nào</td></tr>";
    }
    ?>

</table>

</body>
</html>
