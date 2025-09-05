<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/payment_functions.php";
$payments = getAllPayments();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Thanh toán</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Danh sách Thanh toán</h2>
    <a href="menu.php">← Quay lại Menu</a> | 
    <a href="them_thanhtoan.php">+ Thêm thanh toán</a>
    <br><br>

    <table>
        <tr>
            <th>Mã Thanh toán</th>
            <th>Mã Đặt vé</th>
            <th>Khách hàng</th>
            <th>Phương thức</th>
            <th>Số tiền</th>
            <th>Ngày thanh toán</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php while($row = $payments->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MaThanhToan'] ?></td>
            <td><?= $row['MaDatVe'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['PhuongThuc'] ?></td>
            <td><?= number_format($row['SoTien']) ?> VND</td>
            <td><?= $row['NgayThanhToan'] ?></td>
            <td><?= $row['TrangThai'] ?></td>
            <td>
                <a href="../handle/delete_payment.php?id=<?= $row['MaThanhToan'] ?>"
                   onclick="return confirm('Bạn có chắc muốn xóa thanh toán này?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
