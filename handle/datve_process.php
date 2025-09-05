<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/datve_functions.php';

checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if ($action == 'create') {
        $maKH = $_POST['makh'];
        $maVe = $_POST['mave'];
        $soLuong = $_POST['soluong'];
        $trangThaiDat = $_POST['trangthaidat'];
        
        if (empty($maKH) || empty($maVe) || empty($soLuong)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = createDatVe($maKH, $maVe, $soLuong, $trangThaiDat);
            
            if ($result) {
                $_SESSION['success'] = 'Tạo đặt vé thành công!';
            } else {
                $_SESSION['error'] = 'Tạo đặt vé thất bại!';
            }
        }
        
        header('Location: ../views/datve.php');
        exit();
        
    } elseif ($action == 'update') {
        $maDatVe = $_POST['madatve'];
        $maKH = $_POST['makh'];
        $maVe = $_POST['mave'];
        $soLuong = $_POST['soluong'];
        $trangThaiDat = $_POST['trangthaidat'];
        
        if (empty($maKH) || empty($maVe) || empty($soLuong)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = updateDatVe($maDatVe, $maKH, $maVe, $soLuong, $trangThaiDat);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật đặt vé thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật đặt vé thất bại!';
            }
        }
        
        header('Location: ../views/datve.php');
        exit();
        
    } elseif ($action == 'delete') {
        $maDatVe = $_POST['madatve'];
        
        $result = deleteDatVe($maDatVe);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }
        
        header('Location: ../views/datve.php');
        exit();
    }
}

header('Location: ../views/datve.php');
exit();
?>
