<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Thêm Vấn Đề</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <style>
        body {
            background: linear-gradient(to right, #e0f7fa, #e1bee7);
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
        }
        .card-header {
            background: teal;
            border-bottom: none;
        }
        .card-header h1 {
            font-size: 1.75rem;
            font-weight: bold;
        }
        .form-control, .form-select {
            border-radius: 8px;
        }
        .btn-primary {
            background: teal;
            border: none;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background: #4a148c;
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card shadow">
                    <div class="card-header text-white text-center">
                        <h1 class="mb-0">Thêm Vấn Đề Mới</h1>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('issues.store') }}" method="POST">
                            @csrf
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label for="computer_id" class="form-label">Máy tính</label>
                                    <select class="form-control" id="computer_id" name="computer_id" required>
                                        <option value="">Chọn máy tính</option>
                                        @foreach($computers as $computer)
                                            <option value="{{ $computer->id }}">{{ $computer->computer_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="model" class="form-label">Phiên bản</label>
                                    <select class="form-control" id="model" name="model" required>
                                        <option value="">Chọn phiên bản</option>
                                        @foreach($computers as $computer)
                                            <option value="{{ $computer->model }}">{{ $computer->model }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="reported_by" class="form-label">Người báo cáo</label>
                                    <input type="text" class="form-control" id="reported_by" name="reported_by" placeholder="Nhập tên người báo cáo" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="reported_date" class="form-label">Ngày báo cáo</label>
                                    <input type="datetime-local" class="form-control" id="reported_date" name="reported_date" required>
                                </div>
                                <div class="col-md-12">
                                    <label for="description" class="form-label">Mô tả sự cố</label>
                                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Mô tả chi tiết sự cố..." required></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label for="urgency" class="form-label">Mức độ</label>
                                    <select class="form-control" id="urgency" name="urgency" required>
                                        <option value="">Chọn mức độ</option>
                                        <option value="Low">LOW</option>
                                        <option value="Medium">Medium</option>
                                        <option value="High">High</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="status" class="form-label">Trạng thái</label>
                                    <select class="form-control" id="status" name="status" required>
                                        <option value="">Chọn trạng thái</option>
                                        <option value="Open">OPEN</option>
                                        <option value="In Progress">In Progress</option>
                                        <option value="Resolved">Resolved</option>
                                    </select>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary btn-block">Thêm Vấn Đề</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
