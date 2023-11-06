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
                <h1 class="mb-0">Edit rug</h1>
            </div>
        </div>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="" class="form-label">Location</label>
                <select name="location" class="form-control">
                    <?php
                    foreach ($location as $i):
                        $selected = ($data['rug']->location == $i['value']) ? ' selected' : '';
                        echo '<option value="' . $i['value'] . '"' . $selected . '>' . $i['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Asset #</label>
                <input type="text" name="asset_number" class="form-control" value="<?= $data['rug']->asset_number; ?>" required>
                <span class="invalid-feedback">
                    <?= $data['asset_number_err']; ?>
                </span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Design name</label>
                <input type="text" class="form-control" name="design_name" value="<?= $data['rug']->design_name; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Style</label>
                <select name="style" class="form-control" required>
                    <?php
                    foreach ($style as $i):
                        $selected = ($data['rug']->style == $i['value']) ? ' selected' : '';
                        echo '<option value="' . $i['value'] . '"' . $selected . '>' . $i['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Shape</label>
                <select name="shape" class="form-control">
                    <?php
                    // unset($shape[0]);
                    foreach ($shape as $i):
                        $selected = ($data['rug']->shape == $i['value']) ? ' selected' : '';
                        echo '<option value="' . $i['value'] . '"' . $selected . '>' . $i['value'] . '</option>';
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
                                <input type="number" class="form-control" name="size_width_ft" value="<?= $data['rug']->size_width_ft; ?>" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" min="0" max="11" name="size_width_in" value="<?= $data['rug']->size_width_in; ?>" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Height</label>
                        <div class="row align-items-center">
                            <div class="col-auto">Feet</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_height_ft" value="<?= $data['rug']->size_height_ft; ?>" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" min="0" max="11" name="size_height_in" value="<?= $data['rug']->size_height_in; ?>" required />
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
                        <input type="number" step=".01" class="form-control" name="size_width_m" value="<?= $data['rug']->size_width_m; ?>" required />
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Height</label>
                        <input type="number" step=".01" class="form-control" name="size_height_m" value="<?= $data['rug']->size_height_m; ?>" required />
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">SKU</label>
                <input type="text" class="form-control" name="sku" value="<?= $data['rug']->sku; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Material</label>
                <select name="material" class="form-control" required>
                    <?php
                    foreach ($material as $m):
                        $selected = ($data['rug']->material == $m['value']) ? ' selected' : '';
                        echo '<option value="' . $m['value'] . '"' . $selected . '>' . $m['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Collections</label>
                <select name="collection" class="form-control" required>
                    <?php
                    foreach ($collection as $c):
                        $selected = ($data['rug']->collection == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
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
                    foreach ($colors as $i => $c):
                        $checked = ($data['rug']->primary_color == $c['name']) ? ' checked' : '';
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="primary_color" value="' . $c['name'] . '" id="pc-' . $i . '"' . $checked . ' /><label for="pc-' . $i . '"> <i style="background:' . $c['value'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Secondary Color</label>
                <div class="colors-selector-wrap">
                    <?php
                    foreach ($colors as $i => $c):
                        $checked = ($data['rug']->secondary_color == $c['name']) ? ' checked' : '';
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="secondary_color" value="' . $c['name'] . '" id="sc-' . $i . '"' . $checked . ' /><label for="sc-' . $i . '"> <i style="background:' . $c['value'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Age</label>
                <select name="age" class="form-control" required>
                    <?php
                    foreach ($age as $i):
                        $selected = ($data['rug']->age == $i['value']) ? ' selected' : '';
                        echo '<option value="' . $i['value'] . '"' . $selected . '>' . $i['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Construction</label>
                <select name="construction" class="form-control" required>
                    <?php
                    foreach ($construction as $c):
                        $selected = ($data['rug']->construction == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Country</label>
                <input type="hidden" id="country_selected" value="<?= $data['rug']->country; ?>" name="country" required />
                <div class="country_selector" data-selectedcountry="<?= $data['rug']->country; ?>" data-showspecial="false" data-showflags="true" data-i18nall="All selected" data-i18nnofilter="No selection" data-i18nfilter="Filter" data-onchangecallback="onChangeCallback">
                </div>

            </div>

            <div class="form-group mb-3">
                <?php
                $src = ($data['rug']->image) ? URLROOT . 'uploads/' . $data['rug']->image : '';
                ?>

                <label for="" class="form-label">Image</label>
                <input type="file" class="form-control mb-3 <?= (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>" name="image" id="image" onchange="loadFile(event)" style="<?php echo (!empty($data['rug']->image)) ? 'display:none;' : '' ?>">
                <input type="hidden" id="exist_image" name="exist_image" value="<?= $data['rug']->image; ?>">
                <div class="row" id="image-preview-wrap">
                    <div class="col-auto">

                        <div class="image-preview"><img id="image-preview" src="<?= $src; ?>" /></div>
                    </div>
                    <div class="col">
                        <a href="#" class="btn btn-danger" <?= (empty($src)) ? 'style="display:none;"' : '' ?> id="removeimg">Replace</a>
                    </div>
                </div>

                <span class="invalid-feedback">
                    <?= $data['image_err']; ?>
                </span>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5"><?= $data['rug']->description; ?></textarea>
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary px-4" value="Update" />
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

        $("#removeimg").show();
    };
    
    $("#removeimg").click(function(e){
        e.preventDefault();
        var exist_image = $("#exist_image").val();
        $("#image").show();
        console.log(exist_image);

        $.ajax({
            type: "POST",
            url: "' . URLROOT . 'admin/rugs/removeimg",
            data: { "id": "' . $data['rug']->id . '"},
            success: function (data) { 
                console.log(data);
                //if(data == "success") {
                    $("#exist_image").val("");
                    $("#image-preview").attr("src", "");
                    $("#removeimg").hide();
                //}
            }
        });

        
      });
</script>
';
?>

<?php require APPROOT . '/views/incadmin/footer.php'; ?>