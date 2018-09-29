<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SCRIB_Controller extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->lang->load('common_lang','french');
        $user = $this->session->userdata('USER');

        if(!isset($user) && empty($user)) {
            redirect(base_url('login'));
        }
    }
}