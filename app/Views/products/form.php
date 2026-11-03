<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$isEdit = $product !== null;
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><em class="fa fa-home"></em></a></li>
        <li><a href="<?= site_url('products') ?>">Products</a></li>
        <li class="active"><?= $isEdit ? 'Edit' : 'Add' ?></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $isEdit ? 'Edit product' : 'Add product' ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><em class="fa fa-cubes"></em> Product details</div>
            <div class="panel-body">
                <form method="post" action="<?= $isEdit ? site_url('products/' . $product['product_id']) : site_url('products') ?>">
                    <?= csrf_field() ?>
                    <div class="form-group <?= isset($errors['product_name']) ? 'has-error' : '' ?>">
                        <label for="product_name">Product name</label>
                        <input class="form-control" id="product_name" name="product_name" type="text" maxlength="255" value="<?= esc(old('product_name', $product['product_name'] ?? '')) ?>" required>
                        <?php if (isset($errors['product_name'])): ?><p class="help-block"><?= esc($errors['product_name']) ?></p><?php endif ?>
                    </div>

                    <div class="form-group <?= isset($errors['price']) ? 'has-error' : '' ?>">
                        <label for="price">Price</label>
                        <input class="form-control" id="price" name="price" type="number" min="0" step="0.01" value="<?= esc(old('price', $product['price'] ?? '')) ?>" required>
                        <?php if (isset($errors['price'])): ?><p class="help-block"><?= esc($errors['price']) ?></p><?php endif ?>
                    </div>

                    <div class="form-group <?= isset($errors['quantity']) ? 'has-error' : '' ?>">
                        <label for="quantity">Quantity</label>
                        <input class="form-control" id="quantity" name="quantity" type="number" min="0" step="1" value="<?= esc(old('quantity', $product['quantity'] ?? '')) ?>" required>
                        <?php if (isset($errors['quantity'])): ?><p class="help-block"><?= esc($errors['quantity']) ?></p><?php endif ?>
                    </div>

                    <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Add product' ?></button>
                    <a class="btn btn-default" href="<?= site_url('products') ?>">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
