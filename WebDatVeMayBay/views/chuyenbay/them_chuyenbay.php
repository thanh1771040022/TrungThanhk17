<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
require_once "../functions/db_connection.php";

// Lấy danh sách hãng hàng không
$hangs = $conn->query("SELECT * FROM HangHangKhong");
// Lấy danh sách sân bay
$sanbays = $conn->query("SELECT * FROM SanBay");
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thêm chuyến bay</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="card shadow-lg p-4">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0 text-primary">✈️ Thêm chuyến bay mới</h2>
                <a href="chuyenbay.php" class="btn btn-secondary">← Quay lại</a>
            </div>

            <form method="POST" action="../handle/add_flight.php">
                <!-- Hãng hàng không -->
                <div class="mb-3">
                    <label class="form-label">Hãng hàng không</label>
                    <select name="MaHang" class="form-select" required>
                        <?php while($h = $hangs->fetch_assoc()) { ?>
                            <option value="<?= $h['MaHang'] ?>"><?= $h['TenHang'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Sân bay đi -->
                <div class="mb-3">
                    <label class="form-label">Sân bay đi</label>
                    <select name="SanBayDi" class="form-select" required>
                        <?php while($s = $sanbays->fetch_assoc()) { ?>
                            <option value="<?= $s['MaSanBay'] ?>"><?= $s['TenSanBay'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Sân bay đến -->
                <div class="mb-3">
                    <label class="form-label">Sân bay đến</label>
                    <select name="SanBayDen" class="form-select" required>
                        <?php
                        $sanbays2 = $conn->query("SELECT * FROM SanBay");
                        while($s2 = $sanbays2->fetch_assoc()) { ?>
                            <option value="<?= $s2['MaSanBay'] ?>"><?= $s2['TenSanBay'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <!-- Ngày giờ đi -->
                <div class="mb-3">
                    <label class="form-label">Ngày giờ đi</label>
                    <input type="datetime-local" name="NgayGioDi" class="form-control" required>
                </div>

                <!-- Ngày giờ đến -->
                <div class="mb-3">
                    <label class="form-label">Ngày giờ đến</label>
                    <input type="datetime-local" name="NgayGioDen" class="form-control" required>
                </div>

                <!-- Trạng thái -->
                <div class="mb-3">
                    <label class="form-label">Trạng thái</label>
                    <select name="TrangThai" class="form-select">
                        <option value="Còn chỗ" selected>Còn chỗ</option>
                        <option value="Hết chỗ">Hết chỗ</option>
                    </select>
                </div>

                <div class="text-center">
                    <button type="submit" class="btn btn-success px-4">✔ Thêm chuyến bay</button>
                    <a href="chuyenbay.php" class="btn btn-outline-secondary px-4">Hủy</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
