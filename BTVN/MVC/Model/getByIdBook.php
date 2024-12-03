<?php
require_once '../Config/database.php';

function getBookById($id) {
    $database = new Database();
    $conn = $database->connect();

    $sql = "SELECT * FROM books WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
