<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Order History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0">Order History</h4>
            </div>
            <div class="card-body">
                <?php if (!empty($orders)) : ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Product ID</th>
                                    <th>Tracking Number</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Total Price</th>
                                    <th>Status</th>
                                    <th>Order Date</th>
                                    <th>Expected Delivery</th>
                                    <th>Destination</th>
                                    <th>Remarks</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($orders as $index => $order): ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= esc($order['product_id']) ?></td>
                                        <td><?= esc($order['order_tracking_number']) ?></td>
                                        <td><?= esc($order['quantity']) ?></td>
                                        <td>RM <?= number_format($order['unit_price'], 2) ?></td>
                                        <td>RM <?= number_format($order['total_price'], 2) ?></td>
                                        <td>
                                            <?php if ($order['order_status'] == 'Pending'): ?>
                                                <span class="badge bg-warning text-dark">Pending</span>
                                            <?php elseif ($order['order_status'] == 'Completed'): ?>
                                                <span class="badge bg-success">Completed</span>
                                            <?php else: ?>
                                                <span class="badge bg-secondary"><?= esc($order['order_status']) ?></span>
                                            <?php endif; ?>
                                        </td>
                                        <td><?= esc($order['order_date']) ?></td>
                                        <td><?= esc($order['expected_delivery_date']) ?></td>
                                        <td><?= esc($order['destination_address']) ?></td>
                                        <td><?= esc($order['remarks']) ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                <?php else : ?>
                    <div class="alert alert-info">No orders found for this organisation.</div>
                <?php endif; ?>
            </div>
        </div>
    </div>

</body>

</html>