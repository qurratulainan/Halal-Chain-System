<!DOCTYPE html>
<html>

<head>
    <title>Product History</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">

    <div class="container mt-5">
        <h3 class="mb-4">Product History</h3>
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Name</th>
                    <th>Code</th>
                    <th>Category</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($products)): ?>
                    <?php foreach ($products as $p): ?>
                        <tr>
                            <td><?= esc($p['product_id']) ?></td>
                            <td><?= esc($p['product_name']) ?></td>
                            <td><?= esc($p['product_code']) ?></td>
                            <td><?= esc($p['product_category']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">No products found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

</body>

</html>