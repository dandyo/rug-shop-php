<?php require APPROOT . '/views/incadmin/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-7">
        <div class="row align-items-center mb-5">
            <div class="col-auto pe-0">
                <a href="<?= URLROOT; ?>admin/rugs" class="btn"><span class="icon-chevron-left"></span></a>
            </div>
            <div class="col-auto">
                <h1 class="mb-0">Delete rug</h1>
            </div>
        </div>

        <div>
            <h3 class="mb-4">Are you sure you want to delete?</h3>
            <form action="<?= URLROOT; ?>admin/rugs/delete/<?= $data['rug_id']; ?>" method="post">
                <input type="hidden" value="<?= $data['rug_id']; ?>" name="id" />
                <input type="submit" class="btn btn-danger" value="Yes">
                <a href="<?= URLROOT; ?>admin/rugs" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>