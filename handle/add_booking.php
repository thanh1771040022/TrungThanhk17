<?php
require_once "../functions/booking_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaKH = $_POST['MaKH'];
    $MaVe = $_POST['MaVe'];
    $SoLuong = $_POST['SoLuong'];
    $TrangThaiDat = $_POST['TrangThaiDat'];

    if (addBooking($MaKH, $MaVe, $SoLuong, $TrangThaiDat)) {
        header("Location: ../datve.php");
        exit();
    } else {
        echo "Lỗi khi thêm đặt vé!";
    }
}
?>
