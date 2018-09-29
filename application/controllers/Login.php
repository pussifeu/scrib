<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 21/03/2018
 * Time: 09:47
 */
class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->lang->load('common_lang', 'french');
        $this->load->library('Auth_AD');
    }

    /**
     * Call login page and create session when informations are good
     */
    public function index()
    {
        $this->form_validation->set_rules('login-nni', 'NNI', 'required|trim');
        $this->form_validation->set_rules('login-password', 'Mot de passe Sésame', 'required');


        if (isset ($this->session->userdata()['logged_in']) && $this->session->userdata()['logged_in'] == true) {
            redirect(base_url('redacteur'));
        }

        if ($this->form_validation->run() == false) {
            $this->load->view('pages/login/vw_login');
        } else {
            $nni = strtolower($this->input->post('login-nni'));
            $password = $this->input->post('login-password');

            if ($this->auth_ad->login($nni, $password)) {

                $this->session->set_userdata('logged_in', false);
                $ldapInfos = $this->auth_ad->getUserInfos($nni)[0];
                $this->setDefaultUserIntoSession($ldapInfos);

                redirect(base_url('redacteur'));
            } else {
                $this->session->set_flashdata('error', $this->lang->line('label_connexion_fail'));
                redirect(base_url('login'));
            }
        }

    }

    /**
     * Set default user to session
     * @param $user
     */
    public function setDefaultUserIntoSession($user)
    {
        //LOGGED IN
        $this->session->set_userdata('logged_in', true);
        $this->session->set_userdata('USER', $user);
    }


    /**
     * Session destroy and logout
     */
    public function logout()
    {
        $this->session->unset_userdata('logged_in');
        $this->session->sess_destroy();
        $this->load->view('pages/login/vw_login');
    }
}