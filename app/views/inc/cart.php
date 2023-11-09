<div class="col-lg-3 col-xl-3 col-xxl-2">
    <div id="cart-wrap">
        <div id="cart-overlay"></div>
        <div id="cart">
            <div class="mb-3">
                <h5 class="text-center mb-0">Cart <span class="badge text-bg-secondary p-1 cart-count">
                        <?= $cartTotal; ?>
                    </span></h5>
            </div>

            <div id="cart-items" class="cart-items">
                <?php
                if (isset($_SESSION["cart_item"]) && !empty($_SESSION["cart_item"])) { ?>
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
                                <a href="#" class="cart-item-remove" data-id="<?= $rug['id'] ?>"><span class="icon-highlight_remove"></span> Remove</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
            </div>
            <div class="cart-empty text-center" style="<?= (!isset($_SESSION["cart_item"]) || empty($_SESSION["cart_item"])) ? 'display:block;' : 'display:none;' ?>">
                <span>No items</span>
            </div>
            <div class="cart-checkout-btn" style="<?= (!isset($_SESSION["cart_item"]) || empty($_SESSION["cart_item"])) ? 'display:none;' : 'display:block;' ?>">
                <a href="<?= URLROOT; ?>cart/checkout" class="btn btn-brown w-100">Request quote</a>
            </div>
        </div>
    </div>
</div>