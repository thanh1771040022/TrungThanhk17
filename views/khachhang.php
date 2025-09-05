<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/customer_functions.php";
$customers = getAllCustomers();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Khách hàng</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Danh sách khách hàng</h2>
    <a href="menu.php">← Quay lại Menu</a> | 
    <a href="them_khachhang.php">+ Thêm khách hàng</a>
    <br><br>

    <table>
        <tr>
            <th>Mã KH</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>CMND/CCCD</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Thao tác</th>
        </tr>
        <?php while($row = $customers->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MaKH'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['NgaySinh'] ?></td>
            <td><?= $row['CMND_CCCD'] ?></td>
            <td><?= $row['SoDienThoai'] ?></td>
            <td><?= $row['Email'] ?></td>
            <td><?= $row['DiaChi'] ?></td>
            <td>
                <a href="../handle/delete_customer.php?id=<?= $row['MaKH'] ?>" 
                   onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
