<head>
    <meta charset="UTF-8">
    <title>Register Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Register</h3>

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

                        <form action="<?= site_url('register/store') ?>" method="post">
                            <?= csrf_field() ?>

                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" name="full_name" id="full_name" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="phone_number" class="form-label">Phone Number</label>
                                <input type="text" name="phone_number" id="phone_number" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="halal_cert_number" class="form-label">Halal Cert Number</label>
                                <input type="text" name="halal_cert_number" id="halal_cert_number" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="halal_expired_date" class="form-label">Halal Certificate Expiry Date</label>
                                <input type="datetime-local" name="halal_expired_date" id="halal_expired_date" class="form-control" required>
                            </div>

                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" name="address" id="address" class="form-control">
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select name="role_id" id="role_id" class="form-select" required>
                                    <option value="">Select Role</option>
                                    <?php foreach ($roles as $role): ?>
                                        <option value="<?= esc($role['role_id']) ?>"><?= esc($role['role_name']) ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="organisation_name" class="form-label">Organisation Name</label>
                                <input type="text" name="organisation_name" id="organisation_name" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>

                        <hr>
                        <p class="text-center">
                            Already have an account?
                            <a href="<?= site_url('login') ?>">Login here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>