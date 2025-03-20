<form action="save_registration.php" method="POST">
    <h2>Danh sách học phần đã chọn</h2>
    <ul>
        <?php
        session_start();
        if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
            echo "<p>Chưa có học phần nào được chọn!</p>";
        } else {
            foreach ($_SESSION['cart'] as $hp) {
                echo "<li>" . htmlspecialchars($hp) . "</li>";
                echo "<input type='hidden' name='hoc_phan[]' value='" . htmlspecialchars($hp) . "'>";
            }
        }
        ?>
    </ul>
    <button type="submit">Lưu Đăng Ký</button>
</form>
