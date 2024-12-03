<?php
require_once "../Config/Database.php";

function getAllBooks() {
    $database = new Database();
    $conn = $database->connect(); // Gọi hàm connect để lấy kết nối

    $sql = "SELECT * FROM books";
    $stmt = $conn->prepare($sql);
    $stmt->execute();

    $books = $stmt->fetchAll(); // Lấy tất cả kết quả dưới dạng mảng

    $database->closeConnection(); // Đóng kết nối
    return $books;
}
?>
