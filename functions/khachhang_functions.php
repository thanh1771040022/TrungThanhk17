<?php
require_once 'db_connection.php';

/**
 * Lấy tất cả khách hàng
 */
function getAllKhachHang() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM KhachHang ORDER BY MaKH DESC";
    $result = mysqli_query($conn, $sql);
    $khachhang = [];
    
    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $khachhang[] = $row;
        }
    }
    
    mysqli_close($conn);
    return $khachhang;
}

/**
 * Lấy thông tin khách hàng theo ID
 */
function getKhachHangById($maKH) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM KhachHang WHERE MaKH = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maKH);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $khachhang = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $khachhang;
}

/**
 * Thêm khách hàng mới
 */
function createKhachHang($hoTen, $ngaySinh, $cmndCccd, $soDienThoai, $email, $diaChi) {
    $conn = getDbConnection();
    $sql = "INSERT INTO KhachHang (HoTen, NgaySinh, CMND_CCCD, SoDienThoai, Email, DiaChi) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $hoTen, $ngaySinh, $cmndCccd, $soDienThoai, $email, $diaChi);
    
    $result = mysqli_stmt_execute($stmt);
    $insertId = mysqli_insert_id($conn);
    
    mysqli_close($conn);
    return $result ? $insertId : false;
}

/**
 * Cập nhật thông tin khách hàng
 */
function updateKhachHang($maKH, $hoTen, $ngaySinh, $cmndCccd, $soDienThoai, $email, $diaChi) {
    $conn = getDbConnection();
    $sql = "UPDATE KhachHang SET HoTen = ?, NgaySinh = ?, CMND_CCCD = ?, SoDienThoai = ?, Email = ?, DiaChi = ? WHERE MaKH = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssssi", $hoTen, $ngaySinh, $cmndCccd, $soDienThoai, $email, $diaChi, $maKH);
    
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return $result;
}

/**
 * Xóa khách hàng
 */
function deleteKhachHang($maKH) {
    $conn = getDbConnection();
    
    // Kiểm tra xem khách hàng có đặt vé nào không
    $checkSql = "SELECT COUNT(*) as count FROM DatVe WHERE MaKH = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "i", $maKH);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    
    if ($checkRow['count'] > 0) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Không thể xóa khách hàng đã có đặt vé'];
    }
    
    // Xóa khách hàng
    $sql = "DELETE FROM KhachHang WHERE MaKH = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maKH);
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return ['success' => $result, 'message' => $result ? 'Xóa khách hàng thành công' : 'Xóa khách hàng thất bại'];
}

/**
 * Tìm kiếm khách hàng
 */
function searchKhachHang($keyword) {
    $conn = getDbConnection();
    $keyword = "%$keyword%";
    $sql = "SELECT * FROM KhachHang WHERE HoTen LIKE ? OR CMND_CCCD LIKE ? OR SoDienThoai LIKE ? OR Email LIKE ? ORDER BY MaKH DESC";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssss", $keyword, $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $khachhang = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $khachhang[] = $row;
    }
    
    mysqli_close($conn);
    return $khachhang;
}
?>
