<?php
session_start();

require_once '../../functions/auth.php';
require_once '../../functions/sanbay_functions.php';

checkLogin();

// Kiểm tra tham số ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header('Location: ../sanbay.php');
    exit();
}

$id = (int)$_GET['id'];
$sanBay = getSanBayById($id);

if (!$sanBay) {
    header('Location: ../sanbay.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chỉnh sửa Sân bay - Airline Management System</title>
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
                            <i class="fas fa-edit"></i> Chỉnh sửa Sân bay
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/sanbay_process.php">
                            <input type="hidden" name="action" value="update">
                            <input type="hidden" name="id" value="<?= $sanBay['MaSanBay'] ?>">
                            
                            <div class="mb-3">
                                <label for="tensanbay" class="form-label">Tên sân bay <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tensanbay" name="tensanbay" 
                                       value="<?= htmlspecialchars($sanBay['TenSanBay']) ?>" 
                                       maxlength="100" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="maicao" class="form-label">Mã ICAO <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="maicao" name="maicao" 
                                           value="<?= htmlspecialchars($sanBay['MaICAO']) ?>" 
                                           maxlength="4" required style="text-transform: uppercase;">
                                    <small class="form-text text-muted">4 ký tự (VD: VVTS, VVDN)</small>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="maiata" class="form-label">Mã IATA <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="maiata" name="maiata" 
                                           value="<?= htmlspecialchars($sanBay['MaIATA']) ?>" 
                                           maxlength="3" required style="text-transform: uppercase;">
                                    <small class="form-text text-muted">3 ký tự (VD: TSN, DAD)</small>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="thanhpho" class="form-label">Thành phố <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="thanhpho" name="thanhpho" 
                                           value="<?= htmlspecialchars($sanBay['ThanhPho']) ?>" 
                                           maxlength="50" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="quocgia" class="form-label">Quốc gia <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" id="quocgia" name="quocgia" 
                                           value="<?= htmlspecialchars($sanBay['QuocGia']) ?>" 
                                           maxlength="50" required>
                                </div>
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../sanbay.php" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật sân bay
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
        // Tự động chuyển đổi sang chữ in hoa cho mã ICAO và IATA
        document.getElementById('maicao').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
        
        document.getElementById('maiata').addEventListener('input', function() {
            this.value = this.value.toUpperCase();
        });
    </script>
</body>

</html>
