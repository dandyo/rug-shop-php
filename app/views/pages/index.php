<?php $headerStyles = '<link rel="stylesheet" href="' . URLROOT . 'vendor/country/niceCountryInput.css" />'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page-banner">
    <div class="container-xl">

    </div>
</div>
<div class="py-4 py-md-5 bg-lgrey2">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-4 col-lg-3 mb-4 mb-md-0">
                <?php require APPROOT . '/views/inc/sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9">
                <?php
                if (isset($_GET)) {
                    $params = $_GET;
                    echo '<div class="mb-4">';
                    foreach ($params as $key => $value) {
                        if (!empty($value)) {
                            echo '<span class="badge text-bg-primary">' . $key . '</span> ';
                        }
                    }
                    echo '</div>';

                    // print_r($params);
                }
                ?>

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gy-3">
                    <?php foreach ($data['rugs'] as $rug) : ?>
                        <div class="col">
                            <div class="rug-item">
                                <div class="rug-item-image">
                                    <a href="<?= URLROOT; ?>rugs/<?= $rug->id; ?>">
                                        <img src="<?= URLROOT . 'uploads/'; ?><?= $rug->image; ?>" alt="<?= $rug->asset_number; ?>" class="w-100">
                                    </a>
                                </div>
                                <div class="rug-item-desc">
                                    <?= $rug->size_width_ft; ?>' <?= $rug->size_width_in; ?>" x <?= $rug->size_height_ft; ?>' <?= $rug->size_height_in; ?>"<br>
                                    <?= $rug->size_width_m; ?>m x <?= $rug->size_height_m; ?>m<br>
                                    <?= $rug->location; ?><br>
                                    <?= $rug->asset_number; ?><br>
                                    <input type="checkbox" data-id="<?= $rug->id; ?>" class="add-checkbox">
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
$footerScripts = '
<script src="' . URLROOT . 'js/sidebar.js"></script>
';
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>