<?php 
    require_once '../Model/BookModel.php';

class BookController{
    // Hiển thị danh sách tất cả sách
    public function index() {
        $bookModel = new BookModel(); // Tạo đối tượng Book
        $books = $bookModel->getAllBook(); // Lấy tất cả sách từ model
        require_once '../View/bookList.php'; // Chuyển kết quả tới view để hiển thị
    }
    // Hiển thị chi tiết một cuốn sách
    public function show($id) {
        $bookModel = new BookModel(); // Tạo đối tượng Book
        $book = $bookModel->getBookById($id); // Lấy thông tin sách theo ID
        require_once '../View/bookDetail.php'; // Chuyển kết quả tới view để hiển thị
    }

    // Thêm sách mới
    public function create() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $author = $_POST['author'];
            $price = $_POST['price'];

            $bookModel = new BookModel();; // Tạo đối tượng Book
            $bookModel->createBook($title, $author, $price); // Tạo sách mới

            // Chuyển hướng đến trang danh sách sách sau khi thêm
            header('Location: index.php');
        } else {
            require_once '../View/createBook.php'; // Hiển thị form tạo sách
        }
    }

    // Cập nhật thông tin sách
    public function edit($id) {
        $bookModel = new BookModel(); // Tạo đối tượng Book
        $book = $bookModel->getBookById($id); // Lấy sách theo ID

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy dữ liệu từ form
            $title = $_POST['title'];
            $author = $_POST['author'];
            $price = $_POST['price'];

            $bookModel->updateBook($id, $title, $author, $price); // Cập nhật sách

            // Chuyển hướng đến trang chi tiết sách sau khi sửa
            header('Location: index.php');
        } else {
            require_once '../View/editBook.php'; // Hiển thị form chỉnh sửa sách
        }
    }

    // Xóa sách
    public function delete($id) {
        $bookModel = new BookModel(); // Tạo đối tượng Book
        $bookModel->deleteBook($id); // Xóa sách theo ID

        // Chuyển hướng đến trang danh sách sách sau khi xóa
        header('Location: index.php');
    }



}

    



?>