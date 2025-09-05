<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/sanbayhanghankhong_functions.php';

checkLogin();

// Xác định tab hiện tại
$currentTab = $_GET['tab'] ?? 'hanghangkhong';

// Lấy dữ liệu
$hangHangKhong = getAllHangHangKhong();
$sanBay = getAllSanBay();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Sân bay & Hãng hàng không - Airline Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php include 'menu.php'; ?>

    <!-- Main content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Quản lý Sân bay & Hãng hàng không</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Cấu hình</li>
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

        <?php if (isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i><?= htmlspecialchars($_SESSION['error']) ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <section class="section">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <!-- Tabs -->
                            <ul class="nav nav-tabs" id="configTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?= $currentTab == 'hanghangkhong' ? 'active' : '' ?>" 
                                            id="hanghangkhong-tab" data-bs-toggle="tab" 
                                            data-bs-target="#hanghangkhong" type="button" role="tab">
                                        <i class="fas fa-building"></i> Hãng hàng không
                                    </button>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link <?= $currentTab == 'sanbay' ? 'active' : '' ?>" 
                                            id="sanbay-tab" data-bs-toggle="tab" 
                                            data-bs-target="#sanbay" type="button" role="tab">
                                        <i class="fas fa-map-marker-alt"></i> Sân bay
                                    </button>
                                </li>
                            </ul>

                            <div class="tab-content" id="configTabContent">
                                <!-- Tab Hãng hàng không -->
                                <div class="tab-pane fade <?= $currentTab == 'hanghangkhong' ? 'show active' : '' ?>" 
                                     id="hanghangkhong" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center my-3">
                                        <h5>Danh sách Hãng hàng không</h5>
                                        <a href="sanbayhanghankhong/create_hanghangkhong.php" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Thêm hãng hàng không
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Mã hãng</th>
                                                    <th scope="col">Tên hãng</th>
                                                    <th scope="col">Quốc gia</th>
                                                    <th scope="col">Website</th>
                                                    <th scope="col">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($hangHangKhong)): ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($hangHangKhong as $index => $hang): ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><?= htmlspecialchars($hang['MaHang']) ?></td>
                                                            <td><?= htmlspecialchars($hang['TenHang']) ?></td>
                                                            <td><?= htmlspecialchars($hang['QuocGia']) ?></td>
                                                            <td>
                                                                <?php if ($hang['Website']): ?>
                                                                    <a href="<?= htmlspecialchars($hang['Website']) ?>" target="_blank" class="text-decoration-none">
                                                                        <?= htmlspecialchars($hang['Website']) ?>
                                                                    </a>
                                                                <?php endif; ?>
                                                            </td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="sanbayhanghankhong/edit_hanghangkhong.php?id=<?= $hang['MaHang'] ?>" 
                                                                       class="btn btn-sm btn-outline-warning" title="Sửa">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                            data-bs-toggle="modal" data-bs-target="#deleteHangModal" 
                                                                            data-id="<?= $hang['MaHang'] ?>" 
                                                                            data-name="<?= htmlspecialchars($hang['TenHang']) ?>"
                                                                            title="Xóa">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!-- Tab Sân bay -->
                                <div class="tab-pane fade <?= $currentTab == 'sanbay' ? 'show active' : '' ?>" 
                                     id="sanbay" role="tabpanel">
                                    <div class="d-flex justify-content-between align-items-center my-3">
                                        <h5>Danh sách Sân bay</h5>
                                        <a href="sanbayhanghankhong/create_sanbay.php" class="btn btn-primary">
                                            <i class="fas fa-plus"></i> Thêm sân bay
                                        </a>
                                    </div>

                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Mã sân bay</th>
                                                    <th scope="col">Tên sân bay</th>
                                                    <th scope="col">Thành phố</th>
                                                    <th scope="col">Quốc gia</th>
                                                    <th scope="col">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php if (empty($sanBay)): ?>
                                                    <tr>
                                                        <td colspan="6" class="text-center">Không có dữ liệu</td>
                                                    </tr>
                                                <?php else: ?>
                                                    <?php foreach ($sanBay as $index => $sb): ?>
                                                        <tr>
                                                            <td><?= $index + 1 ?></td>
                                                            <td><?= htmlspecialchars($sb['MaSanBay']) ?></td>
                                                            <td><?= htmlspecialchars($sb['TenSanBay']) ?></td>
                                                            <td><?= htmlspecialchars($sb['ThanhPho']) ?></td>
                                                            <td><?= htmlspecialchars($sb['QuocGia']) ?></td>
                                                            <td>
                                                                <div class="btn-group" role="group">
                                                                    <a href="sanbayhanghankhong/edit_sanbay.php?id=<?= $sb['MaSanBay'] ?>" 
                                                                       class="btn btn-sm btn-outline-warning" title="Sửa">
                                                                        <i class="fas fa-edit"></i>
                                                                    </a>
                                                                    <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                            data-bs-toggle="modal" data-bs-target="#deleteSanbayModal" 
                                                                            data-id="<?= $sb['MaSanBay'] ?>" 
                                                                            data-name="<?= htmlspecialchars($sb['TenSanBay']) ?>"
                                                                            title="Xóa">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                <?php endif; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

    <!-- Delete Hang Modal -->
    <div class="modal fade" id="deleteHangModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa hãng hàng không <span id="hangName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form method="POST" action="../handle/sanbayhanghankhong_process.php" style="display: inline;">
                        <input type="hidden" name="action" value="delete_hang">
                        <input type="hidden" name="mahang" id="hangId">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Delete Sanbay Modal -->
    <div class="modal fade" id="deleteSanbayModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa sân bay <span id="sanbayName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form method="POST" action="../handle/sanbayhanghankhong_process.php" style="display: inline;">
                        <input type="hidden" name="action" value="delete_sanbay">
                        <input type="hidden" name="masanbay" id="sanbayId">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Handle delete hang modal
        const deleteHangModal = document.getElementById('deleteHangModal');
        deleteHangModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const hangId = button.getAttribute('data-id');
            const hangName = button.getAttribute('data-name');
            
            document.getElementById('hangId').value = hangId;
            document.getElementById('hangName').textContent = hangName;
        });

        // Handle delete sanbay modal
        const deleteSanbayModal = document.getElementById('deleteSanbayModal');
        deleteSanbayModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const sanbayId = button.getAttribute('data-id');
            const sanbayName = button.getAttribute('data-name');
            
            document.getElementById('sanbayId').value = sanbayId;
            document.getElementById('sanbayName').textContent = sanbayName;
        });

        // Update URL when tab changes
        document.querySelectorAll('[data-bs-toggle="tab"]').forEach(function(tab) {
            tab.addEventListener('shown.bs.tab', function(e) {
                const targetId = e.target.getAttribute('data-bs-target').replace('#', '');
                const url = new URL(window.location);
                url.searchParams.set('tab', targetId);
                window.history.pushState({}, '', url);
            });
        });
    </script>
</body>

</html>
