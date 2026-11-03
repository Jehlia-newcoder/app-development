<?php $authenticated = session()->has('user_id'); ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Inventory Dashboard') ?> | Inventory</title>
    <link href="<?= base_url('template-preview/css/styles.css') ?>" rel="stylesheet">
</head>
<body class="<?= $authenticated ? 'sb-nav-fixed' : 'bg-primary' ?>">
<?php if ($authenticated): ?>
    <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
        <a class="navbar-brand ps-3" href="<?= site_url('dashboard') ?>">Inventory</a>
        <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" type="button" aria-label="Toggle navigation">
            <i class="fas fa-bars" aria-hidden="true"></i>
        </button>
        <div class="navbar-nav ms-auto me-3 me-lg-4">
            <span class="nav-link text-white"><?= esc(session()->get('username')) ?></span>
        </div>
        <form method="post" action="<?= site_url('logout') ?>" class="me-3 mb-0">
            <?= csrf_field() ?>
            <button class="btn btn-outline-light btn-sm" type="submit">Log out</button>
        </form>
    </nav>
    <div id="layoutSidenav">
        <div id="layoutSidenav_nav">
            <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion" aria-label="Main navigation">
                <div class="sb-sidenav-menu">
                    <div class="nav">
                        <div class="sb-sidenav-menu-heading">Inventory</div>
                        <a class="nav-link <?= uri_string() === 'dashboard' ? 'active' : '' ?>" href="<?= site_url('dashboard') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-gauge-high" aria-hidden="true"></i></div>
                            Dashboard
                        </a>
                        <a class="nav-link <?= str_starts_with(uri_string(), 'products') ? 'active' : '' ?>" href="<?= site_url('products') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-boxes-stacked" aria-hidden="true"></i></div>
                            Products
                        </a>
                        <a class="nav-link <?= str_starts_with(uri_string(), 'users') ? 'active' : '' ?>" href="<?= site_url('users') ?>">
                            <div class="sb-nav-link-icon"><i class="fas fa-users" aria-hidden="true"></i></div>
                            Users
                        </a>
                    </div>
                </div>
                <div class="sb-sidenav-footer">
                    <div class="small">Logged in as:</div>
                    <?= esc(session()->get('username')) ?>
                </div>
            </nav>
        </div>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4 py-4">
<?php else: ?>
    <div id="layoutAuthentication">
        <div id="layoutAuthentication_content">
            <main>
                <div class="container-fluid px-4 py-4">
<?php endif ?>
                    <?php if ($message = session()->getFlashdata('success')): ?>
                        <div class="alert alert-success" role="status"><?= esc($message) ?></div>
                    <?php endif ?>
                    <?php if ($message = session()->getFlashdata('error')): ?>
                        <div class="alert alert-danger" role="alert"><?= esc($message) ?></div>
                    <?php endif ?>
                    <?= $this->renderSection('content') ?>
                </div>
            </main>
<?php if ($authenticated): ?>
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="small text-muted">Inventory Manager &middot; Built with SB Admin and Bootstrap</div>
                </div>
            </footer>
        </div>
    </div>
<?php else: ?>
        </div>
        <div id="layoutAuthentication_footer">
            <footer class="py-4 bg-light mt-auto">
                <div class="container-fluid px-4">
                    <div class="small text-muted">Inventory Manager &middot; Built with SB Admin and Bootstrap</div>
                </div>
            </footer>
        </div>
    </div>
<?php endif ?>
<script src="<?= base_url('template-preview/js/bootstrap.bundle.min.js') ?>"></script>
<script src="<?= base_url('template-preview/js/fontawesome-all.js') ?>"></script>
<script src="<?= base_url('template-preview/js/scripts.js') ?>"></script>
</body>
</html>
