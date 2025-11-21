<?php
class Room {
    private $conn;
    private $table = "rooms";

    public $id;
    public $room_name;
    public $capacity;
    public $description;
    public $status;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả phòng
    public function getAll() {
        $query = "SELECT * FROM " . $this->table . " WHERE status = 'active' ORDER BY room_name";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Lấy thông tin 1 phòng
    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Thêm phòng mới (cho admin)
    public function create() {
        $query = "INSERT INTO " . $this->table . " 
                  (room_name, capacity, description) 
                  VALUES (:room_name, :capacity, :description)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":room_name", $this->room_name);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":description", $this->description);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Cập nhật phòng
    public function update() {
        $query = "UPDATE " . $this->table . " 
                  SET room_name = :room_name, 
                      capacity = :capacity, 
                      description = :description,
                      status = :status
                  WHERE id = :id";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":room_name", $this->room_name);
        $stmt->bindParam(":capacity", $this->capacity);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Xóa phòng
    public function delete() {
        // Kiểm tra xem phòng có lịch đặt không
        $query = "SELECT COUNT(*) as total FROM bookings WHERE room_id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if($result['total'] > 0) {
            return false; // Không được xóa nếu có lịch đặt
        }

        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>