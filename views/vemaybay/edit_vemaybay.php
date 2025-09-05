<?php
session_start();

require_once '../../functions/auth.php';
require_once '../../functions/vemaybay_functions.php';
require_once '../../functions/chuyenbay_functions.php';

checkLogin();

// Kiểm tra tham số ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../vemaybay.php');
    exit();
}

$id = (int)$_GET['id'];
$veMayBay = getVeMayBayById($id);

if (!$veMayBay) {
    header('Location: ../vemaybay.php');
    exit();
}

// Lấy danh sách chuyến bay
$chuyenBay = getAllChuyenBay();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Vé máy bay - Airline Management System</title>
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
                            <i class="fas fa-edit"></i> Chỉnh sửa Vé máy bay #<?= $veMayBay['MaVe'] ?>
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/vemaybay_process.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $veMayBay['MaVe'] ?>">
                            
                            <div class="mb-3">
                                <label for="machuyenbay" class="form-label">Chuyến bay <span class="text-danger">*</span></label>
                                <select class="form-select" id="machuyenbay" name="machuyenbay" required>
                                    <option value="">Chọn chuyến bay...</option>
                                    <?php foreach ($chuyenBay as $cb): ?>
                                        <option value="<?= $cb['MaChuyenBay'] ?>" 
                                                <?= ($cb['MaChuyenBay'] == $veMayBay['MaChuyenBay']) ? 'selected' : '' ?>>
                                            <?= htmlspecialchars($cb['TenHang']) ?> - 
                                            <?= htmlspecialchars($cb['SanBayDiTen']) ?> → <?= htmlspecialchars($cb['SanBayDenTen']) ?> 
                                            (<?= date('d/m/Y H:i', strtotime($cb['NgayGioDi'])) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="hangve" class="form-label">Hạng vé <span class="text-danger">*</span></label>
                                    <select class="form-select" id="hangve" name="hangve" required>
                                        <option value="">Chọn hạng vé...</option>
                                        <option value="Economy" <?= ($veMayBay['HangVe'] == 'Economy') ? 'selected' : '' ?>>Economy</option>
                                        <option value="Business" <?= ($veMayBay['HangVe'] == 'Business') ? 'selected' : '' ?>>Business</option>
                                        <option value="First Class" <?= ($veMayBay['HangVe'] == 'First Class') ? 'selected' : '' ?>>First Class</option>
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="giave" class="form-label">Giá vé (VNĐ) <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control" id="giave" name="giave" 
                                           value="<?= htmlspecialchars($veMayBay['GiaVe']) ?>" 
                                           min="0" step="1000" required>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="trangthaive" class="form-label">Trạng thái vé <span class="text-danger">*</span></label>
                                <select class="form-select" id="trangthaive" name="trangthaive" required>
                                    <option value="Còn trống" <?= ($veMayBay['TrangThaiVe'] == 'Còn trống') ? 'selected' : '' ?>>Còn trống</option>
                                    <option value="Đã bán" <?= ($veMayBay['TrangThaiVe'] == 'Đã bán') ? 'selected' : '' ?>>Đã bán</option>
                                    <option value="Đã hủy" <?= ($veMayBay['TrangThaiVe'] == 'Đã hủy') ? 'selected' : '' ?>>Đã hủy</option>
                                </select>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../vemaybay.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật vé máy bay
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
