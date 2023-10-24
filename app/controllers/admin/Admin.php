<?php
class Admin extends Controller
{
    public function __construct()
    {
        if (!isLoggedIn()) {
            redirect('users/login');
        }
    }

    // public function Index(Type $var = null)
    // {
    //     $data = [];
    //     $this->view('admin/index', $data);
    // }


    public function index()
    {
        // $posts = $this->postModel->getPosts();
        $data = [];
        $this->view('admin/index', $data);
    }
}
