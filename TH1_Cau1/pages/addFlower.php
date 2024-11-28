<?php
include 'functions.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $flowers = loadFlowers();

    $newFlower = [
        'id' => uniqid(),
        'name' => $_POST['name'],
        'description' => $_POST['description'],
        'image' => $_POST['image'] // URL hoặc đường dẫn ảnh
    ];

    $flowers[] = $newFlower;
    saveFlowers($flowers);

    header('Location: admin.php');
    exit();
}
?>

<form method="POST">
    <label for="name">Tên hoa:</label><br>
    <input type="text" id="name" name="name" required><br>
    <label for="description">Mô tả:</label><br>
    <textarea id="description" name="description" required></textarea><br>
    <label for="image">Đường dẫn ảnh:</label><br>
    <input type="text" id="image" name="image" required><br>
    <button type="submit">Thêm hoa</button>
</form>
