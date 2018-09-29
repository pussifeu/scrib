<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 19/03/2018
 * Time: 16:40
 */
class Regroupements extends SCRIB_Controller
{
    var $tables = 'L_GROUP_CHAMP';
    var $key = 'GROUPC_ID';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('regroupementModel');
    }

    public function index()
    {
        $param['regroupments'] = $this->regroupementModel->getAllElements($this->tables, $this->key, 'GROUPC_STATUS');
        $param ['content'] = 'pages/connaisseur/regroupements/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $name = secureFields('regroupements-nom');
        if (isset($name) && !empty($name)) {
            $elements = array(
                'GROUPC_LIBELEE' => $name
            );
            $this->regroupementModel->insertOrUpdateElement($this->tables, $this->key, $elements);
            $msgFlash = $this->lang->line('label_regroupements_save');
            $this->session->set_flashdata('success', $msgFlash);
        } else {
            $msgFlash = $this->lang->line('label_regroupements_error');
            $this->session->set_flashdata('error', $msgFlash);
        }

        redirect(base_url('connaisseur/regroupements'));
    }

    public function delete($id)
    {
        $this->regroupementModel->deleteElement($this->tables, $this->key, $id);
        $msgFlash = $this->lang->line('label_regroupements_delete');
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/regroupements'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && $pk == 'GROUPC_LIBELEE') {
            echo 1;
        } else $this->regroupementModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
    }
}