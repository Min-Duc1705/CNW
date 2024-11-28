<?php
include '../includes/functions.php';

// Kiểm tra nếu form đã được gửi đi
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id']; // ID của sản phẩm cần sửa
    $ten_san_pham = $_POST['ten_san_pham'];
    $gia = $_POST['gia'];

    // Sửa sản phẩm
    if (editProduct($id, $ten_san_pham, $gia)) {
        // Sau khi sửa thành công, chuyển hướng về trang index.php
        header("Location: ../index.php"); 
        exit(); // Đảm bảo rằng mã sau header không bị thực thi
    }
}
?>

<!-- Mã HTML cho form sửa sản phẩm -->
<?php
if (isset($_GET['id'])) {
    $product = getProductById($_GET['id']);
    if ($product) {
?>
    <form action="edit.php" method="POST">
        <input type="hidden" name="id" value="<?= $product['id'] ?>">
        <input type="text" name="ten_san_pham" value="<?= htmlspecialchars($product['ten_san_pham']) ?>" required>
        <input type="number" name="gia" value="<?= $product['gia'] ?>" required>
        <button type="submit">Sửa</button>
    </form>
<?php
    }
}
?>
