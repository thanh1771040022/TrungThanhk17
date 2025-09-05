<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/vemaybay_functions.php';

checkLogin();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $action = $_POST['action'];
    
    if ($action == 'create') {
        $maChuyenBay = $_POST['machuyenbay'];
        $hangVe = trim($_POST['hangve']);
        $giaVe = $_POST['giave'];
        $trangThaiVe = $_POST['trangthaive'];
        
        if (empty($maChuyenBay) || empty($hangVe) || empty($giaVe)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = createVeMayBay($maChuyenBay, $hangVe, $giaVe, $trangThaiVe);
            
            if ($result) {
                $_SESSION['success'] = 'Thêm vé máy bay thành công!';
            } else {
                $_SESSION['error'] = 'Thêm vé máy bay thất bại!';
            }
        }
        
        header('Location: ../views/vemaybay.php');
        exit();
        
    } elseif ($action == 'update') {
        $maVe = $_POST['mave'];
        $maChuyenBay = $_POST['machuyenbay'];
        $hangVe = trim($_POST['hangve']);
        $giaVe = $_POST['giave'];
        $trangThaiVe = $_POST['trangthaive'];
        
        if (empty($maChuyenBay) || empty($hangVe) || empty($giaVe)) {
            $_SESSION['error'] = 'Vui lòng nhập đầy đủ thông tin bắt buộc!';
        } else {
            $result = updateVeMayBay($maVe, $maChuyenBay, $hangVe, $giaVe, $trangThaiVe);
            
            if ($result) {
                $_SESSION['success'] = 'Cập nhật vé máy bay thành công!';
            } else {
                $_SESSION['error'] = 'Cập nhật vé máy bay thất bại!';
            }
        }
        
        header('Location: ../views/vemaybay.php');
        exit();
        
    } elseif ($action == 'delete') {
        $maVe = $_POST['mave'];
        
        $result = deleteVeMayBay($maVe);
        
        if ($result['success']) {
            $_SESSION['success'] = $result['message'];
        } else {
            $_SESSION['error'] = $result['message'];
        }
        
        header('Location: ../views/vemaybay.php');
        exit();
    }
}

header('Location: ../views/vemaybay.php');
exit();
?>
