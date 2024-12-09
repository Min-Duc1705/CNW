<?php
require_once './Config/CategoriesDB.php';
class CategoryModel {
    private $conn; // Kết nối cơ sở dữ liệu

    // Hàm khởi tạo để kết nối với cơ sở dữ liệu
    public function __construct() {
        $db = new CategoriesDB(); // Tạo đối tượng UserDB
        $this->conn = $db->getConnection(); // Lấy kết nối PDO
    }

    // Lấy tất cả các danh mục
    public function getAllCategories() {
        $query = "SELECT * FROM categories";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy một danh mục theo ID
    public function getCategoryById($id) {
        $query = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm danh mục mới
    public function addCategory($name) {
        $query = "INSERT INTO categories (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Cập nhật danh mục theo ID
    public function updateCategory($id, $name) {
        $query = "UPDATE categories SET name = :name WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        return $stmt->execute();
    }

    // Xóa danh mục theo ID
    public function deleteCategory($id) {
        $query = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}
?>
