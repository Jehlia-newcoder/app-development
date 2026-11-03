<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$isEdit = $product !== null;
?>
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
    <h1 class="mt-4"><?= $isEdit ? 'Edit product' : 'Add product' ?></h1>
    <a class="btn btn-outline-secondary" href="<?= site_url('products') ?>">Back to products</a>
</div>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('products') ?>">Products</a></li>
    <li class="breadcrumb-item active"><?= $isEdit ? 'Edit' : 'Add' ?></li>
</ol>
<section class="card mb-4">
    <div class="card-header">
        <i class="fas fa-box-open me-1" aria-hidden="true"></i>
        Product details
    </div>
    <div class="card-body">
        <form method="post" action="<?= $isEdit ? site_url('products/' . $product['product_id']) : site_url('products') ?>">
            <?= csrf_field() ?>
            <div class="form-floating mb-3">
                <input class="form-control <?= isset($errors['product_name']) ? 'is-invalid' : '' ?>" id="product_name" name="product_name" type="text" placeholder="Product name" maxlength="255" value="<?= esc(old('product_name', $product['product_name'] ?? '')) ?>" required>
                <label for="product_name">Product name</label>
                <?php if (isset($errors['product_name'])): ?><div class="invalid-feedback d-block"><?= esc($errors['product_name']) ?></div><?php endif ?>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control <?= isset($errors['price']) ? 'is-invalid' : '' ?>" id="price" name="price" type="number" placeholder="Price" min="0" step="0.01" value="<?= esc(old('price', $product['price'] ?? '')) ?>" required>
                <label for="price">Price</label>
                <?php if (isset($errors['price'])): ?><div class="invalid-feedback d-block"><?= esc($errors['price']) ?></div><?php endif ?>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control <?= isset($errors['quantity']) ? 'is-invalid' : '' ?>" id="quantity" name="quantity" type="number" placeholder="Quantity" min="0" step="1" value="<?= esc(old('quantity', $product['quantity'] ?? '')) ?>" required>
                <label for="quantity">Quantity</label>
                <?php if (isset($errors['quantity'])): ?><div class="invalid-feedback d-block"><?= esc($errors['quantity']) ?></div><?php endif ?>
            </div>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Add product' ?></button>
                <a class="btn btn-secondary" href="<?= site_url('products') ?>">Cancel</a>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
