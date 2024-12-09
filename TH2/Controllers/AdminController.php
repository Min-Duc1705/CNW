<?php
require_once __DIR__ . '/../Models/AdminModel.php';

class AdminController {

    private $adminModel;

    public function __construct() {
        $this->adminModel = new AdminModel();
    }

    // Xử lý đăng nhập
    public function login() {
        session_start(); // Khởi động session

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $username = $_POST['username'];
            $password = $_POST['password'];

            // Kiểm tra đăng nhập
            $user = $this->adminModel->login($username, $password);

            if ($user) {
                $_SESSION['user'] = $user; // Lưu thông tin người dùng vào session

                // Kiểm tra vai trò
                if ($user['role'] == 1) { // Admin
                    header("Location: dashboard.php"); // Chuyển hướng đến trang dashboard admin
                } else { // User
                    header("Location: home.php"); // Chuyển hướng đến trang người dùng
                }
                exit();
            } else {
                // Nếu sai tài khoản hoặc mật khẩu
                $_SESSION['login_error'] = "Tên đăng nhập hoặc mật khẩu không đúng!";
                header("Location: login.php");
                exit();
            }
        }
    }

    // Xử lý đăng xuất
    public function logout() {
        $this->adminModel->logout(); // Hủy session
        header("Location: login.php"); // Quay lại trang đăng nhập
        exit();
    }
}
?>
