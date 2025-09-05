<?php
require_once 'db_connection.php';

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
 * Lấy thông tin hãng hàng không theo ID
 */
function getHangHangKhongById($maHang) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM HangHangKhong WHERE MaHang = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maHang);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $hanghangkhong = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $hanghangkhong;
}

/**
 * Thêm hãng hàng không mới
 */
function createHangHangKhong($tenHang, $quocGia, $website) {
    $conn = getDbConnection();
    $sql = "INSERT INTO HangHangKhong (TenHang, QuocGia, Website) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $tenHang, $quocGia, $website);
    
    $result = mysqli_stmt_execute($stmt);
    $insertId = mysqli_insert_id($conn);
    
    mysqli_close($conn);
    return $result ? $insertId : false;
}

/**
 * Cập nhật thông tin hãng hàng không
 */
function updateHangHangKhong($maHang, $tenHang, $quocGia, $website) {
    $conn = getDbConnection();
    $sql = "UPDATE HangHangKhong SET TenHang = ?, QuocGia = ?, Website = ? WHERE MaHang = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $tenHang, $quocGia, $website, $maHang);
    
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return $result;
}

/**
 * Xóa hãng hàng không
 */
function deleteHangHangKhong($maHang) {
    $conn = getDbConnection();
    
    // Kiểm tra xem hãng hàng không có chuyến bay nào không
    $checkSql = "SELECT COUNT(*) as count FROM ChuyenBay WHERE MaHang = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "i", $maHang);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    
    if ($checkRow['count'] > 0) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Không thể xóa hãng hàng không đã có chuyến bay'];
    }
    
    // Xóa hãng hàng không
    $sql = "DELETE FROM HangHangKhong WHERE MaHang = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maHang);
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return ['success' => $result, 'message' => $result ? 'Xóa hãng hàng không thành công' : 'Xóa hãng hàng không thất bại'];
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

/**
 * Lấy thông tin sân bay theo ID
 */
function getSanBayById($maSanBay) {
    $conn = getDbConnection();
    $sql = "SELECT * FROM SanBay WHERE MaSanBay = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maSanBay);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $sanbay = mysqli_fetch_assoc($result);
    
    mysqli_close($conn);
    return $sanbay;
}

/**
 * Thêm sân bay mới
 */
function createSanBay($tenSanBay, $thanhPho, $quocGia) {
    $conn = getDbConnection();
    $sql = "INSERT INTO SanBay (TenSanBay, ThanhPho, QuocGia) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $tenSanBay, $thanhPho, $quocGia);
    
    $result = mysqli_stmt_execute($stmt);
    $insertId = mysqli_insert_id($conn);
    
    mysqli_close($conn);
    return $result ? $insertId : false;
}

/**
 * Cập nhật thông tin sân bay
 */
function updateSanBay($maSanBay, $tenSanBay, $thanhPho, $quocGia) {
    $conn = getDbConnection();
    $sql = "UPDATE SanBay SET TenSanBay = ?, ThanhPho = ?, QuocGia = ? WHERE MaSanBay = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sssi", $tenSanBay, $thanhPho, $quocGia, $maSanBay);
    
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return $result;
}

/**
 * Xóa sân bay
 */
function deleteSanBay($maSanBay) {
    $conn = getDbConnection();
    
    // Kiểm tra xem sân bay có được sử dụng trong chuyến bay không
    $checkSql = "SELECT COUNT(*) as count FROM ChuyenBay WHERE SanBayDi = ? OR SanBayDen = ?";
    $stmt = mysqli_prepare($conn, $checkSql);
    mysqli_stmt_bind_param($stmt, "ii", $maSanBay, $maSanBay);
    mysqli_stmt_execute($stmt);
    $checkResult = mysqli_stmt_get_result($stmt);
    $checkRow = mysqli_fetch_assoc($checkResult);
    
    if ($checkRow['count'] > 0) {
        mysqli_close($conn);
        return ['success' => false, 'message' => 'Không thể xóa sân bay đang được sử dụng trong chuyến bay'];
    }
    
    // Xóa sân bay
    $sql = "DELETE FROM SanBay WHERE MaSanBay = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $maSanBay);
    $result = mysqli_stmt_execute($stmt);
    
    mysqli_close($conn);
    return ['success' => $result, 'message' => $result ? 'Xóa sân bay thành công' : 'Xóa sân bay thất bại'];
}

/**
 * Tìm kiếm hãng hàng không
 */
function searchHangHangKhong($keyword) {
    $conn = getDbConnection();
    $keyword = "%$keyword%";
    $sql = "SELECT * FROM HangHangKhong WHERE TenHang LIKE ? OR QuocGia LIKE ? ORDER BY TenHang";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ss", $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $hanghangkhong = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $hanghangkhong[] = $row;
    }
    
    mysqli_close($conn);
    return $hanghangkhong;
}

/**
 * Tìm kiếm sân bay
 */
function searchSanBay($keyword) {
    $conn = getDbConnection();
    $keyword = "%$keyword%";
    $sql = "SELECT * FROM SanBay WHERE TenSanBay LIKE ? OR ThanhPho LIKE ? OR QuocGia LIKE ? ORDER BY TenSanBay";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "sss", $keyword, $keyword, $keyword);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    $sanbay = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $sanbay[] = $row;
    }
    
    mysqli_close($conn);
    return $sanbay;
}
?>
