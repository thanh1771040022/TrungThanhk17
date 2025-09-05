<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/ticket_functions.php";
$tickets = getAllTickets();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản lý Vé máy bay</title>
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
<div class="container">
    <h2>Danh sách Vé máy bay</h2>
    <a href="menu.php">← Quay lại Menu</a> | 
    <a href="them_ve.php">+ Thêm vé</a>
    <br><br>

    <table>
        <tr>
            <th>Mã Vé</th>
            <th>Chuyến bay</th>
            <th>Hạng vé</th>
            <th>Giá vé</th>
            <th>Tình trạng</th>
            <th>Thao tác</th>
        </tr>
        <?php while($row = $tickets->fetch_assoc()) { ?>
        <tr>
            <td><?= $row['MaVe'] ?></td>
            <td><?= $row['NoiDi'] ?> → <?= $row['NoiDen'] ?> (<?= $row['NgayBay'] ?>)</td>
            <td><?= $row['HangVe'] ?></td>
            <td><?= number_format($row['GiaVe']) ?> VND</td>
            <td><?= $row['TinhTrang'] ?></td>
            <td>
                <a href="../handle/delete_ticket.php?id=<?= $row['MaVe'] ?>" 
                   onclick="return confirm('Bạn có chắc muốn xóa vé này?')">Xóa</a>
            </td>
        </tr>
        <?php } ?>
    </table>
</div>
</body>
</html>
