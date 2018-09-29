<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 19/03/2018
 * Time: 16:40
 */
class Perimeters extends SCRIB_Controller
{
    var $tables = 'L_PERIMETER';
    var $key = 'PER_ID';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('perimetersModel');
    }

    public function index()
    {
        $param['perimeters'] = $this->perimetersModel->getAllElements($this->tables, $this->key, 'PER_STATUS');
        $param ['content'] = 'pages/connaisseur/perimeters/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $name = secureFields('perimeter-nom');
        $description = secureFields('perimeter-desc');
        if (isset($name) && !empty($name)) {
            $elements = array(
                'PER_LIBELLE' => $name,
                'PER_DESCRIPTION' => $description
            );
            $this->perimetersModel->insertOrUpdateElement($this->tables, $this->key, $elements);
            $msgFlash = $this->lang->line('label_perimeters_save');
            $this->session->set_flashdata('success', $msgFlash);
        } else {
            $msgFlash = $this->lang->line('label_perimeters_error');
            $this->session->set_flashdata('error', $msgFlash);
        }

        redirect(base_url('connaisseur/perimeters'));
    }

    public function delete($id)
    {
        $this->perimetersModel->deleteElement($this->tables, $this->key, $id);
        $msgFlash = $this->lang->line('label_perimeters_delete');
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/perimeters'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && $pk == 'PER_LIBELLE') {
            echo 1;
        } else $this->perimetersModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
    }
}