<?php
require_once "../functions/flight_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $MaHang   = $_POST['MaHang'];
    $SanBayDi = $_POST['SanBayDi'];
    $SanBayDen= $_POST['SanBayDen'];
    $NgayGioDi= $_POST['NgayGioDi'];
    $NgayGioDen= $_POST['NgayGioDen'];
    $TrangThai= $_POST['TrangThai'];

    if (addFlight($MaHang, $SanBayDi, $SanBayDen, $NgayGioDi, $NgayGioDen, $TrangThai)) {
        header("Location: ../views/chuyenbay.php");
        exit();
    } else {
        echo "Lỗi khi thêm chuyến bay!";
    }
}
?>
