<?php
/**
 * Hàm kiểm tra xem user đã đăng nhập chưa
 * Nếu chưa đăng nhập, chuyển hướng về trang login
 * 
 * @param string $redirectPath Đường dẫn để chuyển hướng về trang login (mặc định: '../index.php')
 */
function checkLogin($redirectPath = '../index.php') {
    // Khởi tạo session nếu chưa có
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Kiểm tra xem user đã đăng nhập chưa
    if (!isset($_SESSION['user_id']) || !isset($_SESSION['username'])) {
        // Nếu chưa đăng nhập, set thông báo lỗi và chuyển hướng
        $_SESSION['error'] = 'Bạn cần đăng nhập để truy cập trang này!';
        header('Location: ' . $redirectPath);
        exit();
    }
}

/**
 * Hàm đăng xuất user
 * Xóa tất cả session và chuyển hướng về trang login
 * 
 * @param string $redirectPath Đường dẫn để chuyển hướng sau khi logout (mặc định: '../index.php')
 */
function logout($redirectPath = '../index.php') {
    // Khởi tạo session nếu chưa có
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Hủy tất cả session
    session_unset();
    session_destroy();
    
    // Khởi tạo session mới để lưu thông báo
    session_start();
    $_SESSION['success'] = 'Đăng xuất thành công!';
    
    // Chuyển hướng về trang đăng nhập
    header('Location: ' . $redirectPath);
    exit();
}

/**
 * Hàm lấy thông tin user hiện tại
 * 
 * @return array Mảng chứa thông tin user hiện tại
 */
function getCurrentUser() {
    // Khởi tạo session nếu chưa có
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    
    // Trả về thông tin user hiện tại
    return [
        'user_id' => $_SESSION['user_id'] ?? null,
        'username' => $_SESSION['username'] ?? null,
        'full_name' => $_SESSION['full_name'] ?? null,
        'chucvu' => $_SESSION['chucvu'] ?? null
    ];
}

/**
 * Hàm xác thực user khi đăng nhập
 * 
 * @param string $username Tên đăng nhập
 * @param string $password Mật khẩu
 * @return bool True nếu xác thực thành công, False nếu thất bại
 */
function authenticateUser($username, $password) {
    require_once 'db_connection.php';
    
    $conn = getDbConnection();
    
    // Truy vấn thông tin user từ bảng users
    $sql = "SELECT id, username, password, role FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $username);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    
    if ($row = mysqli_fetch_assoc($result)) {
        // Kiểm tra mật khẩu (plain text)
        if ($password === $row['password']) {
            // Xác thực thành công, lưu thông tin vào session
            $_SESSION['user_id'] = $row['id'];
$_SESSION['username'] = $row['username'];
            $_SESSION['full_name'] = $row['username']; // Tạm thời dùng username làm full_name
            $_SESSION['chucvu'] = $row['role'];
            
            mysqli_stmt_close($stmt);
            mysqli_close($conn);
            return true;
        }
    }
    
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
    return false;
}

/**
 * Hàm tạo hash mật khẩu
 * 
 * @param string $password Mật khẩu gốc
 * @return string Mật khẩu đã được hash
 */
function hashPassword($password) {
    return password_hash($password, PASSWORD_DEFAULT);
}
?>