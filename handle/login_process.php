<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    if (empty($username) || empty($password)) {
        $_SESSION['error'] = 'Vui lòng nhập đầy đủ tên đăng nhập và mật khẩu!';
        header('Location: ../index.php');
        exit();
    }
    
    require_once '../functions/auth.php';
    
    if (authenticateUser($username, $password)) {
        $_SESSION['success'] = 'Đăng nhập thành công! Chào mừng bạn đến với hệ thống quản lý vé máy bay.';
        header('Location: ../views/dashboard.php');
        exit();
    } else {
        $_SESSION['error'] = 'Tên đăng nhập hoặc mật khẩu không đúng!';
        header('Location: ../index.php');
        exit();
    }
} else {
    header('Location: ../index.php');
    exit();
}
?>
