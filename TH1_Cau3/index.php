<?php
// Đường dẫn tới file CSV
$filename = "students.csv";

// Mảng chứa dữ liệu sinh viên
$sinhvien = [];

// Kiểm tra file có tồn tại không
if (!file_exists($filename)) {
    die("File CSV không tồn tại. Vui lòng kiểm tra lại!");
}

// Mở file CSV
if (($handle = fopen($filename, "r")) !== FALSE) {
    // Đọc dòng đầu tiên (tiêu đề)
    $headers = fgetcsv($handle, 1000, ",");

    // Đọc từng dòng dữ liệu
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        // Kết hợp tiêu đề với dữ liệu từng dòng
        $sinhvien[] = array_combine($headers, $data);
    }

    // Đóng file
    fclose($handle);
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách sinh viên</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Danh sách sinh viên</h1>
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Ngày sinh</th>
                    <th>Lớp</th>
                    <th>Điểm trung bình</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Kiểm tra nếu mảng sinh viên không rỗng
                if (!empty($sinhvien)) {
                    // Hiển thị từng sinh viên trong bảng
                    foreach ($sinhvien as $sv) {
                        echo "<tr>";
                        echo "<td>{$sv['ID']}</td>";
                        echo "<td>{$sv['Họ tên']}</td>";
                        echo "<td>{$sv['Ngày sinh']}</td>";
                        echo "<td>{$sv['Lớp']}</td>";
                        echo "<td>{$sv['Điểm trung bình']}</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5' class='text-center'>Không có dữ liệu sinh viên.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
