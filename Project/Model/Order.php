<?php
require_once 'config/database.php';

class Order {
    private $conn;
    private $table_name = "orders";
    
    public $id;
    public $user_id;
    public $full_name;
    public $email;
    public $address;
    public $total_amount;
    public $order_items;
    public $created_at;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function createOrder($user_id, $full_name, $email, $address, $total_amount, $order_items) {
        $query = "INSERT INTO " . $this->table_name . " (user_id, full_name, email, address, total_amount, order_items, created_at) VALUES (:user_id, :full_name, :email, :address, :total_amount, :order_items, NOW())";
        
        $stmt = $this->conn->prepare($query);
        
        $order_items_json = json_encode($order_items);
        
        $stmt->bindParam(":user_id", $user_id);
        $stmt->bindParam(":full_name", $full_name);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":address", $address);
        $stmt->bindParam(":total_amount", $total_amount);
        $stmt->bindParam(":order_items", $order_items_json);
        
        if($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }
    
    public function getOrdersByUserId($user_id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE user_id = :user_id ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":user_id", $user_id);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getOrderById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
}
?> 