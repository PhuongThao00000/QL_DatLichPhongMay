<?php
class Booking {
    private $conn;
    private $table = "bookings";

    public $id;
    public $user_id;
    public $room_id;
    public $booking_date;
    public $start_time;
    public $end_time;
    public $purpose;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Tạo booking mới
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  (user_id, room_id, booking_date, start_time, end_time, purpose) 
                  VALUES (:user_id, :room_id, :booking_date, :start_time, :end_time, :purpose)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":user_id", $this->user_id);
        $stmt->bindParam(":room_id", $this->room_id);
        $stmt->bindParam(":booking_date", $this->booking_date);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);
        $stmt->bindParam(":purpose", $this->purpose);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Lấy tất cả booking của user
    public function getByUserId($user_id) {
        $query = "SELECT b.*, r.room_name, r.capacity 
                  FROM " . $this->table . " b
                  INNER JOIN rooms r ON b.room_id = r.id
                  WHERE b.user_id = :user_id
                  ORDER BY b.booking_date DESC, b.start_time DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy tất cả booking (cho admin)
    public function getAll() {
        $query = "SELECT b.*, r.room_name, u.fullname 
                  FROM " . $this->table . " b
                  INNER JOIN rooms r ON b.room_id = r.id
                  INNER JOIN users u ON b.user_id = u.id
                  ORDER BY b.booking_date DESC, b.start_time DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Kiểm tra trùng lịch
    public function checkConflict() {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE room_id = :room_id 
                  AND booking_date = :booking_date 
                  AND status != 'rejected'
                  AND (
                      (:start_time >= start_time AND :start_time < end_time)
                      OR (:end_time > start_time AND :end_time <= end_time)
                      OR (:start_time <= start_time AND :end_time >= end_time)
                  )";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":room_id", $this->room_id);
        $stmt->bindParam(":booking_date", $this->booking_date);
        $stmt->bindParam(":start_time", $this->start_time);
        $stmt->bindParam(":end_time", $this->end_time);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }

    // Cập nhật trạng thái (cho admin)
    public function updateStatus($id, $status) {
        $query = "UPDATE " . $this->table . " SET status = :status WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $id);
        
        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>