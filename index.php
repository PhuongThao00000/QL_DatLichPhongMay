<?php
// Bật hiển thị lỗi (để debug)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Thiết lập múi giờ
date_default_timezone_set('Asia/Ho_Chi_Minh');

// Lấy controller và action từ URL
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'auth';
$action = isset($_GET['action']) ? $_GET['action'] : 'login';

// Routing
switch($controller) {
    case 'auth':
        require_once 'controllers/AuthController.php';
        $authController = new AuthController();
        
        switch($action) {
            case 'login':
                $authController->login();
                break;
            case 'register':
                $authController->register();
                break;
            case 'logout':
                $authController->logout();
                break;
            default:
                $authController->login();
        }
        break;
        
    case 'room':
        require_once 'controllers/RoomController.php';
        $roomController = new RoomController();
        
        switch($action) {
            case 'index':
                $roomController->index();
                break;
            case 'detail':
                $roomController->detail();
                break;
            case 'create':
                $roomController->create();
                break;
            case 'edit':
                $roomController->edit();
                break;
            case 'delete':
                $roomController->delete();
                break;
            default:
                $roomController->index();
        }
        break;
        
    case 'booking':
        require_once 'controllers/BookingController.php';
        $bookingController = new BookingController();
        
        switch($action) {
            case 'index':
                $bookingController->index();
                break;
            case 'create':
                $bookingController->create();
                break;
            case 'updateStatus':
                $bookingController->updateStatus();
                break;
            default:
                $bookingController->index();
        }
        break;
        
    default:
        header("Location: index.php?controller=auth&action=login");
        exit();
}
?>