<?php
$questions = [];

// Xử lý file tải lên
if (isset($_FILES['fileTXT'])) {
    $file = $_FILES['fileTXT']['tmp_name'];

    // Kiểm tra nếu file được tải lên hợp lệ
    if (is_uploaded_file($file)) {
        // Đọc nội dung file vào mảng
        $questions = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    } else {
        echo "<script>alert('Không thể đọc file. Vui lòng thử lại!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bài Trắc Nghiệm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Bài Trắc Nghiệm</h1>

        <!-- Form upload file -->
        <form method="POST" enctype="multipart/form-data" class="mb-4">
            <div class="mb-3">
                <label for="fileTXT" class="form-label">Chọn file TXT:</label>
                <input type="file" class="form-control" id="fileTXT" name="fileTXT" accept=".txt" required>
            </div>
            <button type="submit" class="btn btn-primary">Tải lên và hiển thị</button>
        </form>

        <!-- Hiển thị bài trắc nghiệm nếu có file -->
        <?php if (!empty($questions)): ?>
            <form action="submit.php" method="POST">
                <?php
                $number = 1;
                $current_question = [];

                foreach ($questions as $line) {
                    if (strpos($line, "Câu") === 0) {
                        if (!empty($current_question)) {
                            // Hiển thị câu hỏi trước
                            echo "<div class='card mb-4'>";
                            echo "<div class='card-header'><strong>{$current_question[0]}</strong></div>";
                            echo "<div class='card-body'>";
                            for ($i = 1; $i <= 4; $i++) {
                                $answer = substr($current_question[$i], 0, 1); // A, B, C, D
                                echo "<div class='form-check'>";
                                echo "<input class='form-check-input' type='radio' name='question{$number}' value='{$answer}' id='question{$number}{$answer}'>";
                                echo "<label class='form-check-label' for='question{$number}{$answer}'>{$current_question[$i]}</label>";
                                echo "</div>";
                            }
                            echo "</div>";
                            echo "</div>";
                            $number++;
                        }
                        $current_question = [];
                    }
                    $current_question[] = $line;
                }

                // Hiển thị câu hỏi cuối cùng
                if (!empty($current_question)) {
                    echo "<div class='card mb-4'>";
                    echo "<div class='card-header'><strong>{$current_question[0]}</strong></div>";
                    echo "<div class='card-body'>";
                    for ($i = 1; $i <= 4; $i++) {
                        $answer = substr($current_question[$i], 0, 1);
                        echo "<div class='form-check'>";
                        echo "<input class='form-check-input' type='radio' name='question{$number}' value='{$answer}' id='question{$number}{$answer}'>";
                        echo "<label class='form-check-label' for='question{$number}{$answer}'>{$current_question[$i]}</label>";
                        echo "</div>";
                    }
                    echo "</div>";
                    echo "</div>";
                }
                ?>
                <button type="submit" class="btn btn-primary d-block mx-auto">Nộp bài</button>
            </form>
        <?php endif; ?>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
