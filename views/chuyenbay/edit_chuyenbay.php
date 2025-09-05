<?php
session_start();

require_once '../../functions/auth.php';
require_once '../../functions/chuyenbay_functions.php';

checkLogin();

// Lấy ID từ URL
$maChuyenBay = $_GET['id'] ?? 0;

if (!$maChuyenBay) {
    $_SESSION['error'] = 'Không tìm thấy chuyến bay!';
    header('Location: ../chuyenbay.php');
    exit();
}

// Lấy thông tin chuyến bay
$chuyenBay = getChuyenBayById($maChuyenBay);

if (!$chuyenBay) {
    $_SESSION['error'] = 'Không tìm thấy chuyến bay!';
    header('Location: ../chuyenbay.php');
    exit();
}

// Lấy danh sách hãng hàng không và sân bay
$hangHangKhong = getAllHangHangKhong();
$sanBay = getAllSanBay();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa Chuyến bay - Airline Management System</title>
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
            <div class="col-lg-8 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-plane-departure"></i> Sửa thông tin Chuyến bay
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/chuyenbay_process.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="machuyenbay" value="<?= $chuyenBay['MaChuyenBay'] ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="mahang" class="form-label">Hãng hàng không <span class="text-danger">*</span></label>
                                    <select class="form-select" id="mahang" name="mahang" required>
                                        <option value="">Chọn hãng hàng không...</option>
                                        <?php foreach ($hangHangKhong as $hang): ?>
                                            <option value="<?= $hang['MaHang'] ?>" <?= $hang['MaHang'] == $chuyenBay['MaHang'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($hang['TenHang']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="trangThai" class="form-label">Trạng thái <span class="text-danger">*</span></label>
                                    <select class="form-select" id="trangThai" name="trangThai" required>
                                        <option value="Đang hoạt động" <?= $chuyenBay['TrangThai'] == 'Đang hoạt động' ? 'selected' : '' ?>>Đang hoạt động</option>
                                        <option value="Tạm dừng" <?= $chuyenBay['TrangThai'] == 'Tạm dừng' ? 'selected' : '' ?>>Tạm dừng</option>
                                        <option value="Hủy" <?= $chuyenBay['TrangThai'] == 'Hủy' ? 'selected' : '' ?>>Hủy</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="sanBayDi" class="form-label">Sân bay đi <span class="text-danger">*</span></label>
                                    <select class="form-select" id="sanBayDi" name="sanBayDi" required>
                                        <option value="">Chọn sân bay đi...</option>
                                        <?php foreach ($sanBay as $sb): ?>
                                            <option value="<?= $sb['MaSanBay'] ?>" <?= $sb['MaSanBay'] == $chuyenBay['SanBayDi'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($sb['TenSanBay']) ?> - <?= htmlspecialchars($sb['ThanhPho']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="sanBayDen" class="form-label">Sân bay đến <span class="text-danger">*</span></label>
                                    <select class="form-select" id="sanBayDen" name="sanBayDen" required>
                                        <option value="">Chọn sân bay đến...</option>
                                        <?php foreach ($sanBay as $sb): ?>
                                            <option value="<?= $sb['MaSanBay'] ?>" <?= $sb['MaSanBay'] == $chuyenBay['SanBayDen'] ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($sb['TenSanBay']) ?> - <?= htmlspecialchars($sb['ThanhPho']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ngayGioDi" class="form-label">Ngày giờ đi <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="ngayGioDi" name="ngayGioDi" 
                                           value="<?= date('Y-m-d\TH:i', strtotime($chuyenBay['NgayGioDi'])) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ngayGioDen" class="form-label">Ngày giờ đến <span class="text-danger">*</span></label>
                                    <input type="datetime-local" class="form-control" id="ngayGioDen" name="ngayGioDen" 
                                           value="<?= date('Y-m-d\TH:i', strtotime($chuyenBay['NgayGioDen'])) ?>" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../chuyenbay.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật chuyến bay
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
    
    <script>
        // Validation: Ngày đến phải sau ngày đi
        document.getElementById('ngayGioDen').addEventListener('change', function() {
            const ngayDi = document.getElementById('ngayGioDi').value;
            const ngayDen = this.value;
            
            if (ngayDi && ngayDen && ngayDen <= ngayDi) {
                alert('Ngày giờ đến phải sau ngày giờ đi!');
                this.value = '';
            }
        });
        
        document.getElementById('ngayGioDi').addEventListener('change', function() {
            const ngayDi = this.value;
            const ngayDen = document.getElementById('ngayGioDen').value;
            
            if (ngayDi && ngayDen && ngayDen <= ngayDi) {
                alert('Ngày giờ đến phải sau ngày giờ đi!');
                document.getElementById('ngayGioDen').value = '';
            }
        });
    </script>
</body>

</html>
