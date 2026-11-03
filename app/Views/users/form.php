<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<?php
$errors = session()->getFlashdata('errors') ?? [];
$isEdit = $user !== null;
?>
<div class="page-head">
    <div>
        <h1><?= $isEdit ? 'Edit user' : 'Add user' ?></h1>
        <p class="muted"><?= $isEdit ? 'Leave the password empty to keep it unchanged.' : 'Create a new sign-in account.' ?></p>
    </div>
    <a class="button secondary" href="<?= site_url('users') ?>">Back to users</a>
</div>
<section class="panel">
    <form method="post" action="<?= $isEdit ? site_url('users/' . $user['user_id']) : site_url('users') ?>">
        <?= csrf_field() ?>
        <label for="username">Username</label>
        <input id="username" name="username" type="text" minlength="3" maxlength="100" value="<?= esc(old('username', $user['username'] ?? '')) ?>" autocomplete="username" required>
        <?php if (isset($errors['username'])): ?><span class="field-error"><?= esc($errors['username']) ?></span><?php endif ?>

        <label for="password"><?= $isEdit ? 'New password' : 'Password' ?></label>
        <input id="password" name="password" type="password" minlength="8" maxlength="255" autocomplete="new-password" <?= $isEdit ? '' : 'required' ?>>
        <?php if (isset($errors['password'])): ?><span class="field-error"><?= esc($errors['password']) ?></span><?php endif ?>

        <div class="form-actions">
            <button type="submit"><?= $isEdit ? 'Save changes' : 'Add user' ?></button>
            <a class="button secondary" href="<?= site_url('users') ?>">Cancel</a>
        </div>
    </form>
</section>
<?= $this->endSection() ?>
