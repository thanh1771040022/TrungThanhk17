<?php
session_start();

require_once '../functions/auth.php';
require_once '../functions/chuyenbay_functions.php';

checkLogin();

// Lấy danh sách chuyến bay
$chuyenbay = getAllChuyenBay();
?>

<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Chuyến bay - Airline Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="../css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body>
    <?php include 'menu.php'; ?>

    <!-- Main content -->
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Quản lý Chuyến bay</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Trang chủ</a></li>
                    <li class="breadcrumb-item active">Chuyến bay</li>
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
                            <h5 class="card-title">Danh sách Chuyến bay</h5>

                            <!-- Add button -->
                            <div class="row mb-3">
                                <div class="col-md-12 text-end">
                                    <a href="chuyenbay/create_chuyenbay.php" class="btn btn-primary">
                                        <i class="fas fa-plus"></i> Thêm chuyến bay
                                    </a>
                                </div>
                            </div>

                            <!-- Table -->
                            <div class="table-responsive">
                                <table class="table table-striped table-hover">
                                    <thead class="table-primary">
                                        <tr>
                                            <th scope="col">#</th>
                                            <th scope="col">Mã CB</th>
                                            <th scope="col">Hãng HK</th>
                                            <th scope="col">Điểm đi</th>
                                            <th scope="col">Điểm đến</th>
                                            <th scope="col">Ngày/Giờ đi</th>
                                            <th scope="col">Ngày/Giờ đến</th>
                                            <th scope="col">Trạng thái</th>
                                            <th scope="col">Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (empty($chuyenbay)): ?>
                                            <tr>
                                                <td colspan="9" class="text-center">Không có dữ liệu</td>
                                            </tr>
                                        <?php else: ?>
                                            <?php foreach ($chuyenbay as $index => $cb): ?>
                                                <tr>
                                                    <td><?= $index + 1 ?></td>
                                                    <td><?= htmlspecialchars($cb['MaChuyenBay']) ?></td>
                                                    <td><?= htmlspecialchars($cb['TenHang']) ?></td>
                                                    <td><?= htmlspecialchars($cb['SanBayDiTen']) ?> (<?= htmlspecialchars($cb['ThanhPhoDi']) ?>)</td>
                                                    <td><?= htmlspecialchars($cb['SanBayDenTen']) ?> (<?= htmlspecialchars($cb['ThanhPhoDen']) ?>)</td>
                                                    <td><?= date('d/m/Y H:i', strtotime($cb['NgayGioDi'])) ?></td>
                                                    <td><?= date('d/m/Y H:i', strtotime($cb['NgayGioDen'])) ?></td>
                                                    <td>
                                                        <span class="badge <?= $cb['TrangThai'] == 'Đang hoạt động' ? 'bg-success' : 'bg-secondary' ?>">
                                                            <?= htmlspecialchars($cb['TrangThai']) ?>
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group" role="group">
                                                            <a href="chuyenbay/edit_chuyenbay.php?id=<?= $cb['MaChuyenBay'] ?>" 
                                                               class="btn btn-sm btn-outline-warning" title="Sửa">
                                                                <i class="fas fa-edit"></i>
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-outline-danger" 
                                                                    data-bs-toggle="modal" data-bs-target="#deleteModal" 
                                                                    data-id="<?= $cb['MaChuyenBay'] ?>" 
                                                                    data-name="Chuyến bay <?= htmlspecialchars($cb['MaChuyenBay']) ?>"
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
        </section>

    </main>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Xác nhận xóa</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Bạn có chắc chắn muốn xóa <span id="itemName"></span>?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                    <form method="POST" action="../handle/chuyenbay_process.php" style="display: inline;">
                        <input type="hidden" name="action" value="delete">
                        <input type="hidden" name="machuyenbay" id="itemId">
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // Handle delete modal
        const deleteModal = document.getElementById('deleteModal');
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget;
            const itemId = button.getAttribute('data-id');
            const itemName = button.getAttribute('data-name');
            
            document.getElementById('itemId').value = itemId;
            document.getElementById('itemName').textContent = itemName;
        });
    </script>
</body>

</html>
