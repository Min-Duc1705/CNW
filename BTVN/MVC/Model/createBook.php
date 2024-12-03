<?php
require_once '../Config/database.php';

function createBook($title, $author, $price) {
    $database = new Database();
    $conn = $database->connect();

    $sql = "INSERT INTO books (title, author, price) VALUES (:title, :author, :price)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':title', $title);
    $stmt->bindParam(':author', $author);
    $stmt->bindParam(':price', $price);
    return $stmt->execute();
}
