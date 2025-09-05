<?php
require_once 'db_connection.php';

/**
 * Lấy tất cả đặt vé với thông tin chi tiết
 */
function getAllDatVe() {
    $conn = getDbConnection();
    $sql = "SELECT dv.*, kh.HoTen as TenKhachHang, kh.SoDienThoai, kh.Email,
                   vmb.HangVe, vmb.GiaVe,
                   cb.NgayGioDi, cb.NgayGioDen,
                   hhk.TenHang,
                   sbdi.TenSanBay as SanBayDi, sbdi.ThanhPho as ThanhPhoDi,
                   sbden.TenSanBay as SanBayDen, sbden.ThanhPho as ThanhPhoDen
            FROM DatVe dv
            LEFT JOIN KhachHang kh ON dv.MaKH = kh.MaKH
            LEFT JOIN VeMayBay vmb ON dv.MaVe = vmb.MaVe
            LEFT JOIN ChuyenBay cb ON vmb.MaChuyenBay = cb.MaChuyenBay
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            ORDER BY dv.NgayDat DESC";
    $result = mysqli_query($conn, $sql);
    $datve = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $datve[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $datve;
}

/**
 * Lấy thông tin đặt vé theo ID
 */
function getDatVeById($maDatVe) {
    $conn = getDbConnection();
    $sql = "SELECT dv.*, kh.HoTen as TenKhachHang, kh.SoDienThoai, kh.Email,
                   vmb.HangVe, vmb.GiaVe,
                   cb.NgayGioDi, cb.NgayGioDen,
                   hhk.TenHang,
                   sbdi.TenSanBay as SanBayDi, sbdi.ThanhPho as ThanhPhoDi,
                   sbden.TenSanBay as SanBayDen, sbden.ThanhPho as ThanhPhoDen
            FROM DatVe dv
            LEFT JOIN KhachHang kh ON dv.MaKH = kh.MaKH
            LEFT JOIN VeMayBay vmb ON dv.MaVe = vmb.MaVe
            LEFT JOIN ChuyenBay cb ON vmb.MaChuyenBay = cb.MaChuyenBay
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            WHERE dv.MaDatVe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maDatVe);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $datve = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $datve;
}

/**
 * Thêm đặt vé mới
 */
function createDatVe($maKH, $maVe, $soLuong, $trangThaiDat) {
    $conn = getDbConnection();
    $sql = "INSERT INTO DatVe (MaKH, MaVe, SoLuong, TrangThaiDat) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiis", $maKH, $maVe, $soLuong, $trangThaiDat);
    
    $result = mysqli_stmt_execute($stmt);
    $insertId = mysqli_insert_id($conn);
    
    mysqli_close($conn);
    return $result ? $insertId : false;
}

/**
 * Cập nhật thông tin đặt vé
 */
function updateDatVe($maDatVe, $maKH, $maVe, $soLuong, $trangThaiDat) {
$conn = getDbConnection();
    $sql = "UPDATE DatVe SET MaKH = ?, MaVe = ?, SoLuong = ?, TrangThaiDat = ? WHERE MaDatVe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "iiisi", $maKH, $maVe, $soLuong, $trangThaiDat, $maDatVe);
    
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return $result;
}

/**
 * Xóa đặt vé
 */
function deleteDatVe($maDatVe) {
    $conn = getDbConnection();
    
    // Kiểm tra xem đặt vé có thanh toán nào không
    $checkSql = "SELECT COUNT(*) as count FROM ThanhToan WHERE MaDatVe = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "i", $maDatVe);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    
    if ($checkRow['count'] > 0) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Không thể xóa đặt vé đã có thanh toán'];
    }
    
    // Xóa đặt vé
    $sql = "DELETE FROM DatVe WHERE MaDatVe = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maDatVe);
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return ['success' => $result, 'message' => $result ? 'Xóa đặt vé thành công' : 'Xóa đặt vé thất bại'];
}

/**
 * Tìm kiếm đặt vé
 */
function searchDatVe($keyword) {
    $conn = getDbConnection();
    $keyword = "%$keyword%";
    $sql = "SELECT dv.*, kh.HoTen as TenKhachHang, kh.SoDienThoai, kh.Email,
                   vmb.HangVe, vmb.GiaVe,
                   cb.NgayGioDi, cb.NgayGioDen,
                   hhk.TenHang,
                   sbdi.TenSanBay as SanBayDi, sbdi.ThanhPho as ThanhPhoDi,
                   sbden.TenSanBay as SanBayDen, sbden.ThanhPho as ThanhPhoDen
            FROM DatVe dv
            LEFT JOIN KhachHang kh ON dv.MaKH = kh.MaKH
            LEFT JOIN VeMayBay vmb ON dv.MaVe = vmb.MaVe
            LEFT JOIN ChuyenBay cb ON vmb.MaChuyenBay = cb.MaChuyenBay
            LEFT JOIN HangHangKhong hhk ON cb.MaHang = hhk.MaHang
            LEFT JOIN SanBay sbdi ON cb.SanBayDi = sbdi.MaSanBay
            LEFT JOIN SanBay sbden ON cb.SanBayDen = sbden.MaSanBay
            WHERE kh.HoTen LIKE ? OR kh.SoDienThoai LIKE ? OR dv.TrangThaiDat LIKE ? OR hhk.TenHang LIKE ?
            ORDER BY dv.NgayDat DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $keyword, $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $datve = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $datve[] = $row;
    }
    
    mysqli_close($conn);
    return $datve;
}

/**
 * Lấy tất cả vé máy bay có sẵn để đặt vé
 */
if (!function_exists('getAvailableVeMayBayForBooking')) {
    function getAvailableVeMayBayForBooking() {
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
                WHERE vmb.TrangThaiVe = 'Còn trống'
                ORDER BY cb.NgayGioDi";
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
}
?>