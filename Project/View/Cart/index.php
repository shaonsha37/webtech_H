<div class="row">
    <div class="col-12">
        <h1 class="mb-4">Shopping Cart</h1>
    </div>
</div>

<?php if(empty($cart_items)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h4>Your cart is empty</h4>
                <p>Add some products to your cart to get started!</p>
                <a href="index.php" class="btn btn-primary">Continue Shopping</a>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="col-12">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Subtotal</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($cart_items as $item): ?>
                            <tr>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img src="<?php echo !empty($item['product']['image']) ? htmlspecialchars($item['product']['image']) : 'https://via.placeholder.com/50x50?text=No+Image'; ?>" 
                                             class="me-3" 
                                             style="width: 50px; height: 50px; object-fit: cover;" 
                                             alt="<?php echo htmlspecialchars($item['product']['name']); ?>">
                                        <div>
                                            <h6 class="mb-0"><?php echo htmlspecialchars($item['product']['name']); ?></h6>
                                            <small class="text-muted"><?php echo htmlspecialchars($item['product']['description']); ?></small>
                                        </div>
                                    </div>
                                </td>
                                <td>$<?php echo number_format($item['product']['price'], 2); ?></td>
                                <td>
                                    <form action="index.php?page=cart&action=update" method="POST" class="d-flex align-items-center">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product']['id']; ?>">
                                        <input type="number" class="form-control" name="quantity" value="<?php echo $item['quantity']; ?>" min="1" max="10" style="width: 80px;">
                                        <button type="submit" class="btn btn-sm btn-outline-primary ms-2">Update</button>
                                    </form>
                                </td>
                                <td><strong>$<?php echo number_format($item['subtotal'], 2); ?></strong></td>
                                <td>
                                    <form action="index.php?page=cart&action=remove" method="POST">
                                        <input type="hidden" name="product_id" value="<?php echo $item['product']['id']; ?>">
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to remove this item?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                    <form action="index.php?page=cart&action=clear" method="POST">
                        <button type="submit" class="btn btn-outline-danger" onclick="return confirm('Are you sure you want to clear your cart?')">
                            <i class="fas fa-trash"></i> Clear Cart
                        </button>
                    </form>
                </div>
                <div class="col-md-6 text-end">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Order Summary</h5>
                            <p class="card-text">
                                <strong>Total: $<?php echo number_format($total, 2); ?></strong>
                            </p>
                            <a href="index.php?page=cart&action=checkout" class="btn btn-success">
                                <i class="fas fa-shopping-cart"></i> Proceed to Checkout
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?> 