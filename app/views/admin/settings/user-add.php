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
        <h3 class="mb-4">Add new user</h3>
        <?php flash('form_message'); ?>

        <form action="" method="post">
            <div class="form-group mb-3">
                <label for="" class="form-label">Name</label>
                <input type="text" class="form-control <?= (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" name="name" value="<?= $data['name']; ?>" required />
                <span class="invalid-feedback"><?= $data['name_err']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Email</label>
                <input type="email" class="form-control <?= (!empty($data['email_err'])) ? 'is-invalid' : ''; ?>" name="email" value="<?= $data['email']; ?>" required />
                <span class="invalid-feedback"><?= $data['email_err']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Role</label>
                <select name="role" class="form-control">
                    <option value="user">User</option>
                    <option value="admin">Admin</option>
                </select>
                <span class="invalid-feedback"><?= $data['email_err']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Password</label>
                <input type="password" class="form-control <?= (!empty($data['password_err'])) ? 'is-invalid' : ''; ?>" name="password" value="<?= $data['password']; ?>" required />
                <div class="form-text">Password must be a minimum of 6 characters.</div>
                <span class="invalid-feedback"><?= $data['password_err']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Confirm Password</label>
                <input type="password" class="form-control <?= (!empty($data['confirm_password_err'])) ? 'is-invalid' : ''; ?>" name="confirm_password" value="<?= $data['confirm_password']; ?>" required />
                <span class="invalid-feedback"><?= $data['confirm_password_err']; ?></span>
            </div>
            <input type="submit" value="Save" class="btn btn-success px-4">
        </form>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>