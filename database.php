<?php
class Database {
    private $host = "localhost";
    private $dbname = "school_db";
    private $username = "root"; // change if needed
    private $password = "";     // change if needed
    protected $conn;

    public function __construct() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname}",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    // Generic CRUD Methods
    public function insert($table, $fields, $values) {
        $sql = "INSERT INTO $table ($fields) VALUES ($values)";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }

    public function read($table) {
        $sql = "SELECT * FROM $table";
        return $this->conn->query($sql);
    }

    public function delete($table, $id) {
        $sql = "DELETE FROM $table WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id' => $id]);
    }

    public function update($table, $set, $id) {
        $sql = "UPDATE $table SET $set WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        return $stmt;
    }
}
?>
