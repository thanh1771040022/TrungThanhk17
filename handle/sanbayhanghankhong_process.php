<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/sanbayhanghankhong_functions.php';

checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if ($action == 'create_hang') {
        $tenHang = trim($_POST['tenhang']);
        $quocGia = trim($_POST['quocgia']);
        $website = trim($_POST['website']);
        
        if (empty($tenHang) || empty($quocGia)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = createHangHangKhong($tenHang, $quocGia, $website);
            
            if ($result) {
                $_SESSION['success'] = 'Thêm hãng hàng không thành công!';
            } else {
                $_SESSION['error'] = 'Thêm hãng hàng không thất bại!';
            }
        }
        
        header('Location: ../views/sanbayhanghankhong.php?tab=hanghangkhong');
        exit();
        
    } elseif ($action == 'update_hang') {
        $maHang = $_POST['mahang'];
        $tenHang = trim($_POST['tenhang']);
        $quocGia = trim($_POST['quocgia']);
        $website = trim($_POST['website']);
        
        if (empty($tenHang) || empty($quocGia)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = updateHangHangKhong($maHang, $tenHang, $quocGia, $website);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật hãng hàng không thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật hãng hàng không thất bại!';
            }
        }
        
        header('Location: ../views/sanbayhanghankhong.php?tab=hanghangkhong');
        exit();
        
    } elseif ($action == 'delete_hang') {
        $maHang = $_POST['mahang'];
        
        $result = deleteHangHangKhong($maHang);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }
        
        header('Location: ../views/sanbayhanghankhong.php?tab=hanghangkhong');
        exit();
        
    } elseif ($action == 'create_sanbay') {
        $tenSanBay = trim($_POST['tensanbay']);
        $thanhPho = trim($_POST['thanhpho']);
        $quocGia = trim($_POST['quocgia']);
        
        if (empty($tenSanBay) || empty($thanhPho) || empty($quocGia)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = createSanBay($tenSanBay, $thanhPho, $quocGia);
            
            if ($result) {
                $_SESSION['success'] = 'Thêm sân bay thành công!';
            } else {
                $_SESSION['error'] = 'Thêm sân bay thất bại!';
            }
        }
        
        header('Location: ../views/sanbayhanghankhong.php?tab=sanbay');
        exit();
        
    } elseif ($action == 'update_sanbay') {
        $maSanBay = $_POST['masanbay'];
        $tenSanBay = trim($_POST['tensanbay']);
        $thanhPho = trim($_POST['thanhpho']);
        $quocGia = trim($_POST['quocgia']);
        
        if (empty($tenSanBay) || empty($thanhPho) || empty($quocGia)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = updateSanBay($maSanBay, $tenSanBay, $thanhPho, $quocGia);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật sân bay thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật sân bay thất bại!';
            }
        }
        
        header('Location: ../views/sanbayhanghankhong.php?tab=sanbay');
        exit();
        
    } elseif ($action == 'delete_sanbay') {
        $maSanBay = $_POST['masanbay'];
        
        $result = deleteSanBay($maSanBay);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }
        
        header('Location: ../views/sanbayhanghankhong.php?tab=sanbay');
        exit();
    }
}

header('Location: ../views/sanbayhanghankhong.php');
exit();
?>
