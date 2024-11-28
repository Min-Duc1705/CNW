<?php
$jsonFile = __DIR__ . '/data/products.json';
$products = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./style.css">
</head>

<body>
<!DOCTYPE html>
<html lang="en">
<header>
    <nav class="logo">
        <a href="../../BTAP_0123/index.php">Administraction</a>
    </nav>
    <nav>
        <ul>
            <li><a href="../index.php">Trang chủ</a></li>
            <li><a href="#">Trang ngoài</a></li>
            <li><a href="#">Thể loại</a></li>
            <li><a href="#">Tác giả</a></li>
            <li><a href="#">Bài Viết</a></li>
        </ul>
    </nav>
</header>

    <div class="container my-4">
        <div class="row">
            <div class="col-md-12 text-end mb-3">
                <a href="./pages/products/product_add.php" class="btn btn-success">
                    Thêm mới
                </a>
            </div>
            <div class="col-md-12">
                <table class="table table-bordered text-center">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Sản phẩm</th>
                            <th>Giá thành</th>
                            <th>Sửa</th>
                            <th>Xoá</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($products)): ?>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= $product['id'] ?></td>
                                    <td><?= $product['name'] ?></td>
                                    <td><?= number_format($product['price'], 0, ',', '.') ?> VND</td>
                                    <td>
                                    <a href="../BTAP_0123/pages/products/product_edit.php?id=<?= $product['id'] ?>" > 🖊️</a>

                                    </td>
                                    <td>
                                        <a href="../BTAP_0123/pages/products/product_delete.php?id=<?= $product['id'] ?>"  onclick="return confirm('Bạn có chắc chắn muốn xóa sản phẩm này?')">
                                            ✖️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <?php include(__DIR__ . '/includes/footer.php'); ?>
</body>

</html>