<?php
class User {
    private $conn;
    private $table = "users";

    public $id;
    public $username;
    public $password;
    public $fullname;
    public $email;
    public $role;

    public function __construct($db) {
        $this->conn = $db;
    }

    // Đăng ký
    public function register() {
        $query = "INSERT INTO " . $this->table . " 
                  (username, password, fullname, email) 
                  VALUES (:username, :password, :fullname, :email)";
        
        $stmt = $this->conn->prepare($query);
        
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->bindParam(":fullname", $this->fullname);
        $stmt->bindParam(":email", $this->email);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Đăng nhập
    public function login() {
        $query = "SELECT * FROM " . $this->table . " 
                  WHERE username = :username AND password = :password";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->bindParam(":password", $this->password);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // Kiểm tra username đã tồn tại
    public function usernameExists() {
        $query = "SELECT id FROM " . $this->table . " WHERE username = :username";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":username", $this->username);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return true;
        }
        return false;
    }
}
?>