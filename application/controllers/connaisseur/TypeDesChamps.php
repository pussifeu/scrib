<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 19/03/2018
 * Time: 16:40
 */
class TypeDesChamps extends SCRIB_Controller
{
    var $tables = 'L_TYPE_CHAMP';
    var $key = 'TYPC_ID';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('typeDesChampsModel');
    }

    public function index()
    {
        $param['typeschamps'] = $this->typeDesChampsModel->getAllElements($this->tables, $this->key, 'TYPC_STATUS');
        $param ['content'] = 'pages/connaisseur/typeschamps/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $name = secureFields('typeschamp-nom');
        if (isset($name) && !empty($name)) {
            $elements = array(
                'TYPC_LIBELLE' => $name
            );
            $this->typeDesChampsModel->insertOrUpdateElement($this->tables, $this->key, $elements);
            $msgFlash = $this->lang->line('label_typeschamp_save');
            $this->session->set_flashdata('success', $msgFlash);
        } else {
            $msgFlash = $this->lang->line('label_typeschamp_error');
            $this->session->set_flashdata('error', $msgFlash);
        }

        redirect(base_url('connaisseur/typedeschamps'));
    }

    public function delete($id)
    {
        $this->typeDesChampsModel->deleteElement($this->tables, $this->key, $id);
        $msgFlash = $this->lang->line('label_typeschamp_delete');
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/typedeschamps'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && $pk == 'TYPC_LIBELLE') {
            echo 1;
        } else $this->typeDesChampsModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
    }
}