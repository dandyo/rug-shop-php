<?php $headerStyles = '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/tiny-slider.css" integrity="sha512-eMxdaSf5XW3ZW1wZCrWItO2jZ7A9FhuZfjVdztr7ZsKNOmt6TUMTQgfpNoVRyfPE5S9BC0A4suXzsGSrAOWcoQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />'; ?>

<?php $bodyclass = 'rug-single'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page-banner">
    <div class="container-xl">

    </div>
</div>
<div class="py-4 py-md-5 bg-lgrey2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg col-lg-7">
                <p class="d-flex align-item-center"><a href="/shop"><span class="icon icon-chevron-thin-left"></span> Back to shop</a></p>
                <div class="row mb-4">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <div class="image-slider-wrap">
                            <div class="image-slider">
                                <div class="image-slider-item">
                                    <img src="<?= URLROOT . 'uploads/' . $data['rug']->image; ?>" alt="" class="w-100">
                                </div>
                                <?php if (!empty($data['rug']->gallery)) {
                                    $galleries = unserialize($data['rug']->gallery);
                                    foreach ($galleries as $key => $value) {
                                        $gallery = explode(',', $value);
                                        echo '<div class="image-slider-item"><img src="' . URLROOT . "uploads/" . $gallery[0] . '" alt="" class="w-100"></div>';
                                    }
                                    // print_r($gallery);
                                } ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="bg-white p-3 h-100">
                            <h4 class="mb-3">
                                <?= $data['rug']->asset_number; ?>
                            </h4>
                            <table class="table rug-details-table mb-4 mb-xxl-5">
                                <tbody>
                                    <tr>
                                        <td>Size in feet:</td>
                                        <td>
                                            <?= $data['rug']->size_width_ft; ?>'
                                            <?= $data['rug']->size_width_in; ?>" x
                                            <?= $data['rug']->size_length_ft; ?>'
                                            <?= $data['rug']->size_length_in; ?>"
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Location:</td>
                                        <td>
                                            <?= $data['rug']->location; ?>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <?php
                            $disabled = (isInCart($data['rug']->id)) ? ' disabled' : '';
                            ?>
                            <button id="add-to-cart" data-id="<?= $data['rug']->id ?>" type="button" class="btn btn-brown w-100" <?= $disabled; ?>>Add to cart</button>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-3">
                    <h5>More details</h5>
                    <table class="table rug-details-table">
                        <tbody>
                            <tr>
                                <td>Construction:</td>
                                <td>
                                    <?= $data['rug']->construction; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Material:</td>
                                <td>
                                    <?= $data['rug']->material; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Design #:</td>
                                <td>
                                    <?= $data['rug']->design_name; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Primary Colors:</td>
                                <td>
                                    <?= $data['rug']->primary_color; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Secondary Colors:</td>
                                <td>
                                    <?= $data['rug']->secondary_color; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Collection</td>
                                <td>
                                    <?= $data['rug']->collection; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Location:</td>
                                <td>
                                    <?= $data['rug']->location; ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Age:</td>
                                <td>
                                    <?= $data['rug']->age; ?>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <span>Description:</span><br>
                                    <?= $data['rug']->description; ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>
            <div class="col-md-auto col-xxl-auto">
                <?php require APPROOT . '/views/inc/cart.php'; ?>
            </div>
        </div>
        <?php require APPROOT . '/views/inc/cart-toggle.php'; ?>
    </div>
</div>
<?php
$footerScripts = '
<script>var URLROOT = "' . URLROOT . '";</script>
<script src="' . URLROOT . 'js/sidebar.js"></script>
<script src="' . URLROOT . 'js/cart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.2/min/tiny-slider.js" integrity="sha512-8Uje515O2sp28OsddCuTXqV/Xc9fgNZvSnCefU4BfxD06b1nA7z0lT4OrXT50I0oLqCi4gmyxfqP0ZjRbNWrmg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    $(document).ready(function($) {
        var slider = tns({
            mode: "carousel",
            container: ".image-slider",
            items: 1,
            nav: true,
            controls: true,
            controlsPosition: "bottom",
            navPosition: "bottom",
            autoplayButtonOutput: false,
            autoplay: true,
            controlsText: ["<span class=\'icon-chevron-thin-left\'></span>","<span class=\'icon-chevron-thin-right\'></span>"]
        });
    });
</script>
';
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>