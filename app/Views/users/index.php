<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="row">
    <ol class="breadcrumb">
        <li><a href="<?= site_url('dashboard') ?>"><em class="fa fa-home"></em></a></li>
        <li class="active">Users</li>
    </ol>
</div>
<div class="page-heading">
    <div>
        <h1>Users</h1>
        <p>Manage who can access your inventory.</p>
    </div>
    <a class="btn btn-primary" href="<?= site_url('users/new') ?>"><em class="fa fa-plus"></em> Add user</a>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <span><em class="fa fa-users"></em> User accounts</span>
                <span class="panel-heading-count"><?= count($users) ?> <?= count($users) === 1 ? 'account' : 'accounts' ?></span>
            </div>
            <div class="panel-body">
                <?php if ($users === []): ?>
                    <p class="text-muted text-center">No users found.</p>
                <?php else: ?>
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead><tr><th scope="col">ID</th><th scope="col">Username</th><th scope="col">Actions</th></tr></thead>
                            <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= esc($user['user_id']) ?></td>
                                    <td><?= esc($user['username']) ?><?= (int) $user['user_id'] === (int) session()->get('user_id') ? ' (you)' : '' ?></td>
                                    <td>
                                        <a class="btn btn-default btn-xs" href="<?= site_url('users/' . $user['user_id'] . '/edit') ?>"><em class="fa fa-pencil"></em> Edit</a>
                                        <?php if ((int) $user['user_id'] !== (int) session()->get('user_id')): ?>
                                            <form method="post" action="<?= site_url('users/' . $user['user_id'] . '/delete') ?>" onsubmit="return confirm('Delete this user?')" class="inline-form">
                                                <?= csrf_field() ?>
                                                <button class="btn btn-danger btn-xs" type="submit"><em class="fa fa-trash"></em> Delete</button>
                                            </form>
                                        <?php endif ?>
                                    </td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                <?php endif ?>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection() ?>
