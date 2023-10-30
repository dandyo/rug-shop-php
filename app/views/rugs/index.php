<?php require APPROOT . '/views/inc/header.php'; ?>
<div class="page-banner">
    <div class="container-xl">

    </div>
</div>
<div class="py-4 py-md-5">
    <div class="container-xl">
        <div class="row">
            <div class="col-md-5">
                <img src="<?= URLROOT . 'uploads/'; ?><?= $data['rug']->image; ?>" alt="">
            </div>
            <div class="col-md-5">
                <h4 class="mb-3"><?= $data['rug']->asset_number; ?></h4>
                <table class="table rug-details-table">
                    <tbody>
                        <tr>
                            <td>Size in feet:</td>
                            <td><?= $data['rug']->size_width_in; ?> x <?= $data['rug']->size_height_in; ?></td>
                        </tr>
                        <tr>
                            <td>Size in meter:</td>
                            <td><?= $data['rug']->size_width_m; ?>m x <?= $data['rug']->size_height_m; ?> </td>
                        </tr>
                        <tr>
                            <td>Construction:</td>
                            <td><?= $data['rug']->construction; ?> </td>
                        </tr>
                        <tr>
                            <td>Material:</td>
                            <td><?= $data['rug']->material; ?> </td>
                        </tr>
                        <tr>
                            <td>Design #:</td>
                            <td><?= $data['rug']->design_number; ?> </td>
                        </tr>
                        <tr>
                            <td>Primary Colors:</td>
                            <td><?= $data['rug']->primary_color; ?> </td>
                        </tr>
                        <tr>
                            <td>Secondary Colors:</td>
                            <td><?= $data['rug']->secondary_color; ?> </td>
                        </tr>
                        <tr>
                            <td>Collection</td>
                            <td><?= $data['rug']->collection; ?> </td>
                        </tr>
                        <tr>
                            <td>Status:</td>
                            <td><?= $data['rug']->status; ?> </td>
                        </tr>
                        <tr>
                            <td>Location:</td>
                            <td><?= $data['rug']->location; ?> </td>
                        </tr>
                        <tr>
                            <td>Age:</td>
                            <td><?= $data['rug']->age; ?> </td>
                        </tr>
                        <tr>
                            <td>Origin:</td>
                            <td><? //= getCountryName($data['rug']->country); 
                                ?> </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <span>Description:</span><br>
                                <?= $data['rug']->description; ?>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<?php require APPROOT . '/views/inc/footer.php'; ?>