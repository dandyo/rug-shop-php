<?php

/**
 * Every page loads from view folder
 * in order to load a view inside a folder of the view folder
 * the folder/filename must be parsed
 */
class Orders extends Controller
{
    private $orderModel;
    private $rugsModel;

    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
        $this->orderModel = $this->model('Order');
        $this->rugsModel = $this->model('Rug');
    }

    public function index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            if (isset($_GET['search'])) {
                $key = $_GET['search'];

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $no_of_records_per_page = 10;

                $orders = $this->orderModel->searchOrders($key);

                $total_rows = count($orders);
                $offset = ($page - 1) * $no_of_records_per_page;
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $orders2 = $this->orderModel->searchOrdersPage($key, $offset, $no_of_records_per_page);

                $data = [
                    'orders' => $orders2,
                    'search' => $key,
                    'page' => $page,
                    'total_pages' => $total_pages
                ];

                $this->view('admin/orders/index', $data);
            } else {

                if (isset($_GET['page'])) {
                    $page = $_GET['page'];
                } else {
                    $page = 1;
                }

                $no_of_records_per_page = 10;

                $orders = $this->orderModel->getOrders();

                $total_rows = count($orders);
                $offset = ($page - 1) * $no_of_records_per_page;
                $total_pages = ceil($total_rows / $no_of_records_per_page);

                $orders2 = $this->orderModel->getOrdersPage($offset, $no_of_records_per_page);

                $data = [
                    'orders' => $orders2,
                    'search' => '',
                    'page' => $page,
                    'total_pages' => $total_pages
                ];

                $this->view('admin/orders/index', $data);
            }
        }
    }

    public function show($id)
    {
        $order = $this->orderModel->show($id);
        $cart = [];

        if (!empty($order) && !empty($order->cart)) {
            $cart = $this->rugsModel->getRugsIn($order->cart);
        }

        $data = [
            'order' => $order,
            'cart' => $cart
        ];
        $this->view('admin/orders/show', $data);
    }

    public function edit($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            $data = [
                'id' => $id,
                'status' => trim($_POST['status']),
            ];

            $error = '';

            if ($this->orderModel->updateOrder($data)) {
                flash('form_message', 'Order edited succesfully');
                redirect('admin/orders');
            } else {
                die('something went wrong');
            }

            // redirect('admin/orders');

            // $order = $this->orderModel->show($id);

            // $data = [
            //     'order' => $order
            // ];
            // $this->view('admin/orders/edit', $data);
        } else {
            $order = $this->orderModel->show($id);

            $data = [
                'order' => $order
            ];
            $this->view('admin/orders/edit', $data);
        }
    }

    public function delete($id)
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if ($this->orderModel->delete($id)) {
                flash('form_message', 'Order deleted');
                redirect('admin/orders');
            }
        } else {

            $data = [];
            $this->view('admin/orders/delete', $data);
        }
    }
}
