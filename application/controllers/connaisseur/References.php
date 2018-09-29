<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 17/09/2018
 * Time: 16:29
 */
class References extends SCRIB_Controller
{
    var $tables = 'L_REFERENCE';
    var $key = 'REFERENCE_ID';
    var $pathRefDirectory = ASSETSPATH . REFERENCE_FOLDER;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('referenceModel');
    }

    public function index()
    {
        $param['references'] = $this->referenceModel->getAllElements($this->tables, $this->key, 'REFERENCE_STATUS');
        $param ['content'] = 'pages/connaisseur/references/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $name = secureFields('reference-name');
        if (isset($name) && !empty($name)) {
            $elements = array(
                'REFERENCE_LIBELLE' => convert_accented_characters(html_entity_decode($name)),
            );
            //Verifier si le dossier existe dans la base
            $references = $this->referenceModel->getAllElements($this->tables, $this->key);

            if (!$this->verifIfReferencesExist($references, $name)) {
                $this->referenceModel->insertOrUpdateElement($this->tables, $this->key, $elements);
                $name_decode = convert_accented_characters(html_entity_decode($name));
                mkdir($this->pathRefDirectory . SEPARATOR . $name_decode, 0700);
                $msgFlash = $this->lang->line('label_references_save');
                $this->session->set_flashdata('success', $msgFlash);
            } else {
                $msgFlash = $this->lang->line('label_references_exist');
                $this->session->set_flashdata('error', $msgFlash);
            }
        } else {
            $msgFlash = $this->lang->line('label_references_error');
            $this->session->set_flashdata('error', $msgFlash);
        }
        redirect(base_url('connaisseur/references'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && $pk == 'REFERENCE_LIBELLE') {
            echo 1;
        } else {
            $reference = $this->referenceModel->getElementById($this->tables, $this->key, $id);
            $references = $this->referenceModel->getAllElements($this->tables, $this->key);
            if (!$this->verifIfReferencesExist($references, $elements['REFERENCE_LIBELLE'])) {
                if (isset($elements['REFERENCE_LIBELLE']) && !empty($elements['REFERENCE_LIBELLE'])) {
                    $this->referenceModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
                    rename($this->pathRefDirectory . SEPARATOR .$reference->REFERENCE_LIBELLE, $this->pathRefDirectory . SEPARATOR . $elements['REFERENCE_LIBELLE']);
                    echo "success";
                }
            } else {
                echo "error";
            }

        }
    }

    public function delete($id)
    {
        $reference = $this->referenceModel->getElementById($this->tables, $this->key, $id);
        $this->referenceModel->deleteElement($this->tables, $this->key, $id);
        $msgFlash = $this->lang->line('label_references_delete');
        deleteDirectory($this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE);
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/references'));
    }


    public function verifIfReferencesExist($references, $name)
    {
        $trouve = false;
        if (sizeof($references) > 0) {
            foreach ($references as $reference) {
                if (html_entity_decode($reference->REFERENCE_LIBELLE) == html_entity_decode($name)) {
                    $trouve = true;
                    return $trouve;
                }
            }
            return $trouve;
        }
        return $trouve;
    }

}