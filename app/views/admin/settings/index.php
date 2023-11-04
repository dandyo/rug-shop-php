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
        <h3 class="mb-4">General Settings</h3>
        <?php flash('form_message'); ?>

        <form action="" method="post">
            <div class="form-group mb-4">
                <label for="" class="form-label">Email recipients</label>
                <input type="text" class="form-control" name="email_recipient" value="<?= $data['settings']['email_recipient'] ?>" required />
                <div class="form-text">Separate multiple emails by comma</div>
            </div>
            <input type="submit" value="Save" class="btn btn-success px-4">
        </form>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>