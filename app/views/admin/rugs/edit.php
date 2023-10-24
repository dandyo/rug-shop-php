<?php
$collection = ['Clean Line', 'Contemporary', 'Final-Sale', 'Hair on Hide', 'Indigo', 'Marrakesh', 'Modern', 'Non-Dyed', 'Texture', 'Tibetan', 'Traditional - Transitional', 'Vintage'];
$style = ['Art Deco Design', 'French And Other European Floral Designs', 'Khotan', 'Marrakesh Style', 'Minimalist Plane And Plaid Designs', 'Modern Design', 'Not Applicable', 'Rugs That Have Been Overdyed', 'Scandinavian Designs', 'Traditional Design', 'Transitional Designs', 'Tribal And Geometric Designs'];
$construction = ['Flat weave', 'Hand knotted', 'Hand made', 'Machine made rugs', 'Tibetan weave'];
$material = ['Hair on Hide', 'Non-Dyed', 'Wool Pile', 'Wool & Silk'];
$age = ['Antique Item', 'New Item', 'Vintage'];
$shape = ['All Shapes', 'Rectangle', 'Round', 'Runner'];
$colors = [
    [
        'name' => 'N/A',
        'color' => 'transparent'
    ],
    [
        'name' => 'black',
        'color' => '#000'
    ],
    [
        'name' => 'blue',
        'color' => '#437fc0'
    ],
    [
        'name' => 'brown',
        'color' => '#314c2d'
    ],
    [
        'name' => 'd blue',
        'color' => '#2d3651'
    ],
    [
        'name' => 'd brown',
        'color' => '#482c15'
    ],
    [
        'name' => 'd gold',
        'color' => '#d0842e'
    ],
    [
        'name' => 'd olive gr',
        'color' => '#514f12'
    ],
    [
        'name' => 'd purple',
        'color' => '#5b325c'
    ],
    [
        'name' => 'd red',
        'color' => '#781f3b'
    ],
    [
        'name' => 'd rust',
        'color' => '#a5391c'
    ],
    [
        'name' => 'gold',
        'color' => '#d8a758'
    ],
    [
        'name' => 'l blue',
        'color' => '#8aabbc'
    ],
    [
        'name' => 'l brown',
        'color' => '#ac867b'
    ],
    [
        'name' => 'l gold',
        'color' => '#ffdd89'
    ],
    [
        'name' => 'l green',
        'color' => '#71886b'
    ],
    [
        'name' => 'l olive gr',
        'color' => '#d8dab3'
    ],
    [
        'name' => 'l red',
        'color' => '#b2697a'
    ],
    [
        'name' => 'peach',
        'color' => '#f1a56b'
    ],
    [
        'name' => 'olive gr',
        'color' => '#a6a265'
    ],
    [
        'name' => 'purple',
        'color' => '#b67baf'
    ],
    [
        'name' => 'red',
        'color' => '#af3c49'
    ],
    [
        'name' => 'rust',
        'color' => '#e97b43'
    ],
    [
        'name' => 'white',
        'color' => '#fff'
    ],
    [
        'name' => 'd green',
        'color' => '#1b2c0e'
    ],
    [
        'name' => 'd green',
        'color' => '#1b2c0e'
    ],
    [
        'name' => 'd green',
        'color' => '#1b2c0e'
    ],
    [
        'name' => 'Multicolor',
        'color' => 'url(' . URLROOT . 'images/multicolor.jpg)'
    ],
    [
        'name' => 'l gray',
        'color' => '#c4c0b4'
    ],
    [
        'name' => 'no border',
        'color' => 'url(' . URLROOT . 'images/no-border.jpg)'
    ],
    [
        'name' => 'off white',
        'color' => '#e8d8cb'
    ],
    [
        'name' => 'l purple',
        'color' => '#bea6bd'
    ],
    [
        'name' => 'camel',
        'color' => '#b47a55'
    ],
    [
        'name' => 'ivory',
        'color' => '#d2c8c7'
    ],
];
?>
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
                    <option value="Prescott" <?= ($data['rug']->location == 'Prescott') ? 'selected' : ''; ?>>Prescott</option>
                    <option value="Scottsdale" <?= ($data['rug']->location == 'Scottsdale') ? 'selected' : ''; ?>>Scottsdale</option>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Asset #</label>
                <input type="text" name="asset_number" class="form-control" value="<?= $data['rug']->asset_number; ?>" required>
                <span class="invalid-feedback"><?= $data['asset_number_err']; ?></span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Design name</label>
                <input type="text" class="form-control" name="design_name" value="<?= $data['rug']->design_name; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Style</label>
                <select name="style" class="form-control" required>
                    <?php
                    foreach ($style as $i) :
                        $selected = ($data['rug']->style == $i) ? ' selected' : '';
                        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Shape</label>
                <select name="shape" class="form-control">
                    <?php
                    foreach ($shape as $i) :
                        $selected = ($data['rug']->shape == $i) ? ' selected' : '';
                        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Size</label>
                <div class="row align-items-center mb-3">
                    <div class="col-auto">
                        <span>&nbsp;</span><br>
                        <span>Inches</span>
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Width</label>
                        <input type="number" step=".01" class="form-control" name="size_width_in" value="<?= $data['rug']->size_width_in; ?>" required />
                    </div>
                    <div class="col">
                        <label for="" class="form-label">Height</label>
                        <input type="number" step=".01" class="form-control" name="size_height_in" value="<?= $data['rug']->size_height_in; ?>" required />
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
                    foreach ($material as $m) :
                        $selected = ($data['rug']->material == $m) ? ' selected' : '';
                        echo '<option value="' . $m . '"' . $selected . '>' . $m . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Collections</label>
                <select name="collection" class="form-control" required>
                    <?php
                    foreach ($collection as $c) :
                        $selected = ($data['rug']->collection == $c) ? ' selected' : '';
                        echo '<option value="' . $c . '"' . $selected . '>' . $c . '</option>';
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
                        $checked = ($data['rug']->primary_color == $c['name']) ? ' checked' : '';
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="primary_color" value="' . $c['name'] . '" id="pc-' . $i . '"' . $checked . ' /><label for="pc-' . $i . '"> <i style="background:' . $c['color'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Secondary Color</label>
                <div class="colors-selector-wrap">
                    <?php
                    foreach ($colors as $i => $c) :
                        $checked = ($data['rug']->secondary_color == $c['name']) ? ' checked' : '';
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="secondary_color" value="' . $c['name'] . '" id="sc-' . $i . '"' . $checked . ' /><label for="sc-' . $i . '"> <i style="background:' . $c['color'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Age</label>
                <select name="age" class="form-control" required>
                    <?php
                    foreach ($age as $i) :
                        $selected = ($data['rug']->age == $i) ? ' selected' : '';
                        echo '<option value="' . $i . '"' . $selected . '>' . $i . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Construction</label>
                <select name="construction" class="form-control" required>
                    <?php
                    foreach ($construction as $c) :
                        $selected = ($data['rug']->construction == $c) ? ' selected' : '';
                        echo '<option value="' . $c . '"' . $selected . '>' . $c . '</option>';
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

                <span class="invalid-feedback"><?= $data['image_err']; ?></span>
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