<?php
require_once __DIR__ . '/../Config/Database.php';

class AdminModel {
    private $conn;

    // Constructor để thiết lập kết nối cơ sở dữ liệu
    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // Phương thức đăng nhập
    public function login($username, $password) {
        try {
            // Truy vấn kiểm tra tài khoản
            $query = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();

            // Lấy thông tin người dùng
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Kiểm tra mật khẩu
            if ($user && password_verify($password, $user['password'])) {
                return $user; // Đăng nhập thành công, trả về thông tin người dùng
            }

            // Nếu sai tài khoản hoặc mật khẩu
            return false;

        } catch (PDOException $e) {
            // Xử lý lỗi
            echo "Lỗi: " . $e->getMessage();
            return false;
        }
    }

    // Phương thức đăng xuất
    public function logout() {
        // Hủy session
        session_start();
        session_unset();
        session_destroy();
    }
}
?>
