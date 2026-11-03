<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<h1 class="mt-4">Dashboard</h1>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item active">Dashboard</li>
</ol>
<div class="row">
    <div class="col-xl-3 col-md-6">
        <div class="card bg-primary text-white mb-4">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="small text-white-50">Product catalog</div>
                    <div class="fs-2 fw-bold"><?= esc($productCount) ?></div>
                </div>
                <i class="fas fa-boxes-stacked fa-3x text-white-50" aria-hidden="true"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= site_url('products') ?>">View products</a>
                <i class="fas fa-angle-right small text-white" aria-hidden="true"></i>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="card bg-success text-white mb-4">
            <div class="card-body d-flex align-items-center justify-content-between">
                <div>
                    <div class="small text-white-50">User accounts</div>
                    <div class="fs-2 fw-bold"><?= esc($userCount) ?></div>
                </div>
                <i class="fas fa-users fa-3x text-white-50" aria-hidden="true"></i>
            </div>
            <div class="card-footer d-flex align-items-center justify-content-between">
                <a class="small text-white stretched-link" href="<?= site_url('users') ?>">Manage users</a>
                <i class="fas fa-angle-right small text-white" aria-hidden="true"></i>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
