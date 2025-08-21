<!DOCTYPE html>
<html>

<head>
    <title>Halal Chain Authenticate</title>
    <link rel="stylesheet" type="text/css" href="<?= base_url('assets/css/style.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
</head>

<body>
    <div class="main">
        <input type="checkbox" id="chk" aria-hidden="true">
        <div class="signup">

            <?php if (session()->getFlashdata('success')): ?>
                <div class="alert alert-success">
                    <?= session()->getFlashdata('success') ?>
                </div>
            <?php endif; ?>
            <form action="<?= base_url('loginsubmit') ?>" method="post">
                <label for="chk" aria-hidden="true">Login</label>
                <input type="email" name="email" placeholder="Email" class="<?= session()->getFlashdata('error') ? 'error-input' : '' ?>" required="">
                <input type="password" name="pswd" placeholder="Password" class="<?= session()->getFlashdata('error') ? 'error-input' : '' ?>" required="">
                <?php if (session()->getFlashdata('error')): ?>
                    <div class="error-message"><?= session()->getFlashdata('error') ?></div>
                <?php endif; ?>
                <button>Login</button>

            </form>
        </div>

        <div class="login">
            <form>
                <label for="chk" aria-hidden="true">Sign up</label>
                <input type="text" name="txt" placeholder="User name" required="">
                <input type="email" name="email" placeholder="Email" required="">
                <input type="number" name="broj" placeholder="BrojTelefona" required="">
                <input type="password" name="pswd" placeholder="Password" required="">
                <button>Sign up</button>
            </form>
        </div>
    </div>
</body>

</html>