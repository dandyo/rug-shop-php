<?php

/**
 * Every page loads from view folder
 * in order to load a view inside a folder of the view folder
 * the folder/filename must be parsed
 */
class Cart extends Controller
{
    private $rugModel;
    private $orderModel;
    private $settingsModel;

    public function __construct()
    {
        $this->rugModel = $this->model('Rug');
        $this->orderModel = $this->model('Order');
        $this->settingsModel = $this->model('Setting');
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = trim($_POST['action']);
            $id = trim($_POST['id']);

            if ($action == "add") {

                $rug = $this->rugModel->show($id);

                $rugArr = array('id' => $rug->id, 'asset_number' => $rug->asset_number, 'design_name' => $rug->design_name, 'size_width_ft' => $rug->size_width_ft, 'size_length_ft' => $rug->size_length_ft, 'size_width_in' => $rug->size_width_in, 'size_length_in' => $rug->size_length_in, 'location' => $rug->location, 'image' => $rug->image);

                $itemArray = array($rug->id => $rugArr);

                if (!empty($_SESSION["cart_item"])) {
                    $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"], $itemArray);
                } else {
                    // $_SESSION["cart_item"] = $itemArray;
                    $_SESSION["cart_item"] = $itemArray;
                }

                $data = [
                    'action' => $action,
                    'rug' => $rugArr,
                    'status' => 'success',
                    'id' => $id
                ];
                header('Content-type: application/json');
                echo json_encode($data);
            }

            if ($action == "remove") {
                if (!empty($_SESSION["cart_item"])) {
                    foreach ($_SESSION["cart_item"] as $k => $v) {
                        if ($id == $v['id']) {
                            unset($_SESSION["cart_item"][$k]);

                            $data = [
                                'action' => $action,
                                'status' => 'success',
                                'id' => $id
                            ];
                            header('Content-type: application/json');
                            echo json_encode($data);
                        }
                    }
                }
            }
        } else {
        }
    }

    public function clear()
    {
        unset($_SESSION["cart_item"]);
        echo "clear";
    }

    public function checkout()
    {
        $data = [];
        $this->view('cart/checkout', $data);
    }

    public function send()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'name' => trim($_POST['name']),
                'company' => trim($_POST['company']),
                'email' => trim($_POST['email']),
                'phone' => trim($_POST['phone']),
                'address1' => trim($_POST['address1']),
                'address2' => trim($_POST['address2']),
                'city' => trim($_POST['city']),
                'state' => trim($_POST['state']),
                'zip' => trim($_POST['zip']),
                'cart' => $_POST['cart'],
                'cartContent' => ''
            ];

            $cartString = '';

            $cartArr = json_decode($data['cart']);
            $cartIDs = array();

            if (!empty($cartArr)) {
                $cartString .= '<table><thead>';
                $cartString .= '<tr>';
                $cartString .= '<th></th>';
                $cartString .= '<th>Asset Number</th>';
                $cartString .= '<th>Size</th>';
                $cartString .= '<th>Location</th>';
                $cartString .= '<th></th>';
                $cartString .= '</tr>';
                $cartString .= '</thead><tbody>';

                foreach ($cartArr as $k => $rug) {
                    $cartString .= '<tr>';
                    $cartString .= '<td><img src="' . URLROOT . 'uploads/' . $rug->image . '" width="120" height="150" /> </td>';
                    $cartString .= '<td>' . $rug->asset_number . '</td>';
                    $cartString .= '<td>' . $rug->size_width_ft . '\' ' . $rug->size_width_in . '" x ' . $rug->size_length_ft . '\' ' . $rug->size_length_in . '"</td>';
                    $cartString .= '<td>' . $rug->location . '</td>';
                    $cartString .= '<td><a href="' . URLROOT . 'rugs/' . $rug->id . '" target="_blank">view</a></td>';
                    $cartString .= '</tr>';

                    array_push($cartIDs, $rug->id);
                }

                $cartString .= '</tbody></table>';

                $data['cartContent'] = serialize($cartIDs);
            }

            // $this->orderModel->addOrder($data);
            // $return_data = [
            //     'status' => 'success'
            // ];

            // header('Content-type: application/json');
            // echo json_encode($return_data);

            $settings = $this->settingsModel->getSetting('email_recipient');
            $to = $settings->value;

            // $to = 'dandyojeda@gmail.com';
            // $to = 'robbie@rekmarketing.com';

            $from = 'Organic Looms<noreply@organiclooms.com>';

            $email_subject = "New Order from Organic Looms website";

            $email_body = '<html>
                <head>
                <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
                    <title></title>
                    <style>
                    table {
                        border-collapse: collapse;
                    }
                    table tr th {
                        border: 1px solid #000;
                        vertical-align: top;
                        padding: 5px;
                    }
                    table tr td {
                        border: 1px solid #000;
                        vertical-align: top;
                        padding: 5px;
                    }
                    </style>
                </head>
                <body>';

            $email_body .= "<h4>You have received a new order from Organic Looms.</h4>";

            $email_body .= '<h4>Here are the details:</h4>
            <p>Name:  ' . $data['name'] . '<br>
            Company name: ' . $data['company'] . '<br>
            Email: ' . $data['email'] . '<br>
            Phone: ' . $data['phone'] . '<br>
            Address: ' . $data['address1'] . ', ' . $data['address2'] . ', ' . $data['city'] . ', ' . $data['state'] . ' ' . $data['zip'] . '<br>
            Cart:</p>' . $cartString;

            $headers = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            try {
                $success = mail($to, $email_subject, $email_body, $headers);
                if ($success) {
                    $this->orderModel->addOrder($data);

                    unset($_SESSION["cart_item"]);

                    $return_data = [
                        'status' => 'success'
                    ];

                    header('Content-type: application/json');
                    echo json_encode($return_data);
                } else {
                    $return_data = [
                        'status' => 'error'
                    ];
                    header('Content-type: application/json');
                    echo json_encode($return_data);
                }
            } catch (Exception $e) {
                header('Content-type: application/json');
                $return_data = [
                    'status' => $e
                ];
                echo json_encode($return_data);
            }
        }
    }

    public function testsend()
    {
        // $to = 'dandyojeda@gmail.com';
        $settings = $this->settingsModel->getSetting('email_recipient');
        $to = $settings->value;

        print_r($settings);
        echo '<br>';
        print_r($to);
    }

    public function thankyou()
    {
        $data = [];
        $this->view('cart/thankyou', $data);
    }
}
