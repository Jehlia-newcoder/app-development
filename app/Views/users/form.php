<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$isEdit = $user !== null;
?>
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
    <h1 class="mt-4"><?= $isEdit ? 'Edit user' : 'Add user' ?></h1>
    <a class="btn btn-outline-secondary" href="<?= site_url('users') ?>">Back to users</a>
</div>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item"><a href="<?= site_url('users') ?>">Users</a></li>
    <li class="breadcrumb-item active"><?= $isEdit ? 'Edit' : 'Add' ?></li>
</ol>
<section class="card mb-4">
    <div class="card-header">
        <i class="fas fa-user me-1" aria-hidden="true"></i>
        User account details
    </div>
    <div class="card-body">
        <form method="post" action="<?= $isEdit ? site_url('users/' . $user['user_id']) : site_url('users') ?>">
            <?= csrf_field() ?>
            <div class="form-floating mb-3">
                <input class="form-control <?= isset($errors['username']) ? 'is-invalid' : '' ?>" id="username" name="username" type="text" placeholder="Username" minlength="3" maxlength="100" value="<?= esc(old('username', $user['username'] ?? '')) ?>" autocomplete="username" required>
                <label for="username">Username</label>
                <?php if (isset($errors['username'])): ?><div class="invalid-feedback d-block"><?= esc($errors['username']) ?></div><?php endif ?>
            </div>

            <div class="form-floating mb-3">
                <input class="form-control <?= isset($errors['password']) ? 'is-invalid' : '' ?>" id="password" name="password" type="password" placeholder="Password" minlength="8" maxlength="255" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
                <label for="password"><?= $isEdit ? 'New password (optional)' : 'Password' ?></label>
                <?php if (isset($errors['password'])): ?><div class="invalid-feedback d-block"><?= esc($errors['password']) ?></div><?php endif ?>
            </div>
            <?php if ($isEdit): ?>
                <p class="form-text">Leave the password empty to keep it unchanged.</p>
            <?php endif ?>

            <div class="d-flex flex-wrap gap-2 mt-4">
                <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Add user' ?></button>
                <a class="btn btn-secondary" href="<?= site_url('users') ?>">Cancel</a>
            </div>
        </form>
    </div>
</section>
<?= $this->endSection() ?>
