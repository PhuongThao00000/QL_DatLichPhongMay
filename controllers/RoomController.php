<?php
session_start();
require_once 'config/database.php';
require_once 'models/Room.php';

class RoomController {
    private $db;
    private $room;

    public function __construct() {
        // Kiểm tra đăng nhập
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->room = new Room($this->db);
    }

    // Hiển thị danh sách phòng
    public function index() {
        $rooms = $this->room->getAll();
        include 'views/rooms/index.php';
    }

    // Hiển thị chi tiết phòng
    public function detail() {
        if(isset($_GET['id'])) {
            $room = $this->room->getById($_GET['id']);
            include 'views/rooms/detail.php';
        } else {
            header("Location: index.php?controller=room&action=index");
        }
    }

    // Hiển thị form thêm phòng (chỉ admin)
    public function create() {
        if($_SESSION['role'] != 'admin') {
            header("Location: index.php?controller=room&action=index");
            exit();
        }

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->room->room_name = $_POST['room_name'];
            $this->room->capacity = $_POST['capacity'];
            $this->room->description = $_POST['description'];

            if($this->room->create()) {
                header("Location: index.php?controller=room&action=index");
                exit();
            } else {
                $error = "Thêm phòng thất bại!";
            }
        }

        include 'views/rooms/create.php';
    }

    // Hiển thị form sửa phòng (chỉ admin)
    public function edit() {
        if($_SESSION['role'] != 'admin') {
            header("Location: index.php?controller=room&action=index");
            exit();
        }

        if(!isset($_GET['id'])) {
            header("Location: index.php?controller=room&action=index");
            exit();
        }

        $room = $this->room->getById($_GET['id']);

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->room->id = $_GET['id'];
            $this->room->room_name = $_POST['room_name'];
            $this->room->capacity = $_POST['capacity'];
            $this->room->description = $_POST['description'];
            $this->room->status = $_POST['status'];

            if($this->room->update()) {
                header("Location: index.php?controller=room&action=index");
                exit();
            } else {
                $error = "Cập nhật phòng thất bại!";
            }
        }

        include 'views/rooms/edit.php';
    }

    // Xóa phòng (chỉ admin)
    public function delete() {
        if($_SESSION['role'] != 'admin') {
            header("Location: index.php?controller=room&action=index");
            exit();
        }

        if(isset($_GET['id'])) {
            $this->room->id = $_GET['id'];
            
            if($this->room->delete()) {
                header("Location: index.php?controller=room&action=index");
            } else {
                // Không xóa được (có lịch đặt)
                $_SESSION['error'] = "Không thể xóa phòng này vì đã có lịch đặt!";
                header("Location: index.php?controller=room&action=index");
            }
        } else {
            header("Location: index.php?controller=room&action=index");
        }
        exit();
    }
}
?>