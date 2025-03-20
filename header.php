<ul>
    <li><a href="index.php">Trang chủ</a></li>
    <li><a href="sinhvien.php">Sinh Viên</a></li>
    <li><a href="hocphan.php">Học Phần</a></li>
    <li><a href="register.php">Danh Sách Học Phần Đã Lưu</a></li>
    <li><a href="registered_courses.php">Chi Tiết Học Phần</a></li>
    <li><a href="dangky.php">Đăng Ký</a></li>
    <?php if (isset($_SESSION['MaSV'])): ?>
        <li><a href="logout.php">Đăng Xuất (<?php echo $_SESSION['MaSV']; ?>)</a></li>
    <?php else: ?>
        <li><a href="login.php">Đăng Nhập</a></li>
    <?php endif; ?>
</ul>
