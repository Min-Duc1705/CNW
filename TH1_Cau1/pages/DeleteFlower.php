<?php
include 'functions.php';

$id = $_GET['id'] ?? '';
$flowers = loadFlowers();
$flowers = array_filter($flowers, fn($f) => $f['id'] !== $id);

saveFlowers($flowers);

header('Location: admin.php');
exit();
?>
