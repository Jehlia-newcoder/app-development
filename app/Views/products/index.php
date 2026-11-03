<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-head">
    <div>
        <h1>Products</h1>
        <p class="muted">View and manage your product catalog.</p>
    </div>
    <a class="button" href="<?= site_url('products/new') ?>">Add product</a>
</div>
<section class="panel">
    <?php if ($products === []): ?>
        <div class="empty">No products yet. Add your first product to get started.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>ID</th><th>Product</th><th>Price</th><th>Quantity</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?= esc($product['product_id']) ?></td>
                        <td><?= esc($product['product_name']) ?></td>
                        <td><?= esc(number_format((float) $product['price'], 2)) ?></td>
                        <td><?= esc($product['quantity']) ?></td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="<?= site_url('products/' . $product['product_id'] . '/edit') ?>">Edit</a>
                                <form method="post" action="<?= site_url('products/' . $product['product_id'] . '/delete') ?>" onsubmit="return confirm('Delete this product?')">
                                    <?= csrf_field() ?>
                                    <button class="danger" type="submit">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>
<?= $this->endSection() ?>
