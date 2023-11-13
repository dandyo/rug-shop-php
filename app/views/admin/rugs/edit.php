<?php $headerStyles = '<link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />'; ?>
<?php require APPROOT . '/views/inc/rug-options.php'; ?>
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

        <form method="post" enctype="multipart/form-data" id="rugEditForm">
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
                        <label for="" class="form-label">Length</label>
                        <div class="row align-items-center">
                            <div class="col-auto">Feet</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" name="size_length_ft" value="<?= $data['rug']->size_length_ft; ?>" required />
                            </div>
                            <div class="col-auto">Inches</div>
                            <div class="col ps-0">
                                <input type="number" class="form-control" min="0" max="11" name="size_length_in" value="<?= $data['rug']->size_length_in; ?>" required />
                            </div>
                        </div>
                    </div>
                </div>
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
                <label for="" class="form-label">Description</label>
                <textarea name="description" class="form-control" rows="3"><?= $data['rug']->description; ?></textarea>
            </div>

            <div class="form-group mb-3">
                <?php
                $src = ($data['rug']->image) ? URLROOT . 'uploads/' . $data['rug']->image : '';
                ?>

                <label for="" class="form-label">Featured Image</label>
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
                <label for="" class="form-label">Gallery</label>
                <div id="my-Dropzone" class="dropzone mb-4"></div>
                <div id="galleryItems">
                    <?php
                    $gallery = array();
                    ;
                    if (!empty($data['rug']->gallery)) {
                        $gallery = unserialize($data['rug']->gallery);

                        // print_r($gallery);
                        foreach ($gallery as $key => $value) {
                            $varArr = explode(',', $value);
                            echo '<input data-img="' . $varArr[0] . '" class="form-control" name="gallery[]" type="hidden" value="' . $value . '">';
                        }
                    }
                    ?>
                </div>

            </div>

            <div class="form-group mb-5">
                <button type="submit" class="btn btn-primary px-4" id="submit">Update</button>
            </div>
        </form>
    </div>
</div>
<?php $page = 'edit-rugs'; ?>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>