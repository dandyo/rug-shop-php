<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Image Library</title>
</head>

<body>
    <div id="main" class="w-100 p-4" style="max-width: 800px;">
        <h2 class="mb-4">Image Library</h2>

        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="upload-tab" data-bs-toggle="tab" data-bs-target="#upload-tab-pane" type="button" role="tab" aria-controls="upload-tab-pane" aria-selected="true">Upload Images</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="library-tab" data-bs-toggle="tab" data-bs-target="#library-tab-pane" type="button" role="tab" aria-controls="library-tab-pane" aria-selected="false">Image Library</button>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="upload-tab-pane" role="tabpanel" aria-labelledby="upload-tab" tabindex="0">
                <div class="p-4">
                    <form action="images" method="post">
                        <input type="file" name="gallery" class="form-control">
                    </form>
                    <form action="" method="post" class="dropzone">
                    </form>
                </div>
            </div>
            <div class="tab-pane fade" id="library-tab-pane" role="tabpanel" aria-labelledby="library-tab" tabindex="0">
                <div class="p-4">
                    <h4>Image thumbnails</h4>
                    <p>Coming soon</p>
                </div>
            </div>
        </div>
    </div>
</body>

</html>