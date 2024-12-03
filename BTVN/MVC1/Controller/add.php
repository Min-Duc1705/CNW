<?php
session_start();
require __DIR__ . '/../Models/functions.php'; // Cập nhật đường dẫn chính xác

$error = '';
$success = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $description = trim($_POST['description']);
    $image = '';

    if (empty($name) || empty($description)) {
        $_SESSION['error'] = "Vui lòng nhập đầy đủ thông tin!";
        header("Location: add.php");
        exit();
    }

    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $uploadDir = __DIR__ . '/../public/images/';  // Sử dụng __DIR__ để lấy đường dẫn chính xác
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        $fileName = basename($_FILES['image']['name']);
        $imagePath = 'public/images/' . $fileName;  // Đường dẫn tương đối

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
        if (in_array($_FILES['image']['type'], $allowedTypes)) {
            if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadDir . $fileName)) {
                $image = $imagePath;
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

    if (addFlower($name, $description, $image)) {
        $_SESSION['success'] = "Thêm hoa thành công!";
        header("Location: ../View/Admin/admin.php");  // Đảm bảo chuyển hướng đúng
        exit();
    } else {
        $_SESSION['error'] = "Không thể thêm hoa vào cơ sở dữ liệu.";
        header("Location: add.php");
        exit();
    }
}

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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center mb-4">Thêm Hoa Mới</h2>

    <?php if ($error): ?>
        <div class="alert alert-danger" role="alert">
            <?= htmlspecialchars($error) ?>
        </div>
    <?php endif; ?>

    <?php if ($success): ?>
        <div class="alert alert-success" role="alert">
            <?= htmlspecialchars($success) ?>
        </div>
    <?php endif; ?>

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
            <a href="../View/Admin/admin.php" class="btn btn-success">Quay lại danh sách</a>
            <button type="submit" class="btn btn-warning">Thêm Hoa</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
</body>
</html>
