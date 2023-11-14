<?php require APPROOT . '/views/incadmin/header.php'; ?>

<div class="row mb-4 align-items-center">
    <div class="col-auto">
        <h1>Orders</h1>
    </div>
    <div class="col-md-6">

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
<div class="table-responsive">
    <table class="table mb-4 mb-md-5">
        <thead>
            <tr>
                <th>Status</th>
                <th>Name</th>
                <th>Adress</th>
                <th>Cart</th>
                <th>Date</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($data['orders'] as $order):
                $cart = 0;
                if (!empty($order->cart)) {
                    $cart = unserialize($order->cart);
                    $cart = count($cart);
                }
                ?>
                <tr data-id="<?= $order->id; ?>">
                    <td>
                        <?= $order->status; ?>
                    </td>
                    <td>
                        <?= $order->name; ?>
                    </td>
                    <td>
                        <?= $order->address1 . ', '; ?>
                        <?= ($order->address2) ? $order->address2 . ", " : ""; ?>
                        <?= $order->city . ', ' . $order->state . ' ' . $order->zip; ?>
                    </td>
                    <td>
                        <?php echo $cart; ?>
                    </td>
                    <td>
                        <?= date("M j, Y h:i:s A", strtotime($order->created_at)); ?>
                    </td>
                    <td>
                        <span class="not-break">
                            <a data-src="<?= URLROOT; ?>admin/orders/show/<?= $order->id; ?>" data-type="ajax" data-fancybox class="btn btn-primary"><span class="icon-info"></span></a>
                            <a href="<?= URLROOT; ?>admin/orders/edit/<?= $order->id; ?>" class="btn btn-success">Edit</a>
                            <a href="<?= URLROOT; ?>admin/orders/delete/<?= $order->id; ?>" class="btn btn-danger">Delete</a>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
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
    <nav aria-label="Page navigation example">
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