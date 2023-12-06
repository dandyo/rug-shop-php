<?php
$sizeArray = array('size_width_ft_min', 'size_width_in_min', 'size_width_ft_max', 'size_width_in_max', 'size_length_ft_min', 'size_length_in_min', 'size_length_ft_max', 'size_length_in_max');
$sizeFlag = false;
?>
<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page-banner">
    <div class="container-xl">

    </div>
</div>
<div class="py-4 py-md-5 bg-lgrey2">
    <div class="container-fluid">
        <div class="row justify-content-center">
            <!-- <div class="col-md-4 col-lg-3 col-xl-3 col-xxl-2"> -->
            <div class="col-12 col-md-auto col-xxl-4 col-sidebar">
                <?php require APPROOT . '/views/inc/sidebar.php'; ?>
            </div>
            <div class="col col-xl col-xxl-8">
                <div class="row">
                    <div class="col-lg-8 col-xxl-9">
                        <?php
                        if (isset($_GET) && !empty($_GET)) {
                            $params = $_GET;
                            echo '<div class="search-params mb-4">';

                            foreach ($params as $key => $value) {
                                // print_r($value) . '<br>';
                                if (!empty($value) && $key != 'page') {
                                    $brackets = (is_array($value)) ? "[]" : "";

                                    if (in_array($key, $sizeArray)) {
                                        if ($sizeFlag == false) {
                                            $sizeFlag = true;
                                            $key = 'size';
                                        } else {
                                            $key = "";
                                        }
                                    }

                                    echo (!empty($key)) ? '<span class="badge text-bg-primary" data-param="' . $key . '' . $brackets . '">' . ucfirst(str_replace('_', ' ', $key)) . ' <i class="icon icon-cross"></i></span> ' : '';
                                }
                            }
                            echo '</div>';
                        }
                        ?>

                        <?php require APPROOT . '/views/inc/cart-toggle.php'; ?>

                        <div class="row row-cols-2 row-cols-sm-3 row-cols-md-2 row-cols-xl-3 row-cols-xxl-4 gy-3 mb-5">
                            <?php foreach ($data['rugs'] as $rug): ?>
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
                                            <?= $rug->size_width_ft; ?>'
                                            <?= $rug->size_width_in; ?>" x
                                            <?= $rug->size_length_ft; ?>'
                                            <?= $rug->size_length_in; ?>"<br>
                                            <?= $rug->location; ?><br>
                                            <input type="checkbox" data-id="<?= $rug->id; ?>" class="add-checkbox" <?= $checked ?> />
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

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
                        $url = http_build_query($data['params'], '', '&amp;');

                        if (!empty($data['params'])) {
                            $pageLink = '?' . $url . '&page=';
                        }
                        ?>
                        <?php if ($data['total_pages'] > 1) { ?>
                            <div class="pagination-wrap text-center">
                                <nav class="mx-auto">
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
                                    <span class="page-num">Page
                                        <?= $data['page']; ?>
                                    </span>
                                </nav>
                            </div>
                        <?php } ?>
                        <div id="preloader"></div>
                    </div>
                    <div class="col-lg-4 col-xxl-3">
                        <?php require APPROOT . '/views/inc/cart.php'; ?>
                    </div>
                </div>
            </div>
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