<?php
class NewsModel {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAllNews() {
        $stmt = $this->conn->prepare("SELECT news.*, categories.name AS category_name FROM news 
                                      LEFT JOIN categories ON news.category_id = categories.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addNews($title, $content, $image, $category_id) {
        $stmt = $this->conn->prepare("INSERT INTO news (title, content, image, created_at, category_id) 
                                      VALUES (?, ?, ?, NOW(), ?)");
        return $stmt->execute([$title, $content, $image, $category_id]);
    }

    public function updateNews($id, $title, $content, $image, $category_id) {
        $stmt = $this->conn->prepare("UPDATE news SET title = ?, content = ?, image = ?, category_id = ? WHERE id = ?");
        return $stmt->execute([$title, $content, $image, $category_id, $id]);
    }

    public function deleteNews($id) {
        $stmt = $this->conn->prepare("DELETE FROM news WHERE id = ?");
        return $stmt->execute([$id]);
    }

    // Phương thức getNewsById để lấy tin tức theo ID
    public function getNewsById($id) {
        $stmt = $this->conn->prepare("SELECT news.*, categories.name AS category_name FROM news 
                                      LEFT JOIN categories ON news.category_id = categories.id 
                                      WHERE news.id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Phương thức lấy tất cả tin tức có danh mục = 1
    public function getNewsByCategory($categoryId, $limit = 5) {
        $stmt = $this->conn->prepare("SELECT * FROM news WHERE category_id = :categoryId ORDER BY created_at DESC LIMIT :limit");
        $stmt->bindValue(':categoryId', $categoryId, PDO::PARAM_INT);
        $stmt->bindValue(':limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    

}
?>
