<?php
require_once 'models/User.php';

class UserController {
    private $user;
    
    public function __construct() {
        $this->user = new User();
    }
    
    public function index() {
        // Redirect to home if already logged in
        if(isset($_SESSION['user_id'])) {
            header("Location: index.php");
            exit();
        }
        
        include 'views/user/login.php';
    }
    
    public function register() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $full_name = trim($_POST['full_name']);
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];
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
            } elseif($this->user->emailExists($email)) {
                $errors[] = "Email already exists";
            }
            
            if(empty($password)) {
                $errors[] = "Password is required";
            } elseif(strlen($password) < 6) {
                $errors[] = "Password must be at least 6 characters";
            }
            
            if($password !== $confirm_password) {
                $errors[] = "Passwords do not match";
            }
            
            if(empty($address)) {
                $errors[] = "Address is required";
            }
            
            if(empty($errors)) {
                if($this->user->register($full_name, $email, $password, $address)) {
                    $_SESSION['success'] = "Registration successful! Please login.";
                    header("Location: index.php?page=user&action=login");
                    exit();
                } else {
                    $errors[] = "Registration failed. Please try again.";
                }
            }
            
            if(!empty($errors)) {
                $_SESSION['errors'] = $errors;
            }
        }
        
        include 'views/user/register.php';
    }
    
    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $email = trim($_POST['email']);
            $password = $_POST['password'];
            
            $errors = [];
            
            if(empty($email)) {
                $errors[] = "Email is required";
            }
            
            if(empty($password)) {
                $errors[] = "Password is required";
            }
            
            if(empty($errors)) {
                $user_data = $this->user->login($email, $password);
                if($user_data) {
                    $_SESSION['user_id'] = $user_data['id'];
                    $_SESSION['user_name'] = $user_data['full_name'];
                    $_SESSION['user_email'] = $user_data['email'];
                    $_SESSION['user_address'] = $user_data['address'];
                    
                    header("Location: index.php");
                    exit();
                } else {
                    $errors[] = "Invalid email or password";
                }
            }
            
            if(!empty($errors)) {
                $_SESSION['errors'] = $errors;
            }
        }
        
        include 'views/user/login.php';
    }
    
    public function logout() {
        session_destroy();
        header("Location: index.php");
        exit();
    }
}
?> 