<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="login-wrap">
    <div class="panel">
        <h1>Welcome back</h1>
        <p class="muted">Log in to manage your products and users.</p>
        <form method="post" action="<?= site_url('login') ?>">
            <?= csrf_field() ?>
            <label for="username">Username</label>
            <input id="username" name="username" type="text" value="<?= esc(old('username')) ?>" autocomplete="username" required autofocus>
            <label for="password">Password</label>
            <input id="password" name="password" type="password" autocomplete="current-password" required>
            <div class="form-actions">
                <button type="submit">Log in</button>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection() ?>
