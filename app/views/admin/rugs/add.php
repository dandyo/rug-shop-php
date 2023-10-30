<?php require APPROOT . '/views/inc/rug-options.php'; ?>
<?php $headerStyles = '<link rel="stylesheet" href="' . URLROOT . 'vendor/country/niceCountryInput.css" />'; ?>
<?php require APPROOT . '/views/incadmin/header.php'; ?>
<div class="row justify-content-center">
    <div class="col-md-6 col-lg-7">
        <div class="row align-items-center mb-4 mb-md-5">
            <div class="col-auto pe-0">
                <a href="<?= URLROOT; ?>admin/rugs" class="btn"><span class="icon-chevron-left"></span></a>
            </div>
            <div class="col-auto">
                <h1 class="mb-0">Add new rug</h1>
            </div>
        </div>

        <?php flash('form_message'); ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="" class="form-label">Location</label>
                <select name="location" class="form-control">
                    <option value="Prescott">Prescott</option>
                    <option value="Scottsdale">Scottsdale</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Asset #</label>
                <input type="text" name="asset_number" class="form-control <?= (!empty($data['asset_number_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['asset_number']; ?>" required>
                <span class="invalid-feedback"><?= $data['asset_number_err']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Design name</label>
                <input type="text" class="form-control" name="design_name">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Style</label>
                <select name="style" class="form-control" required>
                    <?php
                    foreach ($style as $c) :
                        echo '<option value="' . $c . '">' . $c . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Shape</label>
                <select name="shape" class="form-control">
                    <?php
                    unset($shape[0]);
                    foreach ($shape as $c) :
                        echo '<option value="' . $c . '">' . $c . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Size</label>
                <div class="row align-items-center mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="" class="form-label">Width</label>
                        <div class="row align-items-center">
                            <div class="col-auto">Feet</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_width_ft" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_width_in" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Height</label>
                        <div class="row align-items-center">
                            <div class="col-auto">Feet</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_height_ft" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_height_in" required />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-auto">
                        <span>&nbsp;</span><br>
                        <span>Meter</span>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Width</label>
                        <input type="number" step=".01" class="form-control" name="size_width_m" required />
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Height</label>
                        <input type="number" step=".01" class="form-control" name="size_height_m" required />
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">SKU</label>
                <input type="text" class="form-control" name="sku">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Material</label>
                <select name="material" class="form-control" required>
                    <?php
                    foreach ($material as $c) :
                        echo '<option value="' . $c . '">' . $c . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Collections</label>
                <select name="collection" class="form-control" required>
                    <?php
                    foreach ($collection as $c) :
                        echo '<option value="' . $c . '">' . $c . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Primary Color</label>
                <!-- <select name="primary_color" class="form-control" required>
                    <option value="N/A">N/A</option>
                </select> -->
                <div class="colors-selector-wrap">
                    <?php
                    foreach ($colors as $i => $c) :
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="primary_color" value="' . $c['name'] . '" id="pc-' . $i . '" /><label for="pc-' . $i . '"> <i style="background:' . $c['color'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Secondary Color</label>
                <div class="colors-selector-wrap">
                    <?php
                    foreach ($colors as $i => $c) :
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="secondary_color" value="' . $c['name'] . '" id="sc-' . $i . '" /><label for="sc-' . $i . '"> <i style="background:' . $c['color'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Age</label>
                <select name="age" class="form-control" required>
                    <?php
                    foreach ($age as $c) :
                        echo '<option value="' . $c . '">' . $c . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Construction</label>
                <select name="construction" class="form-control" required>
                    <?php
                    foreach ($construction as $c) :
                        echo '<option value="' . $c . '">' . $c . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Country</label>
                <input type="hidden" id="country_selected" value="US" name="country" required />
                <div class="country_selector" data-selectedcountry="US" data-showspecial="false" data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback">
                </div>

            </div>

            <div class="form-group">
                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control mb-3 <?= (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>" name="image" id="image" onchange="loadFile(event)">
                <div class="image-preview"><img id="image-preview" /></div>
                <span class="invalid-feedback"><?= $data['image_err']; ?></span>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5"><?= $data['rug']->description; ?></textarea>
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary px-4" value="Save" />
            </div>
        </form>
    </div>
</div>
<?php
$footerScripts = '<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script src="' . URLROOT . 'vendor/country/niceCountryInput.js"></script>
<script>
    function onChangeCallback(ctr){
        console.log("The country was changed: " + ctr);
        $("#country_selected").val(ctr);
    }
    $(document).ready(function () {
        $(".country_selector").each(function(i,e){
            new NiceCountryInput(e).init();
        });
    });
    var loadFile = function(event) {
        var output = document.getElementById("image-preview");
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function() {
            URL.revokeObjectURL(output.src) // free memory
        }

        $("#image-preview").addClass("mb-3");
      };
</script>
';
?>

<?php require APPROOT . '/views/incadmin/footer.php'; ?>