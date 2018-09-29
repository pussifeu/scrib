<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 30/05/2018
 * Time: 15:49
 */
class Matrices extends SCRIB_Controller
{
    var $tables = 'MATRICES';
    var $key = 'MATRICES_ID';

    var $tables_perimeters = 'L_PERIMETER';
    var $key_perimeters = 'PER_ID';

    var $tables_lots = 'L_LOTS';
    var $key_lots = 'LOT_ID';

    var $tables_reference = 'L_REFERENCE';
    var $key_reference = 'REFERENCE_ID';

    var $tables_ss_reference = 'L_SS_REFERENCE';
    var $key_ss_reference = 'SS_REFERENCE_ID';

    var $pathRefDirectory = ASSETSPATH . REFERENCE_FOLDER;

    public function __construct()
    {
        parent::__construct();
        $this->load->model('perimetersModel');
        $this->load->model('lotsModel');
        $this->load->model('matricesModel');
        $this->load->model('referenceModel');
        $this->load->model('ssReferenceModel');
        $this->load->library('breadcrumbs');
        $this->load->library('FileLib');
    }

    public function index()
    {
        $param['matrices'] = $this->matricesModel->getAllElements($this->tables, $this->key, 'MATRICES_STATUS');
        $param['references_array'] = $this->formatReference($this->referenceModel->getAllElements($this->tables_reference, $this->key_reference, 'REFERENCE_STATUS'));
        $param['content'] = 'pages/connaisseur/matrices/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $reference_id = $this->input->post('REFERENCE_ID');
        $ss_reference_id = $this->input->post('SS_REFERENCE_ID');

        $name = $this->input->post('MATRICES_NAME');
        $doc_ref = $this->input->post('MATRICES_DOC_REF');
        $version = $this->input->post('MATRICES_VERSION');
        $resume = $this->input->post('MATRICES_RESUME');
        $matrix_init = $this->input->post('MATRICES_INIT');
        $creation_type = $this->input->post('MATRICES_CREATION_TYPE');

        if (isset($creation_type) && !empty($creation_type)) {
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $reference_id);
            $ss_reference = $this->ssReferenceModel->getElementById($this->tables_ss_reference, $this->key_ss_reference, $ss_reference_id);
            $matrixLocation = $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $ss_reference->SS_REFERENCE_LIBELLE;
            if ($creation_type == "1") {
                if (isset($matrix_init) && !empty($matrix_init)) {
                    $this->filelib->upload($matrixLocation);
                    $this->excel_reader->read($matrixLocation . SEPARATOR . $matrix_init);
                    $worksheet = $this->excel_reader->sheets[0];
                    if (isset($worksheet["cells"])) {
                        $elements = array(
                            "REFERENCE_ID" => $reference_id,
                            "SS_REFERENCE_ID" => $ss_reference_id,
                            "MATRICES_INIT" => $matrix_init,
                            "MATRICES_NAME" => $worksheet["cells"][1][1],
                            "MATRICES_DOC_REF" => $worksheet["cells"][3][1],
                            "MATRICES_VERSION" => $worksheet["cells"][5][1],
                            "MATRICES_RESUME" => $worksheet["cells"][7][1]
                        );
                        $id = $this->matricesModel->insertOrUpdateElement($this->tables, $this->key, $elements);
                        //READ EXEL DOCUMENT
                        $this->readAndFormatExcel($worksheet, $id, $matrixLocation);
                        $msgFlash = $this->lang->line('label_matrices_save');
                        $this->session->set_flashdata('success', $msgFlash);
                    } else {
                        $msgFlash = 'Le fichier excel que vous avez uploader n\'est pas bon';
                        $this->session->set_flashdata('error', $msgFlash);
                    }
                } else {
                    $msgFlash = $this->lang->line('label_matrices_error');
                    $this->session->set_flashdata('error', $msgFlash);
                }
            } else {
                if ((isset($name) && !empty($name))
                    && (isset($doc_ref) && !empty($doc_ref))
                    && (isset($version) && !empty($version))
                    && (isset($resume) && !empty($resume))
                    && (isset($reference_id) && !empty($reference_id))
                ) {
                    $elements = array(
                        "REFERENCE_ID" => $reference_id,
                        "SS_REFERENCE_ID" => $ss_reference_id,
                        "MATRICES_NAME" => $name,
                        "MATRICES_DOC_REF" => $doc_ref,
                        "MATRICES_VERSION" => $version,
                        "MATRICES_RESUME" => $resume
                    );
                    $id = $this->matricesModel->insertOrUpdateElement($this->tables, $this->key, $elements);
                    $this->createMatixJSONFile($name, $id, $matrixLocation);
                    $this->filelib->upload($matrixLocation);
                    $msgFlash = $this->lang->line('label_matrices_save');
                    $this->session->set_flashdata('success', $msgFlash);
                } else {
                    $msgFlash = $this->lang->line('label_matrices_error');
                    $this->session->set_flashdata('error', $msgFlash);
                }
            }
        }
        redirect(base_url('connaisseur/matrices'));
    }

    public function createMatixJSONFile($name, $id, $matrixLocation)
    {
        $jsonFilename = $name . '_' . $id . '.json';
        fopen($matrixLocation . SEPARATOR . $jsonFilename, "w");
    }

    public function readAndFormatExcel($worksheet = null, $id, $matrixLocation)
    {
        $this->createMatixJSONFile($worksheet["cells"][1][1], $id, $matrixLocation);
        //FORMAT EXCEL AND WRITE IT TO THE MATRICE.JSON
    }

    public function detail($id)
    {
        if (isset($id) && !empty($id)) {
            $this->breadcrumbs->push('GESTION DE LA MATRICE', 'connaisseur/matrices');
            $this->breadcrumbs->push('DETAIL DE LA MATRICE', 'connaisseur/matrices/detail');
            $lots = $this->lotsModel->getAllElements($this->tables_lots, $this->key_lots, 'LOT_STATUS');
            $perimeters = $this->perimetersModel->getAllElements($this->tables_perimeters, $this->key_perimeters, 'PER_STATUS');
            $matrix = $this->matricesModel->getElementById($this->tables, $this->key, $id);
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $matrix->REFERENCE_ID);
            $ss_reference = $this->ssReferenceModel->getElementById($this->tables_ss_reference, $this->key_ss_reference, $matrix->SS_REFERENCE_ID);

            $matrixLocation = $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $ss_reference->SS_REFERENCE_LIBELLE;
            $jsonFilename = $matrix->MATRICES_NAME . '_' . $matrix->MATRICES_ID . '.json';
            $jsonFilePath = $matrixLocation . SEPARATOR . $jsonFilename;

            $param ['lots'] = json_encode($lots);
            $param ['perimeters'] = json_encode($perimeters);
            $param ['matrice'] = $this->matricesModel->getElementById($this->tables, $this->key, $id);
            $param ['jsonData'] = json_encode(file_get_contents($jsonFilePath), true);
            $param ['fileIsEmpty'] = empty(json_decode($param ['jsonData'], true)) || json_decode($param ['jsonData'], true) == 'null';

            $param ['breadcrumbs'] = $this->breadcrumbs->show();
            $param ['content'] = 'pages/connaisseur/matrices/vw_matrices_detail';
            $this->load->view('template', $param);
        } else {
            redirect(base_url('connaisseur/matrices'));
        }
    }

    public function delete($id)
    {
        if (isset($id) && !empty($id)) {
            $matrix = $this->matricesModel->getElementById($this->tables, $this->key, $id);
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $matrix->REFERENCE_ID);
            $ss_reference = $this->ssReferenceModel->getElementById($this->tables_ss_reference, $this->key_ss_reference, $matrix->SS_REFERENCE_ID);

            $this->matricesModel->deleteElement($this->tables, $this->key, $id);
            $matrixLocation = $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $ss_reference->SS_REFERENCE_LIBELLE;
            $jsonFilename = $matrix->MATRICES_NAME . '_' . $matrix->MATRICES_ID . '.json';
            unlink($matrixLocation . SEPARATOR . $jsonFilename);
            $msgFlash = $this->lang->line('label_matrices_delete');
            $this->session->set_flashdata('success', $msgFlash);
            redirect(base_url('connaisseur/matrices'));
        } else {
            redirect(base_url('connaisseur/matrices'));
        }
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && (($pk == 'MATRICES_NAME') || ($pk == 'MATRICES_DOC_REF') || ($pk == 'MATRICES_VERSION') || ($pk == 'MATRICES_RESUME'))) {
            echo 1;
        } else {
            $matrix = $this->matricesModel->getElementById($this->tables, $this->key, $id);
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $matrix->REFERENCE_ID);
            $ss_reference = $this->ssReferenceModel->getElementById($this->tables_ss_reference, $this->key_ss_reference, $matrix->SS_REFERENCE_ID);
            $matrixLocation = $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $ss_reference->SS_REFERENCE_LIBELLE;

            $jsonFilename = $matrix->MATRICES_NAME . '_' . $matrix->MATRICES_ID . '.json';
            $jsonFilePath = $matrixLocation . SEPARATOR . $jsonFilename;
            $this->matricesModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
            if (isset($elements['MATRICES_NAME']) && !empty($elements['MATRICES_NAME']))
                rename($jsonFilePath, $matrixLocation . SEPARATOR . $elements['MATRICES_NAME'] . "_" . $matrix->MATRICES_ID . ".json");
        }

    }

    public function createObjectPerimeters($array)
    {
        $object = new stdClass();
        $arrayReturn = [];
        if (sizeof($array) > 0) {
            foreach ($array as $key => $value) {
                $object->id = $value->PER_ID;
                $object->libelle = $value->PER_LIBELLE;
                array_push($arrayReturn, $object);
            }
        }
        return $arrayReturn;
    }

    public function createObjectLots($array)
    {
        $object = new stdClass();
        $arrayReturn = [];
        if (sizeof($array) > 0) {
            foreach ($array as $key => $value) {
                $object->id = $value->LOT_ID;
                $object->libelle = $value->LOT_LIBELLE;
                array_push($arrayReturn, $object);
            }
        }
        return $arrayReturn;
    }


    public function getJSONData()
    {
        $id = $this->input->post('idMatrice');
        if (isset($id) && !empty($id)) {
            $matrix = $this->matricesModel->getElementById($this->tables, $this->key, $id);
            $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $matrix->REFERENCE_ID);
            $ss_reference = $this->ssReferenceModel->getElementById($this->tables_ss_reference, $this->key_ss_reference, $matrix->SS_REFERENCE_ID);

            $matrixLocation = $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $ss_reference->SS_REFERENCE_LIBELLE;
            $jsonFilename = $matrix->MATRICES_NAME . '_' . $matrix->MATRICES_ID . '.json';
            $jsonFilePath = $matrixLocation . SEPARATOR . $jsonFilename;
            $jsonData = file_get_contents($jsonFilePath);
            echo $jsonData;
        } else
            echo 0;
    }

    public function saveMatrixJsonFile()
    {
        $data = $this->input->post('formData');
        $id = $this->input->post('matrice_id');

        $matrix = $this->matricesModel->getElementById($this->tables, $this->key, $id);
        $reference = $this->referenceModel->getElementById($this->tables_reference, $this->key_reference, $matrix->REFERENCE_ID);
        $ss_reference = $this->ssReferenceModel->getElementById($this->tables_ss_reference, $this->key_ss_reference, $matrix->SS_REFERENCE_ID);

        $matrixLocation = $this->pathRefDirectory . SEPARATOR . $reference->REFERENCE_LIBELLE . SEPARATOR . $ss_reference->SS_REFERENCE_LIBELLE;
        $jsonFilename = $matrix->MATRICES_NAME . '_' . $matrix->MATRICES_ID . '.json';
        $jsonFilePath = $matrixLocation . SEPARATOR . $jsonFilename;

        if (file_exists($jsonFilePath)) {
            $fp = fopen($jsonFilePath, 'w');
            fwrite($fp, json_pretty($data));
            fclose($fp);
        } else {
            file_put_contents($jsonFilePath, json_pretty($data), FILE_APPEND | LOCK_EX);
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
}