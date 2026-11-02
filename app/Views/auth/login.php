<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Alkesin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0f766e, #1e40af);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .login-card {
            width: 100%;
            max-width: 380px;
            background: #fff;
            border-radius: 16px;
            padding: 40px 32px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
        }

        .login-logo {
            width: 60px;
            height: 60px;
            background: #0d9488;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.6rem;
            margin: 0 auto 16px;
        }

        .btn-alkesin {
            background: #0d9488;
            border: none;
        }

        .btn-alkesin:hover {
            background: #0f766e;
        }
    </style>
</head>

<body>
    <div class="login-card">
        <div class="text-center mb-3">
            <div class="login-logo"><i class="bi bi-heart-pulse-fill"></i></div>
            <h4 class="fw-bold mb-0">ALKE<span style="color:#0d9488">SIN</span></h4>
            <small class="text-muted">Sistem Manajemen Alat Kesehatan</small>
        </div>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="alert alert-danger py-2"><?= session()->getFlashdata('error') ?></div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('success')): ?>
            <div class="alert alert-success py-2"><?= session()->getFlashdata('success') ?></div>
        <?php endif; ?>

        <form action="<?= base_url('login') ?>" method="post">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label class="form-label">Username</label>
                <input type="text" name="username" class="form-control" required autofocus>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-alkesin w-100 text-white fw-semibold py-2">Masuk</button>
        </form>
        <p class="text-center text-muted small mt-3 mb-0">Default: admin / admin123</p>
    </div>
</body>

</html>