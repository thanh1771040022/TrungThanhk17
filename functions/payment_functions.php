<?php
require_once "db_connection.php";

// Lấy danh sách thanh toán
function getAllPayments() {
    $conn = getDbConnection();
    $sql = "SELECT ThanhToan.MaThanhToan, DatVe.MaDatVe, KhachHang.HoTen, ThanhToan.PhuongThuc,
                   ThanhToan.SoTien, ThanhToan.NgayThanhToan, ThanhToan.TrangThai
            FROM ThanhToan
            JOIN DatVe ON ThanhToan.MaDatVe = DatVe.MaDatVe
            JOIN KhachHang ON DatVe.MaKH = KhachHang.MaKH";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Thêm thanh toán
function addPayment($MaDatVe, $PhuongThuc, $SoTien, $TrangThai) {
    $conn = getDbConnection();
    $sql = "INSERT INTO ThanhToan (MaDatVe, PhuongThuc, SoTien, TrangThai) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isds", $MaDatVe, $PhuongThuc, $SoTien, $TrangThai);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Xóa thanh toán
function deletePayment($MaThanhToan) {
    $conn = getDbConnection();
    $sql = "DELETE FROM ThanhToan WHERE MaThanhToan=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaThanhToan);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Lấy danh sách đặt vé (để chọn khi thanh toán)
function getAllBookings() {
    $conn = getDbConnection();
    $sql = "SELECT DatVe.MaDatVe, KhachHang.HoTen, Ve.HangVe, ChuyenBay.NoiDi, ChuyenBay.NoiDen, ChuyenBay.NgayBay
            FROM DatVe
            JOIN KhachHang ON DatVe.MaKH = KhachHang.MaKH
            JOIN Ve ON DatVe.MaVe = Ve.MaVe
            JOIN ChuyenBay ON Ve.MaChuyenBay = ChuyenBay.MaChuyenBay";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
?>
