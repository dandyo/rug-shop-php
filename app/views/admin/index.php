<?php require APPROOT . '/views/incadmin/header.php'; ?>
<h1 class="mb-4">Dashboard</h1>
<div class="row">
    <div class="col">
        <h2 class="mb-4">Rugs</h2>

        <!-- <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div> -->
    </div>
    <div class="col">
        <h2 class="mb-4">Orders</h2>

        <div class="card">
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Status</th>
                            <th>Name</th>
                            <th>Adress</th>
                            <th>Cart</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($data['orders'] as $order) :
                            $cart = 0;
                            if (!empty($order->cart)) {
                                $cart = unserialize($order->cart);
                                $cart = count($cart);
                            }
                        ?>
                            <tr data-id="<?= $order->id; ?>">
                                <td><?= $order->status; ?></td>
                                <td><?= $order->name; ?></td>
                                <td><?= $order->city . ', ' . $order->state . ' ' . $order->zip; ?></td>
                                <td><?php echo $cart; ?></td>
                                <td><?= date("m/d/Y", strtotime($order->created_at)); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>

                <a href="<?= URLROOT; ?>admin/orders" class="btn btn-primary">View all</a>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>