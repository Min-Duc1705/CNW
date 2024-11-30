<?php
// Cấu hình kết nối cơ sở dữ liệu
define('DB_HOST', 'localhost'); // Địa chỉ máy chủ
define('DB_USER', 'admin');      // Tên người dùng MySQL
define('DB_PASS', '123456');          // Mật khẩu MySQL
define('DB_NAME', 'FlowerSystem'); // Tên cơ sở dữ liệu

// Kết nối đến cơ sở dữ liệu
function getConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

    // Kiểm tra kết nối
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}



?>