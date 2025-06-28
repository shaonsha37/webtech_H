<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Welcome to E-Store</h1>
        <p class="lead mb-5">Discover amazing products at great prices!</p>
    </div>
</div>

<!-- Search Section -->
<div class="row mb-4">
    <div class="col-12">
        <div class="card search-card">
            <div class="card-body">
                <form method="GET" action="index.php" class="row g-3">
                    <div class="col-md-10">
                        <div class="input-group search-input-group">
                            <span class="input-group-text">
                                <i class="fas fa-search"></i>
                            </span>
                            <input type="text" 
                                   class="form-control" 
                                   name="search" 
                                   placeholder="Search products by name or description..." 
                                   value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100 search-btn">
                            <i class="fas fa-search me-2"></i>Search
                        </button>
                    </div>
                </form>
                <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
                    <div class="mt-3">
                        <a href="index.php" class="btn btn-outline-secondary btn-sm clear-search-btn">
                            <i class="fas fa-times me-1"></i>Clear Search
                        </a>
                        <span class="text-muted ms-2 search-results-info">
                            Showing results for: "<strong><?php echo htmlspecialchars($_GET['search']); ?></strong>"
                        </span>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <?php if(empty($products)): ?>
        <div class="col-12">
            <div class="alert alert-info">
                <h4>No products found</h4>
                <?php if(isset($_GET['search']) && !empty($_GET['search'])): ?>
                    <p>No products match your search criteria. Try different keywords or browse all products.</p>
                <?php else: ?>
                    <p>Please check back later for new products.</p>
                <?php endif; ?>
            </div>
        </div>
    <?php else: ?>
        <?php foreach($products as $product): ?>
            <div class="col-md-4 col-lg-3 mb-4">
                <div class="card product-card h-100">
                    <img src="<?php echo !empty($product['image']) ? htmlspecialchars($product['image']) : 'https://via.placeholder.com/300x200?text=No+Image'; ?>" 
                         class="card-img-top product-image" 
                         alt="<?php echo htmlspecialchars($product['name']); ?>">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title"><?php echo htmlspecialchars($product['name']); ?></h5>
                        <p class="card-text flex-grow-1"><?php echo htmlspecialchars($product['description']); ?></p>
                        <div class="mt-auto">
                            <p class="card-text">
                                <strong class="text-primary">$<?php echo number_format($product['price'], 2); ?></strong>
                            </p>
                            <form class="add-to-cart-form" data-product-id="<?php echo $product['id']; ?>">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <div class="input-group mb-3">
                                    <input type="number" class="form-control" name="quantity" value="1" min="1" max="10">
                                    <button class="btn btn-primary" type="submit">
                                        <i class="fas fa-cart-plus"></i> Add to Cart
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const forms = document.querySelectorAll('.add-to-cart-form');
    
    forms.forEach(function(form) {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(form);
            const productId = form.dataset.productId;
            const quantityInput = form.querySelector('input[name="quantity"]');
            const submitButton = form.querySelector('button[type="submit"]');
            const originalText = submitButton.innerHTML;
            
            // Disable button and show loading
            submitButton.disabled = true;
            submitButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Adding...';
            
            // Send AJAX request
            fetch('index.php?page=cart&action=add', {
                method: 'POST',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Update cart badge with actual server data
                    const cartBadge = document.getElementById('cart-badge');
                    if (cartBadge) {
                        cartBadge.textContent = data.cart_count;
                        cartBadge.style.display = 'inline';
                        cartBadge.classList.add('updated');
                        
                        setTimeout(function() {
                            cartBadge.classList.remove('updated');
                        }, 500);
                    }
                    
                    // Show success message
                    showAlert(data.message, 'success');
                    
                    // Reset form
                    quantityInput.value = 1;
                } else {
                    // Show error message
                    showAlert(data.message, 'error');
                }
                
                // Re-enable button
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            })
            .catch(error => {
                console.error('Error:', error);
                showAlert('Error adding product to cart. Please try again.', 'error');
                
                // Re-enable button
                submitButton.disabled = false;
                submitButton.innerHTML = originalText;
            });
        });
    });
});

function showAlert(message, type) {
    // Remove existing alerts
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());
    
    // Create new alert
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type === 'success' ? 'success' : 'danger'} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;
    
    // Insert alert at the top of the container
    const container = document.querySelector('.container.mt-4');
    if (container) {
        container.insertBefore(alertDiv, container.firstChild);
        
        // Auto-hide after 5 seconds
        setTimeout(function() {
            if (alertDiv.parentNode) {
                alertDiv.style.transition = 'opacity 0.5s ease';
                alertDiv.style.opacity = '0';
                setTimeout(function() {
                    if (alertDiv.parentNode) {
                        alertDiv.parentNode.removeChild(alertDiv);
                    }
                }, 500);
            }
        }, 5000);
    }
}
</script> 