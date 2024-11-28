<?php
// Đường dẫn tới file JSON
$jsonFile = __DIR__ . '../../data/';

$products = file_exists($jsonFile) ? json_decode(file_get_contents($jsonFile), true) : [];

$productId = (int) $_GET['id'];
$productIndex = array_search($productId, array_column($products, 'id'));
$currentProduct = $products[$productIndex];
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $products[$productIndex]['name'] = $_POST['name'];
    $products[$productIndex]['price'] = (int) $_POST['price'];
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
    <title>Sửa sản phẩm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container my-4">
        <h2 class="text-center">Sửa sản phẩm</h2>
        <form method="POST" action="">
            <div class="mb-3">
                <label for="name" class="form-label">Tên sản phẩm:</label>
                <input type="text" name="name" id="name" class="form-control" value="<?= $currentProduct['name'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Giá thành:</label>
                <input type="number" name="price" id="price" class="form-control" value="<?= $currentProduct['price'] ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật sản phẩm</button>

        </form>
    </div>
</body>

</html>
