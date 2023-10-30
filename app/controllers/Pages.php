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
    public function Index(Type $var = null)
    {

        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            $params = $_GET;

            // print_r($params);           

            $rugs = $this->rugModel->refineSearch($params);
            $data = [
                'rugs' => $rugs,
                'params' => $params
            ];

            $this->view('pages/index', $data);
        } else {
            $rugs = $this->rugModel->getRugs();
            $data = [
                'rugs' => $rugs
            ];
            $this->view('pages/index', $data);
        }
    }
}
