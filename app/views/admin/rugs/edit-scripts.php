<script>var URLROOT = "<?= URLROOT ?> ";</script>
<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script>
    var filenames = [];
    var files = [];
</script>
<script>
    var loadFile = function (event) {
        var output = document.getElementById("image-preview");
        output.src = URL.createObjectURL(event.target.files[0]);
        output.onload = function () {
            URL.revokeObjectURL(output.src) // free memory
        }

        $("#removeimg").show();
    };

    $("#removeimg").click(function (e) {
        e.preventDefault();
        var exist_image = $("#exist_image").val();
        $("#image").show();
        console.log(exist_image);

        queryString = "id=<?php echo $data['rug']->id; ?>";

        $.ajax({
            type: "POST",
            url: "/shop/admin/rugs/removeimg",
            data: queryString,
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

    $(function () {
        Dropzone.options.myDropzone = {
            url: "/shop/admin/images/upload",
            paramName: "file",
            maxFilesize: 1,
            maxFiles: 4,
            acceptedFiles: "image/*",
            autoProcessQueue: true,
            addRemoveLinks: true,
            renameFile: function (file) {
                let timeStr = new Date().getTime();
                let newName = "gallery_" + timeStr + "_" + file.name;
                return newName;
            },
            init: function () {
                var myDropzone = this;

                $.getJSON('/shop/admin/images/get/<?= $data['rug']->id ?>', function (data) {
                    // console.log(data);
                    $.each(data, function (index, val) {
                        var mockFile = { name: val.name, size: val.size };
                        myDropzone.options.addedfile.call(myDropzone, mockFile);
                        myDropzone.options.thumbnail.call(myDropzone, mockFile, "/shop/uploads/" + val.name);
                        myDropzone.emit("complete", mockFile);
                    });

                });

                this.on("success", function (file, response) {
                    file.previewElement.id = response.file.name;
                    // console.log(response.file.size)

                    var newfile = response.file.name + ',' + response.file.size + ',' + response.file.type;
                    $("#galleryItems").append("<input data-img='" + response.file.name + "' class='form-control' name='gallery[]' type='hidden' value='" + newfile + "'>");
                });

                this.on("removedfile", function (file) {
                    var name = file.name;
                    // console.log(file.name);
                    $('#galleryItems').find('input[data-img="' + name + '"]').remove();

                    queryString = "filename=" + name;

                    $.ajax({
                        url: "/shop/admin/images/remove",
                        data: queryString,
                        type: "POST",
                        dataType: "json",
                        async: false,
                        success: function (data) {
                            // console.log(name);
                        }
                    });
                });
            }
        }
    });
</script>