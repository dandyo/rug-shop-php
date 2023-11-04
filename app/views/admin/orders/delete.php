<?php require APPROOT . '/views/inc/rug-options.php'; ?>
<?php require APPROOT . '/views/incadmin/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-7">
        <div class="row align-items-center mb-4 mb-md-5">
            <div class="col-auto pe-0">
                <a href="<?= URLROOT; ?>admin/orders" class="btn"><span class="icon-chevron-left"></span></a>
            </div>
            <div class="col-auto">
                <h1 class="mb-0">Delete order</h1>
            </div>
        </div>

        <form method="post">
            <h5 class="mb-4">Are you sure you want to delete?</h5>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-danger px-4" value="Yes" />
                <a href="<?= URLROOT; ?>admin/orders" class="btn btn-link">Cancel</a>
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>