<?php
require_once "../functions/flight_functions.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteFlight($id)) {
        header("Location: ../views/chuyenbay.php");
        exit();
    } else {
        echo "Lỗi khi xóa!";
    }
}
?>
