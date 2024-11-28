<?php
include 'functions.php';

$flowers = loadFlowers();
$id = $_GET['id'] ?? '';
$flower = array_filter($flowers, fn($f) => $f['id'] === $id);

if (!$flower) {
    die('Hoa không tồn tại.');
}

$flower = reset($flower);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    foreach ($flowers as &$f) {
        if ($f['id'] === $id) {
            $f['name'] = $_POST['name'];
            $f['description'] = $_POST['description'];
            $f['image'] = $_POST['image'];
            break;
        }
    }
    saveFlowers($flowers);

    header('Location: admin.php');
    exit();
}
?>

<form method="POST">
    <label for="name">Tên hoa:</label><br>
    <input type="text" id="name" name="name" value="<?= htmlspecialchars($flower['name']) ?>" required><br>
    <label for="description">Mô tả:</label><br>
    <textarea id="description" name="description" required><?= htmlspecialchars($flower['description']) ?></textarea><br>
    <label for="image">Đường dẫn ảnh:</label><br>
    <input type="text" id="image" name="image" value="<?= htmlspecialchars($flower['image']) ?>" required><br>
    <button type="submit">Cập nhật</button>
</form>
