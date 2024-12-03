<?php
require_once '../Config/database.php';

function deleteBook($id) {
    $database = new Database();
    $conn = $database->connect();

    $sql = "DELETE FROM books WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
}
