<?php
include 'functions.php';
$products = getProducts();
?>

<main>
    <a href="pages/add.php">Thêm mới sản phẩm</a>

    <table border="1" cellspacing="0" cellpadding="5" id="product-table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Giá thành</th>
                <th>Sửa</th>
                <th>Xóa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
                <tr id="product-<?= $product['id'] ?>">
                    <td><?= htmlspecialchars($product['ten_san_pham']) ?></td>
                    <td><?= number_format($product['gia'], 0, ',', '.') ?> VND</td>
                    <td><a href="pages/edit.php?id=<?= $product['id'] ?>">Sửa</a></td>
                    <td><a href="#" class="delete-product" data-id="<?= $product['id'] ?>">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    // Thêm mới sản phẩm
    $('#add-product-form').on('submit', function(e) {
        e.preventDefault();

        var data = $(this).serialize(); // Lấy dữ liệu từ form

        $.ajax({
            type: 'POST',
            url: 'pages/add.php',
            data: data,
            success: function(response) {
                // Thêm dòng mới vào bảng ngay lập tức
                $('#product-table tbody').append(response);
                $('#add-product-form')[0].reset(); // Reset form
            }
        });
    });

    // Sửa sản phẩm
    $(document).on('click', '.edit-product', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        // Gọi trang sửa với AJAX
        $.ajax({
            type: 'GET',
            url: 'pages/edit.php',
            data: { id: productId },
            success: function(response) {
                // Cập nhật sản phẩm trên bảng (có thể thêm giao diện form chỉnh sửa nếu cần)
                alert('Sửa thành công');
                // Thực hiện cập nhật trực tiếp vào bảng nếu cần thiết
            }
        });
    });

    // Xóa sản phẩm
    $(document).on('click', '.delete-product', function(e) {
        e.preventDefault();
        var productId = $(this).data('id');
        if (confirm('Bạn có chắc chắn muốn xóa?')) {
            $.ajax({
                type: 'GET',
                url: 'pages/delete.php',
                data: { id: productId },
                success: function(response) {
                    // Xóa dòng trong bảng ngay lập tức
                    $('#product-' + productId).remove();
                }
            });
        }
    });
});
</script>


