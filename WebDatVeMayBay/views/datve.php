<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/booking_functions.php";
$bookings = getAllBookings();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Đặt vé</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Danh sách Đặt vé</h2>
    <a href="menu.php">← Quay lại Menu</a> | 
    <a href="them_datve.php">+ Thêm đặt vé</a>
    <br><br>

    <table>
        <tr>
            <th>Mã Đặt vé</th>
            <th>Khách hàng</th>
            <th>Chuyến bay</th>
            <th>Hạng vé</th>
            <th>Số lượng</th>
            <th>Trạng thái</th>
            <th>Ngày đặt</th>
            <th>Thao tác</th>
        </tr>
        <?php while($row = $bookings->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MaDatVe'] ?></td>
            <td><?= $row['HoTen'] ?></td>
            <td><?= $row['NoiDi'] ?> → <?= $row['NoiDen'] ?> (<?= $row['NgayBay'] ?>)</td>
            <td><?= $row['HangVe'] ?></td>
            <td><?= $row['SoLuong'] ?></td>
            <td><?= $row['TrangThaiDat'] ?></td>
            <td><?= $row['NgayDat'] ?></td>
            <td>
                <a href="../handle/delete_booking.php?id=<?= $row['MaDatVe'] ?>"
                   onclick="return confirm('Bạn có chắc muốn xóa đặt vé này?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
