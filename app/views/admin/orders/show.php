<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" integrity="sha512-b2QcS5SsA8tZodcDtGRELiGv5SaKSk1vDHDaQRda0htPYWZ6046lr3kJ5bAAQdpV2mmA/4v0wQF9MyU6/pDIAg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <main id="main" class="p-3" style="max-width: 800px;">
        <table class="table rug-details-table w-100 mb-4">
            <tbody>
                <tr>
                    <th>Name</th>
                    <td>
                        <?= $data['order']->name; ?>
                    </td>
                </tr>
                <tr>
                    <th>Company</th>
                    <td>
                        <?= $data['order']->company; ?>
                    </td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>
                        <a href="mailto:<?= $data['order']->email; ?>">
                            <?= $data['order']->email; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Phone</th>
                    <td>
                        <a href="tel:<?= $data['order']->phone; ?>">
                            <?= $data['order']->phone; ?>
                        </a>
                    </td>
                </tr>
                <tr>
                    <th>Address</th>
                    <td>
                        <?= $data['order']->address1; ?>,
                        <?= $data['order']->address2; ?>,
                        <?= $data['order']->city; ?>,
                        <?= $data['order']->state; ?>
                        <?= $data['order']->zip; ?>
                    </td>
                </tr>
                <tr>
                    <th>Date</th>
                    <td>
                        <?= date("M j, Y h:i:s A", strtotime($data['order']->created_at)); ?>
                    </td>
                </tr>
            </tbody>
        </table>
        <table class="table rug-details-table w-100">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Location</th>
                    <th>Asset #</th>
                    <th>Design Name</th>
                    <th>Size</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['cart'])) { ?>
                    <?php foreach ($data['cart'] as $rug): ?>
                        <tr>
                            <td><img src="<?= URLROOT . 'uploads/'; ?><?= $rug->image; ?>" alt="" width="100"></td>
                            <td>
                                <?= $rug->location; ?>
                            </td>
                            <td>
                                <?= $rug->asset_number; ?>
                            </td>
                            <td>
                                <?= $rug->design_name; ?>
                            </td>
                            <td>
                                <?= $rug->size_width_ft; ?>'
                                <?= $rug->size_width_in; ?>" x
                                <?= $rug->size_length_ft; ?>'
                                <?= $rug->size_length_in; ?>"
                            </td>
                            <td><a href="<?= URLROOT . 'rugs/' . $rug->id; ?>" target="_blank" class="btn btn-primary"><span class="icon-info"></span></a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php } ?>
            </tbody>
        </table>
    </main>
</body>

</html>