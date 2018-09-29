<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 17/09/2018
 * Time: 16:29
 */
class SousReferences extends SCRIB_Controller
{
    var $tables = 'L_SS_REFERENCE';
    var $key = 'SS_REFERENCE_ID';

    var $tables_reference = 'L_REFERENCE';
    var $key_reference = 'REFERENCE_ID';

    var $pathRefDirectory = ASSETSPATH . REFERENCE_FOLDER;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('ssReferenceModel');
        $this->load->model('referenceModel');
    }

    public function index()
    {
        $param['references_array'] = $this->formatReference($this->referenceModel->getAllElements($this->tables_reference, $this->key_reference, 'REFERENCE_STATUS'));
        $param['references_json'] = $this->formatReferenceToJson($this->referenceModel->getAllElements($this->tables_reference, $this->key_reference, 'REFERENCE_STATUS'));
        $param['ssReferences'] = $this->ssReferenceModel->getAllElements($this->tables, $this->key, 'SS_REFERENCE_STATUS');
        $param ['content'] = 'pages/connaisseur/sousReferences/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $referencePost = secureFields('reference-name');
        $name = secureFields('ss-reference-name');
        if (isset($name) && !empty($name)) {
            $elements = array(
                'REFERENCE_ID' => $referencePost,
                'SS_REFERENCE_LIBELLE' => convert_accented_characters(html_entity_decode($name)),
            );
            //Verifier si le dossier existe dans la base
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $referencePost);
            $ss_references = $this->ssReferenceModel->getAllElements($this->tables, $this->key);

            if (!$this->verifIfSSReferencesExist($ss_references, $name, $referencePost)) {
                $this->ssReferenceModel->insertOrUpdateElement($this->tables, $this->key, $elements);
                $name_decode = convert_accented_characters(html_entity_decode($name));
                mkdir($this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $name_decode, 0700);
                $msgFlash = $this->lang->line('label_ss_references_save');
                $this->session->set_flashdata('success', $msgFlash);
            } else {
                $msgFlash = $this->lang->line('label_ss_references_exist');
                $this->session->set_flashdata('error', $msgFlash);
            }
        } else {
            $msgFlash = $this->lang->line('label_ss_references_error');
            $this->session->set_flashdata('error', $msgFlash);
        }
        redirect(base_url('connaisseur/sousReferences'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && $pk == 'SS_REFERENCE_LIBELLE') {
            echo 1;
        } else {
            $ss_reference = $this->ssReferenceModel->getElementById($this->tables, $this->key, $id);
            $ss_references = $this->ssReferenceModel->getAllElements($this->tables, $this->key);
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $ss_reference->REFERENCE_ID);
            if (!$this->verifIfSSReferencesExist($ss_references, $elements['SS_REFERENCE_LIBELLE'], $reference->REFERENCE_ID)) {
                if (isset($elements['SS_REFERENCE_LIBELLE']) && !empty($elements['SS_REFERENCE_LIBELLE'])) {
                    $this->ssReferenceModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
                    rename($this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR .$ss_reference->SS_REFERENCE_LIBELLE, $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR. $elements['SS_REFERENCE_LIBELLE']);
                }
            } else {
                echo "error";
            }

        }
    }

    public function delete($id)
    {
        $ss_reference = $this->ssReferenceModel->getElementById($this->tables, $this->key, $id);
        $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $ss_reference->REFERENCE_ID);
        $this->ssReferenceModel->deleteElement($this->tables, $this->key, $id);
        $msgFlash = $this->lang->line('label_ss_references_delete');
        deleteDirectory($this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR .$ss_reference->SS_REFERENCE_LIBELLE);
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/sousReferences'));
    }

    public function verifIfSSReferencesExist($ssReferences, $name, $idReference)
    {
        $trouve = false;
        if (sizeof($ssReferences) > 0) {
            foreach ($ssReferences as $ssReference) {
                if ((html_entity_decode($ssReference->SS_REFERENCE_LIBELLE) == html_entity_decode($name)) && $idReference == $ssReference->REFERENCE_ID) {
                    $trouve = true;
                    return $trouve;
                }
            }
            return $trouve;
        }
        return $trouve;
    }

    function getSousReferenceByIdReference() {
        $referenceID = $this->input->post('referenceID');
        if(isset($referenceID) && !empty($referenceID)) {
            $ss_reference = $this->ssReferenceModel->getSousReferenceByIdReference($this->tables, $referenceID);
            echo json_encode($ss_reference);
        } else {
            echo "empty";
        }

    }

    public function formatReference($references)
    {
        $arrayReferences = [];
        $array['0'] = $this->lang->line('label_references_select');
        foreach ($references as $reference) {
            $array[$reference->REFERENCE_ID] = $reference->REFERENCE_LIBELLE;
        }
        array_push($arrayReferences, $array);
        return $arrayReferences;
    }

    public function formatReferenceToJson($references)
    {
        $arrayReferences = [];
        foreach ($references as $reference) {
            $array['value'] = $reference->REFERENCE_ID;
            $array['text'] = html_entity_decode($reference->REFERENCE_LIBELLE);
            array_push($arrayReferences, $array);
        }
        return json_encode($arrayReferences);
    }

}