<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><em class="fa fa-home"></em></a></li>
        <li class="active">Products</li>
    </ol>
</div>
<div class="page-heading">
    <div>
        <h1>Products</h1>
        <p>Manage your product catalog and stock.</p>
    </div>
    <a class="btn btn-primary" href="<?= site_url('products/new') ?>"><em class="fa fa-plus"></em> Add product</a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><em class="fa fa-cubes"></em> Product catalog</span>
                <span class="panel-heading-count"><?= count($products) ?> <?= count($products) === 1 ? 'item' : 'items' ?></span>
            </div>
            <div class="panel-body">
                <?php if ($products === []): ?>
                    <p class="text-muted text-center">No products yet. Add your first product to get started.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead><tr><th scope="col">ID</th><th scope="col">Product</th><th scope="col">Price</th><th scope="col">Quantity</th><th scope="col">Actions</th></tr></thead>
                            <tbody>
                            <?php foreach ($products as $product): ?>
                                <tr>
                                    <td><?= esc($product['product_id']) ?></td>
                                    <td><?= esc($product['product_name']) ?></td>
                                    <td><?= esc(number_format((float) $product['price'], 2)) ?></td>
                                    <td><?= esc($product['quantity']) ?></td>
                                    <td>
                                        <a class="btn btn-default btn-xs" href="<?= site_url('products/' . $product['product_id'] . '/edit') ?>"><em class="fa fa-pencil"></em> Edit</a>
                                        <form method="post" action="<?= site_url('products/' . $product['product_id'] . '/delete') ?>" onsubmit="return confirm('Delete this product?')" class="inline-form">
                                            <?= csrf_field() ?>
                                            <button class="btn btn-danger btn-xs" type="submit"><em class="fa fa-trash"></em> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
