<?php
include 'includes/functions.php';
$products = getProducts();
?>

<main>
    <form id="add-product-form" action="pages/add.php" method="POST">
        <input type="text" name="ten_san_pham" placeholder="Tên sản phẩm" required>
        <input type="number" name="gia" placeholder="Giá" required>
        <button type="submit">Thêm mới</button>
    </form>

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
                    <td><a href="pages/delete.php?id=<?= $product['id'] ?>" onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</main>
