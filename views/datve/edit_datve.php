<?php
session_start();

require_once '../../functions/auth.php';
require_once '../../functions/datve_functions.php';
require_once '../../functions/khachhang_functions.php';
require_once '../../functions/vemaybay_functions.php';

checkLogin();

// Kiểm tra tham số ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../datve.php');
    exit();
}

$id = (int)$_GET['id'];
$datVe = getDatVeById($id);

if (!$datVe) {
    header('Location: ../datve.php');
    exit();
}

// Lấy danh sách khách hàng
$khachHang = getAllKhachHang();

// Lấy danh sách vé máy bay (bao gồm vé hiện tại và những vé còn trống)
$veMayBay = getAllVeMayBayForEdit($datVe['MaVe']);
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Đặt vé - Airline Management System</title>
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
                            <i class="fas fa-edit"></i> Chỉnh sửa Đặt vé #<?= $datVe['MaDatVe'] ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/datve_process.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $datVe['MaDatVe'] ?>">
                            
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="makhachhang" class="form-label">Khách hàng <span class="text-danger">*</span></label>
                                    <select class="form-select" id="makhachhang" name="makhachhang" required>
                                        <option value="">Chọn khách hàng...</option>
                                        <?php foreach ($khachHang as $kh): ?>
                                            <option value="<?= $kh['MaKhachHang'] ?>" 
                                                    <?= ($kh['MaKhachHang'] == $datVe['MaKhachHang']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($kh['HoTen']) ?> - <?= htmlspecialchars($kh['CCCD']) ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <label for="mave" class="form-label">Vé máy bay <span class="text-danger">*</span></label>
                                    <select class="form-select" id="mave" name="mave" required>
                                        <option value="">Chọn vé máy bay...</option>
                                        <?php foreach ($veMayBay as $ve): ?>
                                            <option value="<?= $ve['MaVe'] ?>" 
                                                    data-price="<?= $ve['GiaVe'] ?>"
                                                    <?= ($ve['MaVe'] == $datVe['MaVe']) ? 'selected' : '' ?>>
                                                <?= htmlspecialchars($ve['TenHang']) ?> - 
                                                <?= htmlspecialchars($ve['SanBayDiTen']) ?> → <?= htmlspecialchars($ve['SanBayDenTen']) ?> 
                                                (<?= $ve['HangVe'] ?> - <?= number_format($ve['GiaVe'], 0, ',', '.') ?>đ)
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="ngaydat" class="form-label">Ngày đặt <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" id="ngaydat" name="ngaydat" 
                                           value="<?= date('Y-m-d', strtotime($datVe['NgayDat'])) ?>" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="trangthaidatve" class="form-label">Trạng thái đặt vé <span class="text-danger">*</span></label>
                                    <select class="form-select" id="trangthaidatve" name="trangthaidatve" required>
                                        <option value="Đang chờ" <?= ($datVe['TrangThaiDatVe'] == 'Đang chờ') ? 'selected' : '' ?>>Đang chờ</option>
                                        <option value="Đã xác nhận" <?= ($datVe['TrangThaiDatVe'] == 'Đã xác nhận') ? 'selected' : '' ?>>Đã xác nhận</option>
                                        <option value="Đã thanh toán" <?= ($datVe['TrangThaiDatVe'] == 'Đã thanh toán') ? 'selected' : '' ?>>Đã thanh toán</option>
                                        <option value="Đã hủy" <?= ($datVe['TrangThaiDatVe'] == 'Đã hủy') ? 'selected' : '' ?>>Đã hủy</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="tongtien" class="form-label">Tổng tiền (VNĐ)</label>
                                    <input type="number" class="form-control" id="tongtien" name="tongtien" 
                                           value="<?= $datVe['TongTien'] ?>" min="0" step="1000" readonly>
                                    <small class="form-text text-muted">Tổng tiền sẽ được cập nhật khi thay đổi vé</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="ghichu" class="form-label">Ghi chú</label>
                                    <textarea class="form-control" id="ghichu" name="ghichu" rows="2" 
                                              placeholder="Ghi chú thêm (nếu có)..."><?= htmlspecialchars($datVe['GhiChu'] ?? '') ?></textarea>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../datve.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật đặt vé
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
    
    <!-- Custom JavaScript -->
    <script>
        // Tự động cập nhật tổng tiền khi chọn vé
        document.getElementById('mave').addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            const totalField = document.getElementById('tongtien');
            
            if (price) {
                totalField.value = price;
            } else {
                totalField.value = '';
            }
        });
    </script>
</body>

</html>
