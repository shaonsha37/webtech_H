<div class="row">
    <div class="col-12">
        <h1 class="mb-4">My Orders</h1>
    </div>
</div>

<?php if(empty($orders)): ?>
    <div class="row">
        <div class="col-12">
            <div class="alert alert-info">
                <h4>No orders found</h4>
                <p>You haven't placed any orders yet.</p>
                <a href="index.php" class="btn btn-primary">Start Shopping</a>
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
                            <th>Order ID</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order): ?>
                            <tr>
                                <td>
                                    <strong>#<?php echo $order['id']; ?></strong>
                                </td>
                                <td>
                                    <?php echo date('M d, Y H:i', strtotime($order['created_at'])); ?>
                                </td>
                                <td>
                                    <strong class="text-primary">$<?php echo number_format($order['total_amount'], 2); ?></strong>
                                </td>
                                <td>
                                    <span class="badge bg-success">Completed</span>
                                </td>
                                <td>
                                    <a href="index.php?page=order&action=view&id=<?php echo $order['id']; ?>" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye"></i> View Details
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
<?php endif; ?> 