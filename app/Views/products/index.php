<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
    <h1 class="mt-4">Products</h1>
    <a class="btn btn-primary" href="<?= site_url('products/new') ?>">Add product</a>
</div>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Products</li>
</ol>
<section class="card mb-4">
    <div class="card-header">
        <i class="fas fa-box-open me-1" aria-hidden="true"></i>
        Product catalog
    </div>
    <?php if ($products === []): ?>
        <div class="card-body text-center text-muted py-5">No products yet. Add your first product to get started.</div>
    <?php else: ?>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead><tr><th scope="col">ID</th><th scope="col">Product</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">Actions</th></tr></thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= esc($product['product_id']) ?></td>
                        <td><?= esc($product['product_name']) ?></td>
                        <td><?= esc(number_format((float) $product['price'], 2)) ?></td>
                        <td><?= esc($product['quantity']) ?></td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('products/' . $product['product_id'] . '/edit') ?>">Edit</a>
                                <form method="post" action="<?= site_url('products/' . $product['product_id'] . '/delete') ?>" onsubmit="return confirm('Delete this product?')" class="m-0">
                                    <?= csrf_field() ?>
                                    <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
    <?php endif ?>
</section>
<?= $this->endSection() ?>
