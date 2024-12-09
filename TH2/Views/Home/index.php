<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="../../public/css/home.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<title>Trang Chủ</title>
</head>

<body>
    <header>
        <!-- Logo -->
        <nav class="logo">
            <img src="../../public/images/logo.png" alt="Logo">
        </nav>

        <!-- Thanh tìm kiếm -->
        <nav class="search-bar">
            <form action="../../controllers/HomeController.php" method="GET">
                <input type="text" name="search" placeholder="Tìm kiếm bài viết..." required>
                <i class="fa fa-search"></i>
            </form>
        </nav>

        <!-- Nút đăng nhập / đăng ký -->
        <nav class="auth-buttons">
            <a href="../Admin/login.php" class="btn btn-success">Đăng Nhập</a>
            <a href="../Admin/register.php" class="btn btn-outline-primary">Đăng Ký</a>
        </nav>
    </header>

    <!-- Hiển thị danh mục tin tức -->
    <div class="container section">
        <?php
        // Kết nối cơ sở dữ liệu và khởi tạo controller
        require_once __DIR__ . "/../Config/Database.php";
        require_once __DIR__ . "/../Models/NewsModel.php";
        require_once __DIR__ . "/../Controllers/HomeController.php";
        
    
        
        
        $db = new Database();
        $conn = $db->connect();
        $newsModel = new NewsModel($conn);
        $controller = new HomeController($newsModel);

        // Danh sách danh mục cần hiển thị
        $categories = [
            ['id' => 1, 'name' => 'Thời Sự'],
            ['id' => 2, 'name' => 'Khoa Học'],
            ['id' => 3, 'name' => 'Thế Giới'],
            ['id' => 4, 'name' => 'Thể Thao'],
            ['id' => 5, 'name' => 'Giải Trí']
        ];

        // Hiển thị tin tức theo từng danh mục
        foreach ($categories as $category) {
            $newsList = $controller->getNewsByCategory($category['id'], 5); // Lấy 5 bài viết
        ?>
            <div class="row mb-4">
                <div class="col-12">
                    <div class="section-title">
                        <span><?= htmlspecialchars($category['name']) ?></span>
                    </div>
                </div>
                <?php foreach ($newsList as $news) { ?>
                    <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                        <div class="card" style="width: 18rem;">
                            <img src="../../public/images/<?= htmlspecialchars($news['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($news['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($news['title']) ?></h5>
                                <p class="card-text"><?= htmlspecialchars(substr($news['content'], 0, 100)) ?>...</p>
                                <a href="detail.php?id=<?= $news['id'] ?>" class="btn btn-primary">Xem Thêm</a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        <?php } ?>
    </div>
</body>

</html>