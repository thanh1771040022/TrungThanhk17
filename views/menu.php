<?php
// Sử dụng __DIR__ để tính toán đường dẫn chính xác từ vị trí file hiện tại
require_once __DIR__ . '/../functions/auth.php';
checkLogin(__DIR__ . '/../index.php');
$currentUser = getCurrentUser();
?>
<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang chủ</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../css/dark-mode.css">
    <style>
        /* Navbar xanh lá nhạt */
        .navbar {
            background: linear-gradient(90deg, #d4edda, #c3e6cb);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar-brand img {
            transition: transform 0.3s ease;
        }
        .navbar-brand img:hover {
            transform: scale(1.1);
        }
        .navbar-nav .nav-link {
            color: #155724 !important;
            font-weight: 500;
            transition: all 0.2s ease;
            border-radius: 6px;
            padding: 8px 14px;
        }
        .navbar-nav .nav-link:hover {
            background-color: #28a745;
            color: #fff !important;
        }
        .navbar-nav .nav-link.active {
            background-color: #218838;
            color: #fff !important;
        }
        .dropdown-menu {
            border-radius: 8px;
        }
        .dropdown-item:hover {
            background-color: #28a745;
            color: #fff;
        }
        .theme-toggle {
            border: none;
            background: #28a745;
            color: #fff;
            border-radius: 50%;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }
        .theme-toggle:hover {
            background: #218838;
        }
        .dropdown-toggle img {
            border: 2px solid #28a745;
        }
    </style>
</head>

<body>
    <?php $currentPage = basename($_SERVER['PHP_SELF']); ?>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <!-- Brand -->
            <a class="navbar-brand" href="dashboard.php">
                <img src="../images/fitdnu_logo.png" height="40" alt="FIT-DNU Logo" />
            </a>

            <!-- Toggle button -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" 
                data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" 
                aria-label="Toggle navigation">
                <span><i class="fas fa-bars"></i></span>
            </button>

            <!-- Menu items -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item"><a class="nav-link <?= $currentPage=='dashboard.php'?'active':'' ?>" href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage=='khachhang.php'?'active':'' ?>" href="khachhang.php"><i class="fas fa-users"></i> Khách hàng</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage=='chuyenbay.php'?'active':'' ?>" href="chuyenbay.php"><i class="fas fa-plane"></i> Chuyến bay</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage=='vemaybay.php'?'active':'' ?>" href="vemaybay.php"><i class="fas fa-ticket-alt"></i> Vé máy bay</a></li>
                    <li class="nav-item"><a class="nav-link <?= $currentPage=='datve.php'?'active':'' ?>" href="datve.php"><i class="fas fa-calendar-check"></i> Đặt vé</a></li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="configDropdown" role="button" data-bs-toggle="dropdown">
                            <i class="fas fa-cog"></i> Cấu hình
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="sanbayhanghankhong.php?tab=hanghangkhong"><i class="fas fa-building"></i> Hãng hàng không</a></li>
                            <li><a class="dropdown-item" href="sanbayhanghankhong.php?tab=sanbay"><i class="fas fa-map-marker-alt"></i> Sân bay</a></li>
                        </ul>
                    </li>
                </ul>

                <!-- Right side -->
                <div class="d-flex align-items-center gap-3">
                    <!-- Theme toggle -->
                    <button type="button" class="theme-toggle" id="theme-toggle" title="Chuyển giao diện">
                        <i class="fas fa-moon"></i>
                    </button>
                    <!-- User -->
                    <div class="dropdown">
                        <a class="dropdown-toggle d-flex align-items-center hidden-arrow" href="#" id="userMenu" role="button" data-bs-toggle="dropdown">
                            <img src="../images/aiotlab_logo.png" class="rounded-circle" height="30" alt="Avatar" />
                            <span class="ms-2 fw-semibold"><?= htmlspecialchars($currentUser['username'] ?? 'User') ?></span>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="#"><i class="fas fa-user-circle me-2"></i> Hồ sơ</a></li>
                            <li><a class="dropdown-item" href="#"><i class="fas fa-cog me-2"></i> Cài đặt</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item text-danger" href="../handle/logout_process.php"><i class="fas fa-sign-out-alt me-2"></i> Đăng xuất</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../js/dark-mode.js"></script>
</body>
</html>
