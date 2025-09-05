<?php
require_once "../functions/payment_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaDatVe = $_POST['MaDatVe'];
    $PhuongThuc = $_POST['PhuongThuc'];
    $SoTien = $_POST['SoTien'];
    $TrangThai = $_POST['TrangThai'];

    if (addPayment($MaDatVe, $PhuongThuc, $SoTien, $TrangThai)) {
        header("Location: ../views/thanhtoan.php");
        exit();
    } else {
        echo "Lỗi khi thêm thanh toán!";
    }
}
?>
