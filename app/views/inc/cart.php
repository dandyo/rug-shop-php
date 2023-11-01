<br>
<div class="col-xl-2">
    <div class="cart-wrap">
        <div class="mb-3">
            <h5 class="text-center mb-0">Cart</h5>
        </div>

        <div id="cart-items" class="cart-items">
            <?php
            if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) {
                $item_total = 0; ?>
                <?php foreach ($_SESSION["cart_item"] as $rug) : ?>
                    <div class="rug-item" data-id="<?= $rug['id'] ?>">
                        <div class="rug-item-image">
                            <a href="<?= URLROOT; ?>rugs/<?= $rug['id']; ?>">
                                <img src="<?= URLROOT . 'uploads/'; ?><?= $rug['image']; ?>" alt="<?= $rug['asset_number']; ?>" class="w-100">
                            </a>
                        </div>
                        <div class="rug-item-desc">
                            <?= $rug['asset_number']; ?><br>
                            <?= $rug['size_width_ft']; ?>' <?= $rug['size_width_in']; ?>" x <?= $rug['size_height_ft']; ?>' <?= $rug['size_height_in']; ?>"<br>
                            <?= $rug['size_width_m']; ?>m x <?= $rug['size_height_m']; ?>m<br>
                            <?= $rug['location']; ?><br>
                            <a href="#" class="cart-item-remove" data-id="<?= $rug['id'] ?>"><span class="icon-highlight_remove"></span> Remove</a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php } ?>
        </div>
        <div class="cart-empty" style="<?= (!isset($_SESSION["cart_item"]) && empty($_SESSION["cart_item"])) ? 'display:block;' : 'display:none;' ?>">
            <p>No items</p>
        </div>
        <div class="cart-checkout-btn" style="<?= (!isset($_SESSION["cart_item"]) && empty($_SESSION["cart_item"])) ? 'display:none;' : 'display:block;' ?>">
            <a href="<?= URLROOT; ?>cart/checkout" class="btn btn-brown w-100">Ask for quote</a>
        </div>
    </div>
</div>