<?php
// Disable session warnings to prevent them from showing
error_reporting(E_ALL & ~E_WARNING);

// Include session helper
require_once 'config/session_helper.php';

// Start session safely
safe_session_start();

// Re-enable error reporting
error_reporting(E_ALL);

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'ecommerce');

// Include necessary files
require_once 'config/database.php';
require_once 'controllers/UserController.php';
require_once 'controllers/ProductController.php';
require_once 'controllers/OrderController.php';
require_once 'controllers/CartController.php';

// Simple routing
$page = isset($_GET['page']) ? $_GET['page'] : 'home';
$action = isset($_GET['action']) ? $_GET['action'] : 'index';

// Route to appropriate controller
switch ($page) {
    case 'home':
        $controller = new ProductController();
        $controller->index();
        break;
    case 'user':
        $controller = new UserController();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $controller->index();
        }
        break;
    case 'cart':
        $controller = new CartController();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $controller->index();
        }
        break;
    case 'order':
        $controller = new OrderController();
        if (method_exists($controller, $action)) {
            $controller->$action();
        } else {
            $controller->index();
        }
        break;
    default:
        $controller = new ProductController();
        $controller->index();
        break;
}
?> 