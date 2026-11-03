<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row justify-content-center">
    <div class="col-lg-5">
        <div class="card shadow-lg border-0 rounded-lg mt-5">
            <div class="card-header">
                <h1 class="text-center font-weight-light my-4 h3">Welcome back</h1>
            </div>
            <div class="card-body">
                <p class="text-muted text-center">Log in to manage your products and users.</p>
                <form method="post" action="<?= site_url('login') ?>">
                    <?= csrf_field() ?>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= esc(old('username')) ?>" autocomplete="username" required autofocus>
                        <label for="username">Username</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input class="form-control" id="password" name="password" type="password" placeholder="Password" autocomplete="current-password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="d-flex align-items-center justify-content-end mt-4 mb-0">
                        <button class="btn btn-primary" type="submit">Log in</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
