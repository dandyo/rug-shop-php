<?php
class Images extends Controller
{
    private $imageModel;
    private $rugModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->imageModel = $this->model('Image');
        $this->rugModel = $this->model('Rug');
    }

    public function library()
    {
        $data = [];
        $this->view('admin/images/library', $data);
    }

    public function upload()
    {
        if (!empty($_FILES)) {
            // File path configuration 
            $uploadDir = "uploads/";
            // $num_files = count($_FILES['file']['name']);

            $file = array();
            $maxsize = 5242880;
            $maxwidth = 700;

            $img = $_FILES['file']['name'];

            $extension = pathinfo($img, PATHINFO_EXTENSION);
            $newppic = pathinfo($img, PATHINFO_FILENAME);

            // $newpic = time() . '_' . $newppic . '.' . $extension;
            $newpic = $newppic . '.' . $extension;
            $fullpath = $uploadDir . $newpic;

            if (($_FILES['file']['size'] >= $maxsize)) {
                // resize it to 512pixels width
                compressimage($_FILES['file']['tmp_name'], $fullpath, $maxwidth);
            } else {
                move_uploaded_file($_FILES['file']['tmp_name'], $fullpath);
            }

            $size = $_FILES['file']['size'];
            $type = $_FILES['file']['type'];

            $file = array('name' => $newpic, 'size' => $size, 'type' => $type, 'path' => $fullpath);

            $savedata = [
                'filename' => $newpic,
                'size' => $size,
                'type' => $type
            ];

            $this->imageModel->add($savedata);

            $data = [
                'file' => $file
            ];

            header('Content-type: application/json');
            echo json_encode($data);
        }
    }

    public function remove()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $filename = $_POST['filename'];

            try {

                $this->imageModel->remove($filename);

                if (file_exists('uploads/' . $filename)) {
                    unlink("uploads/" . $filename);
                }

                $data = [
                    'status' => 'success',
                ];

                header('Content-type: application/json');
                echo json_encode($data);

            } catch (Exception $e) {
                header('Content-type: application/json');
                http_response_code(500);
            }
        }

    }
    public function get($id)
    {
        // if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (!empty($id)) {
            // $id = $_POST['id'];

            $rug = $this->rugModel->show($id);
            $galleryArr = array();

            if (!empty($rug->gallery)) {
                $galleries = unserialize($rug->gallery);

                foreach ($galleries as $key => $gallery) {
                    $gallery = explode(',', $gallery);
                    $galleryArr[] = array('name' => $gallery[0], 'size' => $gallery[1], 'type' => $gallery[2]);
                }
            }

            // $data = [
            //     'gallery' => $galleryArr,
            // ];

            header('Content-type: application/json');
            echo json_encode($galleryArr);
        }
    }
}