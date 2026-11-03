<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$isEdit = $user !== null;
?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><em class="fa fa-home"></em></a></li>
        <li><a href="<?= site_url('users') ?>">Users</a></li>
        <li class="active"><?= $isEdit ? 'Edit' : 'Add' ?></li>
    </ol>
</div>
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header"><?= $isEdit ? 'Edit user' : 'Add user' ?></h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-8">
        <div class="panel panel-default">
            <div class="panel-heading"><em class="fa fa-user"></em> User account details</div>
            <div class="panel-body">
                <form method="post" action="<?= $isEdit ? site_url('users/' . $user['user_id']) : site_url('users') ?>">
                    <?= csrf_field() ?>
                    <div class="form-group <?= isset($errors['username']) ? 'has-error' : '' ?>">
                        <label for="username">Username</label>
                        <input class="form-control" id="username" name="username" type="text" minlength="3" maxlength="100" value="<?= esc(old('username', $user['username'] ?? '')) ?>" autocomplete="username" required>
                        <?php if (isset($errors['username'])): ?><p class="help-block"><?= esc($errors['username']) ?></p><?php endif ?>
                    </div>

                    <div class="form-group <?= isset($errors['password']) ? 'has-error' : '' ?>">
                        <label for="password"><?= $isEdit ? 'New password (optional)' : 'Password' ?></label>
                        <input class="form-control" id="password" name="password" type="password" minlength="8" maxlength="255" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
                        <?php if (isset($errors['password'])): ?><p class="help-block"><?= esc($errors['password']) ?></p><?php endif ?>
                    </div>
                    <?php if ($isEdit): ?>
                        <p class="help-block">Leave the password empty to keep it unchanged.</p>
                    <?php endif ?>

                    <button class="btn btn-primary" type="submit"><?= $isEdit ? 'Save changes' : 'Add user' ?></button>
                    <a class="btn btn-default" href="<?= site_url('users') ?>">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
