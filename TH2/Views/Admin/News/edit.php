<?php
require_once "../../../Config/Database.php";
require_once "../../../Controllers/NewsController.php";

$db = new Database();
$conn = $db->connect();
$controller = new NewsController($conn);

// Kiểm tra nếu có ID từ URL
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $newsId = $_GET['id'];
    $news = $controller->getNewsById($newsId);
} else {
    // Nếu không có ID, chuyển hướng về trang danh sách
    header("Location: .../../../../Admin/dashboard.php");
    exit();
}

// Xử lý hành động nếu có (Cập nhật tin tức)
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["action"]) && $_POST["action"] === "edit") {
    $controller->editNews($_POST["id"], $_POST["title"], $_POST["content"], $_POST["image"], $_POST["category_id"]);
    header("Location: .../../../../Admin/dashboard.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit News</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h3 class="fw-bold fs-4 mb-3">Edit News</h3>
        <form method="POST" action="edit.php?id=<?= $newsId ?>" class="p-4 border rounded shadow-sm">
            <input type="hidden" name="action" value="edit">
            <input type="hidden" name="id" value="<?= $news['id'] ?>">

            <!-- Title Input -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" name="title" id="title" value="<?= htmlspecialchars($news['title']) ?>" required>
            </div>

            <!-- Content Input -->
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" name="content" id="content" rows="4" required><?= htmlspecialchars($news['content']) ?></textarea>
            </div>

            <!-- Image Input -->
            <div class="mb-3">
                <label for="image" class="form-label">Image URL</label>
                <input type="text" class="form-control" name="image" id="image" value="<?= htmlspecialchars($news['image']) ?>">
            </div>

            <!-- Category ID Input -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Category ID</label>
                <input type="number" class="form-control" name="category_id" id="category_id" value="<?= $news['category_id'] ?>" required>
            </div>

            <button type="submit" class="btn btn-warning">Update News</button>
            <a href="../dashboard.php" class="btn btn-secondary ms-2">Back to Dashboard</a>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
