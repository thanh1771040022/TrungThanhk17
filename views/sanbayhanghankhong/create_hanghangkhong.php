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
    <title>Thêm Hãng hàng không - Airline Management System</title>
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
                            <i class="fas fa-building"></i> Thêm Hãng hàng không mới
                        </h5>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="../../handle/sanbayhanghankhong_process.php">
                            <input type="hidden" name="action" value="create_hang">
                            
                            <div class="mb-3">
                                <label for="tenhang" class="form-label">Tên hãng <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="tenhang" name="tenhang" required>
                            </div>

                            <div class="mb-3">
                                <label for="quocgia" class="form-label">Quốc gia <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="quocgia" name="quocgia" required>
                            </div>

                            <div class="mb-3">
                                <label for="website" class="form-label">Website</label>
                                <input type="url" class="form-control" id="website" name="website" placeholder="https://example.com">
                            </div>

                            <div class="d-flex justify-content-between">
                                <a href="../sanbayhanghankhong.php?tab=hanghangkhong" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left"></i> Quay lại
                                </a>
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Lưu hãng hàng không
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
