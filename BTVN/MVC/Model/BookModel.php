<?php 
require_once '../Config/database.php';

class BookModel {
    private $conn;

    public function __construct() {
        $database = new Database();
        $this->conn = $database->connect();
    }

    // Lấy tất cả danh sách
    public function getAllBook() {
        $sql = "select * from books";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        reset($stmt->fetchAll(PDO::FETCH_ASSOC));

    }

    // Lấy thông tin sách theo ID
    public function getBookById($id) {
        $sql = "select * from books where id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
        
    }

    // Tạo mới một quyển sách
    public function createBook($title, $author, $price) {
        $sql = "INSERT INTO books (title, author, price) VALUES (:title, :author, :price)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Cập nhật thông tin sách
    public function updateBook($id, $title, $author, $price) {
        $sql = "UPDATE books SET title = :title, author = :author, price = :price WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':author', $author);
        $stmt->bindParam(':price', $price);
        return $stmt->execute();
    }

    // Xóa sách theo ID
    public function deleteBook($id) {
        $sql = "DELETE FROM books WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}



?>