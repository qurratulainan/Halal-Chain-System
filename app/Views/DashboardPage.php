<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-5">
                    <h2>Welcome to Halal Chain Dashboard</h2>
                    <p class="text-muted">Choose an action below to proceed.</p>
                </div>
                <div class="row justify-content-center">
                    <div class="col-md-5">
                        <a href="<?= site_url('product/history') ?>" class="text-decoration-none">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body text-center">
                                    <h4 class="card-title">Product</h4>
                                    <p class="card-text text-muted">View and manage your products.</p>
                                    <span class="btn btn-success">Go to Product</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5">
                        <a href="<?= site_url('order') ?>" class="text-decoration-none">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body text-center">
                                    <h4 class="card-title">Order</h4>
                                    <p class="card-text text-muted">Place a new order or view your orders.</p>
                                    <span class="btn btn-primary">Go to Order</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="text-center mt-4">
                    <a href="<?= site_url('product') ?>" class="btn btn-outline-secondary">Add New Product</a>
                    <a href="<?= site_url('product/history') ?>" class="btn btn-outline-secondary">Product History</a>
                    <a href="<?= site_url('logout') ?>" class="btn btn-outline-danger ms-2">Logout</a>
                </div>
            </div>
        </div>
    </div>
</body>