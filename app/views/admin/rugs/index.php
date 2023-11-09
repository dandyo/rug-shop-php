<?php require APPROOT . '/views/incadmin/header.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-auto">
        <h1>Rugs</h1>
    </div>
    <div class="col-md-6">
        <a href="<?= URLROOT; ?>admin/rugs/add" class="btn btn-primary pull-right">
            <i class="icon-plus"></i> Add Rug
        </a>
    </div>
</div>

<?php flash('form_message'); ?>
<div class="row mb-4">
    <div class="col-lg-6">
        <form action="" method="get">
            <div class="row">
                <div class="col col-md-5 form-group">
                    <input type="text" name="search" class="form-control" placeholder="Search" value="<?= $data['search']; ?>">
                </div>
                <div class="col-auto ps-0">
                    <input type="submit" value="Go" class="btn btn-secondary" />
                </div>
            </div>
        </form>
    </div>
</div>
<table class="table mb-4 mb-md-5">
    <thead>
        <tr>
            <th>Image</th>
            <th>Location</th>
            <th>Asset #</th>
            <th>Design</th>
            <th>Size</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($data['rugs'] as $rug): ?>
            <tr>
                <td><img src="<?= URLROOT . 'uploads/'; ?><?= $rug->image; ?>" alt="" width="100"></td>
                <td>
                    <?= $rug->location; ?>
                </td>
                <td>
                    <?= $rug->asset_number; ?>
                </td>
                <td>
                    <?= $rug->design_name; ?>
                </td>
                <td>
                    <?= $rug->size_width_ft; ?>'
                    <?= $rug->size_width_in; ?>" x
                    <?= $rug->size_length_ft; ?>'
                    <?= $rug->size_length_in; ?>"
                </td>
                <td>
                    <a data-src="<?= URLROOT; ?>admin/rugs/show/<?= $rug->id; ?>" data-type="ajax" data-fancybox class="btn btn-primary"><span class="icon-info"></span></a>
                    <a href="<?= URLROOT; ?>admin/rugs/edit/<?= $rug->id; ?>" class="btn btn-success">Edit</a>
                    <a href="<?= URLROOT; ?>admin/rugs/delete/<?= $rug->id; ?>" class="btn btn-danger">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<div>
    <?php
    $next = 0;
    if (isset($data['page'])) {
        $next = (int) $data['page'] + 1;
    }
    $prev = 0;
    if (isset($data['page'])) {
        $prev = (int) $data['page'] - 1;
    }
    $pageLink = '?page=';

    if (!empty($data['search'])) {
        $pageLink = '?search=' . $data['search'] . '&page=';
    }
    ?>
    <nav>
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="<?= $pageLink ?>1">First</a></li>
            <li class="page-item <?= ($data['page'] <= 1) ? 'disabled' : '' ?>">
                <a class="page-link" href="<?php if ($data['page'] <= 1) {
                    echo '#';
                } else {
                    echo $pageLink . ($data['page'] - 1);
                } ?>">Prev</a>
            </li>
            <li class="page-item <?= ($data['page'] >= $data['total_pages']) ? 'disabled' : ''; ?>">
                <a class="page-link" href="<?php if ($data['page'] >= $data['total_pages']) {
                    echo '#';
                } else {
                    echo $pageLink . ($data['page'] + 1);
                } ?>">Next</a>
            </li>
            <li class="page-item"><a class="page-link" href="<?= $pageLink . $data['total_pages']; ?>">Last</a></li>
        </ul>
    </nav>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>