<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1>Dashboard</h1>
<p class="muted">Choose an area to manage.</p>
<div class="cards">
    <a class="card" href="<?= site_url('products') ?>">
        <span class="muted">Product catalog</span>
        <span class="count"><?= esc($productCount) ?></span>
        <span>View and manage products →</span>
    </a>
    <a class="card" href="<?= site_url('users') ?>">
        <span class="muted">User accounts</span>
        <span class="count"><?= esc($userCount) ?></span>
        <span>View and manage users →</span>
    </a>
</div>
<?= $this->endSection() ?>
