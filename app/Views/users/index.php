<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="d-flex flex-column flex-sm-row align-items-sm-center justify-content-between gap-3">
    <h1 class="mt-4">Users</h1>
    <a class="btn btn-primary" href="<?= site_url('users/new') ?>">Add user</a>
</div>
<ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="<?= site_url('dashboard') ?>">Dashboard</a></li>
    <li class="breadcrumb-item active">Users</li>
</ol>
<section class="card mb-4">
    <div class="card-header">
        <i class="fas fa-users me-1" aria-hidden="true"></i>
        User accounts
    </div>
    <?php if ($users === []): ?>
        <div class="card-body text-center text-muted py-5">No users found.</div>
    <?php else: ?>
        <div class="card-body">
            <div class="table-responsive">
            <table class="table table-bordered table-hover align-middle mb-0">
                <thead><tr><th scope="col">ID</th><th scope="col">Username</th><th scope="col">Actions</th></tr></thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['user_id']) ?></td>
                        <td><?= esc($user['username']) ?><?= (int) $user['user_id'] === (int) session()->get('user_id') ? ' (you)' : '' ?></td>
                        <td>
                            <div class="d-flex flex-wrap gap-2">
                                <a class="btn btn-outline-secondary btn-sm" href="<?= site_url('users/' . $user['user_id'] . '/edit') ?>">Edit</a>
                                <?php if ((int) $user['user_id'] !== (int) session()->get('user_id')): ?>
                                    <form method="post" action="<?= site_url('users/' . $user['user_id'] . '/delete') ?>" onsubmit="return confirm('Delete this user?')" class="m-0">
                                        <?= csrf_field() ?>
                                        <button class="btn btn-outline-danger btn-sm" type="submit">Delete</button>
                                    </form>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
            </div>
        </div>
    <?php endif ?>
</section>
<?= $this->endSection() ?>
