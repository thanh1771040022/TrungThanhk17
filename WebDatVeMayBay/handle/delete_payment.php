<?php
require_once "../functions/payment_functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deletePayment($id)) {
        header("Location: ../views/thanhtoan.php");
        exit();
    } else {
        echo "Lỗi khi xóa thanh toán!";
    }
}
?>
