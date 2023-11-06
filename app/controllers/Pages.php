<?php

/**
 * Every page loads from view folder
 * in order to load a view inside a folder of the view folder
 * the folder/filename must be parsed
 */
class Pages extends Controller
{
    private $rugModel;

    public function __construct()
    {
        $this->rugModel = $this->model('Rug');
    }
    public function about()
    {
        $data = [
            'title' => 'About',
            'description' => "App to share posts"
        ];
        $this->view('pages/about', $data);
    }
    public function Index()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $params = $_GET;
            if (isset($_GET['page'])) {
                $page = $_GET['page'];
            } else {
                $page = 1;
            }

            $no_of_records_per_page = 16;

            // print_r($params);           

            $rugs = $this->rugModel->refineSearch($params);
            $total_rows = count($rugs);
            $offset = ($page - 1) * $no_of_records_per_page;
            $total_pages = ceil($total_rows / $no_of_records_per_page);  

            $rugs2 = $this->rugModel->refineSearch($params, $offset, $no_of_records_per_page);        

            $data = [
                'rugs' => $rugs,
                'params' => $params,
                'page' => $page,
                'total_pages' => $total_pages
            ];

            $this->view('pages/index', $data);
        } else {
            // if (isset($_GET['page'])) {
            //     $page = $_GET['page'];
            // } else {
            //     $page = 1;
            // }

            // $key = $_GET['search'];
            // $no_of_records_per_page = 16;

            // $rugs = $this->rugModel->getRugs();

            // $total_rows = count($rugs);
            // $offset = ($page - 1) * $no_of_records_per_page;
            // $total_pages = ceil($total_rows / $no_of_records_per_page);

            // $rugs2 = $this->rugModel->searchRugsPage($key, $offset, $no_of_records_per_page);

            // $data = [
            //     'rugs' => $rugs2,
            //     'search' => $key,
            //     'page' => $page,
            //     'total_pages' => $total_pages
            // ];

            // $this->view('pages/index', $data);
        }
    }
}
