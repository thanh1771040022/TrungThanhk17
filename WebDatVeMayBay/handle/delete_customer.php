<?php
require_once "../functions/customer_functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteCustomer($id)) {
        header("Location: ../views/khachhang.php");
        exit();
    } else {
        echo "Lỗi khi xóa!";
    }
}
?>
