<?php
class Admin extends Controller
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

    // public function Index(Type $var = null)
    // {
    //     $data = [];
    //     $this->view('admin/index', $data);
    // }


    public function index()
    {
        // $posts = $this->postModel->getPosts();
        $orders = $this->orderModel->getOrdersPage(0, 7);

        $data = [
            'orders' => $orders
        ];

        $this->view('admin/index', $data);
    }
}
