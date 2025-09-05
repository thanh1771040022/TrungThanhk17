<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/payment_functions.php";
$bookings = getAllBookings();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm Thanh toán</title>
</head>
<body>
    <h2>Thêm Thanh toán</h2>
    <a href="thanhtoan.php">← Quay lại</a>

    <form method="POST" action="../handle/add_payment.php">
        <label>Đơn đặt vé</label>
        <select name="MaDatVe" required>
            <?php while($dv = $bookings->fetch_assoc()) { ?>
                <option value="<?= $dv['MaDatVe'] ?>">
                    Mã <?= $dv['MaDatVe'] ?> - <?= $dv['HoTen'] ?> (<?= $dv['NoiDi'] ?> → <?= $dv['NoiDen'] ?>, <?= $dv['NgayBay'] ?> - <?= $dv['HangVe'] ?>)
                </option>
            <?php } ?>
        </select>
        <br><br>

        <label>Phương thức</label>
        <select name="PhuongThuc">
            <option value="Tiền mặt">Tiền mặt</option>
            <option value="Chuyển khoản">Chuyển khoản</option>
            <option value="Thẻ tín dụng">Thẻ tín dụng</option>
        </select>
        <br><br>

        <label>Số tiền</label>
        <input type="number" name="SoTien" required> VND
        add_payment.php
        <label>Trạng thái</label>
        <select name="TrangThai">
            <option value="Chờ xác nhận">Chờ xác nhận</option>
            <option value="Hoàn tất">Hoàn tất</option>
            <option value="Hủy">Hủy</option>
        </select>
        <br><br>

        <button type="submit">Thêm thanh toán</button>
    </form>
</body>
</html>
