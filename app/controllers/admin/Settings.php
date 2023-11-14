<?php

/**
 * Every page loads from view folder
 * in order to load a view inside a folder of the view folder
 * the folder/filename must be parsed
 */
class Settings extends Controller
{
    private $settingModel;
    private $userModel;
    private $variableModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        } else if (isLoggedIn() && $_SESSION['role'] != 'admin') {
            redirect('admin');
        }

        $this->settingModel = $this->model('Setting');
        $this->userModel = $this->model('User');
        $this->variableModel = $this->model('Variable');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $postData = [
                'email_recipient' => trim($_POST['email_recipient']),
                'test' => 'change test'
            ];

            $success = true;

            foreach ($postData as $key => $data) {
                if ($this->settingModel->updateSetting($key, $data)) {
                    $success = true;
                } else {
                    $success = false;
                    break;
                }
            }

            if ($success) {
                flash('form_message', 'Settings updated succesfully');
            }
        }

        // $recipient = $this->settingModel->getSetting('email_recipient');
        $settings = $this->settingModel->getAllSettings();
        $settingsArr = array();

        if (!empty($settings)) {
            foreach ($settings as $key => $value) {
                // array_push($settingsArr, ());
                $settingsArr[$value->setting] = $value->value;
            }
        }

        $data = [
            'nav' => 'index',
            'settings' => $settingsArr
        ];

        $this->view('admin/settings/index', $data);
    }

    public function users()
    {
        $users = $this->userModel->getAllUsers();

        $data = [
            'nav' => 'users',
            'users' => $users
        ];

        $this->view('admin/settings/users', $data);
    }

    public function useradd()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'password' => trim($_POST['password']),
                'confirm_password' => trim($_POST['confirm_password']),
                'role' => trim($_POST['role']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // validate name

            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            //Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            } else {
                // check email
                if ($this->userModel->findUserByEmail($data['email'])) {
                    $data['email_err'] = 'email already taken';
                }
            }

            //Validate Password
            if (empty($data['password'])) {
                $data['password_err'] = 'Please enter password';
            } elseif (strlen($data['password']) < 6) {
                $data['password_err'] = 'Password must have 6 characters';
            }

            // Validate Confirm Password

            if (empty($data['confirm_password'])) {
                $data['confirm_password_err'] = 'Please confirm password';
            } else {
                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validated
                // die('success');
                // Hash Password
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                //Register User
                if ($this->userModel->register($data)) {
                    flash('form_message', 'User added successfully');
                    redirect('admin/settings/users');
                } else {
                    die('Something went wrong');
                }
                #..
            } else {
                //load view with errors
                $data['nav'] = 'users';

                $this->view('admin/settings/user-add', $data);
            }
        } else {

            $data = [
                'nav' => 'users'
            ];

            $this->view('admin/settings/user-add', $data);
        }
    }

    public function useredit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $data = [
                'id' => $id,
                'name' => trim($_POST['name']),
                'email' => trim($_POST['email']),
                'role' => trim($_POST['role']),
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];
            // validate name

            if (empty($data['name'])) {
                $data['name_err'] = 'Please enter name';
            }
            //Validate Email
            if (empty($data['email'])) {
                $data['email_err'] = 'Please enter email';
            }

            //Validate Password
            if (!empty(trim($_POST['password']))) {
                $data['password'] = trim($_POST['password']);
                $data['confirm_password'] = trim($_POST['confirm_password']);

                if (strlen($data['password']) < 6) {
                    $data['password_err'] = 'Password must have 6 characters';
                }

                if ($data['password'] != $data['confirm_password']) {
                    $data['confirm_password_err'] = 'Passwords do not match';
                }
            }

            // Validate Confirm Password

            // if (empty($data['confirm_password'])) {
            //     $data['confirm_password_err'] = 'Please confirm password';
            // } else {
            //     if ($data['password'] != $data['confirm_password']) {
            //         $data['confirm_password_err'] = 'Passwords do not match';
            //     }
            // }

            if (empty($data['email_err']) && empty($data['name_err']) && empty($data['password_err']) && empty($data['confirm_password_err'])) {
                //validated
                // die('success');
                // Hash Password
                // $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                if (!empty(trim($_POST['password']))) {
                    $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                    if ($this->userModel->updateWithPassword($data)) {
                        flash('form_message', 'User updated successfully');
                        redirect('admin/settings/users');
                    } else {
                        die('Something went wrong');
                    }
                } else {
                    if ($this->userModel->update($data)) {
                        flash('form_message', 'User updated successfully');
                        redirect('admin/settings/users');
                    } else {
                        die('Something went wrong');
                    }
                }
            } else {
                $data['nav'] = 'users';

                $this->view('admin/settings/user-edit', $data);
            }
        } else {
            $user = $this->userModel->getUserbyId($id);

            $data = [
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role,
                'name_err' => '',
                'email_err' => '',
                'password_err' => '',
                'confirm_password_err' => ''
            ];

            $data['nav'] = 'users';

            $this->view('admin/settings/user-edit', $data);
        }
    }

    public function userdelete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->userModel->delete($id)) {
                flash('form_message', 'User deleted');
                redirect('admin/settings/users');
            }
        } else {
            $data = [
                'nav' => 'users'
            ];

            $this->view('admin/settings/user-delete', $data);
        }
    }

    public function variables()
    {
        $variables = $this->variableModel->getAllVariables();
        $vars = array();

        if (!empty($variables)) {
            foreach ($variables as $key => $value) {
                $newarr = array('id' => $value->id, 'name' => $value->name, 'value' => $value->value);

                if (array_key_exists($value->type, $vars)) {
                    array_push($vars[$value->type], $newarr);
                } else {
                    $vars[$value->type] = array($newarr);
                }
            }
        }

        $data = [
            'nav' => 'variables',
            'variables' => $vars
        ];

        $this->view('admin/settings/variables', $data);
    }

    public function varupdate($id)
    {
        $var = $this->variableModel->getVariable($id);
        $data = [
            'var' => $var
        ];

        $this->view('admin/settings/variable-update', $data);
    }

    public function varadd()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $value = trim($_POST['value']);
            $type = trim($_POST['type']);
            $name = trim($_POST['name']);

            $data = [
                'action' => 'add',
                'type' => $type,
                'name' => $value,
                'value' => $value
            ];

            if ($type == 'color') {
                $data['name'] = $name;
            }

            if (!$this->variableModel->checkVariable($data)) {

                $newvar = $this->variableModel->add($data);

                if ($newvar) {
                    $data['status'] = 'success';
                    $data['id'] = $newvar;

                    header('Content-type: application/json');
                    echo json_encode($data);
                } else {
                    http_response_code(500);
                }
            } else {
                $data = [
                    'status' => 'exists',
                    'type' => $type
                ];

                http_response_code(500);
                echo json_encode($data);
            }
        }
    }

    public function varedit()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_SPECIAL_CHARS);

            $type = trim($_POST['type']);
            $name = trim($_POST['name']);

            $data = [
                'id' => trim($_POST['id']),
                'type' => trim($_POST['type']),
                'name' => trim($_POST['value']),
                'value' => trim($_POST['value'])
            ];

            if ($type == 'color') {
                $data['name'] = $name;
            }

            if ($this->variableModel->update($data)) {
                $data['status'] = 'success';
                header('Content-type: application/json');
                echo json_encode($data);
            } else {
                http_response_code(500);
            }
        }
    }

    public function vardelete()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = trim($_POST['id']);
            $type = trim($_POST['type']);

            $data = [
                'action' => 'delete',
                'type' => $type,
                'id' => $id
            ];

            if ($this->variableModel->delete($id)) {
                $data['status'] = 'success';

                header('Content-type: application/json');
                echo json_encode($data);
            } else {
                http_response_code(500);
            }
        }
    }
}
