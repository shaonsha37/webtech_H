<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Commerce Store</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .navbar-brand {
            font-weight: bold;
            font-size: 1.5rem;
        }
        .product-card {
            transition: transform 0.2s;
            height: 100%;
        }
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .product-image {
            height: 200px;
            object-fit: cover;
        }
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #dc3545;
            color: white;
            border-radius: 50%;
            padding: 2px 6px;
            font-size: 0.7rem;
            transition: all 0.3s ease;
        }
        .alert {
            margin-bottom: 20px;
        }
        .cart-badge.updated {
            animation: pulse 0.5s ease-in-out;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.2); }
            100% { transform: scale(1); }
        }
        
        /* Search styling */
        .search-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        }
        
        .search-card .card-body {
            padding: 1.5rem;
        }
        
        .search-input-group {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }
        
        .search-input-group .input-group-text {
            background: #667eea;
            color: white;
            border: none;
            padding: 0.75rem 1rem;
        }
        
        .search-input-group .form-control {
            border: none;
            padding: 0.75rem 1rem;
            font-size: 1rem;
        }
        
        .search-input-group .form-control:focus {
            box-shadow: none;
            border-color: #667eea;
        }
        
        .search-btn {
            border-radius: 10px;
            padding: 0.75rem 1.5rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            transition: all 0.3s ease;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border: none;
        }
        
        .search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .clear-search-btn {
            border-radius: 8px;
            padding: 0.5rem 1rem;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .clear-search-btn:hover {
            background-color: #6c757d;
            border-color: #6c757d;
            color: white;
        }
        
        .search-results-info {
            font-size: 0.95rem;
            color: #6c757d;
        }
        
        .search-results-info strong {
            color: #495057;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-shopping-cart me-2"></i>E-Store
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                </ul>
                
                <ul class="navbar-nav">
                    <li class="nav-item position-relative">
                        <a class="nav-link" href="index.php?page=cart">
                            <i class="fas fa-shopping-cart"></i> Cart
                            <?php if(!empty($_SESSION['cart']) && is_array($_SESSION['cart'])): ?>
                                <span class="cart-badge" id="cart-badge"><?php echo array_sum($_SESSION['cart']); ?></span>
                            <?php else: ?>
                                <span class="cart-badge" id="cart-badge" style="display: none;">0</span>
                            <?php endif; ?>
                        </a>
                    </li>
                    
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=order">My Orders</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user"></i> <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="index.php?page=user&action=logout">Logout</a></li>
                            </ul>
                        </li>
                    <?php else: ?>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=user&action=login">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?page=user&action=register">Register</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <?php if(isset($_SESSION['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" id="success-alert">
                <?php echo htmlspecialchars($_SESSION['success']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['error'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" id="error-alert">
                <?php echo htmlspecialchars($_SESSION['error']); ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <?php if(isset($_SESSION['errors'])): ?>
            <div class="alert alert-danger alert-dismissible fade show" id="errors-alert">
                <ul class="mb-0">
                    <?php foreach($_SESSION['errors'] as $error): ?>
                        <li><?php echo htmlspecialchars($error); ?></li>
                    <?php endforeach; ?>
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>
    </div>

    <script>
        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    if (alert.parentNode) {
                        alert.style.transition = 'opacity 0.5s ease';
                        alert.style.opacity = '0';
                        setTimeout(function() {
                            if (alert.parentNode) {
                                alert.parentNode.removeChild(alert);
                            }
                        }, 500);
                    }
                }, 5000);
            });
        });

        // Update cart badge when form is submitted
        document.addEventListener('DOMContentLoaded', function() {
            const forms = document.querySelectorAll('form[action*="cart&action=add"]');
            forms.forEach(function(form) {
                form.addEventListener('submit', function() {
                    const quantityInput = form.querySelector('input[name="quantity"]');
                    const currentBadge = document.getElementById('cart-badge');
                    
                    if (currentBadge && quantityInput) {
                        const currentCount = parseInt(currentBadge.textContent) || 0;
                        const newQuantity = parseInt(quantityInput.value) || 1;
                        const newCount = currentCount + newQuantity;
                        
                        currentBadge.textContent = newCount;
                        currentBadge.style.display = 'inline';
                        currentBadge.classList.add('updated');
                        
                        setTimeout(function() {
                            currentBadge.classList.remove('updated');
                        }, 500);
                    }
                });
            });
        });
    </script>
</body>
</html> 