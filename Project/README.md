# E-Commerce Store

A simple e-commerce application built with PHP, HTML, CSS, and JavaScript using the MVC architecture.

## Features

-   User registration and login
-   Product browsing
-   Shopping cart functionality
-   Order placement and management
-   Responsive design with Bootstrap

## Requirements

-   PHP 7.4 or higher
-   MySQL/MariaDB
-   Web server (Apache/Nginx)
-   phpMyAdmin (for database management)

## Installation

1. **Clone or download the project** to your web server directory.

2. **Create the database** in phpMyAdmin:

    - Create a new database named `ecommerce`
    - Import the SQL file or run the database creation queries

3. **Configure database connection**:

    - Edit `index.php` and update the database credentials:
        ```php
        define('DB_HOST', 'localhost');
        define('DB_USER', 'your_username');
        define('DB_PASS', 'your_password');
        define('DB_NAME', 'ecommerce');
        ```

4. **Set up the database tables** using the SQL queries provided below.

## Database Setup

### Create Tables

Run these SQL queries in phpMyAdmin:

```sql
-- Users table
CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE orders (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    total_amount DECIMAL(10,2) NOT NULL,
    order_items JSON NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
```

### Sample Data

Insert some sample products:

```sql
INSERT INTO products (name, description, price, image) VALUES
('Laptop', 'High-performance laptop with latest specifications', 999.99, 'https://via.placeholder.com/300x200?text=Laptop'),
('Smartphone', 'Latest smartphone with advanced features', 699.99, 'https://via.placeholder.com/300x200?text=Smartphone'),
('Headphones', 'Wireless noise-canceling headphones', 199.99, 'https://via.placeholder.com/300x200?text=Headphones'),
('Tablet', '10-inch tablet perfect for work and entertainment', 399.99, 'https://via.placeholder.com/300x200?text=Tablet'),
('Smartwatch', 'Fitness tracking smartwatch', 299.99, 'https://via.placeholder.com/300x200?text=Smartwatch'),
('Camera', 'Professional DSLR camera', 1299.99, 'https://via.placeholder.com/300x200?text=Camera');
```

## Project Structure

```
ecommerce/
├── config/
│   └── database.php
├── controllers/
│   ├── UserController.php
│   ├── ProductController.php
│   ├── CartController.php
│   └── OrderController.php
├── models/
│   ├── User.php
│   ├── Product.php
│   └── Order.php
├── views/
│   ├── layout/
│   │   ├── header.php
│   │   └── footer.php
│   ├── user/
│   │   ├── login.php
│   │   └── register.php
│   ├── cart/
│   │   ├── index.php
│   │   └── checkout.php
│   ├── order/
│   │   ├── index.php
│   │   └── view.php
│   └── home.php
├── index.php
└── README.md
```

## Usage

1. **Access the application** through your web browser
2. **Register a new account** or login with existing credentials
3. **Browse products** on the home page
4. **Add items to cart** using the "Add to Cart" button
5. **View cart** by clicking the cart icon in the navigation
6. **Proceed to checkout** and place your order
7. **View order history** in the "My Orders" section

## Features Explained

### User Management

-   Registration with validation
-   Login/logout functionality
-   Session management

### Product Display

-   Grid layout of products
-   Product images, names, descriptions, and prices
-   Add to cart functionality

### Shopping Cart

-   Session-based cart storage
-   Quantity management
-   Cart total calculation
-   Remove items functionality

### Order Management

-   Checkout process
-   Order placement
-   Order history viewing
-   Order details display

## Security Features

-   Password hashing using PHP's `password_hash()`
-   SQL injection prevention with prepared statements
-   XSS prevention with `htmlspecialchars()`
-   Session-based authentication
-   Input validation and sanitization

## Customization

-   Modify the styling in `views/layout/header.php`
-   Add new products through the database
-   Extend functionality by adding new controllers and models
-   Customize the database schema as needed

## Troubleshooting

1. **Database connection issues**: Check your database credentials in `index.php`
2. **Page not found**: Ensure your web server is configured to serve PHP files
3. **Session issues**: Make sure PHP sessions are enabled
4. **Permission errors**: Check file and folder permissions

## License

This project is open source and available under the MIT License.
