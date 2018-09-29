<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 20/03/2018
 * Time: 10:56
 */
class Edition extends SCRIB_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $param ['content'] = 'pages/edition/vw_index';
        $this->load->view('template', $param);
    }
}