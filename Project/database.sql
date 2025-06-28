-- E-Commerce Database Setup

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    address TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Products table
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    description TEXT,
    price DECIMAL(10,2) NOT NULL,
    image VARCHAR(255),
    category VARCHAR(100) DEFAULT 'electronics',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Orders table
CREATE TABLE IF NOT EXISTS orders (
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

-- Insert sample products with Unsplash images and categories
INSERT INTO products (name, description, price, image, category) VALUES
('Laptop', 'High-performance laptop with latest specifications. Perfect for work, gaming, and multimedia tasks. Features Intel i7 processor, 16GB RAM, and 512GB SSD.', 999.99, 'https://images.unsplash.com/photo-1496181133206-80ce9b88a853?w=600&h=400&fit=crop&crop=center', 'electronics'),
('Smartphone', 'Latest smartphone with advanced features. 6.7-inch OLED display, 128GB storage, 48MP camera, and all-day battery life.', 699.99, 'https://images.unsplash.com/photo-1511707171634-5f897ff02aa9?w=600&h=400&fit=crop&crop=center', 'electronics'),
('Headphones', 'Wireless noise-canceling headphones with premium sound quality. Comfortable over-ear design with 30-hour battery life.', 199.99, 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=600&h=400&fit=crop&crop=center', 'accessories'),
('Tablet', '10-inch tablet perfect for work and entertainment. High-resolution display, powerful processor, and long battery life.', 399.99, 'https://images.unsplash.com/photo-1544244015-0df4b3ffc6b0?w=600&h=400&fit=crop&crop=center', 'electronics'),
('Smartwatch', 'Fitness tracking smartwatch with heart rate monitor, GPS, and water resistance. Perfect for active lifestyles.', 299.99, 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?w=600&h=400&fit=crop&crop=center', 'accessories'),
('Camera', 'Professional DSLR camera with 24MP sensor, 4K video recording, and interchangeable lenses. Ideal for photography enthusiasts.', 1299.99, 'https://images.unsplash.com/photo-1516035069371-29a1b244cc32?w=600&h=400&fit=crop&crop=center', 'electronics'),
('Gaming Console', 'Next-generation gaming console with ultra-fast loading times, ray tracing, and 4K gaming capabilities.', 499.99, 'https://images.unsplash.com/photo-1486401899868-0e435ed85128?w=600&h=400&fit=crop&crop=center', 'gaming'),
('Wireless Speaker', 'Portable wireless speaker with 360-degree sound, waterproof design, and 20-hour battery life.', 149.99, 'https://images.unsplash.com/photo-1608043152269-423dbba4e7e1?w=600&h=400&fit=crop&crop=center', 'accessories'); 