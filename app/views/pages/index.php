<?php $headerStyles = '<link rel="stylesheet" href="' . URLROOT . 'vendor/country/niceCountryInput.css" />'; ?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page-banner">
    <div class="container-xl">

    </div>
</div>
<div class="py-4 py-md-5 bg-lgrey2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-4 col-lg-3 col-xl-2 mb-4 mb-md-0">
                <?php require APPROOT . '/views/inc/sidebar.php'; ?>
            </div>
            <div class="col-md-8 col-lg-9 col-xl-7">
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

                <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 gy-3 mb-5">
                    <?php foreach ($data['rugs'] as $rug) : ?>
                        <?php
                        $checked = (isInCart($rug->id)) ? 'checked' : '';
                        ?>
                        <div class="col">
                            <div class="rug-item">
                                <div class="rug-item-image">
                                    <a href="<?= URLROOT; ?>rugs/<?= $rug->id; ?>">
                                        <img src="<?= URLROOT . 'uploads/'; ?><?= $rug->image; ?>" alt="<?= $rug->asset_number; ?>" class="w-100">
                                    </a>
                                </div>
                                <div class="rug-item-desc">
                                    <?= $rug->asset_number; ?><br>
                                    <?= $rug->size_width_ft; ?>' <?= $rug->size_width_in; ?>" x <?= $rug->size_height_ft; ?>' <?= $rug->size_height_in; ?>"<br>
                                    <?= $rug->size_width_m; ?>m x <?= $rug->size_height_m; ?>m<br>
                                    <?= $rug->location; ?><br>
                                    <input type="checkbox" data-id="<?= $rug->id; ?>" class="add-checkbox" <?= $checked ?> />
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <?php
                print_r($data['total_pages']);
                ?>

                <?php
                $next = 0;
                if (isset($data['page'])) {
                    $next = (int)$data['page'] + 1;
                }
                $prev = 0;
                if (isset($data['page'])) {
                    $prev = (int)$data['page'] - 1;
                }
                $pageLink = '?page=';

                if (!empty($data['search'])) {
                    $pageLink = '?search=' . $data['search'] . '&page=';
                }
                ?>
                <div class="pagination-wrap text-center">
                    <nav class="mx-auto">
                        <ul class=" pagination">
                            <!-- <li class="page-item"><a class="page-link" href="<?= $pageLink ?>1">First</a></li> -->
                            <li class="page-item disabled">
                                <a class="page-link" href="#">Prev</a>
                            </li>
                            <li class="page-item ">
                                <a class="page-link" href="?page=2">Next</a>
                            </li>
                            <!-- <li class="page-item"><a class="page-link" href="?page=2">Last</a></li> -->
                        </ul>
                    </nav>
                </div>
                <div id="preloader"></div>
            </div>

            <?php require APPROOT . '/views/inc/cart.php'; ?>
        </div>
    </div>
</div>
<?php
$footerScripts = '
<script>var URLROOT = "' . URLROOT . '";</script>
<script src="' . URLROOT . 'js/sidebar.js"></script>
<script src="' . URLROOT . 'js/cart.js"></script>
';
?>
<?php require APPROOT . '/views/inc/footer.php'; ?>