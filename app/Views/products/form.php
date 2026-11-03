<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$isEdit = $product !== null;
?>
<div class="page-head">
    <div>
        <h1><?= $isEdit ? 'Edit product' : 'Add product' ?></h1>
        <p class="muted">Enter the product details below.</p>
    </div>
    <a class="button secondary" href="<?= site_url('products') ?>">Back to products</a>
</div>
<section class="panel">
    <form method="post" action="<?= $isEdit ? site_url('products/' . $product['product_id']) : site_url('products') ?>">
        <?= csrf_field() ?>
        <label for="product_name">Product name</label>
        <input id="product_name" name="product_name" type="text" maxlength="255" value="<?= esc(old('product_name', $product['product_name'] ?? '')) ?>" required>
        <?php if (isset($errors['product_name'])): ?><span class="field-error"><?= esc($errors['product_name']) ?></span><?php endif ?>

        <label for="price">Price</label>
        <input id="price" name="price" type="number" min="0" step="0.01" value="<?= esc(old('price', $product['price'] ?? '')) ?>" required>
        <?php if (isset($errors['price'])): ?><span class="field-error"><?= esc($errors['price']) ?></span><?php endif ?>

        <label for="quantity">Quantity</label>
        <input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= esc(old('quantity', $product['quantity'] ?? '')) ?>" required>
        <?php if (isset($errors['quantity'])): ?><span class="field-error"><?= esc($errors['quantity']) ?></span><?php endif ?>

        <div class="form-actions">
            <button type="submit"><?= $isEdit ? 'Save changes' : 'Add product' ?></button>
            <a class="button secondary" href="<?= site_url('products') ?>">Cancel</a>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
