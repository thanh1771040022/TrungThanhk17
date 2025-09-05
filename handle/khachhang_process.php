<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/khachhang_functions.php';

checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if ($action == 'create') {
        $hoTen = trim($_POST['hoten']);
        $ngaySinh = $_POST['ngaysinh'];
        $cmndCccd = trim($_POST['cmnd_cccd']);
        $soDienThoai = trim($_POST['sodienthoai']);
        $email = trim($_POST['email']);
        $diaChi = trim($_POST['diachi']);
        
        if (empty($hoTen) || empty($cmndCccd) || empty($soDienThoai)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = createKhachHang($hoTen, $ngaySinh, $cmndCccd, $soDienThoai, $email, $diaChi);
            
            if ($result) {
                $_SESSION['success'] = 'Thêm khách hàng thành công!';
            } else {
                $_SESSION['error'] = 'Thêm khách hàng thất bại!';
            }
        }
        
        header('Location: ../views/khachhang.php');
        exit();
        
    } elseif ($action == 'update') {
        $maKH = $_POST['makh'];
        $hoTen = trim($_POST['hoten']);
        $ngaySinh = $_POST['ngaysinh'];
        $cmndCccd = trim($_POST['cmnd_cccd']);
        $soDienThoai = trim($_POST['sodienthoai']);
        $email = trim($_POST['email']);
        $diaChi = trim($_POST['diachi']);
        
        if (empty($hoTen) || empty($cmndCccd) || empty($soDienThoai)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = updateKhachHang($maKH, $hoTen, $ngaySinh, $cmndCccd, $soDienThoai, $email, $diaChi);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật khách hàng thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật khách hàng thất bại!';
            }
        }
        
        header('Location: ../views/khachhang.php');
        exit();
        
    } elseif ($action == 'delete') {
        $maKH = $_POST['makh'];
        
        $result = deleteKhachHang($maKH);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }
        
        header('Location: ../views/khachhang.php');
        exit();
    }
}

header('Location: ../views/khachhang.php');
exit();
?>
