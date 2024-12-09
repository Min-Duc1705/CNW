<?php
$db = new Database();
$conn = $db->connect();
if ($conn) {
    echo "Kết nối thành công";
} else {
    echo "Kết nối thất bại";
}