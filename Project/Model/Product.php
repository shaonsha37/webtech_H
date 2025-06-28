<?php
require_once 'config/database.php';

class Product {
    private $conn;
    private $table_name = "products";
    
    public $id;
    public $name;
    public $description;
    public $price;
    public $image;
    public $created_at;
    
    public function __construct() {
        $database = new Database();
        $this->conn = $database->getConnection();
    }
    
    public function getAllProducts() {
        $query = "SELECT * FROM " . $this->table_name . " ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getProductById($id) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = :id LIMIT 1";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();
        
        if($stmt->rowCount() > 0) {
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        return false;
    }
    
    public function getProductsByIds($ids) {
        if(empty($ids)) {
            return [];
        }
        
        $placeholders = str_repeat('?,', count($ids) - 1) . '?';
        $query = "SELECT * FROM " . $this->table_name . " WHERE id IN ($placeholders)";
        
        $stmt = $this->conn->prepare($query);
        $stmt->execute($ids);
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function searchProducts($search = '') {
        if (empty($search)) {
            return $this->getAllProducts();
        }
        
        $query = "SELECT * FROM " . $this->table_name . " WHERE (name LIKE :search OR description LIKE :search) ORDER BY created_at DESC";
        
        $stmt = $this->conn->prepare($query);
        $stmt->bindValue(':search', '%' . $search . '%');
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?> 