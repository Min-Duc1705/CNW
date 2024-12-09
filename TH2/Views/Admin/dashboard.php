<?php
require_once "../../Config/Database.php";
require_once "../../Controllers/NewsController.php";

$db = new Database();
$conn = $db->connect();
$controller = new NewsController($conn);

// Xử lý hành động
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (isset($_POST["action"])) {
        $action = $_POST["action"];
        if ($action === "add") {
            $controller->createNews($_POST["title"], $_POST["content"], $_POST["image"], $_POST["category_id"]);
        } elseif ($action === "edit") {
            $controller->editNews($_POST["id"], $_POST["title"], $_POST["content"], $_POST["image"], $_POST["category_id"]);
        } elseif ($action === "delete") {
            $controller->removeNews($_POST["id"]);
        }
    }
}

$newsList = $controller->listNews();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Dashboard</title>
    <link href="https://cdn.lineicons.com/4.0/lineicons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../../public/css/dashboard.css">
</head>

<body>
    <div class="wrapper">
        <!-- Sidebar -->
        <aside id="sidebar">
            <div class="d-flex">
                <button class="toggle-btn" type="button">
                    <i class="lni lni-grid-alt"></i>
                </button>
                <div class="sidebar-logo">
                    <a href="#">Dashboard</a>
                </div>
            </div>
            <ul class="sidebar-nav">
                <li class="sidebar-item">
                    <a href="#" class="sidebar-link">
                        <i class="lni lni-user"></i>
                        <span>News</span>
                    </a>
                </li>
            </ul>
            <div class="sidebar-footer">
                <a href="../../Views/Admin/login.php" class="sidebar-link">
                <i class="lni lni-home"></i>

                    <span>Logout</span>
                </a>
            </div>
        </aside>

        <!-- Main Content -->
        <div class="main">
            <nav class="navbar navbar-expand px-4 py-3">
                <div class="navbar-collapse collapse">
                    <ul class="navbar-nav ms-auto">
                        <li class="nav-item dropdown">
                            <a href="#" data-bs-toggle="dropdown" class="nav-icon pe-md-0">
                                <img src="../../public/images/account.png" class="avatar img-fluid" alt="User Avatar">
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
            <main class="content px-3 py-4">
                <div class="container-fluid">
                    <h3 class="fw-bold fs-4 mb-3 d-flex justify-content-between align-items-center">
                        <span>Admin Dashboard</span>
                        <a href="../Admin/News/add.php" class="btn btn-success btn-xl">Thêm mới</a>
                    </h3>
                    <div class="row">
                        <div class="col-12">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Title</th>
                                        <th>Content</th>
                                        <th>Image</th>
                                        <th>Category</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($newsList)): ?>
                                        <?php foreach ($newsList as $news): ?>
                                            <tr>
                                                <td><?= $news["id"] ?></td>
                                                <td><?= htmlspecialchars($news["title"]) ?></td>
                                                <td><?= htmlspecialchars($news["content"]) ?></td>
                                                <td>
                                                    <?php if (!empty($news["image"])): ?>
                                                        <img src="<?= htmlspecialchars($news["image"]) ?>" alt="News Image" style="width: 100px;">
                                                    <?php else: ?>
                                                        No Image
                                                    <?php endif; ?>
                                                </td>
                                                <td><?= htmlspecialchars($news["category_name"]) ?></td>
                                                <td>
                                                    <form method="POST" style="display:inline-block;">
                                                        <input type="hidden" name="action" value="delete">
                                                        <input type="hidden" name="id" value="<?= $news["id"] ?>">
                                                        <button type="submit" class="btn btn-danger btn-sm">❌</button>
                                                    </form>
                                                    <button onclick="editNews(<?= $news['id'] ?>)" class="btn btn-warning btn-sm">✏️</button>
                                                </td>
                                            </tr>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Không có tin tức nào được tìm thấy.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function editNews(id) {
            window.location.href = `../Admin/News/edit.php?id=${id}`;
        }
    </script>
</body>
</html>
