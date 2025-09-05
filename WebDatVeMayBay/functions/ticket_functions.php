<?php
require_once "db_connection.php";

// Lấy danh sách vé
function getAllTickets() {
    $conn = getDbConnection();
    $sql = "SELECT Ve.MaVe, Ve.MaChuyenBay, Ve.HangVe, Ve.GiaVe, Ve.TrangThaiVe, 
                   SanBayDi.TenSanBay AS NoiDi, SanBayDen.TenSanBay AS NoiDen, ChuyenBay.NgayGioDi AS NgayBay
            FROM VeMayBay Ve
            JOIN ChuyenBay ON Ve.MaChuyenBay = ChuyenBay.MaChuyenBay
            JOIN SanBay SanBayDi ON ChuyenBay.SanBayDi = SanBayDi.MaSanBay
            JOIN SanBay SanBayDen ON ChuyenBay.SanBayDen = SanBayDen.MaSanBay";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Thêm vé
function addTicket($MaChuyenBay, $HangVe, $GiaVe, $TrangThaiVe) {
    $conn = getDbConnection();
    $sql = "INSERT INTO VeMayBay (MaChuyenBay, HangVe, GiaVe, TrangThaiVe) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isds", $MaChuyenBay, $HangVe, $GiaVe, $TrangThaiVe);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Xóa vé
function deleteTicket($MaVe) {
    $conn = getDbConnection();
    $sql = "DELETE FROM VeMayBay WHERE MaVe=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaVe);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Lấy danh sách chuyến bay (để chọn khi thêm vé)
function getAllFlights() {
    $conn = getDbConnection();
    $sql = "SELECT cb.MaChuyenBay, sb1.TenSanBay AS NoiDi, sb2.TenSanBay AS NoiDen, cb.NgayGioDi
            FROM ChuyenBay cb
            JOIN SanBay sb1 ON cb.SanBayDi = sb1.MaSanBay
            JOIN SanBay sb2 ON cb.SanBayDen = sb2.MaSanBay";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}
?>
