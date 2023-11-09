<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page-banner">
    <div class="container-xl">

    </div>
</div>
<div class="py-4 py-md-5">
    <div class="container-xl">
        <div class="row justify-content-center">
            <div class="col-md-6 mb-4 mb-md-0">
                <h2 class="mb-4">Checkout</h2>
                <form method="post" id="checkoutForm" novalidate>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Name *</label>
                        <input type="text" class="form-control" name="name" required>
                        <p class="help-block text-danger red mb-0"></p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Email *</label>
                        <input type="email" class="form-control" name="email" required>
                        <p class="help-block text-danger red mb-0"></p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Phone *</label>
                        <input type="text" class="form-control" name="phone" required>
                        <p class="help-block text-danger red mb-0"></p>
                    </div>
                    <h5>Address</h5>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Address 1 *</label>
                        <input type="text" class="form-control" name="address1" required>
                        <p class="help-block text-danger red mb-0"></p>
                    </div>
                    <div class="form-group mb-3">
                        <label for="" class="form-label">Address 2 (optional)</label>
                        <input type="text" class="form-control" name="address2">
                    </div>
                    <div class="row">
                        <div class="form-group mb-3 col-sm">
                            <label for="" class="form-label">City *</label>
                            <input type="text" class="form-control" name="city" required>
                            <p class="help-block text-danger red mb-0"></p>
                        </div>
                        <div class="form-group mb-3 col-sm">
                            <label for="" class="form-label">State *</label>
                            <input type="text" class="form-control" name="state" required>
                            <p class="help-block text-danger red mb-0"></p>
                        </div>
                        <div class="form-group mb-3 col-sm">
                            <label for="" class="form-label">Zip *</label>
                            <input type="text" class="form-control" name="zip" required>
                            <p class="help-block text-danger red mb-0"></p>
                        </div>
                    </div>
                    <textarea name="cart" class="d-none w-100"><?php if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) {
                        echo json_encode($_SESSION["cart_item"]);
                    } ?>
                    </textarea>
                    <br>
                    <div id="success"></div>

                    <input type="hidden" id="token" name="token">
                    <input type="submit" class="btn btn-brown w-100" value="Checkout">
                </form>
            </div>
            <div class="col-8 col-sm-6 col-md-4 col-lg-3">
                <h2 class="mb-4">Cart</h2>

                <div id="cart-items" class="cart-items">
                    <?php
                    if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) {
                        $item_total = 0; ?>
                        <?php foreach ($_SESSION["cart_item"] as $rug): ?>
                            <div class="rug-item" data-id="<?= $rug['id'] ?>">
                                <div class="rug-item-image">
                                    <a href="<?= URLROOT; ?>rugs/<?= $rug['id']; ?>">
                                        <img src="<?= URLROOT . 'uploads/'; ?><?= $rug['image']; ?>" alt="<?= $rug['asset_number']; ?>" class="w-100">
                                    </a>
                                </div>
                                <div class="rug-item-desc">
                                    <?= $rug['asset_number']; ?><br>
                                    <?= $rug['size_width_ft']; ?>'
                                    <?= $rug['size_width_in']; ?>" x
                                    <?= $rug['size_length_ft']; ?>'
                                    <?= $rug['size_length_in']; ?>"<br>
                                    <?= $rug['location']; ?><br>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://www.google.com/recaptcha/api.js?render=6LeoZbUoAAAAAOP9GCudF5W0vdGSpF130_xqMbfy"></script>
<script>
    grecaptcha.ready(function () {
        grecaptcha.execute('6LeoZbUoAAAAAOP9GCudF5W0vdGSpF130_xqMbfy', {
            action: 'contact'
        }).then(function (token) {
            document.getElementById("token").value = token;
        });
        // refresh token every minute to prevent expiration
        setInterval(function () {
            grecaptcha.execute('6LeoZbUoAAAAAOP9GCudF5W0vdGSpF130_xqMbfy', {
                action: 'contact'
            }).then(function (token) {
                // console.log( 'refreshed token:', token );
                document.getElementById("token").value = token;
            });
        }, 60000);
    });
</script>
<?php
$footerScripts = '
<script>var URLROOT = "' . URLROOT . '";</script>
<script src="' . URLROOT . 'js/jqBootstrapValidation.js"></script>
<script src="' . URLROOT . 'js/checkout.js"></script>
';
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>