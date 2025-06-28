<?php
require_once 'models/Order.php';
require_once 'models/Product.php';

class OrderController {
    private $order;
    private $product;
    
    public function __construct() {
        $this->order = new Order();
        $this->product = new Product();
    }
    
    public function index() {
        // Check if user is logged in
        if(!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to view your orders.";
            header("Location: index.php?page=user&action=login");
            exit();
        }
        
        $orders = $this->order->getOrdersByUserId($_SESSION['user_id']);
        
        include 'views/layout/header.php';
        include 'views/order/index.php';
        include 'views/layout/footer.php';
    }
    
    public function place() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Check if user is logged in
            if(!isset($_SESSION['user_id'])) {
                $_SESSION['error'] = "Please login to place an order.";
                header("Location: index.php?page=user&action=login");
                exit();
            }
            
            // Check if cart is empty
            if(empty($_SESSION['cart'])) {
                $_SESSION['error'] = "Your cart is empty.";
                header("Location: index.php?page=cart");
                exit();
            }
            
            $full_name = trim($_POST['full_name']);
            $email = trim($_POST['email']);
            $address = trim($_POST['address']);
            
            $errors = [];
            
            // Validation
            if(empty($full_name)) {
                $errors[] = "Full name is required";
            }
            
            if(empty($email)) {
                $errors[] = "Email is required";
            } elseif(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email format";
            }
            
            if(empty($address)) {
                $errors[] = "Address is required";
            }
            
            if(empty($errors)) {
                // Calculate total and prepare order items
                $cart_items = [];
                $total = 0;
                
                $product_ids = array_keys($_SESSION['cart']);
                $products = $this->product->getProductsByIds($product_ids);
                
                foreach($products as $product) {
                    $quantity = $_SESSION['cart'][$product['id']];
                    $cart_items[] = [
                        'product_id' => $product['id'],
                        'name' => $product['name'],
                        'price' => $product['price'],
                        'quantity' => $quantity,
                        'subtotal' => $product['price'] * $quantity
                    ];
                    $total += $product['price'] * $quantity;
                }
                
                // Create order
                $order_id = $this->order->createOrder(
                    $_SESSION['user_id'],
                    $full_name,
                    $email,
                    $address,
                    $total,
                    $cart_items
                );
                
                if($order_id) {
                    // Clear cart
                    $_SESSION['cart'] = [];
                    $_SESSION['success'] = "Order placed successfully! Order ID: #" . $order_id;
                    header("Location: index.php?page=order");
                    exit();
                } else {
                    $errors[] = "Failed to place order. Please try again.";
                }
            }
            
            if(!empty($errors)) {
                $_SESSION['errors'] = $errors;
                header("Location: index.php?page=cart&action=checkout");
                exit();
            }
        }
        
        header("Location: index.php?page=cart");
        exit();
    }
    
    public function view() {
        // Check if user is logged in
        if(!isset($_SESSION['user_id'])) {
            $_SESSION['error'] = "Please login to view order details.";
            header("Location: index.php?page=user&action=login");
            exit();
        }
        
        $order_id = (int)$_GET['id'];
        $order = $this->order->getOrderById($order_id);
        
        // Check if order exists and belongs to user
        if(!$order || $order['user_id'] != $_SESSION['user_id']) {
            $_SESSION['error'] = "Order not found.";
            header("Location: index.php?page=order");
            exit();
        }
        
        include 'views/layout/header.php';
        include 'views/order/view.php';
        include 'views/layout/footer.php';
    }
}
?> 