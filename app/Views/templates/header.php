<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= esc($title) ?> - Alkesin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <style>
        :root {
            --alkesin-teal: #0d9488;
            --alkesin-teal-dark: #0f766e;
            --alkesin-blue: #1e40af;
            --alkesin-bg: #f4f7f8;
        }

        body {
            background: var(--alkesin-bg);
            font-family: 'Segoe UI', system-ui, sans-serif;
        }

        .sidebar {
            width: 240px;
            min-height: 100vh;
            background: linear-gradient(180deg, var(--alkesin-teal-dark), #134e4a);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            flex-direction: column;
        }

        .sidebar .brand {
            padding: 22px 20px;
            color: #fff;
            font-weight: 700;
            font-size: 1.25rem;
            letter-spacing: 0.5px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }

        .sidebar .brand span {
            color: #5eead4;
        }

        .sidebar a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.8);
            padding: 12px 20px;
            text-decoration: none;
            font-size: 0.94rem;
            transition: 0.15s;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, 0.1);
            color: #fff;
            border-left: 3px solid #5eead4;
        }

        .sidebar-menu {
            flex: 1;
        }

        .sidebar-logout {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            padding: 10px 0;
        }

        .sidebar-logout a {
            color: #f5443b !important;
            font-weight: 600;
        }

        .sidebar-logout a:hover {
            background: #e02f26 !important;
            color: #fecaca !important;
            border-left: 3px solid #ef4444 !important;
        }

        .main-content {
            margin-left: 240px;
            padding: 0;
        }

        .topbar {
            background: #fff;
            padding: 14px 28px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.06);
        }

        .content-area {
            padding: 28px;
        }

        .card-stat {
            border: none;
            border-radius: 14px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
        }

        .btn-alkesin {
            background: var(--alkesin-teal);
            border: none;
            color: #fff;
        }

        .btn-alkesin:hover {
            background: var(--alkesin-teal-dark);
            color: #fff;
        }

        table thead {
            background: #ecfdf5;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="brand">ALKE<span>SIN</span></div>

        <div class="sidebar-menu">
            <a href="<?= base_url('home') ?>" class="<?= (uri_string() == 'home') ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="<?= base_url('produk') ?>" class="<?= (strpos(uri_string(), 'produk') === 0) ? 'active' : '' ?>">
                <i class="bi bi-box-seam"></i> Data Produk
            </a>
            <a href="<?= base_url('stok-gudang') ?>" class="<?= (strpos(uri_string(), 'stok-gudang') === 0) ? 'active' : '' ?>">
                <i class="bi bi-truck"></i> Stok Gudang
            </a>
            <a href="<?= base_url('transaksi') ?>" class="<?= (strpos(uri_string(), 'transaksi') === 0) ? 'active' : '' ?>">
                <i class="bi bi-receipt"></i> Transaksi Pembelian
            </a>
        </div>

        <div class="sidebar-logout">
            <a href="<?= base_url('logout') ?>">
                <i class="bi bi-box-arrow-right"></i> Logout
            </a>
        </div>
    </div>

    <div class="main-content">
        <div class="topbar">
            <h5 class="mb-0 fw-semibold text-dark"><?= esc($title) ?></h5>
            <div class="text-muted">
                <i class="bi bi-person-circle"></i> <?= esc(session()->get('full_name')) ?>
            </div>
        </div>
        <div class="content-area">