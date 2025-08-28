<head>
    <meta charset="UTF-8">
    <title>Product Page</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Add Product</h3>

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

                        <form action="<?= site_url('product/store') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name</label>
                                <input type="text" name="product_name" id="product_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="product_code" class="form-label">Product Code</label>
                                <input type="text" name="product_code" id="product_code" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="product_category" class="form-label">Product Category</label>
                                <input type="text" name="product_category" id="product_category" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="animal_name" class="form-label">Animal Name</label>
                                <input type="text" name="animal_name" id="animal_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="animal_breed" class="form-label">Animal Breed</label>
                                <input type="text" name="animal_breed" id="animal_breed" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="meat_name" class="form-label">Meat Name</label>
                                <input type="text" name="meat_name" id="meat_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="meat_part" class="form-label">Meat Part</label>
                                <input type="text" name="meat_part" id="meat_part" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="country_id" class="form-label">Country</label>
                                <select name="country_id" id="country_id" class="form-control" required>
                                    <option value="">Select Country</option>
                                    <?php foreach ($countries as $country): ?>
                                        <option value="<?= esc($country['country_name']) ?>"><?= esc($country['country_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="product_price" class="form-label">Product Price</label>
                                <input type="text" name="product_price" id="product_price" class="form-control" required>
                            </div>

                            <!-- <div class="mb-3">
                                <label for="halal_cert_number" class="form-label">Halal Cert Number</label>
                                <input type="text" name="halal_cert_number" id="halal_cert_number" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="halal_expired_date" class="form-label">Halal Certificate Expiry Date</label>
                                <input type="datetime-local" name="halal_expired_date" id="halal_expired_date" class="form-control" required>
                            </div> -->

                            <!-- <div class="mb-3">
                                <label for="date_of_processing" class="form-label">Date of Processing</label>
                                <input type="date" name="date_of_processing" id="date_of_processing" class="form-control">
                            </div> -->

                            <button type="submit" class="btn btn-primary w-100">Add Product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>