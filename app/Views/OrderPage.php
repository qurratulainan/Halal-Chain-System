<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <a href="<?= site_url('dashboard') ?>" class="btn btn-outline-secondary">⬅ Back</a>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Delivery Management Page</h3>

                        <?php if (session()->getFlashdata('error')): ?>
                            <div class="alert alert-danger">
                                <?= session()->getFlashdata('error') ?>
                            </div>
                        <?php endif; ?>

                        <?php if (session()->getFlashdata('success')): ?>
                            <div class="alert alert-success">
                                <?= session()->getFlashdata('success') ?>
                            </div>
                        <?php endif; ?>

                        <form action="<?= site_url('orders/store') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="product_id" class="form-label">Select Product</label>
                                <select name="product_id" id="product_id" class="form-select" required>
                                    <option value="">-- Choose a Product --</option>
                                    <?php foreach ($tbl_products as $product): ?>
                                        <option value="<?= $product['product_id'] ?>">
                                            <?= esc($product['product_name']) ?> (<?= esc($product['product_code']) ?>)
                                        </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="quantity" class="form-label">Quantity</label>
                                <input type="number" name="quantity" id="quantity" class="form-control" step="0.01" required>
                            </div>

                            <div class="mb-3">
                                <label for="order_date" class="form-label">Order Date</label>
                                <input type="date" class="form-control" name="order_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="expected_delivery_date" class="form-label">Expected Delivery Date</label>
                                <input type="date" class="form-control" name="expected_delivery_date" required>
                            </div>

                            <div class="mb-3">
                                <label for="order_status" class="form-label">Order Status</label>
                                <select class="form-select" name="order_status" required>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Cancelled">Cancelled</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="origin_address" class="form-label">Origin Address</label>
                                <input type="text" class="form-control" name="origin_address" required>
                            </div>

                            <div class="mb-3">
                                <label for="destination_address" class="form-label">Destination Address</label>
                                <input type="text" class="form-control" name="destination_address" required>
                            </div>

                            <div class="mb-3">
                                <label for="origin_port_shipment" class="form-label">Origin Port of Shipment</label>
                                <input type="text" class="form-control" name="origin_port_shipment">
                            </div>

                            <div class="mb-3">
                                <label for="depart_date_from_port" class="form-label">Departure Date from Port</label>
                                <input type="date" class="form-control" name="depart_date_from_port">
                            </div>

                            <div class="mb-3">
                                <label for="port_of_shipment" class="form-label">Port of Shipment</label>
                                <input type="text" class="form-control" name="port_of_shipment">
                            </div>

                            <div class="mb-3">
                                <label for="port_arrival_date" class="form-label">Port Arrival Date</label>
                                <input type="date" class="form-control" name="port_arrival_date">
                            </div>

                            <div class="mb-3">
                                <label for="port_leave_date" class="form-label">Port Leave Date</label>
                                <input type="date" class="form-control" name="port_leave_date">
                            </div>

                            <div class="mb-3">
                                <label for="remarks" class="form-label">Remarks</label>
                                <textarea class="form-control" name="remarks" rows="3"></textarea>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Schedule Delivery</button>


                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>