<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main id="main" style="max-width: 800px;">
        <table class="table rug-details-table w-100">
            <tbody>
                <tr>
                    <td>Size in feet:</td>
                    <td>
                        <?= $data['rug']->size_width_ft; ?>'
                        <?= $data['rug']->size_width_in; ?>" x
                        <?= $data['rug']->size_length_ft; ?>'
                        <?= $data['rug']->size_length_in; ?>"
                    </td>
                </tr>
                <tr>
                    <td>Construction:</td>
                    <td>
                        <?= $data['rug']->construction; ?>
                    </td>
                </tr>
                <tr>
                    <td>Material:</td>
                    <td>
                        <?= $data['rug']->material; ?>
                    </td>
                </tr>
                <tr>
                    <td>Design #:</td>
                    <td>
                        <?= $data['rug']->design_name; ?>
                    </td>
                </tr>
                <tr>
                    <td>Primary Colors:</td>
                    <td>
                        <?= $data['rug']->primary_color; ?>
                    </td>
                </tr>
                <tr>
                    <td>Secondary Colors:</td>
                    <td>
                        <?= $data['rug']->secondary_color; ?>
                    </td>
                </tr>
                <tr>
                    <td>Collection</td>
                    <td>
                        <?= $data['rug']->collection; ?>
                    </td>
                </tr>
                <tr>
                    <td>Location:</td>
                    <td>
                        <?= $data['rug']->location; ?>
                    </td>
                </tr>
                <tr>
                    <td>Age:</td>
                    <td>
                        <?= $data['rug']->age; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span>Description:</span><br>
                        <?= $data['rug']->description; ?>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</body>

</html>