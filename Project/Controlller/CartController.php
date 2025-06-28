<?php
require_once 'models/Product.php';
require_once 'config/session_helper.php';

class CartController {
    private $product;
    
    public function __construct() {
        $this->product = new Product();
        
        // Initialize cart if not exists or if it's not an array
        if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }
    }
    
    public function index() {
        $cart_items = [];
        $total = 0;
        
        if(!empty($_SESSION['cart']) && is_array($_SESSION['cart'])) {
            $product_ids = array_keys($_SESSION['cart']);
            $products = $this->product->getProductsByIds($product_ids);
            
            foreach($products as $product) {
                $quantity = $_SESSION['cart'][$product['id']];
                $cart_items[] = [
                    'product' => $product,
                    'quantity' => $quantity,
                    'subtotal' => $product['price'] * $quantity
                ];
                $total += $product['price'] * $quantity;
            }
        }
        
        include 'views/layout/header.php';
        include 'views/cart/index.php';
        include 'views/layout/footer.php';
    }
    
    public function add() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure cart is initialized
            if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            if($quantity > 0 && $product_id > 0) {
                if(isset($_SESSION['cart'][$product_id])) {
                    $_SESSION['cart'][$product_id] = (int)$_SESSION['cart'][$product_id] + $quantity;
                } else {
                    $_SESSION['cart'][$product_id] = $quantity;
                }
                
                // Check if this is an AJAX request
                if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    // Return JSON response for AJAX
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => true,
                        'message' => 'Product added to cart successfully!',
                        'cart_count' => array_sum($_SESSION['cart']),
                        'product_id' => $product_id,
                        'quantity' => $quantity
                    ]);
                    exit();
                } else {
                    // Regular form submission - redirect
                    $_SESSION['success'] = "Product added to cart successfully!";
                    header("Location: index.php");
                    exit();
                }
            } else {
                if(isset($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
                    // Return JSON error for AJAX
                    header('Content-Type: application/json');
                    echo json_encode([
                        'success' => false,
                        'message' => 'Invalid product or quantity!'
                    ]);
                    exit();
                } else {
                    // Regular form submission - redirect with error
                    $_SESSION['error'] = "Invalid product or quantity!";
                    header("Location: index.php");
                    exit();
                }
            }
        }
        
        // If not POST request, redirect to home
        header("Location: index.php");
        exit();
    }
    
    public function update() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure cart is initialized
            if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            $product_id = (int)$_POST['product_id'];
            $quantity = (int)$_POST['quantity'];
            
            if($quantity > 0) {
                $_SESSION['cart'][$product_id] = $quantity;
            } else {
                unset($_SESSION['cart'][$product_id]);
            }
            
            $_SESSION['success'] = "Cart updated successfully!";
        }
        
        header("Location: index.php?page=cart");
        exit();
    }
    
    public function remove() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ensure cart is initialized
            if(!isset($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
                $_SESSION['cart'] = [];
            }
            
            $product_id = (int)$_POST['product_id'];
            
            if(isset($_SESSION['cart'][$product_id])) {
                unset($_SESSION['cart'][$product_id]);
                $_SESSION['success'] = "Product removed from cart!";
            }
        }
        
        header("Location: index.php?page=cart");
        exit();
    }
    
    public function clear() {
        $_SESSION['cart'] = [];
        $_SESSION['success'] = "Cart cleared successfully!";
        
        header("Location: index.php?page=cart");
        exit();
    }
    
    public function checkout() {
        // Check if user is logged in using helper function
        require_login();
        
        if(empty($_SESSION['cart']) || !is_array($_SESSION['cart'])) {
            header("Location: index.php?page=cart");
            exit();
        }
        
        $cart_items = [];
        $total = 0;
        
        $product_ids = array_keys($_SESSION['cart']);
        $products = $this->product->getProductsByIds($product_ids);
        
        foreach($products as $product) {
            $quantity = $_SESSION['cart'][$product['id']];
            $cart_items[] = [
                'product' => $product,
                'quantity' => $quantity,
                'subtotal' => $product['price'] * $quantity
            ];
            $total += $product['price'] * $quantity;
        }
        
        include 'views/layout/header.php';
        include 'views/cart/checkout.php';
        include 'views/layout/footer.php';
    }
}
?> 