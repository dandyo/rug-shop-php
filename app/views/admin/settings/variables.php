<?php require APPROOT . '/views/incadmin/header.php'; ?>
<div class="row mb-4 align-items-center">
    <div class="col-auto">
        <h1>Settings</h1>
    </div>
</div>
<div class="row">
    <div class="col-lg-3">
        <?php require APPROOT . '/views/incadmin/settings-nav.php'; ?>
    </div>
    <div class="col">
        <h3 class="mb-4">Variables Settings</h3>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="location">
                <input type="hidden" name="type" value="location">
                <div class="form-group mb-3">
                    <label class="form-label">Locations</label> <span class="d-inline-block ms-2 alert--location text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Add location" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--location">
                <?php
                if (!empty($data['variables']['location'])) {
                    foreach ($data['variables']['location'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox>' . $var['value'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="collection">
                <input type="hidden" name="type" value="collection">
                <div class="form-group mb-3">
                    <label class="form-label">Collections</label> <span class="d-inline-block ms-2 alert--collection text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Add collection" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--collection">
                <?php
                if (!empty($data['variables']['collection'])) {
                    foreach ($data['variables']['collection'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox>' . $var['value'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="construction">
                <input type="hidden" name="type" value="construction">
                <div class="form-group mb-3">
                    <label class="form-label">Construction</label> <span class="d-inline-block ms-2 alert--construction text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Add construction" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--construction">
                <?php
                if (!empty($data['variables']['construction'])) {
                    foreach ($data['variables']['construction'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox>' . $var['value'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="material">
                <input type="hidden" name="type" value="material">
                <div class="form-group mb-3">
                    <label class="form-label">Material</label> <span class="d-inline-block ms-2 alert--material text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Add material" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--material">
                <?php
                if (!empty($data['variables']['material'])) {
                    foreach ($data['variables']['material'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox>' . $var['value'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="age">
                <input type="hidden" name="type" value="age">
                <div class="form-group mb-3">
                    <label class="form-label">Age</label> <span class="d-inline-block ms-2 alert--age text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Add age" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--age">
                <?php
                if (!empty($data['variables']['age'])) {
                    foreach ($data['variables']['age'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox>' . $var['value'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="shape">
                <input type="hidden" name="type" value="shape">
                <div class="form-group mb-3">
                    <label class="form-label">Shapes</label> <span class="d-inline-block ms-2 alert--shape text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Add shape" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--shape">
                <?php
                if (!empty($data['variables']['shape'])) {
                    foreach ($data['variables']['shape'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox>' . $var['value'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>

        <div class="mb-4">
            <form action="" method="post" class="formVariable" data-type="color">
                <input type="hidden" name="type" value="color">
                <div class="form-group mb-3">
                    <label class="form-label">Colors</label> <span class="d-inline-block ms-2 alert--color text-danger"></span>
                    <div class="row">
                        <div class="col pe-0">
                            <input type="text" name="name" class="form-control" placeholder="Name" required />
                        </div>
                        <div class="col pe-0">
                            <input type="text" name="value" class="form-control" placeholder="Color" required />
                        </div>
                        <div class="col-auto">
                            <button type="submit" class="btn btn-primary"><span class="icon icon-plus"></span></button>
                        </div>
                    </div>

                </div>
            </form>

            <div class="var-list var-list--color">
                <?php
                if (!empty($data['variables']['color'])) {
                    foreach ($data['variables']['color'] as $key => $var) {
                        echo '<span data-id="var-' . $var['id'] . '" data-src="/shop/admin/settings/varupdate/' . $var['id'] . '" class="var-item" data-type="ajax" data-filter="#main" data-fancybox><i style="background:' . $var['value'] . ';"></i>' . $var['name'] . '</span>';
                    }
                }
                ?>
            </div>
        </div>
        <br>
        <br>
    </div>
</div>
<?php
$footerScripts = '<script src="' . URLROOT . 'js/admin/variables.js"></script>';
?>
<?php require APPROOT . '/views/incadmin/footer.php'; ?>