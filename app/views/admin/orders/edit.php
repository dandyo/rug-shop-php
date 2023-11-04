<?php require APPROOT . '/views/inc/rug-options.php'; ?>
<?php require APPROOT . '/views/incadmin/header.php'; ?>

<div class="row justify-content-center">
    <div class="col-md-6 col-lg-7">
        <div class="row align-items-center mb-4 mb-md-5">
            <div class="col-auto pe-0">
                <a href="<?= URLROOT; ?>admin/orders" class="btn"><span class="icon-chevron-left"></span></a>
            </div>
            <div class="col-auto">
                <h1 class="mb-0">Edit order</h1>
            </div>
        </div>

        <form method="post">
            <div class="form-group mb-3">
                <label for="" class="form-label">Status</label>
                <select name="status" class="form-control">
                    <option value="new" <?= ($data['order']->status == 'status') ? 'selected' : ''; ?>>New</option>
                    <option value="delivered" <?= ($data['order']->status == 'delivered') ? 'selected' : ''; ?>>Delivered</option>
                    <option value="canceled" <?= ($data['order']->status == 'canceled') ? 'selected' : ''; ?>>Canceled</option>
                </select>
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary px-4" value="Update" />
            </div>
        </form>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>