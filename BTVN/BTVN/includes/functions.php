<?php
include dirname(__DIR__) . '/database/db.php'; // Bao gồm kết nối cơ sở dữ liệu và thông tin sản phẩm

// Lấy danh sách sản phẩm
function getProducts() {
    global $products;
    return $products;
}

// Thêm sản phẩm
function addProduct($ten_san_pham, $gia) {
    global $products;
    $newId = count($products) ? end($products)['id'] + 1 : 1; // Xác định ID mới nếu danh sách sản phẩm không trống
    $products[] = [
        "id" => $newId,
        "ten_san_pham" => $ten_san_pham,
        "gia" => $gia
    ];
    return true;
}

// Sửa sản phẩm
function editProduct($id, $ten_san_pham, $gia) {
    global $products;
    foreach ($products as &$product) {
        if ($product['id'] == $id) {
            $product['ten_san_pham'] = $ten_san_pham;
            $product['gia'] = $gia;
            return true;
        }
    }
    return false;
}

// Xóa sản phẩm
function deleteProduct($id) {
    global $products;
    foreach ($products as $key => $product) {
        if ($product['id'] == $id) {
            unset($products[$key]);
            $products = array_values($products); // Tái sắp xếp lại chỉ mục của mảng
            return true;
        }
    }
    return false;
}

// Lấy sản phẩm theo ID
function getProductById($id) {
    global $products;
    foreach ($products as $product) {
        if ($product['id'] == $id) {
            return $product;
        }
    }
    return null; // Nếu không tìm thấy sản phẩm có ID tương ứng
}
