<?php require APPROOT . '/views/inc/rug-options.php'; ?>
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
        <?php if (!empty($data['asset_number_err']) || !empty($data['image_err']) || !empty($data['primary_color_err']) || !empty($data['secondary_color_err'])) { ?>
            <div class="alert alert-danger" role="alert">
                Please input all required fields
            </div>

        <?php } ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group mb-3">
                <label for="" class="form-label">Location *</label>
                <select name="location" class="form-control">
                    <?php
                    foreach ($location as $i):
                        $selected = ($data['location'] == $i['value']) ? ' selected' : '';
                        echo '<option value="' . $i['value'] . '"' . $selected . '>' . $i['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Asset # *</label>
                <input type="text" name="asset_number" class="form-control <?= (!empty($data['asset_number_err'])) ? 'is-invalid' : ''; ?>" value="<?= $data['asset_number']; ?>" required>
                <span class="invalid-feedback">
                    <?= $data['asset_number_err']; ?>
                </span>
            </div>
            <div class="form-group mb-3">
                <label for="" class="form-label">Design name</label>
                <input type="text" class="form-control" name="design_name" value="<?= $data['design_name']; ?>">
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Shape *</label>
                <select name="shape" class="form-control">
                    <?php
                    // unset($shape[0]);
                    foreach ($shape as $c):
                        $selected = ($data['shape'] == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Size *</label>
                <div class="row align-items-center mb-3">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="" class="form-label">Width</label>
                        <div class="row align-items-center">
                            <div class="col-auto">Feet</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_width_ft" value="<?= $data['size_width_ft']; ?>" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_width_in" value="<?= $data['size_width_in']; ?>" min="0" step="1" max="11" required />
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label for="" class="form-label">Length</label>
                        <div class="row align-items-center">
                            <div class="col-auto">Feet</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_length_ft" value="<?= $data['size_length_ft']; ?>" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_length_in" value="<?= $data['size_length_in']; ?>" min="0" step="1" max="11" required />
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Material *</label>
                <select name="material" class="form-control" required>
                    <?php
                    foreach ($material as $c):
                        $selected = ($data['material'] == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Collections *</label>
                <select name="collection" class="form-control" required>
                    <?php
                    foreach ($collection as $c):
                        $selected = ($data['collection'] == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Primary Color *</label>
                <div class="colors-selector-wrap">
                    <?php
                    foreach ($colors as $i => $c):
                        $selected = ($data['primary_color'] == $c['name']) ? ' checked' : '';
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="primary_color" value="' . $c['name'] . '" id="pc-' . $i . '"' . $selected . ' /><label for="pc-' . $i . '"> <i style="background:' . $c['value'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Secondary Color *</label>
                <div class="colors-selector-wrap">
                    <?php
                    foreach ($colors as $i => $c):
                        $selected = ($data['secondary_color'] == $c['name']) ? ' checked' : '';
                        echo '<span class="radio-colors" data-i="' . $i . '"><input type="radio" name="secondary_color" value="' . $c['name'] . '" id="sc-' . $i . '"' . $selected . ' /><label for="sc-' . $i . '"> <i style="background:' . $c['value'] . '"></i><span>' . $c['name'] . '</span></label></span>';
                    endforeach;
                    ?>
                </div>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Age *</label>
                <select name="age" class="form-control" required>
                    <?php
                    foreach ($age as $c):
                        $selected = ($data['age'] == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Construction *</label>
                <select name="construction" class="form-control" required>
                    <?php
                    foreach ($construction as $c):
                        $selected = ($data['construction'] == $c['value']) ? ' selected' : '';
                        echo '<option value="' . $c['value'] . '"' . $selected . '>' . $c['value'] . '</option>';
                    endforeach;
                    ?>
                </select>
            </div>

            <div class="form-group">
                <label for="" class="form-label">Image *</label>
                <input type="file" class="form-control mb-3 <?= (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>" name="image" id="image" onchange="loadFile(event)">
                <div class="image-preview"><img id="image-preview" /></div>
                <span class="invalid-feedback">
                    <?= $data['image_err']; ?>
                </span>
            </div>

            <div class="form-group mb-3">
                <label for="" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="5"><?= $data['description']; ?></textarea>
            </div>

            <div class="form-group mb-3">
                <input type="submit" class="btn btn-primary px-4" value="Save" />
            </div>
        </form>
    </div>
</div>
<?php
$footerScripts = '<script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
<script>
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