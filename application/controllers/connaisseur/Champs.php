<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 16/04/2018
 * Time: 16:17
 */
class Champs extends SCRIB_Controller
{
    var $tables_champs = 'L_CHAMPS';
    var $tables_types = 'L_TYPE_CHAMP';
    var $key_champs = 'CHAMPS_ID';
    var $key_types = 'TYPC_ID';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('typeDesChampsModel', 'champsModel'));
    }

    public function index()
    {
        $param ['champs'] = $this->champsModel->getAllElements($this->tables_champs, $this->key_champs, 'CHAMPS_STATUS');
        $param ['typeschamps'] = $this->typeDesChampsModel->getAllElements($this->tables_types, $this->key_types, 'TYPC_STATUS');
        $param ['typeschampsarray'] = $this->formatTypeChamp($param ['typeschamps']);
        $param ['typeschampsjson'] = $this->formatTypeChampToJson($param ['typeschamps']);
        $param ['content'] = 'pages/connaisseur/champs/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $name = $this->input->post('CHAMPS_VAL');
        if (isset($_POST['CHAMPS_OBLIGATOIRE']))
            $_POST['CHAMPS_OBLIGATOIRE'] = true;
        else
            $_POST['CHAMPS_OBLIGATOIRE'] = false;

        if (isset($name) && !empty($name)) {
            $elements = $_POST;
            $this->champsModel->insertOrUpdateElement($this->tables_champs, $this->key_champs, $elements);
            $msgFlash = $this->lang->line('label_champs_save');
            $this->session->set_flashdata('success', $msgFlash);
        } else {
            $msgFlash = $this->lang->line('label_champs_error');
            $this->session->set_flashdata('error', $msgFlash);
        }

        redirect(base_url('connaisseur/champs'));
    }

    public function delete($id)
    {
        $this->champsModel->deleteElement($this->tables_champs, $this->key_champs, $id);
        $msgFlash = $this->lang->line('label_champs_delete');
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/champs'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && (($pk == 'CHAMPS_VAL') || ($pk == 'CHAMPS_DEFAULT_VALUE'))) {
            echo 1;
        } else $this->champsModel->insertOrUpdateElement($this->tables_champs, $this->key_champs, $elements, $id);
    }


    public function edit()
    {
        $id = $this->input->post('CHAMPS_ID');
        $name = $this->input->post('CHAMPS_VAL');
        if (isset($_POST['CHAMPS_OBLIGATOIRE']))
            $_POST['CHAMPS_OBLIGATOIRE'] = true;
        else
            $_POST['CHAMPS_OBLIGATOIRE'] = false;

        if (isset($name) && !empty($name)) {
            $elements = $_POST;
            $this->champsModel->insertOrUpdateElement($this->tables_champs, $this->key_champs, $elements, $id);
            $msgFlash = $this->lang->line('label_champs_edit_save');
            $this->session->set_flashdata('success', $msgFlash);
        } else {
            $msgFlash = $this->lang->line('label_champs_error');
            $this->session->set_flashdata('error', $msgFlash);
        }
        redirect(base_url('connaisseur/champs'));
    }

    public function formatTypeChamp($typeschamps)
    {
        $arrayTypeChamps = [];
        $array['0'] = $this->lang->line('label_champs_select');
        foreach ($typeschamps as $typeschamp) {
            $array[$typeschamp->TYPC_ID] = $typeschamp->TYPC_LIBELLE;
        }
        array_push($arrayTypeChamps, $array);
        return $arrayTypeChamps;
    }

    public function formatTypeChampToJson($typeschamps)
    {
        $arrayTypeChamps = [];
        foreach ($typeschamps as $typeschamp) {
            $array['value'] = $typeschamp->TYPC_ID;
            $array['text'] = $typeschamp->TYPC_LIBELLE;
            array_push($arrayTypeChamps, $array);
        }
        return json_encode($arrayTypeChamps);
    }

}