<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/ticket_functions.php";
$flights = getAllFlights();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm vé máy bay</title>
</head>
<body>
    <h2>Thêm Vé máy bay</h2>
    <a href="ve.php">← Quay lại</a>

    <form method="POST" action="../handle/add_ticket.php">
        <label>Chuyến bay</label>
        <select name="MaChuyenBay" required>
            <?php while($cb = $flights->fetch_assoc()) { ?>
                <option value="<?= $cb['MaChuyenBay'] ?>">
                    <?= $cb['NoiDi'] ?> → <?= $cb['NoiDen'] ?> (<?= $cb['NgayBay'] ?>)
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label>Hạng vé</label>
        <select name="HangVe">
            <option value="Phổ thông">Phổ thông</option>
            <option value="Thương gia">Thương gia</option>
            <option value="Hạng nhất">Hạng nhất</option>
        </select>
        <br><br>

        <label>Giá vé</label>
        <input type="number" name="GiaVe" required> VND
        <br><br>

        <label>Tình trạng</label>
        <select name="TinhTrang">
            <option value="Còn trống">Còn trống</option>
            <option value="Đã đặt">Đã đặt</option>
        </select>
        <br><br>

        <button type="submit">Thêm vé</button>
    </form>
</body>
</html>
