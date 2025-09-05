<?php
require_once 'db_connection.php';

/**
 * Lấy tất cả chuyến bay với thông tin hãng hàng không và sân bay
 */
function getAllChuyenBay() {
    $conn = getDbConnection();
    $sql = "SELECT cb.*, hhk.TenHang as TenHang, 
                   sbdi.TenSanBay as SanBayDiTen, sbdi.ThanhPho as ThanhPhoDi, 
                   sbden.TenSanBay as SanBayDenTen, sbden.ThanhPho as ThanhPhoDen
            FROM ChuyenBay cb 
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            ORDER BY cb.NgayGioDi DESC";
    $result = mysqli_query($conn, $sql);
    $chuyenbay = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $chuyenbay[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $chuyenbay;
}

/**
 * Lấy thông tin chuyến bay theo ID
 */
function getChuyenBayById($maChuyenBay) {
    $conn = getDbConnection();
    $sql = "SELECT cb.*, hhk.TenHang as TenHang, 
                   sbdi.TenSanBay as SanBayDiTen, sbdi.ThanhPho as ThanhPhoDi, 
                   sbden.TenSanBay as SanBayDenTen, sbden.ThanhPho as ThanhPhoDen
            FROM ChuyenBay cb 
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            WHERE cb.MaChuyenBay = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maChuyenBay);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $chuyenbay = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $chuyenbay;
}

/**
 * Thêm chuyến bay mới
 */
function createChuyenBay($maHang, $sanBayDi, $sanBayDen, $ngayGioDi, $ngayGioDen, $trangThai) {
    $conn = getDbConnection();
    $sql = "INSERT INTO ChuyenBay (MaHang, SanBayDi, SanBayDen, NgayGioDi, NgayGioDen, TrangThai) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiisss", $maHang, $sanBayDi, $sanBayDen, $ngayGioDi, $ngayGioDen, $trangThai);
    
    $result = mysqli_stmt_execute($stmt);
    $insertId = mysqli_insert_id($conn);
    
    mysqli_close($conn);
    return $result ? $insertId : false;
}

/**
 * Cập nhật thông tin chuyến bay
 */
function updateChuyenBay($maChuyenBay, $maHang, $sanBayDi, $sanBayDen, $ngayGioDi, $ngayGioDen, $trangThai) {
    $conn = getDbConnection();
    $sql = "UPDATE ChuyenBay SET MaHang = ?, SanBayDi = ?, SanBayDen = ?, NgayGioDi = ?, NgayGioDen = ?, TrangThai = ? WHERE MaChuyenBay = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiisssi", $maHang, $sanBayDi, $sanBayDen, $ngayGioDi, $ngayGioDen, $trangThai, $maChuyenBay);
    
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return $result;
}

/**
 * Xóa chuyến bay
 */
function deleteChuyenBay($maChuyenBay) {
    $conn = getDbConnection();
    
    // Kiểm tra xem chuyến bay có vé nào không
    $checkSql = "SELECT COUNT(*) as count FROM VeMayBay WHERE MaChuyenBay = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "i", $maChuyenBay);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    
    if ($checkRow['count'] > 0) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Không thể xóa chuyến bay đã có vé'];
    }
    
    // Xóa chuyến bay
    $sql = "DELETE FROM ChuyenBay WHERE MaChuyenBay = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maChuyenBay);
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return ['success' => $result, 'message' => $result ? 'Xóa chuyến bay thành công' : 'Xóa chuyến bay thất bại'];
}

/**
 * Tìm kiếm chuyến bay
 */
function searchChuyenBay($keyword) {
    $conn = getDbConnection();
    $keyword = "%$keyword%";
    $sql = "SELECT cb.*, hhk.TenHang as TenHang, 
                   sbdi.TenSanBay as SanBayDiTen, sbdi.ThanhPho as ThanhPhoDi, 
                   sbden.TenSanBay as SanBayDenTen, sbden.ThanhPho as ThanhPhoDen
            FROM ChuyenBay cb 
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            WHERE hhk.TenHang LIKE ? OR sbdi.TenSanBay LIKE ? OR sbden.TenSanBay LIKE ? OR cb.TrangThai LIKE ?
            ORDER BY cb.NgayGioDi DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $keyword, $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $chuyenbay = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $chuyenbay[] = $row;
    }
    
    mysqli_close($conn);
    return $chuyenbay;
}

/**
 * Lấy tất cả hãng hàng không
 */
function getAllHangHangKhong() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM HangHangKhong ORDER BY TenHang";
    $result = mysqli_query($conn, $sql);
    $hanghangkhong = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $hanghangkhong[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $hanghangkhong;
}

/**
 * Lấy tất cả sân bay
 */
function getAllSanBay() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM SanBay ORDER BY TenSanBay";
    $result = mysqli_query($conn, $sql);
    $sanbay = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sanbay[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $sanbay;
}
?>
