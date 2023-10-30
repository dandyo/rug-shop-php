<?php
class Rugs extends Controller
{

    private $rugModel;

    public function __construct()
    {
        $this->rugModel = $this->model('Rug');
    }

    public function index($id)
    {
        $rug = $this->rugModel->show($id);
        $data = [
            'rug' => $rug
        ];
        $this->view('rugs/index', $data);
    }
}
