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
        <h3 class="mb-4">Delete user</h3>

        <form action="" method="post">
            <h5 class="mb-4">Are you sure you want to delete?</h5>
            <input type="submit" value="Yes" class="btn btn-danger px-4">
            <a href="<?= URLROOT; ?>admin/settings/users" class="btn btn-link">Cancel</a>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>