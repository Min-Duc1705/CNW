<?php
include 'functions.php';

$flowers = loadFlowers();
?>

<h1>Danh sách các loài hoa</h1>
<div style="display: flex; flex-wrap: wrap;">
    <?php foreach ($flowers as $flower): ?>
    <div style="margin: 10px; border: 1px solid #ddd; padding: 10px;">
        <h2><?= htmlspecialchars($flower['name']) ?></h2>
        <p><?= htmlspecialchars($flower['description']) ?></p>
        <img src="<?= htmlspecialchars($flower['image']) ?>" alt="<?= htmlspecialchars($flower['name']) ?>" width="150">
    </div>
    <?php endforeach; ?>
</div>
