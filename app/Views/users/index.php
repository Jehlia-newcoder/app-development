<?= $this->extend('layouts/main') ?>

<?= $this->section('content') ?>
<div class="page-head">
    <div>
        <h1>Users</h1>
        <p class="muted">View and manage sign-in accounts.</p>
    </div>
    <a class="button" href="<?= site_url('users/new') ?>">Add user</a>
</div>
<section class="panel">
    <?php if ($users === []): ?>
        <div class="empty">No users found.</div>
    <?php else: ?>
        <div class="table-wrap">
            <table>
                <thead><tr><th>ID</th><th>Username</th><th>Actions</th></tr></thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= esc($user['user_id']) ?></td>
                        <td><?= esc($user['username']) ?><?= (int) $user['user_id'] === (int) session()->get('user_id') ? ' (you)' : '' ?></td>
                        <td>
                            <div class="actions">
                                <a class="button secondary" href="<?= site_url('users/' . $user['user_id'] . '/edit') ?>">Edit</a>
                                <?php if ((int) $user['user_id'] !== (int) session()->get('user_id')): ?>
                                    <form method="post" action="<?= site_url('users/' . $user['user_id'] . '/delete') ?>" onsubmit="return confirm('Delete this user?')">
                                        <?= csrf_field() ?>
                                        <button class="danger" type="submit">Delete</button>
                                    </form>
                                <?php endif ?>
                            </div>
                        </td>
                    </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php endif ?>
</section>
<?= $this->endSection() ?>
