<?php
require_once 'db_connection.php';

/**
 * Lấy tất cả vé máy bay
 */
function getAllVeMayBay() {
    $conn = getDbConnection();
    $sql = "SELECT vmb.*, cb.NgayGioDi, cb.NgayGioDen,
                   hhk.TenHang,
                   sbdi.TenSanBay as SanBayDi, sbdi.ThanhPho as ThanhPhoDi,
                   sbden.TenSanBay as SanBayDen, sbden.ThanhPho as ThanhPhoDen
            FROM VeMayBay vmb
            LEFT JOIN ChuyenBay cb ON vmb.MaChuyenBay = cb.MaChuyenBay
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            ORDER BY cb.NgayGioDi DESC";
    $result = mysqli_query($conn, $sql);
    $vemaybaydatvemaybaydatve = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $vemaybaydatvemaybaydatve[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $vemaybaydatvemaybaydatve;
}

/**
 * Lấy thông tin vé máy bay theo ID
 */
function getVeMayBayById($maVe) {
    $conn = getDbConnection();
    $sql = "SELECT vmb.*, cb.NgayGioDi, cb.NgayGioDen,
                   hhk.TenHang,
                   sbdi.TenSanBay as SanBayDi, sbdi.ThanhPho as ThanhPhoDi,
                   sbden.TenSanBay as SanBayDen, sbden.ThanhPho as ThanhPhoDen
            FROM VeMayBay vmb
            LEFT JOIN ChuyenBay cb ON vmb.MaChuyenBay = cb.MaChuyenBay
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            WHERE vmb.MaVe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maVe);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $vemaybaydatvemaybaydatve = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $vemaybaydatvemaybaydatve;
}

/**
 * Thêm vé máy bay mới
 */
function createVeMayBay($maChuyenBay, $hangVe, $giaVe, $trangThaiVe) {
    $conn = getDbConnection();
    $sql = "INSERT INTO VeMayBay (MaChuyenBay, HangVe, GiaVe, TrangThaiVe) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isds", $maChuyenBay, $hangVe, $giaVe, $trangThaiVe);
    
    $result = mysqli_stmt_execute($stmt);
    $insertId = mysqli_insert_id($conn);
    
    mysqli_close($conn);
    return $result ? $insertId : false;
}

/**
 * Cập nhật thông tin vé máy bay
 */
function updateVeMayBay($maVe, $maChuyenBay, $hangVe, $giaVe, $trangThaiVe) {
    $conn = getDbConnection();
    $sql = "UPDATE VeMayBay SET MaChuyenBay = ?, HangVe = ?, GiaVe = ?, TrangThaiVe = ? WHERE MaVe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "isdsi", $maChuyenBay, $hangVe, $giaVe, $trangThaiVe, $maVe);
    
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return $result;
}

/**
 * Xóa vé máy bay
 */
function deleteVeMayBay($maVe) {
    $conn = getDbConnection();
    
    // Kiểm tra xem vé có được đặt không
    $checkSql = "SELECT COUNT(*) as count FROM DatVe WHERE MaVe = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "i", $maVe);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    
    if ($checkRow['count'] > 0) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Không thể xóa vé đã được đặt'];
    }
    
    // Xóa vé máy bay
    $sql = "DELETE FROM VeMayBay WHERE MaVe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maVe);
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return ['success' => $result, 'message' => $result ? 'Xóa vé máy bay thành công' : 'Xóa vé máy bay thất bại'];
}

/**
 * Tìm kiếm vé máy bay
 */
function searchVeMayBay($keyword) {
    $conn = getDbConnection();
    $keyword = "%$keyword%";
    $sql = "SELECT vmb.*, cb.NgayGioDi, cb.NgayGioDen,
                   hhk.TenHang,
                   sbdi.TenSanBay as SanBayDi, sbdi.ThanhPho as ThanhPhoDi,
                   sbden.TenSanBay as SanBayDen, sbden.ThanhPho as ThanhPhoDen
            FROM VeMayBay vmb
            LEFT JOIN ChuyenBay cb ON vmb.MaChuyenBay = cb.MaChuyenBay
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            WHERE vmb.HangVe LIKE ? OR vmb.TrangThaiVe LIKE ? OR hhk.TenHang LIKE ? OR sbdi.TenSanBay LIKE ? OR sbden.TenSanBay LIKE ?
            ORDER BY cb.NgayGioDi DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssss", $keyword, $keyword, $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $vemaybaydatvemaybaydatve = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $vemaybaydatvemaybaydatve[] = $row;
    }
    
    mysqli_close($conn);
    return $vemaybaydatvemaybaydatve;
}
?>
