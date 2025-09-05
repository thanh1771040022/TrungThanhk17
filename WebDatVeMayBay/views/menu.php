<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Trang quản lý</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow">
            <div class="card-body">
                <h1 class="card-title text-center mb-4">Chào mừng <span class="text-primary"><?php echo $_SESSION['username']; ?></span> đến hệ thống quản lý</h1>
                <ul class="list-group">
                    <li class="list-group-item"><a href="chuyenbay.php" class="btn btn-outline-primary w-100">Quản lý chuyến bay</a></li>
                    <li class="list-group-item"><a href="ve.php" class="btn btn-outline-primary w-100">Quản lý vé máy bay</a></li>
                    <li class="list-group-item"><a href="khachhang.php" class="btn btn-outline-primary w-100">Quản lý khách hàng</a></li>
                    <li class="list-group-item"><a href="datve.php" class="btn btn-outline-primary w-100">Quản lý đặt vé</a></li>
                    <li class="list-group-item"><a href="thanhtoan.php" class="btn btn-outline-primary w-100">Quản lý thanh toán</a></li>
                    <li class="list-group-item"><a href="../handle/logout_process.php" class="btn btn-danger w-100">Đăng xuất</a></li>
                </ul>
            </div>
        </div>
    </div>
</body>
</html>