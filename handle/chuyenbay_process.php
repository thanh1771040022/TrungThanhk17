<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/chuyenbay_functions.php';

checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if ($action == 'create') {
        $maHang = $_POST['mahang'];
        $sanBayDi = $_POST['sanBayDi'];
        $sanBayDen = $_POST['sanBayDen'];
        $ngayGioDi = $_POST['ngayGioDi'];
        $ngayGioDen = $_POST['ngayGioDen'];
        $trangThai = $_POST['trangThai'];
        
        if (empty($maHang) || empty($sanBayDi) || empty($sanBayDen) || empty($ngayGioDi) || empty($ngayGioDen)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = createChuyenBay($maHang, $sanBayDi, $sanBayDen, $ngayGioDi, $ngayGioDen, $trangThai);
            
            if ($result) {
                $_SESSION['success'] = 'Thêm chuyến bay thành công!';
            } else {
                $_SESSION['error'] = 'Thêm chuyến bay thất bại!';
            }
        }
        
        header('Location: ../views/chuyenbay.php');
        exit();
        
    } elseif ($action == 'update') {
        $maChuyenBay = $_POST['machuyenbay'];
        $maHang = $_POST['mahang'];
        $sanBayDi = $_POST['sanBayDi'];
        $sanBayDen = $_POST['sanBayDen'];
        $ngayGioDi = $_POST['ngayGioDi'];
        $ngayGioDen = $_POST['ngayGioDen'];
        $trangThai = $_POST['trangThai'];
        
        if (empty($maHang) || empty($sanBayDi) || empty($sanBayDen) || empty($ngayGioDi) || empty($ngayGioDen)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = updateChuyenBay($maChuyenBay, $maHang, $sanBayDi, $sanBayDen, $ngayGioDi, $ngayGioDen, $trangThai);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật chuyến bay thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật chuyến bay thất bại!';
            }
        }
        
        header('Location: ../views/chuyenbay.php');
        exit();
        
    } elseif ($action == 'delete') {
        $maChuyenBay = $_POST['machuyenbay'];
        
        $result = deleteChuyenBay($maChuyenBay);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }
        
        header('Location: ../views/chuyenbay.php');
        exit();
    }
}

header('Location: ../views/chuyenbay.php');
exit();
?>
