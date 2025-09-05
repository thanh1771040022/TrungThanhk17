<?php
require_once "../functions/booking_functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteBooking($id)) {
        header("Location: ../views/datve.php");
        exit();
    } else {
        echo "Lỗi khi xóa đặt vé!";
    }
}
?>
