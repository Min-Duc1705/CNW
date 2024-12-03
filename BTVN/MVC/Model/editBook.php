<?php
require_once '../Config/database.php';

function updateBook($id, $title, $author, $price) {
    $database = new Database();
    $conn = $database->connect();

    $sql = "UPDATE books SET title = :title, author = :author, price = :price WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':price', $price);
    return $stmt->execute();
}
