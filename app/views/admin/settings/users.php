<?php require APPROOT . '/views/incadmin/header.php'; ?>
<div class="row mb-4 align-items-center">
    <div class="col-auto">
        <h1>Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <?php require APPROOT . '/views/incadmin/settings-nav.php'; ?>
    </div>
    <div class="col">
        <h3 class="mb-4">User Settings</h3>
        <?php flash('form_message'); ?>
        <p><a href="<?= URLROOT; ?>admin/settings/useradd" class="btn btn-success">Add new user</a></p>

        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['users'] as $user) : ?>
                    <tr>
                        <td><?= $user->name; ?></td>
                        <td><?= $user->email; ?></td>
                        <td><?= $user->role; ?></td>
                        <td>
                            <a href="<?= URLROOT; ?>admin/settings/useredit/<?= $user->id; ?>" class="btn btn-success">Edit</a>
                            <a href="<?= URLROOT; ?>admin/settings/userdelete/<?= $user->id; ?>" class="btn btn-danger">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>