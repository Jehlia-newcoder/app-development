<?php
$authenticated = session()->has('user_id');
$currentPath = uri_string();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Inventory Dashboard') ?> | Inventory</title>
    <link href="<?= base_url('assets/lumino/css/bootstrap.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/lumino/css/font-awesome.min.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/lumino/css/styles.css') ?>" rel="stylesheet">
    <link href="<?= base_url('assets/lumino/css/app.css') ?>" rel="stylesheet">
</head>
<body class="<?= $authenticated ? 'app-authenticated' : 'app-guest' ?>">
<?php if ($authenticated): ?>
    <nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
        <div class="container-fluid">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="<?= site_url('dashboard') ?>"><span>Inventory</span> Manager</a>
                <ul class="nav navbar-top-links navbar-right">
                    <li><span class="navbar-text"><?= esc(session()->get('username')) ?></span></li>
                    <li>
                        <form method="post" action="<?= site_url('logout') ?>" class="navbar-form">
                            <?= csrf_field() ?>
                            <button class="btn btn-default btn-sm" type="submit">Log out</button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
        <div class="profile-sidebar">
            <div class="profile-userpic"><i class="fa fa-user-circle fa-3x" aria-hidden="true"></i></div>
            <div class="profile-usertitle">
                <div class="profile-usertitle-name"><?= esc(session()->get('username')) ?></div>
                <div class="profile-usertitle-status"><span class="indicator label-success"></span>Signed in</div>
            </div>
            <div class="clear"></div>
        </div>
        <ul class="nav menu">
            <li class="<?= $currentPath === 'dashboard' ? 'active' : '' ?>">
                <a href="<?= site_url('dashboard') ?>"><em class="fa fa-dashboard">&nbsp;</em> Dashboard</a>
            </li>
            <li class="<?= str_starts_with($currentPath, 'products') ? 'active' : '' ?>">
                <a href="<?= site_url('products') ?>"><em class="fa fa-cubes">&nbsp;</em> Products</a>
            </li>
            <li class="<?= str_starts_with($currentPath, 'users') ? 'active' : '' ?>">
                <a href="<?= site_url('users') ?>"><em class="fa fa-users">&nbsp;</em> Users</a>
            </li>
        </ul>
    </div>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
<?php else: ?>
    <div class="container">
<?php endif ?>
        <?php if ($message = session()->getFlashdata('success')): ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-success" role="status"><?= esc($message) ?></div>
                </div>
            </div>
        <?php endif ?>
        <?php if ($message = session()->getFlashdata('error')): ?>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-danger" role="alert"><?= esc($message === 'The action you requested is not allowed.' ? 'This form expired or was already submitted. Please review and try again.' : $message) ?></div>
                </div>
            </div>
        <?php endif ?>
        <?= $this->renderSection('content') ?>
    </div>
<script src="<?= base_url('assets/lumino/js/jquery-1.11.1.min.js') ?>"></script>
<script src="<?= base_url('assets/lumino/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/lumino/js/custom.js?v=2') ?>"></script>
</body>
</html>
