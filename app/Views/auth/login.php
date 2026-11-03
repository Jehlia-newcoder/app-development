<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
        <div class="login-panel panel panel-default">
            <div class="panel-heading"><h2 class="panel-title">Inventory Manager</h2></div>
            <div class="panel-body">
                <p class="text-muted">Log in to manage your products and users.</p>
                <form method="post" action="<?= site_url('login') ?>">
                    <?= csrf_field() ?>
                    <fieldset>
                        <div class="form-group">
                            <label class="sr-only" for="username">Username</label>
                            <input class="form-control" id="username" name="username" type="text" placeholder="Username" value="<?= esc(old('username')) ?>" autocomplete="username" required autofocus>
                        </div>
                        <div class="form-group">
                            <label class="sr-only" for="password">Password</label>
                            <input class="form-control" id="password" name="password" type="password" placeholder="Password" autocomplete="current-password" required>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">Log in</button>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
