<?php
include __DIR__ . '/../Config/databaseSQL.php'; // Đảm bảo chỉ nạp một lần



// Lấy danh sách hoa từ cơ sở dữ liệu
function getFlowers() {
    $conn = getConnection();
    $sql = "SELECT * FROM flowers";
    $result = $conn->query($sql);
    $flowers = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $flowers[] = $row;
        }
    }
    $conn->close();
    return $flowers;
}

// Lấy thông tin hoa theo ID
function getFlowerById($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("SELECT * FROM flowers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $flower = $result->fetch_assoc();
    $stmt->close();
    $conn->close();
    return $flower;
}

// Thêm mới hoa
function addFlower($name, $description, $image) {
    $conn = new mysqli('localhost', 'admin', '123456', 'FlowerSystem');
    if ($conn->connect_error) {
        return false; // Lỗi kết nối
    }

    $stmt = $conn->prepare("INSERT INTO flowers (name, description, image) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $description, $image);

    $result = $stmt->execute();
    $stmt->close();
    $conn->close();

    return $result; // Trả về kết quả của execute
}


// Cập nhật thông tin hoa theo ID
function updateFlower($id, $newName, $newDescription, $newImage) {
    $conn = getConnection();
    $stmt = $conn->prepare("UPDATE flowers SET name = ?, description = ?, image = ? WHERE id = ?");
    $stmt->bind_param("sssi", $newName, $newDescription, $newImage, $id);
    $stmt->execute();
    $updated = $stmt->affected_rows > 0;
    $stmt->close();
    $conn->close();
    return $updated;
}

// Xóa hoa theo ID
function deleteFlower($id) {
    $conn = getConnection();
    $stmt = $conn->prepare("DELETE FROM flowers WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $deleted = $stmt->affected_rows > 0;
    $stmt->close();
    $conn->close();
    return $deleted;
}
?>
