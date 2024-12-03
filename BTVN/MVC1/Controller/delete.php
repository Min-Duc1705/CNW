<?php
include '../Models/functions.php';

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];
    if (deleteFlower($id)) {
        header("Location: ../View/Admin/admin.php?success=deleted");
    } else {
        header("Location: ../View/Admin/admin.php?error=notfound");
    }
} else {
    header("Location: ../View/Admin/admin.php?error=missingid");
}
exit();
?>