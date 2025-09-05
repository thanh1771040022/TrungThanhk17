<?php
require_once "db_connection.php";

// Lấy danh sách đặt vé
function getAllBookings() {
    $conn = getDbConnection();
    $sql = "SELECT dv.MaDatVe, kh.HoTen, ve.HangVe, sb1.TenSanBay AS NoiDi, sb2.TenSanBay AS NoiDen,
                   cb.NgayGioDi AS NgayBay, dv.SoLuong, dv.TrangThaiDat, dv.NgayDat
            FROM DatVe dv
            JOIN KhachHang kh ON dv.MaKH = kh.MaKH
            JOIN VeMayBay ve ON dv.MaVe = ve.MaVe
            JOIN ChuyenBay cb ON ve.MaChuyenBay = cb.MaChuyenBay
            JOIN SanBay sb1 ON cb.SanBayDi = sb1.MaSanBay
            JOIN SanBay sb2 ON cb.SanBayDen = sb2.MaSanBay";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Thêm đặt vé
function addBooking($MaKH, $MaVe, $SoLuong, $TrangThaiDat) {
    $conn = getDbConnection();
    $sql = "INSERT INTO DatVe (MaKH, MaVe, SoLuong, TrangThaiDat, NgayDat) VALUES (?, ?, ?, ?, NOW())";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiis", $MaKH, $MaVe, $SoLuong, $TrangThaiDat);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Xóa đặt vé
function deleteBooking($MaDatVe) {
    $conn = getDbConnection();
    $sql = "DELETE FROM DatVe WHERE MaDatVe=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaDatVe);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Lấy danh sách khách hàng (để chọn khi đặt vé)
function getAllCustomers() {
    $conn = getDbConnection();
    $sql = "SELECT MaKH, HoTen FROM KhachHang";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Lấy danh sách vé còn trống
function getAllTickets() {
    $conn = getDbConnection();
    $sql = "SELECT ve.MaVe, ve.HangVe, sb1.TenSanBay AS NoiDi, sb2.TenSanBay AS NoiDen, cb.NgayGioDi AS NgayBay
            FROM VeMayBay ve
            JOIN ChuyenBay cb ON ve.MaChuyenBay = cb.MaChuyenBay
            JOIN SanBay sb1 ON cb.SanBayDi = sb1.MaSanBay
            JOIN SanBay sb2 ON cb.SanBayDen = sb2.MaSanBay
            WHERE ve.TrangThaiVe = 'Còn trống'";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
?>
