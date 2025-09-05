<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/flight_functions.php";
$flights = getAllFlights();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Chuyến bay</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Danh sách chuyến bay</h2>
    <a href="menu.php">← Quay lại Menu</a> | 
    <a href="them_chuyenbay.php">+ Thêm chuyến bay</a>
    <br><br>

    <table>
        <tr>
            <th>Mã</th>
            <th>Hãng</th>
            <th>Sân bay đi</th>
            <th>Sân bay đến</th>
            <th>Ngày giờ đi</th>
            <th>Ngày giờ đến</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
        </tr>
        <?php while($row = $flights->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MaChuyenBay'] ?></td>
            <td><?= $row['TenHang'] ?></td>
            <td><?= $row['SanBayDiTen'] ?></td>
            <td><?= $row['SanBayDenTen'] ?></td>
            <td><?= $row['NgayGioDi'] ?></td>
            <td><?= $row['NgayGioDen'] ?></td>
            <td><?= $row['TrangThai'] ?></td>
            <td>
                <a href="../handle/delete_flight.php?id=<?= $row['MaChuyenBay'] ?>" 
                   onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
