<?php
include 'D:/Xamp/htdocs/TH1/Cau_1/pages/functions.php';

$flowers = loadFlowers();
?>

<h1>Quản lý loài hoa</h1>
<a href="addFlower.php">Thêm loài hoa mới</a>
<table class="table table-dark table-hover">
    <tr>
        <th>Tên hoa</th>
        <th>Mô tả</th>
        <th>Ảnh</th>
        <th>Hành động</th>
    </tr>
    <?php foreach ($flowers as $flower): ?>
    <tr>
        <td><?= htmlspecialchars($flower['name']) ?></td>
        <td><?= htmlspecialchars($flower['description']) ?></td>
        <td><img src="<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" width="100"></td>
        <td>
            <a href="EditFlower.php?id=<?= $flower['id'] ?>">Sửa</a>
            <a href="DeleteFlower.php?id=<?= $flower['id'] ?>" onclick="return confirm('Bạn có chắc chắn?')">Xóa</a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
