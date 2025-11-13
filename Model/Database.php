<?php
class Database {
    private $host = "localhost";
    private $user = "root";
    private $pass = "";
    private $name = "qlpm";

    public $conn;

    public function __construct() {
        this->connect();
    }

    public function connect() {
        this->$conn = new mysqli($this->host, $this->user, $this->pass, $this->name);
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        mysqli_set_charset($this->conn, "utf8");
        return $this->conn;
    }
}