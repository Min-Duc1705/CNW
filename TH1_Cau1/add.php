<?php
session_start();
require 'functions.php'; // Đổi tên để đồng bộ với file chứa các hàm xử lý như `addFlower`

// Khởi tạo giá trị mặc định cho $error và $success
$error = '';
$success = '';

// Xử lý thêm sản phẩm
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Lấy giá trị từ form
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image = '';

    // Kiểm tra trường hợp thiếu dữ liệu
    if (empty($name) || empty($description)) {
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
        header("Location: add.php");
        exit();
    }

    // Xử lý upload ảnh
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = 'images/'; // Thư mục lưu ảnh
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Tạo thư mục nếu chưa tồn tại
        }
        $fileName = basename($_FILES['image']['name']);
        $imagePath = $uploadDir . $fileName;

        // Kiểm tra loại file hợp lệ (chỉ cho phép jpg, png, gif)
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $image = $imagePath; // Lưu đường dẫn ảnh
            } else {
                $_SESSION['error'] = "Không thể tải lên hình ảnh.";
                header("Location: add.php");
                exit();
            }
        } else {
            $_SESSION['error'] = "Chỉ chấp nhận file ảnh định dạng JPG, PNG, GIF.";
            header("Location: add.php");
            exit();
        }
    } else {
        $_SESSION['error'] = "Vui lòng chọn một hình ảnh hợp lệ.";
        header("Location: add.php");
        exit();
    }

    // Thêm hoa vào danh sách
    addFlower($name, $description, $image);

    // Điều hướng về admin.php với thông báo thành công
    $_SESSION['success'] = "Thêm hoa thành công!";
    header("Location: admin.php");
    exit();
}

// Hiển thị lỗi hoặc thông báo từ session (nếu có)
$error = isset($_SESSION['error']) ? $_SESSION['error'] : '';
$success = isset($_SESSION['success']) ? $_SESSION['success'] : '';
unset($_SESSION['error'], $_SESSION['success']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Hoa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Thêm Hoa Mới</h2>
    
    <!-- Hiển thị thông báo lỗi -->
    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <!-- Hiển thị thông báo thành công -->
    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

    <!-- Form thêm hoa -->
    <form method="POST" action="add.php" enctype="multipart/form-data" class="needs-validation" novalidate>
        <div class="mb-3">
            <label for="name" class="form-label">Tên Hoa:</label>
            <input type="text" id="name" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô tả:</label>
            <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
        </div>

        <div class="mb-3">
            <label for="image" class="form-label">Hình ảnh:</label>
            <input type="file" id="image" name="image" class="form-control" required>
        </div>

        <div class="d-flex justify-content-between">
            <a href="admin.php" class="btn btn-success">Quay lại danh sách</a>
            <button type="submit" class="btn btn-warning">Thêm Hoa</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNaklUhoMOzN9Ng5D6NSMknFtISVz3TZL62NqRj5u/ffS69WWanFH1cxQ7i10sH" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhG81rIwKpGL+meAZdqB1m6iJ1kk9WpQl0eDv+z8IhAXe+Ao1sg6P4s3ISzD" crossorigin="anonymous"></script>
</body>
</html>
