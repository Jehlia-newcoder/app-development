<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= esc($title ?? 'Inventory Dashboard') ?> | Inventory</title>
    <style>
        :root { color-scheme: light; font-family: system-ui, -apple-system, "Segoe UI", sans-serif; color: #172033; background: #f3f5f9; }
        * { box-sizing: border-box; }
        body { margin: 0; min-height: 100vh; }
        a { color: #3156c8; text-decoration: none; }
        a:hover { text-decoration: underline; }
        .topbar { background: #18233b; color: #fff; }
        .nav { max-width: 1080px; margin: auto; min-height: 64px; padding: 12px 24px; display: flex; align-items: center; gap: 22px; }
        .brand { color: #fff; font-size: 1.1rem; font-weight: 700; margin-right: auto; }
        .nav a:not(.brand) { color: #dce4ff; }
        .nav form { margin: 0; }
        main { max-width: 1080px; margin: 34px auto; padding: 0 24px; }
        h1 { margin: 0 0 8px; font-size: 1.85rem; }
        h2 { margin-top: 0; }
        .muted { color: #67738b; }
        .page-head { display: flex; align-items: center; justify-content: space-between; gap: 16px; margin-bottom: 22px; }
        .panel, .card { background: #fff; border: 1px solid #e1e6ef; border-radius: 12px; box-shadow: 0 5px 18px #1720330b; }
        .panel { padding: 24px; }
        .cards { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 18px; margin-top: 26px; }
        .card { display: block; padding: 24px; color: inherit; }
        .card:hover { border-color: #9aabe8; text-decoration: none; }
        .count { display: block; font-size: 2rem; font-weight: 700; margin-top: 8px; }
        .button, button { display: inline-flex; align-items: center; justify-content: center; border: 0; border-radius: 7px; background: #3156c8; color: #fff; font: inherit; font-weight: 600; padding: 10px 15px; cursor: pointer; }
        .button:hover, button:hover { background: #2545a8; color: #fff; text-decoration: none; }
        .button.secondary { background: #e9edf5; color: #25324a; }
        .button.danger, button.danger { background: #b83245; }
        button.small { padding: 7px 10px; font-size: .9rem; }
        .actions { display: flex; align-items: center; gap: 8px; }
        .actions form { margin: 0; }
        .table-wrap { overflow-x: auto; }
        table { width: 100%; border-collapse: collapse; }
        th, td { padding: 14px 12px; border-bottom: 1px solid #e9edf3; text-align: left; vertical-align: middle; }
        th { color: #64708a; font-size: .85rem; text-transform: uppercase; letter-spacing: .04em; }
        tr:last-child td { border-bottom: 0; }
        label { display: block; font-weight: 600; margin: 16px 0 6px; }
        input { display: block; width: 100%; max-width: 520px; padding: 11px 12px; border: 1px solid #cbd3e0; border-radius: 7px; font: inherit; }
        input:focus { outline: 3px solid #3156c833; border-color: #3156c8; }
        .form-actions { display: flex; gap: 10px; margin-top: 22px; }
        .alert { padding: 12px 15px; border-radius: 8px; margin-bottom: 18px; }
        .alert.success { color: #155c38; background: #e4f6ed; }
        .alert.error, .field-error { color: #982b3c; background: #fff0f1; }
        .field-error { display: block; background: transparent; margin-top: 5px; }
        .empty { padding: 26px; color: #67738b; text-align: center; }
        .login-wrap { max-width: 460px; margin: 8vh auto; }
        @media (max-width: 600px) {
            .nav { flex-wrap: wrap; gap: 14px; padding: 12px 18px; }
            main { margin: 24px auto; padding: 0 16px; }
            .page-head { align-items: flex-start; flex-direction: column; }
            .panel { padding: 18px; }
        }
    </style>
</head>
<body>
<header class="topbar">
    <nav class="nav" aria-label="Main navigation">
        <a class="brand" href="<?= site_url(session()->has('user_id') ? 'dashboard' : 'login') ?>">Inventory</a>
        <?php if (session()->has('user_id')): ?>
            <a href="<?= site_url('dashboard') ?>">Dashboard</a>
            <a href="<?= site_url('products') ?>">Products</a>
            <a href="<?= site_url('users') ?>">Users</a>
            <span><?= esc(session()->get('username')) ?></span>
            <form method="post" action="<?= site_url('logout') ?>">
                <?= csrf_field() ?>
                <button class="small" type="submit">Log out</button>
            </form>
        <?php endif ?>
    </nav>
</header>
<main>
    <?php if ($message = session()->getFlashdata('success')): ?>
        <div class="alert success" role="status"><?= esc($message) ?></div>
    <?php endif ?>
    <?php if ($message = session()->getFlashdata('error')): ?>
        <div class="alert error" role="alert"><?= esc($message) ?></div>
    <?php endif ?>
    <?= $this->renderSection('content') ?>
</main>
</body>
</html>
