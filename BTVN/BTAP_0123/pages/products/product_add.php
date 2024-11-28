<?php
$jsonFile = __DIR__ . '/../../data/products.json';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $products = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

    $maxId = 0;
    if (!empty($products)) {
        $maxId = max(array_column($products, 'id'));
    }
    $newProduct = [
        'id' => $maxId + 1,
        'name' => $_POST['name'],
        'price' => (int) $_POST['price']
    ];
    $products[] = $newProduct;
    file_put_contents($jsonFile, json_encode($products, JSON_PRETTY_PRINT));
    header('Location: ../../index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">Thêm sản phẩm mới</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá thành:</label>
                <input type="number" name="price" id="price" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm sản phẩm</button>
            <a href="../../index.php" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
</body>

</html>