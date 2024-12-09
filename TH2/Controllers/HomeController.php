<?php
require_once "../Config/Database.php";
require_once "../Models/NewsModel.php"; // Import NewsModel

class HomeController {
    private $newsModel;

    public function __construct($newsModel) {
        $this->newsModel = $newsModel;
    }

    // Lấy danh sách tin mới
    public function getLatestNews($limit = 5) {
        return $this->newsModel->getLatestNews($limit);
    }

    // Lấy danh sách tin theo danh mục
    public function getNewsByCategory($categoryId, $limit = 5) {
        return $this->newsModel->getNewsByCategory($categoryId, $limit);
    }
}

// Kết nối cơ sở dữ liệu
$db = new Database();
$conn = $db->connect();

// Khởi tạo NewsModel
$newsModel = new NewsModel($conn);

// Khởi tạo HomeController và truyền NewsModel vào
$controller = new HomeController($newsModel);

// Lấy danh sách tin mới
$latestNews = $controller->getLatestNews(5);

// Ví dụ lấy danh sách tin theo danh mục (id = 1)
$categoryNews = $controller->getNewsByCategory(1, 5);
?>
