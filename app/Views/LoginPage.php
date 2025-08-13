<head>
    <meta charset="UTF-8">
    <title>Login Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h3 class="card-title text-center mb-4">Login</h3>

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

                        <form action="<?= site_url('dashboard') ?>" method="post">
                            <?= csrf_field() ?>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Enter your email" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control" placeholder="Enter your password" required>
                            </div>

                            <div class="mb-3">
                                <label for="role_id" class="form-label">Role</label>
                                <select name="role_id" id="role_id" class="form-select" required>
                                    <option value="">Select Role</option>
                                    <?php if (!empty($roles) && is_array($roles)): ?>
                                        <?php foreach ($roles as $role): ?>
                                            <option value="<?= esc($role['role_id']) ?>"><?= esc($role['role_name']) ?></option>
                                        <?php endforeach; ?>
                                    <?php endif; ?>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                        <hr>
                        <p class="text-center">
                            Don’t have an account?
                            <a href="<?= site_url('RegisterPage') ?>">Register here</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>