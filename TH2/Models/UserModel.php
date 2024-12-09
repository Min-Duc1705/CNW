<?php
// Sửa lại đường dẫn cho đúng
require_once __DIR__ . '../Config/Database.php';


class UserModel {
    private $conn;

    // Constructor để kết nối cơ sở dữ liệu
    public function __construct() {
        $db = new Database(); // Tạo đối tượng UserDB
        $this->conn = $db->getConnection(); // Lấy kết nối PDO
    }

    // Thêm người dùng mới
    public function addUser($username, $password, $email, $role = 'user') {
        try {
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT); // Mã hóa mật khẩu
            $sql = "INSERT INTO users (username, password, email, role, created_at) VALUES (:username, :password, :email, :role, NOW())";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', $hashedPassword);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Lấy danh sách tất cả người dùng
    public function getAllUsers() {
        try {
            $sql = "SELECT id, username, email, role, created_at FROM users";
            $stmt = $this->conn->query($sql);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return [];
        }
    }

    // Lấy thông tin người dùng theo ID
    public function getUserById($id) {
        try {
            $sql = "SELECT id, username, email, role, created_at FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);  // Sửa lỗi từ ">" thành "->"
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            return null;
        }
    }

    // Cập nhật thông tin người dùng
    public function updateUser($id, $username, $email, $role) {
        try {
            $sql = "UPDATE users SET username = :username, email = :email, role = :role, updated_at = NOW() WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':role', $role);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Xóa người dùng
    public function deleteUser($id) {
        try {
            $sql = "DELETE FROM users WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            return false;
        }
    }

    // Xác thực người dùng (login)
    public function authenticateUser($username, $password) {
        try {
            $sql = "SELECT * FROM users WHERE username = :username";
            $stmt = $this->conn->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $result = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($result && password_verify($password, $result['password'])) {
                return $result; // Trả về thông tin người dùng
            }
            return false; // Sai username hoặc password
        } catch (PDOException $e) {
            return false;
        }
    }

    // Đóng kết nối
    public function closeConnection() {
        $this->conn = null;
    }
}
?>
