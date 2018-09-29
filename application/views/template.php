<?php
$this->load->view('includes/vw_header');
$this->load->view('includes/vw_navigation');
$this->load->view('includes/alert/vw_alert');
$this->load->view($content);
$this->load->view('includes/vw_footer');