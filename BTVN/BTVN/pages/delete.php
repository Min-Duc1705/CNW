<?php
include '../includes/functions.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    deleteProduct($id); // Xóa sản phẩm

    echo "success"; // Nếu xóa thành công
}
?>
