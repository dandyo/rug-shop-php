<?php require APPROOT . '/views/inc/rug-options.php'; ?>
<?php
$json = file_get_contents(URLROOT . "js/countries.json");
$countries = json_decode($json, TRUE);

// $searchparams = [];
// if (isset($_GET)) {
//     $searchparams = $_GET;
//     print_r($searchparams);
// }
?>
<div class="search-form-wrap">
    <a class="btn btn-brown w-100 d-block d-md-none mb-3" data-bs-toggle="collapse" href="#search-fillter-wrap" role="button" aria-expanded="false">
        Search Filters
    </a>
    <div id="search-fillter-wrap" class="collapse d-md-block">
        <form action="" method="get" id="search-filters">
            <h5 class="mb-3 d-none d-md-block">Search Filters</h5>

            <div class="accordion accordion-search-filter mb-3">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse2" aria-expanded="false" aria-controls="collapse2">
                            Shape & Size
                        </button>
                    </h2>
                    <div id="collapse2" class="accordion-collapse collapse <?= (isset($_GET['shape']) && $_GET['shape'] != '' || isset($_GET['size_width_ft_min']) && !empty($_GET['size_width_ft_min'])) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <div class="mb-3">
                                <?php
                                $select_shape = '';
                                if (isset($_GET['shape']) && $_GET['shape'] != '') {
                                    $select_shape = $_GET['shape'];
                                }
                                ;
                                ?>
                                <select class="form-control" name="shape">
                                    <option value="">All Shapes</option>
                                    <?php
                                    // unset($shape[0]);
                                    foreach ($shape as $c):
                                        $s = ($select_shape == $c['value']) ? 'selected' : '';
                                        echo '<option value="' . $c['value'] . '" ' . $s . '>' . $c['value'] . '</option>';
                                    endforeach;
                                    ?>
                                </select>
                            </div>
                            <div>
                                <div class="card mb-3">
                                    <div class="card-header text-center">
                                        Width
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row align-items-center gx-2">
                                            <div class="col">
                                                <span class="text-center d-block">Min</span>
                                                <div class="row gx-2">
                                                    <div class="col pe-1">
                                                        <span class="d-block mb-1 text-center">ft.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_width_ft_min" min="0" step="1" value="<?= (isset($_GET['size_width_ft_min']) && !empty($_GET['size_width_ft_min'])) ? $_GET['size_width_ft_min'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="col ps-1">
                                                        <span class="d-block mb-1 text-center">in.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_width_in_min" min="0" max="11" value="<?= (isset($_GET['size_width_in_min']) && !empty($_GET['size_width_in_min'])) ? $_GET['size_width_in_min'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col ps-0">
                                                <span class="text-center d-block">Max</span>
                                                <div class="d-flex">
                                                    <div class="pe-1">
                                                        <span class="d-block mb-1 text-center">ft.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_width_ft_max" min="0" value="<?= (isset($_GET['size_width_ft_max']) && !empty($_GET['size_width_ft_max'])) ? $_GET['size_width_ft_max'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="ps-1">
                                                        <span class="d-block mb-1 text-center">in.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_width_in_max" min="0" max="11" value="<?= (isset($_GET['size_width_in_max']) && !empty($_GET['size_width_in_max'])) ? $_GET['size_width_in_max'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card mb-3">
                                    <div class="card-header text-center">
                                        Length
                                    </div>
                                    <div class="card-body p-2">
                                        <div class="row align-items-center gx-2">
                                            <div class="col ps-0">
                                                <span class="text-center d-block">Min</span>
                                                <div class="d-flex">
                                                    <div class="pe-1">
                                                        <span class="d-block mb-1 text-center">ft.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_length_ft_min" min="0" value="<?= (isset($_GET['size_length_ft_min']) && !empty($_GET['size_length_ft_min'])) ? $_GET['size_length_ft_min'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="ps-1">
                                                        <span class="d-block mb-1 text-center">in.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_length_in_min" min="0" max="11" value="<?= (isset($_GET['size_length_in_min']) && !empty($_GET['size_length_in_min'])) ? $_GET['size_length_in_min'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col ps-0">
                                                <span class="text-center d-block">Max</span>
                                                <div class="d-flex">
                                                    <div class="pe-1">
                                                        <span class="d-block mb-1 text-center">ft.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_length_ft_max" min="0" value="<?= (isset($_GET['size_length_ft_max']) && !empty($_GET['size_length_ft_max'])) ? $_GET['size_length_ft_max'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                    <div class="ps-1">
                                                        <span class="d-block mb-1 text-center">in.</span>
                                                        <div class="quantity">
                                                            <input type="number" class="form-control" name="size_length_in_max" min="0" max="11" value="<?= (isset($_GET['size_length_in_max']) && !empty($_GET['size_length_in_max'])) ? $_GET['size_length_in_max'] : '' ?>" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse3" aria-expanded="false" aria-controls="collapse3">
                            Design #
                        </button>
                    </h2>
                    <div id="collapse3" class="accordion-collapse collapse">
                        <div class="accordion-body">
                            <input type="text" class="form-control" name="design_number" placeholder="Design Number" value="" />
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse5" aria-expanded="false" aria-controls="collapse5">
                            Primary Color
                        </button>
                    </h2>
                    <?php
                    $select_pc = [];
                    if (isset($_GET['primary_color']) && $_GET['primary_color'] != '') {
                        $select_pc = $_GET['primary_color'];
                    } ?>
                    <div id="collapse5" class="accordion-collapse collapse <?= (!empty($select_pc)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <div class="scroll-max">
                                <?php
                                foreach ($colors as $k => $c):
                                    $checked = (in_array($c['name'], $select_pc)) ? 'checked' : '';
                                    echo '<div class="form-check radio-colors">
                            <input name="primary_color[]" class="form-check-input" type="checkbox" value="' . $c['name'] . '" id="pc-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="pc-' . $k . '">
                            <i style="background:' . $c['value'] . '"></i><span>' . strtoupper($c['name']) . '</span></label>
                            </div>';
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse6" aria-expanded="false" aria-controls="collapse6">
                            Secondary Color
                        </button>
                    </h2>
                    <?php
                    $select_sc = [];
                    if (isset($_GET['secondary_color']) && $_GET['secondary_color'] != '') {
                        $select_sc = $_GET['secondary_color'];
                    } ?>
                    <div id="collapse6" class="accordion-collapse collapse <?= (!empty($select_sc)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <div class="scroll-max">
                                <?php
                                foreach ($colors as $k => $c):
                                    $checked = (in_array($c['name'], $select_sc)) ? 'checked' : '';
                                    echo '<div class="form-check radio-colors">
                            <input name="secondary_color[]" class="form-check-input" type="checkbox" value="' . $c['name'] . '" id="sc-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="sc-' . $k . '">
                            <i style="background:' . $c['value'] . '"></i><span>' . strtoupper($c['name']) . '</span></label>
                            </div>';
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse7" aria-expanded="false" aria-controls="collapse7">
                            Collection
                        </button>
                    </h2>
                    <?php
                    $select_collection = [];
                    if (isset($_GET['collection']) && $_GET['collection'] != '') {
                        $select_collection = $_GET['collection'];
                    } ?>
                    <div id="collapse7" class="accordion-collapse collapse <?= (!empty($select_collection)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <div class="scroll-max">
                                <?php
                                foreach ($collection as $k => $c):
                                    $checked = (in_array($c['value'], $select_collection)) ? 'checked' : '';
                                    echo '<div class="form-check">
                            <input name="collection[]" class="form-check-input" type="checkbox" value="' . $c['value'] . '" id="collection-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="collection-' . $k . '">' . $c['value'] . '</label>
                            </div>';
                                endforeach;
                                ?>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse8" aria-expanded="false" aria-controls="collapse8">
                            Construction
                        </button>
                    </h2>
                    <?php
                    $select_construction = [];
                    if (isset($_GET['construction']) && $_GET['construction'] != '') {
                        $select_construction = $_GET['construction'];
                    } ?>
                    <div id="collapse8" class="accordion-collapse collapse <?= (!empty($select_construction)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <?php
                            foreach ($construction as $k => $c):
                                $checked = (in_array($c['value'], $select_construction)) ? 'checked' : '';
                                echo '<div class="form-check">
                            <input name="construction[]" class="form-check-input" type="checkbox" value="' . $c['value'] . '" id="construction-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="construction-' . $k . '">' . $c['value'] . '</label>
                            </div>';
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse9" aria-expanded="false" aria-controls="collapse9">
                            Age
                        </button>
                    </h2>
                    <?php
                    $select_age = [];
                    if (isset($_GET['age']) && $_GET['age'] != '') {
                        $select_age = $_GET['age'];
                    } ?>
                    <div id="collapse9" class="accordion-collapse collapse <?= (!empty($select_age)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <?php
                            foreach ($age as $k => $c):
                                $checked = (in_array($c['value'], $select_age)) ? 'checked' : '';
                                echo '<div class="form-check">
                            <input name="age[]" class="form-check-input" type="checkbox" value="' . $c['value'] . '" id="age-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="age-' . $k . '">' . $c['value'] . '</label>
                            </div>';
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse11" aria-expanded="false" aria-controls="collapse11">
                            Material
                        </button>
                    </h2>
                    <?php
                    $select_material = [];
                    if (isset($_GET['material']) && $_GET['material'] != '') {
                        $select_material = $_GET['material'];
                    } ?>
                    <div id="collapse11" class="accordion-collapse collapse <?= (!empty($select_material)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <?php
                            foreach ($material as $k => $c):
                                $checked = (in_array($c['value'], $select_material)) ? 'checked' : '';
                                echo '<div class="form-check">
                            <input name="material[]" class="form-check-input" type="checkbox" value="' . $c['value'] . '" id="material-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="material-' . $k . '">' . $c['value'] . '</label>
                            </div>';
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h2 class="accordion-header">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse12" aria-expanded="false" aria-controls="collapse12">
                            Location
                        </button>
                    </h2>
                    <?php
                    $select_location = [];
                    if (isset($_GET['location']) && $_GET['location'] != '') {
                        $select_location = $_GET['location'];
                    } ?>
                    <div id="collapse12" class="accordion-collapse collapse <?= (!empty($select_location)) ? 'show' : ''; ?>">
                        <div class="accordion-body">
                            <?php
                            foreach ($location as $k => $c):
                                $checked = (in_array($c['value'], $select_location)) ? 'checked' : '';
                                echo '<div class="form-check">
                            <input name="location[]" class="form-check-input" type="checkbox" value="' . $c['value'] . '" id="location-' . $k . '" ' . $checked . '> 
                            <label class="form-check-label" for="location-' . $k . '">' . $c['value'] . '</label>
                            </div>';
                            endforeach;
                            ?>
                        </div>
                    </div>
                </div>

            </div>

            <input type="submit" value="Search" class="btn btn-brown w-100 mb-4">
        </form>
    </div>
</div>