<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><em class="fa fa-home"></em></a></li>
        <li class="active">Dashboard</li>
    </ol>
</div>
<div class="page-heading">
    <div>
        <h1>Dashboard</h1>
        <p>Your inventory at a glance.</p>
    </div>
    <a class="btn btn-primary" href="<?= site_url('products/new') ?>"><em class="fa fa-plus"></em> Add product</a>
</div>
<div class="row stats-grid">
    <div class="col-xs-12 col-sm-6 col-lg-4">
        <a href="<?= site_url('products') ?>" class="dashboard-stat-link">
            <div class="stat-card stat-card-products">
                <div class="stat-card-icon"><em class="fa fa-cubes" aria-hidden="true"></em></div>
                <div class="stat-card-content">
                    <span class="stat-card-label">Products</span>
                    <strong class="stat-card-value"><?= esc($productCount) ?></strong>
                    <span class="stat-card-link">View product catalog <em class="fa fa-arrow-right" aria-hidden="true"></em></span>
                </div>
            </div>
        </a>
    </div>
    <div class="col-xs-12 col-sm-6 col-lg-4">
        <a href="<?= site_url('users') ?>" class="dashboard-stat-link">
            <div class="stat-card stat-card-users">
                <div class="stat-card-icon"><em class="fa fa-users" aria-hidden="true"></em></div>
                <div class="stat-card-content">
                    <span class="stat-card-label">User accounts</span>
                    <strong class="stat-card-value"><?= esc($userCount) ?></strong>
                    <span class="stat-card-link">Manage accounts <em class="fa fa-arrow-right" aria-hidden="true"></em></span>
                </div>
            </div>
        </a>
    </div>
</div>
<?= $this->endSection() ?>
