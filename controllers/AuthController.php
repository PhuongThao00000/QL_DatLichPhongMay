<?php
require_once 'config/database.php';
require_once 'models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    // Xử lý đăng nhập
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            $result = $this->user->login();

            if($result) {
                session_start();
                $_SESSION['user_id'] = $result['id'];
                $_SESSION['username'] = $result['username'];
                $_SESSION['fullname'] = $result['fullname'];
                $_SESSION['role'] = $result['role'];

                header("Location: index.php?controller=room&action=index");
                exit();
            } else {
                $error = "Tên đăng nhập hoặc mật khẩu không đúng!";
                include 'views/auth/login.php';
            }
        } else {
            // Nếu không phải POST, hiển thị form login
            include 'views/auth/login.php';
        }
    }

    // Xử lý đăng ký
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];
            $this->user->fullname = $_POST['fullname'];
            $this->user->email = $_POST['email'];

            // Kiểm tra username đã tồn tại
            if($this->user->usernameExists()) {
                $error = "Tên đăng nhập đã tồn tại!";
                include 'views/auth/register.php';
                return;
            }

            // Kiểm tra mật khẩu xác nhận
            if($_POST['password'] != $_POST['confirm_password']) {
                $error = "Mật khẩu xác nhận không khớp!";
                include 'views/auth/register.php';
                return;
            }

            if($this->user->register()) {
                $success = "Đăng ký thành công! Vui lòng đăng nhập.";
                include 'views/auth/login.php';
            } else {
                $error = "Đăng ký thất bại!";
                include 'views/auth/register.php';
            }
        } else {
            // Nếu không phải POST, hiển thị form đăng ký
            include 'views/auth/register.php';
        }
    }

    // Đăng xuất
    public function logout() {
        session_start();
        session_destroy();
        header("Location: index.php?controller=auth&action=login");
        exit();
    }
}
?>