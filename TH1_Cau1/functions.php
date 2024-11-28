<?php
define('DATA_FILE', 'data.json');

// Lấy danh sách hoa từ file
function getFlowers() {
    if (file_exists(DATA_FILE)) {
        $json = file_get_contents(DATA_FILE);
        return json_decode($json, true) ?: [];
    }
    return [];
}

// Lấy thông tin hoa theo ID
function getFlowerById($id) {
    $flowers = getFlowers(); // Lấy danh sách hoa
    foreach ($flowers as $flower) {
        if ($flower['id'] == $id) {
            return $flower;
        }
    }
    return null; // Trả về null nếu không tìm thấy hoa
}

// Lưu danh sách hoa vào file
function saveFlowers($flowers) {
    file_put_contents(DATA_FILE, json_encode($flowers, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
}

// Thêm mới hoa
function addFlower($name, $description, $image) {
    $flowers = getFlowers();
    // Lấy ID tiếp theo
    $newId = count($flowers) > 0 ? max(array_column($flowers, 'id')) + 1 : 1;
    $flowers[] = [
        'id' => $newId,
        'name' => $name,
        'description' => $description,
        'image' => $image
    ];
    saveFlowers($flowers);
}

// Cập nhật thông tin hoa theo ID
function updateFlower($id, $newName, $newDescription, $newImage) {
    $flowers = getFlowers();
    foreach ($flowers as $key => $flower) {
        if ($flower['id'] == $id) {
            $flowers[$key] = [
                'id' => $id, // Đảm bảo không thay đổi ID
                'name' => $newName,
                'description' => $newDescription,
                'image' => $newImage ?: $flower['image'] // Nếu không có hình ảnh mới, giữ hình ảnh cũ
            ];
            saveFlowers($flowers);
            return true;
        }
    }
    return false;

}

// Xóa hoa theo ID
function deleteFlower($id) {
    $flowers = getFlowers();
    foreach ($flowers as $key => $flower) {
        if (isset($flower['id']) && $flower['id'] == $id) {
            unset($flowers[$key]);
            saveFlowers(array_values($flowers)); // Re-index mảng
            return true;
        }
    }
    return false;
}
?>
