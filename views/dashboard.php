<?php
require_once '../functions/auth.php';
require_once '../functions/khachhang_functions.php';
require_once '../functions/chuyenbay_functions.php';
require_once '../functions/datve_functions.php';
require_once '../functions/vemaybay_functions.php';

checkLogin();

// Lấy thống kê tổng quan
$totalKhachHang = count(getAllKhachHang());
$totalChuyenBay = count(getAllChuyenBay());
$totalDatVe = count(getAllDatVe());
$totalVeMayBay = count(getAllVeMayBay());
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Airline Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link href="../css/dark-mode.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php include 'menu.php'; ?>

    <!-- Main content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>

        <!-- Success/Error Messages -->
        <?php if (isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle me-2"></i><?= htmlspecialchars($_SESSION['success']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>

        <!-- Dashboard Cards -->
        <section class="section dashboard">
            <div class="row">

                <!-- Khách hàng Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Khách hàng</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-users"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $totalKhachHang ?></h6>
                                    <span class="text-muted small pt-2 ps-1">khách hàng</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Chuyến bay Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Chuyến bay</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-plane"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $totalChuyenBay ?></h6>
                                    <span class="text-muted small pt-2 ps-1">chuyến bay</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Vé máy bay Card -->
                <div class="col-xxl-3 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Vé máy bay</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-ticket-alt"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $totalVeMayBay ?></h6>
                                    <span class="text-muted small pt-2 ps-1">vé máy bay</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Đặt vé Card -->
                <div class="col-xxl-3 col-xl-12">
                    <div class="card info-card bookings-card">
                        <div class="card-body">
                            <h5 class="card-title">Đặt vé</h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="fas fa-calendar-check"></i>
                                </div>
                                <div class="ps-3">
                                    <h6><?= $totalDatVe ?></h6>
                                    <span class="text-muted small pt-2 ps-1">đặt vé</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </section>

        <!-- Recent Activities -->
        <section class="section">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Hoạt động gần đây</h5>
                            <div class="activity">
                                <div class="activity-item d-flex">
                                    <div class="activite-label">32 phút</div>
                                    <i class='bi bi-circle-fill activity-badge text-success align-self-start'></i>
                                    <div class="activity-content">
                                        Đã thêm khách hàng mới <a href="#" class="fw-bold text-dark">Nguyễn Văn A</a>
                                    </div>
                                </div>

                                <div class="activity-item d-flex">
                                    <div class="activite-label">56 phút</div>
                                    <i class='bi bi-circle-fill activity-badge text-danger align-self-start'></i>
                                    <div class="activity-content">
                                        Đã cập nhật chuyến bay <a href="#" class="fw-bold text-dark">VN123</a>
                                    </div>
                                </div>

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2 giờ</div>
                                    <i class='bi bi-circle-fill activity-badge text-primary align-self-start'></i>
                                    <div class="activity-content">
                                        Đã tạo đặt vé mới cho <a href="#" class="fw-bold text-dark">Trần Thị B</a>
                                    </div>
                                </div>

                                <div class="activity-item d-flex">
                                    <div class="activite-label">1 ngày</div>
                                    <i class='bi bi-circle-fill activity-badge text-warning align-self-start'></i>
                                    <div class="activity-content">
                                        Đã thêm vé máy bay mới cho chuyến bay <a href="#" class="fw-bold text-dark">VJ456</a>
                                    </div>
                                </div>

                                <div class="activity-item d-flex">
                                    <div class="activite-label">2 ngày</div>
                                    <i class='bi bi-circle-fill activity-badge text-muted align-self-start'></i>
                                    <div class="activity-content">
                                        Đã cập nhật thông tin sân bay <a href="#" class="fw-bold text-dark">Tân Sơn Nhất</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Dark Mode JS -->
    <script src="../js/dark-mode.js"></script>
</body>

</html>
