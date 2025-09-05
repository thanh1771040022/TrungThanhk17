<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/booking_functions.php";
$customers = getAllCustomers();
$tickets = getAllTickets();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Đặt vé</title>
</head>
<body>
    <h2>Thêm Đặt vé</h2>
    <a href="datve.php">← Quay lại</a>

    <form method="POST" action="../handle/add_booking.php">
        <label>Khách hàng</label>
        <select name="MaKH" required>
            <?php while($kh = $customers->fetch_assoc()) { ?>
                <option value="<?= $kh['MaKH'] ?>"><?= $kh['HoTen'] ?></option>
            <?php } ?>
        </select>
        <br><br>

        <label>Vé</label>
        <select name="MaVe" required>
            <?php while($ve = $tickets->fetch_assoc()) { ?>
                <option value="<?= $ve['MaVe'] ?>">
                    <?= $ve['NoiDi'] ?> → <?= $ve['NoiDen'] ?> (<?= $ve['NgayBay'] ?>) - <?= $ve['HangVe'] ?>
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label>Số lượng</label>
        <input type="number" name="SoLuong" min="1" required>
        <br><br>

        <label>Trạng thái</label>
        <select name="TrangThaiDat">
            <option value="Chờ thanh toán">Chờ thanh toán</option>
            <option value="Đã thanh toán">Đã thanh toán</option>
            <option value="Hủy">Hủy</option>
        </select>
        <br><br>

        <button type="submit">Thêm đặt vé</button>
    </form>
</body>
</html>
