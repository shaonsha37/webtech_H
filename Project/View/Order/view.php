<div class="row">
    <div class="col-12">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Order Details</h1>
            <a href="index.php?page=order" class="btn btn-outline-primary">
                <i class="fas fa-arrow-left"></i> Back to Orders
            </a>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4>Order Items</h4>
            </div>
            <div class="card-body">
                <?php 
                $order_items = json_decode($order['order_items'], true);
                if($order_items): 
                ?>
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($order_items as $item): ?>
                                    <tr>
                                        <td>
                                            <h6 class="mb-0"><?php echo htmlspecialchars($item['name']); ?></h6>
                                        </td>
                                        <td>$<?php echo number_format($item['price'], 2); ?></td>
                                        <td><?php echo $item['quantity']; ?></td>
                                        <td><strong>$<?php echo number_format($item['subtotal'], 2); ?></strong></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else: ?>
                    <p class="text-muted">No items found for this order.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4>Order Information</h4>
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <strong>Order ID:</strong><br>
                    <span class="text-primary">#<?php echo $order['id']; ?></span>
                </div>
                
                <div class="mb-3">
                    <strong>Order Date:</strong><br>
                    <span><?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?></span>
                </div>
                
                <div class="mb-3">
                    <strong>Status:</strong><br>
                    <span class="badge bg-success">Completed</span>
                </div>
                
                <div class="mb-3">
                    <strong>Total Amount:</strong><br>
                    <span class="text-primary h5">$<?php echo number_format($order['total_amount'], 2); ?></span>
                </div>
            </div>
        </div>
        
        <div class="card mt-3">
            <div class="card-header">
                <h4>Shipping Information</h4>
            </div>
            <div class="card-body">
                <div class="mb-2">
                    <strong>Name:</strong><br>
                    <span><?php echo htmlspecialchars($order['full_name']); ?></span>
                </div>
                
                <div class="mb-2">
                    <strong>Email:</strong><br>
                    <span><?php echo htmlspecialchars($order['email']); ?></span>
                </div>
                
                <div class="mb-2">
                    <strong>Address:</strong><br>
                    <span><?php echo nl2br(htmlspecialchars($order['address'])); ?></span>
                </div>
            </div>
        </div>
    </div>
</div> 