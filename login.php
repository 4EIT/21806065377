<?php include 'header.php'; ?>



<?php
session_start();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng Nhập</title>
</head>
<body>
    <h2>Đăng Nhập</h2>

    <?php if (isset($_SESSION['error'])): ?>
        <p style="color: red;"><?php echo $_SESSION['error']; unset($_SESSION['error']); ?></p>
    <?php endif; ?>

    <form action="process_login.php" method="post">
        <label for="ma_sinh_vien">Mã Sinh Viên:</label>
        <input type="text" name="ma_sinh_vien" required>
        <button type="submit">Đăng Nhập</button>
    </form>

    <br>
    <a href="index.php">⬅ Back to List</a>
</body>
</html>
