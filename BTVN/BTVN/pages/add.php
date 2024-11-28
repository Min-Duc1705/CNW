<?php
include '../includes/functions.php';

// Kiểm tra nếu form đã được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ten_san_pham = $_POST['ten_san_pham'];
    $gia = $_POST['gia'];

    // Thêm sản phẩm vào mảng
    addProduct($ten_san_pham, $gia);

    // Sau khi thêm thành công, chuyển hướng về trang index.php
    header("Location: ../index.php"); 
    exit(); // Đảm bảo rằng mã sau header không bị thực thi
}
?>
