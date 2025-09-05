<?php
require_once "db_connection.php";

// Lấy danh sách chuyến bay
function getAllFlights() {
    $conn = getDbConnection();
    $sql = "SELECT cb.*, hh.TenHang, sb1.TenSanBay AS SanBayDiTen, sb2.TenSanBay AS SanBayDenTen
            FROM ChuyenBay cb
            JOIN HangHangKhong hh ON cb.MaHang = hh.MaHang
            JOIN SanBay sb1 ON cb.SanBayDi = sb1.MaSanBay
            JOIN SanBay sb2 ON cb.SanBayDen = sb2.MaSanBay";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Thêm chuyến bay
function addFlight($MaHang, $SanBayDi, $SanBayDen, $NgayGioDi, $NgayGioDen, $TrangThai) {
    $conn = getDbConnection();
    $sql = "INSERT INTO ChuyenBay (MaHang, SanBayDi, SanBayDen, NgayGioDi, NgayGioDen, TrangThai) 
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("iiisss", $MaHang, $SanBayDi, $SanBayDen, $NgayGioDi, $NgayGioDen, $TrangThai);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Xóa chuyến bay
function deleteFlight($MaChuyenBay) {
    $conn = getDbConnection();
    $sql = "DELETE FROM ChuyenBay WHERE MaChuyenBay=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaChuyenBay);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}
?>
