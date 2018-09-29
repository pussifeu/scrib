<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 19/03/2018
 * Time: 16:40
 */
class Connaisseur extends SCRIB_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        //$this->excel_reader->read(ASSETSPATH.'\\reference\\Matrice.xls');
        //$worksheet = $this->excel_reader->sheets[0];
        //var_dump($worksheet); die;
        $param ['content'] = 'pages/connaisseur/vw_index';
        $this->load->view('template', $param);
    }
}