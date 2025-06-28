<?php
require_once 'models/Product.php';

class ProductController {
    private $product;
    
    public function __construct() {
        $this->product = new Product();
    }
    
    public function index() {
        $search = isset($_GET['search']) ? trim($_GET['search']) : '';
        
        // If search is provided, use search function
        if (!empty($search)) {
            $products = $this->product->searchProducts($search);
        } else {
            $products = $this->product->getAllProducts();
        }
        
        include 'views/layout/header.php';
        include 'views/home.php';
        include 'views/layout/footer.php';
    }
}
?> 