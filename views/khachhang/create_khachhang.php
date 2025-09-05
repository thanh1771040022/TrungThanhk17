<?php
session_start();

require_once '../../functions/auth.php';

checkLogin();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Khách hàng - Airline Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
    <link href="../../css/dark-mode.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <!-- Simple navigation -->
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../dashboard.php">
                <img src="../../images/fitdnu_logo.png" height="40" alt="FIT-DNU Logo" loading="lazy" />
                Airline Management System
            </a>
        </div>
    </nav>

    <!-- Main content -->
    <main class="container mt-4">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user-plus"></i> Thêm Khách hàng mới
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/khachhang_process.php">
                            <input type="hidden" name="action" value="create">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="hoten" class="form-label">Họ tên <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="hoten" name="hoten" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ngaysinh" class="form-label">Ngày sinh</label>
                                    <input type="date" class="form-control" id="ngaysinh" name="ngaysinh">
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cmnd_cccd" class="form-label">CMND/CCCD <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="cmnd_cccd" name="cmnd_cccd" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sodienthoai" class="form-label">Số điện thoại <span class="text-danger">*</span></label>
                                    <input type="tel" class="form-control" id="sodienthoai" name="sodienthoai" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email">
                            </div>

                            <div class="mb-3">
                                <label for="diachi" class="form-label">Địa chỉ</label>
                                <textarea class="form-control" id="diachi" name="diachi" rows="3"></textarea>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../khachhang.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Lưu khách hàng
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Dark Mode JS -->
    <script src="../../js/dark-mode.js"></script>
</body>

</html>
