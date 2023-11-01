<?php

/**
 * Every page loads from view folder
 * in order to load a view inside a folder of the view folder
 * the folder/filename must be parsed
 */
class Cart extends Controller
{
    private $rugModel;

    public function __construct()
    {
        $this->rugModel = $this->model('Rug');
    }

    public function process()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $action = trim($_POST['action']);
            $id = trim($_POST['id']);

            if ($action == "add") {

                $rug = $this->rugModel->show($id);

                $rugArr = array('id' => $rug->id, 'asset_number' => $rug->asset_number, 'design_name' => $rug->design_name, 'size_width_ft' => $rug->size_width_ft, 'size_height_ft' => $rug->size_height_ft, 'size_width_in' => $rug->size_width_in, 'size_height_in' => $rug->size_height_in, 'size_width_m' => $rug->size_width_m, 'size_height_m' => $rug->size_height_m, 'location' => $rug->location, 'image' => $rug->image);

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
            $name = trim($_POST['name']);
            $email = trim($_POST['email']);
            $phone = trim($_POST['phone']);
            $address1 = trim($_POST['address1']);
            $address2 = trim($_POST['address2']);
            $city = trim($_POST['city']);
            $state = trim($_POST['state']);
            $zip = trim($_POST['zip']);
            $cart = $_POST['cart'];

            $cartString = '';

            $cartArr = json_decode($cart);
            $cartIDs = [];

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
                    $cartString .= '<td>' . $rug->size_width_ft . '\' ' . $rug->size_width_in . '" x ' . $rug->size_height_ft . '\' ' . $rug->size_height_in . '" <br> ' . $rug->size_width_m . 'm  x ' . $rug->size_height_m . 'm</td>';
                    $cartString .= '<td>' . $rug->location . '</td>';
                    $cartString .= '<td><a href="' . URLROOT . 'rugs/' . $rug->id . '" target="_blank">view</a></td>';
                    $cartString .= '</tr>';

                    $cartIDs = array_merge($cartIDs, $$rug->id);
                }

                $cartString .= '</tbody></table>';
            }

            // echo $cartString;

            // http_response_code(200);
            // echo json_encode($cartString);

            // echo $cart;

            $to = 'dandyojeda@gmail.com';

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
            <p>Name:  ' . $name . '<br>
            Email: ' . $email . '<br>
            Phone: ' . $phone . '<br>
            Address: ' . $address1 . ', ' . $address2 . ', ' . $city . ', ' . $state . ' ' . $zip . '<br>
            Cart:</p>' . $cartString;

            $headers  = 'MIME-Version: 1.0' . "\r\n";
            $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $headers .= 'From: ' . $from . "\r\n" .
                'Reply-To: ' . $from . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            // $headers .= 'From: Organic Looms <noreply@organiclooms.com>' . "\r\n";
            // $headers .= 'Reply-To: ' . $email . '' . "\r\n";
            // $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

            try {
                $success = mail($to, $email_subject, $email_body, $headers);
                if ($success) {
                    unset($_SESSION["cart_item"]);

                    $data = [
                        'status' => 'success'
                    ];

                    header('Content-type: application/json');
                    // http_response_code(200);
                    echo json_encode($data);
                    // return true;
                } else {
                    $data = [
                        'status' => 'error'
                    ];
                    header('Content-type: application/json');
                    echo json_encode($data);
                    // http_response_code(500);
                }
            } catch (Exception $e) {
                header('Content-type: application/json');
                // http_response_code(500);
                $data = [
                    'status' => $e
                ];
                echo json_encode($data);
            }
        }

        // $data = [];
        // $this->view('cart/checkout', $data);
    }

    public function testsend()
    {
        $to = 'dandyojeda@gmail.com';
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

        $cart = '{"1":{"id":1,"asset_number":"Rug #89739","design_name":"N\/A","size_width_ft":1,"size_height_ft":2,"size_width_in":6,"size_height_in":10,"size_width_m":2,"size_height_m":2,"location":"Prescott","image":"img1399114133_1698126304.jpg"}}';

        $cartString = '';

        $cartArr = json_decode($cart);

        if (!empty($cartArr)) {
            // print_r($cartArr);
            $cartString .= '<table><thead>';
            $cartString .= '<tr>';
            $cartString .= '<th></th>';
            $cartString .= '<th>Asset Number</th>';
            $cartString .= '<th>Size</th>';
            $cartString .= '<th>Location</th>';
            $cartString .= '</tr>';
            $cartString .= '</thead><tbody>';
            foreach ($cartArr as $k => $rug) {
                $cartString .= '<tr>';
                $cartString .= '<td><img src="' . URLROOT . 'uploads/' . $rug->image . '" width="120" height="150" /> </td>';
                $cartString .= '<td>' . $rug->asset_number . '</td>';
                $cartString .= '<td>' . $rug->size_width_ft . '\' ' . $rug->size_width_in . '" x ' . $rug->size_height_ft . '\' ' . $rug->size_height_in . '" <br> ' . $rug->size_width_m . 'm  x ' . $rug->size_height_m . 'm</td>';
                $cartString .= '<td>' . $rug->location . '</td>';
                $cartString .= '</tr>';
            }
            $cartString .= '</tbody></table>';
        }

        $email_body .= '<h4>Here are the details:</h4><br> ' . $cartString;
        $email_body .= '</body></html>';


        // $headers = 'From: Organic Looms <noreply@organiclooms.com>' . "\r\n";
        // $headers .= 'Reply-To: dandyojeda@gmail.com' . "\r\n";

        // $success = mail($to, $email_subject, $email_body, $headers);
        // if ($success) {
        //     echo "success";
        // } else {
        //     echo "failed";
        // }

        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: ' . $from . "\r\n" .
            'Reply-To: ' . $from . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        try {
            $success = mail($to, $email_subject, $email_body, $headers);
            if ($success) {
                $data = [
                    'status' => 'success',
                    'cart' => $cartString
                ];

                header('Content-type: application/json');
                // http_response_code(200);
                echo json_encode($data);
                // return true;
            } else {
                $data = [
                    'status' => 'error',
                    'cart' => $cartString
                ];
                header('Content-type: application/json');
                echo json_encode($data);
                // http_response_code(500);
            }
        } catch (Exception $e) {
            header('Content-type: application/json');
            // http_response_code(500);
            $data = [
                'status' => $e
            ];
            echo json_encode($data);
        }
    }

    public function thankyou()
    {
        $data = [];
        $this->view('cart/thankyou', $data);
    }
}
