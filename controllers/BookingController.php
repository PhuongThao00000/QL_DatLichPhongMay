<?php
session_start();
require_once 'config/database.php';
require_once 'models/Booking.php';
require_once 'models/Room.php';

class BookingController {
    private $db;
    private $booking;
    private $room;

    public function __construct() {
        // Kiểm tra đăng nhập
        if(!isset($_SESSION['user_id'])) {
            header("Location: index.php?controller=auth&action=login");
            exit();
        }

        $database = new Database();
        $this->db = $database->getConnection();
        $this->booking = new Booking($this->db);
        $this->room = new Room($this->db);
    }

    // Hiển thị danh sách booking
    public function index() {
        if($_SESSION['role'] == 'admin') {
            $bookings = $this->booking->getAll();
        } else {
            $bookings = $this->booking->getByUserId($_SESSION['user_id']);
        }
        include 'views/bookings/index.php';
    }

    // Hiển thị form tạo booking
    public function create() {
        // Admin không được đặt lịch
        if($_SESSION['role'] == 'admin') {
            header("Location: index.php?controller=booking&action=index");
            exit();
        }
        
        $rooms = $this->room->getAll();
        
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->booking->user_id = $_SESSION['user_id'];
            $this->booking->room_id = $_POST['room_id'];
            $this->booking->booking_date = $_POST['booking_date'];
            $this->booking->start_time = $_POST['start_time'];
            $this->booking->end_time = $_POST['end_time'];
            $this->booking->purpose = $_POST['purpose'];

            // Kiểm tra trùng lịch
            if($this->booking->checkConflict()) {
                $error = "Phòng đã được đặt trong khung giờ này!";
                include 'views/bookings/create.php';
                return;
            }

            if($this->booking->create()) {
                $success = "Đặt lịch thành công!";
                header("Location: index.php?controller=booking&action=index");
                exit();
            } else {
                $error = "Đặt lịch thất bại!";
            }
        }
        
        include 'views/bookings/create.php';
    }

    // Cập nhật trạng thái (cho admin)
    public function updateStatus() {
        if($_SESSION['role'] == 'admin' && isset($_GET['id']) && isset($_GET['status'])) {
            $id = $_GET['id'];
            $status = $_GET['status'];
            
            if($this->booking->updateStatus($id, $status)) {
                header("Location: index.php?controller=booking&action=index");
                exit();
            }
        }
    }
}
?>