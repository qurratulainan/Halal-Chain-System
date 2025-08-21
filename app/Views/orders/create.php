<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Place an Order</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow-sm">
            <div class="card-header bg-success text-white">
                <h4 class="mb-0">Delivery Management Page</h4>
            </div>
            <div class="card-body">
                <form action="<?= base_url('orders/store') ?>" method="post">
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

                    <!-- <p><strong>Price:</strong> RM <span id="price-display">0.00</span></p> -->

                    <div class="row">
                        <div class="col-md-4 mb-3">
                            <label for="quantity" class="form-label">Quantity in (kg)</label>
                            <input type="number" class="form-control" name="quantity" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="order_date" class="form-label">Order Date</label>
                            <input type="date" class="form-control" name="order_date" required>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="origin_address" class="form-label">Origin Address</label>
                            <textarea class="form-control" name="origin_address" rows="2" required></textarea>

                            <div class="col-md-4 mb-3">
                                <label for="expected_delivery_date" class="form-label">Expected Delivery</label>
                                <input type="date" class="form-control" name="expected_delivery_date" required>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="order_status" class="form-label">Order Status</label>
                            <select class="form-select" name="order_status" required>
                                <option value="Pending">Pending</option>
                                <option value="Approved">Approved</option>
                                <option value="Cancelled">Cancelled</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="destination_address" class="form-label">Destination Address</label>
                            <textarea class="form-control" name="destination_address" rows="2" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="origin_port_shipment" class="form-label">Origin Port of Shipment</label>
                            <textarea class="form-control" name="origin_port_shipment" rows="2"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="depart_date_from_port" class="form-label">Depart Date from Port</label>
                            <input type="date" class="form-control" name="depart_date_from_port">
                        </div>

                        <div class="mb-3">
                            <label for="port_of_shipment" class="form-label">Port of Shipment</label>
                            <textarea class="form-control" name="port_of_shipment" rows="2"></textarea>
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
                            <textarea class="form-control" name="remarks" rows="2"></textarea>
                        </div>

                        <button type="submit" class="btn btn-success">Create Order</button>
                </form>
            </div>
        </div>
    </div>

</body>

</html>

<!-- <script>
    document.getElementById('product_id').addEventListener('change', function() {
        var selected = this.options[this.selectedIndex];
        var price = selected.getAttribute('data-unitprice');
        document.getElementById('price-display').innerText = price ? parseFloat(price).toFixed(2) : "0.00";
    });

    document.addEventListener("DOMContentLoaded", function() {
        const productSelect = document.getElementById("product_id");
        const quantityInput = document.getElementById("quantity");
        const totalPriceField = document.getElementById("total_price");
        const hiddenTotalPrice = document.getElementById("hidden_total_price");

        function calculateTotal() {
            const unitPrice = parseFloat(productSelect.selectedOptions[0]?.getAttribute("data-unitprice")) || 0;
            const quantity = parseInt(quantityInput.value) || 0;
            const total = unitPrice * quantity;

            totalPriceField.value = total.toFixed(2); // shows nicely
            hiddenTotalPrice.value = total; // sends to backend
        }

        productSelect.addEventListener("change", calculateTotal);
        quantityInput.addEventListener("input", calculateTotal);
    });
</script> -->