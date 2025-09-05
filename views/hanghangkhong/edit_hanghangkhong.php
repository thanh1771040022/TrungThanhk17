<?php
session_start();

require_once '../../functions/auth.php';
require_once '../../functions/hanghangkhong_functions.php';

checkLogin();

// Kiểm tra tham số ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../hanghangkhong.php');
    exit();
}

$id = (int)$_GET['id'];
$hangHangKhong = getHangHangKhongById($id);

if (!$hangHangKhong) {
    header('Location: ../hanghangkhong.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Hãng hàng không - Airline Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../../css/style.css" rel="stylesheet">
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
            <div class="col-lg-6 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-edit"></i> Chỉnh sửa Hãng hàng không
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/hanghangkhong_process.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $hangHangKhong['MaHang'] ?>">
                            
                            <div class="mb-3">
                                <label for="tenhang" class="form-label">Tên hãng <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tenhang" name="tenhang" 
                                       value="<?= htmlspecialchars($hangHangKhong['TenHang']) ?>" 
                                       maxlength="100" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="quocgia" class="form-label">Quốc gia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="quocgia" name="quocgia" 
                                           value="<?= htmlspecialchars($hangHangKhong['QuocGia']) ?>" 
                                           maxlength="50" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sodienthoai" class="form-label">Số điện thoại</label>
                                    <input type="tel" class="form-control" id="sodienthoai" name="sodienthoai" 
                                           value="<?= htmlspecialchars($hangHangKhong['SoDienThoai'] ?? '') ?>" 
                                           maxlength="15" pattern="[0-9+\-\s()]+">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" 
                                       value="<?= htmlspecialchars($hangHangKhong['Email'] ?? '') ?>" 
                                       maxlength="100">
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website" 
                                       value="<?= htmlspecialchars($hangHangKhong['Website'] ?? '') ?>" 
                                       maxlength="255" placeholder="https://example.com">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../hanghangkhong.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật hãng hàng không
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
</body>

</html>
