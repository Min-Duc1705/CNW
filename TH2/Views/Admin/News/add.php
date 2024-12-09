<?php
require_once "../../../config/Database.php";
require_once "../../../controllers/NewsController.php";

$db = new Database();
$conn = $db->connect();
$controller = new NewsController($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"]) && $_POST["action"] === "add") {
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $uploadDir = '../../public/images/';
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }
            $filename = basename($_FILES['image']['name']);
            $imagePath = $uploadDir . $filename;
            if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {
                $imagePath = str_replace('../../../', '', $imagePath); // Lưu đường dẫn tương đối
            } else {
                $imagePath = null; // Nếu upload thất bại
            }
        }

        // Gọi hàm thêm mới
        $controller->createNews($_POST["title"], $_POST["content"], $imagePath, $_POST["category_id"]);
        
        // Chuyển hướng về dashboard
        header("Location: ../../Admin/dashboard.php");
        exit();
    }
}
?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<form method="POST" action="" enctype="multipart/form-data" class="p-4 border rounded shadow-sm">

    <h3 class="mb-4 text-center">Add News</h3>
    
    <!-- Title Input -->
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" name="title" id="title" placeholder="Enter title" required>
    </div>

    <!-- Content Input -->
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" name="content" id="content" placeholder="Enter content" rows="4" required></textarea>
    </div>

    <!-- Image Input -->
    <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" name="image" id="image" required>
    </div>

    <!-- Category ID Input -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Category ID</label>
        <input type="number" class="form-control" name="category_id" id="category_id" placeholder="Enter category ID" required>
    </div>

    <div class="d-flex justify-content-between mt-3">
        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary" name="action" value="add">Add News</button>
        
        <!-- Back Button -->
        <a href="../../Admin/dashboard.php" class="btn btn-secondary">Back</a>
    </div>
</form>
