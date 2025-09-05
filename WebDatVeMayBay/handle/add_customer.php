<?php
require_once "../functions/customer_functions.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $HoTen = $_POST['HoTen'];
    $NgaySinh = $_POST['NgaySinh'];
    $CMND_CCCD = $_POST['CMND_CCCD'];
    $SoDienThoai = $_POST['SoDienThoai'];
    $Email = $_POST['Email'];
    $DiaChi = $_POST['DiaChi'];

    if (addCustomer($HoTen, $NgaySinh, $CMND_CCCD, $SoDienThoai, $Email, $DiaChi)) {
        header("Location: ../views/khachhang.php");
        exit();
    } else {
        echo "Lỗi khi thêm khách hàng!";
    }
}
?>
