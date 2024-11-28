<?php
$questions = file("questions.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Lấy đáp án đúng từ file
$answers = [];
foreach ($questions as $line) {
    if (strpos($line, "Đáp án:") !== false) {
        $answers[] = trim(substr($line, strpos($line, ":") + 1));
    }
}

// Tính điểm
$score = 0;
foreach ($_POST as $key => $userAnswer) {
    $questionNumber = (int)filter_var($key, FILTER_SANITIZE_NUMBER_INT);
    if (isset($answers[$questionNumber - 1]) && $answers[$questionNumber - 1] === $userAnswer) {
        $score++;
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Kết Quả Trắc Nghiệm</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Kết Quả Trắc Nghiệm</h1>
        <div class='alert alert-success text-center'>
            Bạn trả lời đúng <strong><?php echo $score; ?></strong>/<?php echo count($answers); ?> câu.
        </div>
        <a href="index.php" class="btn btn-primary d-block mx-auto">Làm lại</a>
    </div>
</body>
</html>
