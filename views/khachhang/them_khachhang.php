<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm khách hàng</title>
</head>
<body>
    <h2>Thêm khách hàng mới</h2>
    <a href="khachhang.php">← Quay lại</a>
    <form method="POST" action="../handle/add_customer.php">
        <label>Họ tên</label>
        <input type="text" name="HoTen" required><br><br>

        <label>Ngày sinh</label>
        <input type="date" name="NgaySinh"><br><br>

        <label>CMND/CCCD</label>
        <input type="text" name="CMND_CCCD"><br><br>

        <label>Số điện thoại</label>
        <input type="text" name="SoDienThoai"><br><br>

        <label>Email</label>
        <input type="email" name="Email"><br><br>

        <label>Địa chỉ</label>
        <input type="text" name="DiaChi"><br><br>

        <button type="submit">Thêm</button>
    </form>
</body>
</html>
