<?php

/**
 * Every page loads from view folder
 * in order to load a view inside a folder of the view folder
 * the folder/filename must be parsed
 */
class Rugs extends Controller
{
    private $rugModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->rugModel = $this->model('Rug');
    }
    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['search'])) {
                $key = $_GET['search'];
                $rugs = $this->rugModel->searchRugs($key);
                $data = [
                    'rugs' => $rugs,
                    'search' => $key
                ];

                $this->view('admin/rugs/index', $data);
            } else {
                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $rugs = $this->rugModel->getRugs();

                $total_rows = count($rugs);
                $no_of_records_per_page = 20;
                $offset = ($page - 1) * $no_of_records_per_page;
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $rugs2 = $this->rugModel->getRugsPage($offset, $no_of_records_per_page);

                $data = [
                    'rugs' => $rugs2,
                    'search' => '',
                    'page' => $page,
                    'total_pages' => $total_pages
                ];

                $this->view('admin/rugs/index', $data);
            }
        }
        // else {
        //     $rugs = $this->rugModel->getRugs();

        //     $data = [
        //         'rugs' => $rugs,
        //         'search' => ''
        //     ];

        //     $this->view('admin/rugs/index', $data);
        // }
    }

    public function add()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
            $data = [
                'location' => trim($_POST['location']),
                'asset_number' => trim($_POST['asset_number']),
                'design_name' => trim($_POST['design_name']),
                'shape' => trim($_POST['shape']),
                'style' => trim($_POST['style']),
                'size_width_ft' => trim($_POST['size_width_ft']),
                'size_height_ft' => trim($_POST['size_height_ft']),
                'size_width_in' => trim($_POST['size_width_in']),
                'size_height_in' => trim($_POST['size_height_in']),
                'size_width_m' => trim($_POST['size_width_m']),
                'size_height_m' => trim($_POST['size_height_m']),
                'sku' => trim($_POST['sku']),
                'material' => trim($_POST['material']),
                'collection' => trim($_POST['collection']),
                'primary_color' => trim($_POST['primary_color']),
                'secondary_color' => trim($_POST['secondary_color']),
                'age' => trim($_POST['age']),
                'construction' => trim($_POST['construction']),
                'country' => trim($_POST['country']),
                'image' => $_FILES['image'],
                'description' => $_FILES['description'],
                'new_image' => '',
                'asset_number_err' => '',
                'primary_color_err' => '',
                'secondary_color_err' => '',
                'image_err' => '',
            ];

            if (empty($data['asset_number'])) {
                $data['asset_number_err'] = 'Please input asset number';
            }

            if (empty($data['primary_color'])) {
                $data['primary_color_err'] = 'Please select primary color';
            }

            if (empty($data['secondary_color'])) {
                $data['secondary_color_err'] = 'Please select secondary color';
            }

            if (empty($data['image'])) {
                $data['image_err'] = 'Please select image';
            } else {
                try {
                    $maxsize = 500; //maximum size of allowed image being uploaded (around half MB)
                    $maxwidth = 500; //maximum width of allowed image dimension in pixels

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
                                // $data['image_err'] =  "Uploaded image size is greater than $maxsize.<br>";
                                compressimage($_FILES['image']['tmp_name'], $name, $maxwidth); // resize it to 512pixels width
                            } else {
                                // echo "This image is just nice.<br>";
                                $result = move_uploaded_file($_FILES['image']['tmp_name'], $name);
                            }

                            $data['new_image'] = $newppic . "." . $extension;
                        } else {
                            $data['image_err'] =  "Image file is not valid. Please try uploading another image.";
                        }
                    }
                } catch (Exception $e) {
                    $data['image_err'] = $e->getMessage();
                }
            }

            if (empty($data['asset_number_err']) && empty($data['image_err']) && empty($data['primary_color_err']) && empty($data['secondary_color_err'])) {
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

    public function edit($id)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'location' => trim($_POST['location']),
                'asset_number' => trim($_POST['asset_number']),
                'design_name' => trim($_POST['design_name']),
                'shape' => trim($_POST['shape']),
                'style' => trim($_POST['style']),
                'size_width_ft' => trim($_POST['size_width_ft']),
                'size_height_ft' => trim($_POST['size_height_ft']),
                'size_width_in' => trim($_POST['size_width_in']),
                'size_height_in' => trim($_POST['size_height_in']),
                'size_width_m' => trim($_POST['size_width_m']),
                'size_height_m' => trim($_POST['size_height_m']),
                'sku' => trim($_POST['sku']),
                'material' => trim($_POST['material']),
                'collection' => trim($_POST['collection']),
                'primary_color' => trim($_POST['primary_color']),
                'secondary_color' => trim($_POST['secondary_color']),
                'age' => trim($_POST['age']),
                'construction' => trim($_POST['construction']),
                'country' => trim($_POST['country']),
                'image' => $_FILES['image'],
                'exist_image' => trim($_POST['exist_image']),
                'description' => trim($_POST['description']),
                'new_image' => '',
                'asset_number_err' => '',
                'primary_color_err' => '',
                'secondary_color_err' => '',
                'image_err' => '',
            ];

            $error = '';

            if (empty($data['image']['name'])) {
                if (empty($data['exist_image'])) {
                    $error = 'Please select image';
                    $data['image_err'] = 'Please select image';
                    // echo "if<br>";
                } else {
                    // echo "else<br>";
                    $data['image'] = trim($_POST['exist_image']);
                }
                // 
            } else {

                try {
                    $maxsize = 500; //maximum size of allowed image being uploaded (around half MB)
                    $maxwidth = 500; //maximum width of allowed image dimension in pixels

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
                                // $data['image_err'] =  "Uploaded image size is greater than $maxsize.<br>";
                                compressimage($_FILES['image']['tmp_name'], $name, $maxwidth); // resize it to 512pixels width
                            } else {
                                // echo "This image is just nice.<br>";
                                $result = move_uploaded_file($_FILES['image']['tmp_name'], $name);
                            }

                            $data['image'] = $newppic . "." . $extension;
                        } else {
                            $data['image_err'] =  "Image file is not valid. Please try uploading another image.";
                        }
                    }
                } catch (Exception $e) {
                    $data['image_err'] = $e->getMessage();
                }
            }

            if (empty($data['asset_number_err']) && empty($data['image_err']) && empty($data['primary_color_err']) && empty($data['secondary_color_err'])) {

                if ($this->rugModel->updateRug($data)) {
                    flash('form_message', 'Rug edited succesfully');
                    redirect('admin/rugs');
                } else {
                    die('somethin went wrong');
                }

                redirect('admin/rugs');
            } else {
                $rug = $this->rugModel->show($id);
                $data = [
                    'rug' => $rug,
                    'image_err' => $error,
                    'asset_number_err' => '',
                    'primary_color_err' => '',
                    'secondary_color_err' => ''
                ];

                $this->view('admin/rugs/edit', $data);
            }
        } else {
            $rug = $this->rugModel->show($id);
            $data = [
                'rug' => $rug,
                'image_err' => '',
                'asset_number_err' => '',
                'primary_color_err' => '',
                'secondary_color_err' => ''
            ];
            $this->view('admin/rugs/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $rug = $this->rugModel->show($id);
            if (file_exists('uploads/' . $rug->image)) {
                unlink("uploads/" . $rug->image);
            }
            // unlink( "path_to_your_upload_directory/".$staff_id.".jpg" );
            if ($this->rugModel->deleteRug($id)) {
                flash('form_message', 'Rug deleted');
                redirect('admin/rugs');
            }
        } else {
            $rug = $this->rugModel->show($id);
            $data = [
                'rug_id' => $rug->id
            ];
            $this->view('admin/rugs/delete', $data);
        }
    }

    public function show($id)
    {
        $rug = $this->rugModel->show($id);
        $data = [
            'rug' => $rug
        ];
        $this->view('admin/rugs/show', $data);
    }

    public function removeimg()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['id']);
            $rug = $this->rugModel->show($id);

            if ($rug->image) {
                $this->rugModel->removeRugImage($id);

                if (file_exists('uploads/' . $rug->image)) {
                    unlink("uploads/" . $rug->image);

                    echo "success";
                } else {
                    echo "something went wrong 1 " . $rug->image;
                }
            } else {
                echo "something went wrong 2";
            }
        } else {
            echo "hey";
        }
    }
}
