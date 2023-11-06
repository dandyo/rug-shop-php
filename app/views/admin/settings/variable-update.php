<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <main id="main" class="p-3 w-100" style="max-width: 600px;">
        <div class="variable-wrap--update">
            <h3 class="mb-4">Update variable</h3>
            <form action="" method="post" id="updateVarForm">
                <input type="hidden" value="<?= $data['var']->id; ?>" name="id">
                <input type="hidden" value="<?= $data['var']->type; ?>" name="type">

                <?php if ($data['var']->type == 'color') { ?>
                    <div class="form-group mb-3">
                        <input type="text" class="form-control" value="<?= $data['var']->name; ?>" name="name" required>
                    </div>
                <?php } ?>

                <div class="form-group mb-3">
                    <input type="text" class="form-control" value="<?= $data['var']->value; ?>" name="value" required>
                </div>
                <div class="row justify-content-between">
                    <div class="col">
                        <button type="button" class="btn btn-danger delete-btn">Delete</button>
                    </div>
                    <div class="col text-end">
                        <input type="submit" value="Save" class="btn btn-primary">
                        <button type="button" class="close btn btn-link">Cancel</button>
                    </div>
                </div>
            </form>
        </div>
        <div class="variable-wrap--delete" style="display:none;">
            <form action="" id="deleteVarForm" method="post">
                <h3 class="mb-4">Are you sure you want to delete?</h3>
                <input type="hidden" value="<?= $data['var']->id; ?>" name="id">
                <input type="hidden" value="<?= $data['var']->type; ?>" name="type">
                <input type="submit" class="btn btn-danger" value="Yes">
                <button type="button" class="close btn btn-link">Cancel</button>
            </form>
        </div>
        <div id="varUpdateStatus"></div>

        <?php //print_r($data) ?>

        <script>
            $('#updateVarForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "/shop/admin/settings/varedit",
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        // console.log(data);

                        if (data.status == 'success') {
                            // var value = (data.type == 'color') ? data.name : data.value;
                            var value = (data.type == 'color') ? '<i style="background:' + data.value + ';"></i> ' + data.name : data.value;

                            $('.var-list--' + data.type).find('.var-item[data-id="var-' + data.id + '"]').html(value);
                            parent.$.fancybox.close();
                        } else {
                            $('#varUpdateStatus').text(data.status);
                        }
                    }
                });
            });

            $('.close').click(function () {
                parent.$.fancybox.close();
            })

            $('#deleteVarForm').on('submit', function (e) {
                e.preventDefault();

                $.ajax({
                    url: "/shop/admin/settings/vardelete",
                    data: $(this).serialize(),
                    type: "POST",
                    dataType: 'json',
                    async: false,
                    success: function (data) {
                        // console.log(data);

                        if (data.status == 'success') {
                            $('.var-list--' + data.type).find('.var-item[data-id="var-' + data.id + '"]').remove();
                            parent.$.fancybox.close();
                        } else {
                            $('#varUpdateStatus').text(data.status);
                        }
                    }
                });
            });

            $('.delete-btn').click(function () {
                $('.variable-wrap--delete').show();
                $('.variable-wrap--update').hide();
            })
        </script>
    </main>
</body>

</html>