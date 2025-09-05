<?php
require_once "db_connection.php";

// Lấy danh sách khách hàng
function getAllCustomers() {
    $conn = getDbConnection();
    $sql = "SELECT * FROM KhachHang";
    $result = $conn->query($sql);
    $conn->close();
    return $result;
}

// Thêm khách hàng
function addCustomer($HoTen, $NgaySinh, $CMND_CCCD, $SoDienThoai, $Email, $DiaChi) {
    $conn = getDbConnection();
    $sql = "INSERT INTO KhachHang (HoTen, NgaySinh, CMND_CCCD, SoDienThoai, Email, DiaChi)
            VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $HoTen, $NgaySinh, $CMND_CCCD, $SoDienThoai, $Email, $DiaChi);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}

// Xóa khách hàng
function deleteCustomer($MaKH) {
    $conn = getDbConnection();
    $sql = "DELETE FROM KhachHang WHERE MaKH=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $MaKH);
    $success = $stmt->execute();
    $stmt->close();
    $conn->close();
    return $success;
}
?>
