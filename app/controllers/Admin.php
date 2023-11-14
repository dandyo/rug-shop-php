<?php
class Admin extends Controller
{
    private $rugModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->rugModel = $this->model('Rug');
        // $this->userModel = $this->model('User');
    }

    public function index()
    {
        // $posts = $this->postModel->getPosts();
        $data = [];
        $this->view('admin/index', $data);
    }

    // public function rugs()
    // {
    //     $rugs = $this->rugModel->getRugs();
    //     $data = [
    //         'rugs' => $rugs
    //     ];
    //     $this->view('admin/rugs/index', $data);
    // }

    public function add_rug()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);
            $data = [
                'location' => trim($_POST['location']),
                'asset_number' => trim($_POST['asset_number']),
                'design_name' => trim($_POST['design_name']),
                'image' => $_FILES['image'],
                'new_image' => '',
                'asset_number_err' => '',
                'image_err' => '',
            ];

            if (empty($data['asset_number'])) {
                $data['asset_number_err'] = 'Please input asset number';
            }

            if (empty($data['image'])) {
                $data['image_err'] = 'Please select image';
            } else {
                try {
                    $maxsize = 524288; //maximum size of allowed image being uploaded (around half MB)
                    $maxwidth = 512; //maximum width of allowed image dimension in pixels

                    // $data['image_err'] = $data["image"]["name"];
                    if ($data["image"]["size"] == 0) {
                        $data['image_err'] = "Please try again.";
                    } else {
                        if ($data["image"]['error'] > 0) {
                            $data['image_err'] = "Error during uploading new image, try again later.";
                        }

                        $extsAllowed = array('jpg', 'jpeg', 'png'); //allowed extensions
                        $uploadedfile = $data["image"]["name"];
                        $extension = pathinfo($uploadedfile, PATHINFO_EXTENSION);

                        if (in_array($extension, $extsAllowed)) {
                            //generate random image file name
                            // $newppic = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 10);
                            $newppic = pathinfo($uploadedfile, PATHINFO_FILENAME);
                            $newppic = $newppic . "_" . time();

                            $name = "uploads/" . $newppic . "." . $extension;

                            //if uploaded image is exceeding max size then compress it
                            if (($_FILES['image']['size'] >= $maxsize)) {
                                $data['image_err'] = "Uploaded image size is greater than $maxsize.<br>";
                                compressimage($_FILES['image']['tmp_name'], $name, $maxwidth); // resize it to 512pixels width
                            } else {
                                // echo "This image is just nice.<br>";
                                $result = move_uploaded_file($_FILES['image']['tmp_name'], $name);
                            }

                            $data['new_image'] = $newppic . "." . $extension;
                        } else {
                            $data['image_err'] = "Image file is not valid. Please try uploading another image.";
                        }
                    }
                } catch (Exception $e) {
                    $data['image_err'] = $e->getMessage();
                }
            }

            if (empty($data['asset_number_err']) && empty($data['image_err'])) {
                // flash('form_message', 'Rug added succesfully');
                if ($this->rugModel->addRug($data)) {
                    flash('form_message', 'Rug added succesfully');
                    redirect('admin/rugs');
                } else {
                    die('somethin went wrong');
                }

                // redirect('admin/rugs');
            } else {
                $this->view('admin/rugs/add', $data);
            }
        } else {
            $data = [
                'title' => 'Add new rug',
                'description' => ""
            ];

            $this->view('admin/rugs/add', $data);
        }
    }

    public function edit_rug()
    {
        $data = [];
        $this->view('admin/rugs/edit', $data);
    }
}
