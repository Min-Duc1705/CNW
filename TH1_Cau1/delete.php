<?php
include './functions.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteFlower($id)) {
        header("Location: admin.php?success=deleted");
    } else {
        header("Location: admin.php?error=notfound");
    }
} else {
    header("Location: admin.php?error=missingid");
}
exit();
?>