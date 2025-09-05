<h2 align="center">
    <a href="https://dainam.edu.vn/vi/khoa-cong-nghe-thong-tin">
    🎓 Faculty of Information Technology (DaiNam University)
    </a>
</h2>
<h2 align="center">
    AIRLINE TICKET MANAGEMENT SYSTEM
</h2>
<div align="center">
    <p align="center">
        <img src="docs/logo/aiotlab_logo.png" alt="AIoTLab Logo" width="170"/>
        <img src="docs/logo/fitdnu_logo.png" alt="AIoTLab Logo" width="180"/>
        <img src="docs/logo/dnu_logo.png" alt="DaiNam University Logo" width="200"/>
    </p>

[![AIoTLab](https://img.shields.io/badge/AIoTLab-green?style=for-the-badge)](https://www.facebook.com/DNUAIoTLab)
[![Faculty of Information Technology](https://img.shields.io/badge/Faculty%20of%20Information%20Technology-blue?style=for-the-badge)](https://dainam.edu.vn/vi/khoa-cong-nghe-thong-tin)
[![DaiNam University](https://img.shields.io/badge/DaiNam%20University-orange?style=for-the-badge)](https://dainam.edu.vn)

</div>

## 📖 1. Giới thiệu
Hệ thống quản lý đặt vé máy bay (Airline Ticket Management System) được phát triển bằng PHP và MySQL. Đây là một ứng dụng web hoàn chỉnh giúp quản lý các hoạt động của hãng hàng không bao gồm quản lý khách hàng, chuyến bay, vé máy bay và đặt vé.

### Tính năng chính:
- 👥 **Quản lý khách hàng**: Thêm, sửa, xóa thông tin khách hàng
- ✈️ **Quản lý chuyến bay**: Quản lý thông tin các chuyến bay, sân bay đi/đến
- 🎫 **Quản lý vé máy bay**: Tạo và quản lý vé cho từng chuyến bay với các hạng ghế khác nhau
- 📅 **Quản lý đặt vé**: Tạo, cập nhật và theo dõi các đơn đặt vé
- 🏢 **Quản lý hãng hàng không**: Quản lý thông tin các hãng hàng không
- 🗺️ **Quản lý sân bay**: Quản lý thông tin các sân bay
- 💳 **Quản lý thanh toán**: Theo dõi các giao dịch thanh toán
- 📊 **Dashboard**: Thống kê tổng quan về tình hình hoạt động
- 🔍 **Tìm kiếm**: Tìm kiếm nhanh trong tất cả các module 

## 🔧 2. Các công nghệ được sử dụng
<div align="center">

### Hệ điều hành
[![Windows](https://img.shields.io/badge/Windows-0078D6?style=for-the-badge&logo=windows&logoColor=white)](https://www.microsoft.com/en-us/windows/)
[![Ubuntu](https://img.shields.io/badge/Ubuntu-E95420?style=for-the-badge&logo=ubuntu&logoColor=white)](https://ubuntu.com/)

### Công nghệ chính
[![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://www.php.net/)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com/)

### Web Server & Database
[![Apache](https://img.shields.io/badge/Apache-D22128?style=for-the-badge&logo=apache&logoColor=white)](https://httpd.apache.org/)
[![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://www.mysql.com/) 
[![XAMPP](https://img.shields.io/badge/XAMPP-FB7A24?style=for-the-badge&logo=xampp&logoColor=white)](https://www.apachefriends.org/)

### Database Management Tools
[![MySQL Workbench](https://img.shields.io/badge/MySQL_Workbench-4479A1?style=for-the-badge&logo=mysql&logoColor=white)](https://dev.mysql.com/downloads/workbench/)
</div>

## ⚙️ 3. Cài đặt và Sử dụng

### 3.1. Yêu cầu hệ thống

- **Web Server**: Apache/Nginx
- **PHP**: Version 7.4 trở lên
- **Database**: MySQL 5.7+ hoặc MariaDB
- **XAMPP** (khuyến nghị cho Windows)
- **MySQL Workbench** (để quản lý database)

### 3.2. Cài đặt

#### 3.2.1. Cài đặt XAMPP (Windows)
1. Tải và cài đặt [XAMPP](https://www.apachefriends.org/download.html)
2. Khởi động Apache và MySQL từ XAMPP Control Panel
3. Sao chép project vào thư mục `C:\xampp\htdocs\QuanLyDatVeMayBay\`

#### 3.2.2. Cài đặt và cấu hình MySQL Workbench
1. Tải và cài đặt [MySQL Workbench](https://dev.mysql.com/downloads/workbench/)
2. Khởi động MySQL Workbench
3. Tạo kết nối mới:
   - Connection Name: `Airline Management`
   - Hostname: `127.0.0.1` hoặc `localhost`
   - Port: `3306`
   - Username: `root`
   - Password: (nhập mật khẩu của bạn)
4. Kết nối và tạo database mới bằng script SQL:

```sql
-- Tạo CSDL
CREATE DATABASE QuanLyDatVeMayBay;
USE QuanLyDatVeMayBay;

-- Bảng Khách hàng
CREATE TABLE KhachHang (
    MaKH INT AUTO_INCREMENT PRIMARY KEY,
    HoTen VARCHAR(100) NOT NULL,
    NgaySinh DATE,
    CMND_CCCD VARCHAR(20) UNIQUE,
    SoDienThoai VARCHAR(15),
    Email VARCHAR(100),
    DiaChi VARCHAR(255)
);

-- Bảng Nhân viên
CREATE TABLE NhanVien (
    MaNV INT AUTO_INCREMENT PRIMARY KEY,
    HoTen VARCHAR(100) NOT NULL,
    NgaySinh DATE,
    ChucVu VARCHAR(50),
    SoDienThoai VARCHAR(15),
    Email VARCHAR(100),
    TenDangNhap VARCHAR(50) UNIQUE,
    MatKhau VARCHAR(255) NOT NULL
);

-- Bảng Hãng hàng không
CREATE TABLE HangHangKhong (
    MaHang INT AUTO_INCREMENT PRIMARY KEY,
    TenHang VARCHAR(100) NOT NULL,
    QuocGia VARCHAR(50),
    Website VARCHAR(100)
);

-- Bảng Sân bay
CREATE TABLE SanBay (
    MaSanBay INT AUTO_INCREMENT PRIMARY KEY,
    TenSanBay VARCHAR(100) NOT NULL,
    ThanhPho VARCHAR(100),
    QuocGia VARCHAR(50)
);

-- Bảng Chuyến bay
CREATE TABLE ChuyenBay (
    MaChuyenBay INT AUTO_INCREMENT PRIMARY KEY,
    MaHang INT,
    SanBayDi INT,
    SanBayDen INT,
    NgayGioDi DATETIME,
    NgayGioDen DATETIME,
    TrangThai VARCHAR(50),
    FOREIGN KEY (MaHang) REFERENCES HangHangKhong(MaHang),
    FOREIGN KEY (SanBayDi) REFERENCES SanBay(MaSanBay),
    FOREIGN KEY (SanBayDen) REFERENCES SanBay(MaSanBay)
);

-- Bảng Vé máy bay
CREATE TABLE VeMayBay (
    MaVe INT AUTO_INCREMENT PRIMARY KEY,
    MaChuyenBay INT,
    HangVe VARCHAR(50),
    GiaVe DECIMAL(15,2),
    TrangThaiVe VARCHAR(50),
    FOREIGN KEY (MaChuyenBay) REFERENCES ChuyenBay(MaChuyenBay)
);

-- Bảng Đặt vé
CREATE TABLE DatVe (
    MaDatVe INT AUTO_INCREMENT PRIMARY KEY,
    MaKH INT,
    MaVe INT,
    NgayDat DATETIME DEFAULT CURRENT_TIMESTAMP,
    SoLuong INT,
    TrangThaiDat VARCHAR(50),
    FOREIGN KEY (MaKH) REFERENCES KhachHang(MaKH),
    FOREIGN KEY (MaVe) REFERENCES VeMayBay(MaVe)
);

-- Bảng Thanh toán
CREATE TABLE ThanhToan (
    MaThanhToan INT AUTO_INCREMENT PRIMARY KEY,
    MaDatVe INT,
    PhuongThuc VARCHAR(50),
    SoTien DECIMAL(15,2),
    NgayThanhToan DATETIME DEFAULT CURRENT_TIMESTAMP,
    TrangThai VARCHAR(50),
    FOREIGN KEY (MaDatVe) REFERENCES DatVe(MaDatVe)
);

-- Thêm dữ liệu mẫu
-- Admin user
INSERT INTO NhanVien (HoTen, ChucVu, TenDangNhap, MatKhau) 
VALUES ('Administrator', 'Quản trị viên', 'admin', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi');

-- Hãng hàng không
INSERT INTO HangHangKhong (TenHang, QuocGia, Website) VALUES
('Vietnam Airlines', 'Việt Nam', 'https://www.vietnamairlines.com'),
('VietJet Air', 'Việt Nam', 'https://www.vietjetair.com'),
('Jetstar Pacific', 'Việt Nam', 'https://www.jetstar.com'),
('Bamboo Airways', 'Việt Nam', 'https://www.bambooairways.com');

-- Sân bay
INSERT INTO SanBay (TenSanBay, ThanhPho, QuocGia) VALUES
('Sân bay Tân Sơn Nhất', 'TP. Hồ Chí Minh', 'Việt Nam'),
('Sân bay Nội Bài', 'Hà Nội', 'Việt Nam'),
('Sân bay Đà Nẵng', 'Đà Nẵng', 'Việt Nam'),
('Sân bay Cam Ranh', 'Khánh Hòa', 'Việt Nam'),
('Sân bay Phù Cát', 'Bình Định', 'Việt Nam');
```

#### 3.2.3. Cấu hình kết nối database
Chỉnh sửa file `functions/db_connection.php`:
```php
$servername = "localhost";
$username = "root"; 
$password = "your_password"; // Mật khẩu MySQL của bạn
$dbname = "QuanLyDatVeMayBay";
```

### 3.3. Chạy ứng dụng

1. Đảm bảo Apache và MySQL đang chạy trong XAMPP
2. Truy cập: `http://localhost/QuanLyDatVeMayBay/`
3. Đăng nhập với tài khoản:
   - **Username**: admin
   - **Password**: password (mật khẩu mặc định được hash)

### 3.4. Cấu trúc project

```
QuanLyDatVeMayBay/
├── index.php                 # Trang đăng nhập
├── functions/               # Business logic
│   ├── auth.php
│   ├── db_connection.php
│   ├── khachhang_functions.php
│   ├── chuyenbay_functions.php
│   ├── vemaybaydatvemaybaydatve_functions.php
│   ├── datve_functions.php
│   └── sanbayhanghankhong_functions.php
├── handle/                  # Controllers
│   ├── login_process.php
│   ├── logout_process.php
│   └── *_process.php
├── views/                   # Views
│   ├── dashboard.php        # Trang chính
│   ├── menu.php            # Navigation
│   ├── khachhang.php       # Quản lý khách hàng
│   ├── chuyenbay.php       # Quản lý chuyến bay
│   ├── vemaybaydatvemaybaydatve.php       # Quản lý vé máy bay
│   ├── datve.php           # Quản lý đặt vé
│   ├── sanbayhanghankhong.php # Quản lý sân bay & hãng HK
│   └── */                  # Thư mục con cho create/edit
├── css/                    # Stylesheets
├── js/                     # JavaScript files
└── images/                 # Assets
```

## 🚀 4. Tính năng chính

### 4.1. Quản lý Khách hàng
- Thêm, sửa, xóa thông tin khách hàng
- Tìm kiếm khách hàng theo tên, CMND/CCCD, số điện thoại
- Lưu trữ thông tin chi tiết: họ tên, ngày sinh, CMND/CCCD, SĐT, email, địa chỉ

### 4.2. Quản lý Chuyến bay
- Tạo và quản lý thông tin chuyến bay
- Liên kết với hãng hàng không, sân bay đi và đến
- Theo dõi trạng thái chuyến bay
- Quản lý thời gian bay

### 4.3. Quản lý Vé máy bay
- Tạo vé cho từng chuyến bay
- Phân loại hạng vé (Economy, Business, First Class...)
- Quản lý giá vé và trạng thái vé
- Liên kết với chuyến bay tương ứng

### 4.4. Quản lý Đặt vé
- Tạo đơn đặt vé cho khách hàng
- Theo dõi trạng thái đặt vé
- Quản lý số lượng vé đặt
- Liên kết với khách hàng và vé máy bay

### 4.5. Cấu hình hệ thống
- Quản lý hãng hàng không
- Quản lý sân bay
- Quản lý thanh toán

## 💡 5. Hướng dẫn sử dụng

1. **Đăng nhập**: Sử dụng tài khoản admin để truy cập hệ thống
2. **Dashboard**: Xem thống kê tổng quan
3. **Quản lý dữ liệu**: Sử dụng các menu để thêm, sửa, xóa thông tin
4. **Tìm kiếm**: Sử dụng chức năng tìm kiếm trong từng module
5. **Đặt vé**: Tạo đơn đặt vé cho khách hàng

## 🤝 6. Đóng góp

Mọi đóng góp đều được chào đón! Vui lòng:
1. Fork project
2. Tạo feature branch
3. Commit thay đổi
4. Push lên branch
5. Tạo Pull Request

## 📞 7. Liên hệ

- **Trường**: Đại học Đại Nam
- **Khoa**: Công nghệ Thông tin
- **Website**: [https://dainam.edu.vn](https://dainam.edu.vn)

---
*Dự án được phát triển bởi sinh viên Khoa Công nghệ Thông tin - Đại học Đại Nam*
