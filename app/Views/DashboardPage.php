<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
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
                        <a href="<?= site_url('orders/create') ?>" class="text-decoration-none">
                            <div class="card shadow-lg mb-4">
                                <div class="card-body text-center">
                                    <h4 class="card-title">Delivery Management</h4>
                                    <p class="card-text text-muted">Arrange and manage deliveries.</p>
                                    <span class="btn btn-primary">Go to Delivery</span>
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