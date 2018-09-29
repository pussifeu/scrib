<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Redacteur extends SCRIB_Controller
{
    private $nni;
    var $tables = 'L_PERIMETER';
    var $key = 'PER_ID';

    public function __construct()
    {
        parent::__construct();
        $this->nni = $this->session->userdata()['USER']['nni'];
        $this->load->library('phpword');
        $this->load->helper('download');
        $this->load->model('perimetersModel');
    }

    /**
     * Call view to list all document
     */
    public function index()
    {
        $pathRefDirectory = ASSETSPATH . REFERENCE_FOLDER;
        if (isset($this->nni) && !empty($this->nni))
            $param ['documents'] = $this->documentModel->getAllDocumentByUser($this->nni);
        else
            $param ['documents'] = array();
        $param ['pathRefDirectory'] = $pathRefDirectory;
        $param ['refDirectories'] = getDirectoryContent($pathRefDirectory);
        $param ['perimeters'] = $this->perimetersModel->getAllElements($this->tables, $this->key, 'PER_STATUS');
        $param ['content'] = 'pages/redacteur/vw_index';
        $this->load->view('template', $param);
    }

    /**
     * Call view to add document
     */
    public function addDocument()
    {
        $ref_selected = explode("$", $this->input->post('value-doc-ref-selected'))[0];
        $ref_dir_selected = explode("$", $this->input->post('value-doc-ref-selected'))[1];
        $ref_doc_selected = '';
        $perim_selected = $this->input->post('choice-per-type');
        $btn_submit_per = $this->input->post('btn-valid-per-button');

        if (isset($this->session->userdata()['REFSELETED']) && isset($this->session->userdata()['PERIMSELETED']) && (!isset($btn_submit_per) || empty($btn_submit_per))) {
            $param ['content'] = 'pages/redacteur/form/vw_document_add';
            $this->load->view('template', $param);
        } else {
            if (isset($ref_selected) && !empty($ref_selected)) {
                $this->clearSession();
                if (strtolower($ref_selected) == "complet" || strtolower($ref_selected) == "complexe") {
                    if (isset($perim_selected) && !empty($perim_selected)) {
                        $this->setSession($ref_selected, $perim_selected, $ref_dir_selected, $ref_doc_selected);
                        $param ['content'] = 'pages/redacteur/form/vw_document_add';
                        $this->load->view('template', $param);
                    }
                } else {
                    $this->setSession($ref_selected, $perim_selected, $ref_dir_selected, $ref_doc_selected);
                    $param ['content'] = 'pages/redacteur/form/vw_document_add';
                    $this->load->view('template', $param);
                }
            } else {
                $msgFlash = $this->lang->line('label_alert_error_verification');
                $this->session->set_flashdata('error', $msgFlash);
                redirect(base_url('redacteur'));
            }
        }

    }


    /**
     * Call view to edit document
     */
    public function editDocument($documentId = null, $version = null)
    {
        $document = $this->documentModel->getElementById('DOCUMENT', 'DOC_ID', $documentId);
        //Lire json file et put in the vw
        if (isset($documentId) && !empty($documentId) && isset($version) && !empty($version) && $document->DOC_STATUS == 't') {
            $jsonFolder = ASSETSPATH . SEPARATOR . JSON_FOLDER;
            $jsonFilename = WORKSPACE_DOCUMENT . $version . '.json';
            $filePath = $jsonFolder . SEPARATOR . $documentId . SEPARATOR . $jsonFilename;
            $param ['datas'] = json_decode(file_get_contents($filePath), true);
            $param ['content'] = 'pages/redacteur/form/vw_document_edit';
            $this->load->view('template', $param);
        } else {
            $msgFlash = $this->lang->line('label_alert_error_verification');
            $this->session->set_flashdata('error', $msgFlash);
            redirect(base_url('redacteur'));
        }
    }


    /**
     * Action to save or generate final document
     */
    public function createDocumentAction()
    {
        $document = $this->documentModel->getDocumentLastRow($this->nni);
        if (sizeof($document) == 0) {
            $documentNumber = 1;
        } else {
            $documentNumber = (int)$document[0]->DOC_NUMERO + 1;
        }
        $documentName = secureFields('document-name');
        $state = secureFields('document-state');
        $documentId = "";
        if (isset($state) && !empty($state)) {
            if ($state == ENCOURS) {
                if (isset($this->nni) && !empty($this->nni)) {
                    $elements = array(
                        'DOC_NOM_DONNEE' => $documentName,
                        'DOC_USER_NNI' => $this->nni,
                        'DOC_ETAT_ID' => $state,
                        'DOC_NOM_ORIGINAL' => 'scrib_doc',
                        'DOC_NUMERO' => $documentNumber,
                        'DOC_VERSION' => 1,
                        'DOC_STATUS' => true
                    );
                    $documentId = $this->documentModel->insertOrUpdateElement('DOCUMENT', 'DOC_ID', $elements);
                    $msgFlash = $this->lang->line('label_alert_save');
                    $this->session->set_flashdata('success', $msgFlash);
                } else {
                    $msgFlash = $this->lang->line('label_alert_error');
                    $this->session->set_flashdata('error', $msgFlash);
                }
            }

            //Generer le document word avec son nom quan l'utiliisateur clique sur generer le document
            if ($state == TERMINEE) {
                if (isset($this->nni) && !empty($this->nni) && isset($documentName) && !empty($documentName)) {
                    $elements = array(
                        'DOC_NOM_DONNEE' => $documentName,
                        'DOC_USER_NNI' => $this->nni,
                        'DOC_ETAT_ID' => $state,
                        'DOC_NOM_ORIGINAL' => 'scrib_doc',
                        'DOC_NUMERO' => $documentNumber,
                        'DOC_VERSION' => 1,
                        'DOC_STATUS' => true
                    );
                    $documentId = $this->documentModel->insertOrUpdateElement('DOCUMENT', 'DOC_ID', $elements);
                    // $this->printDocument($documentId);
                    $msgFlash = $this->lang->line('label_alert_generate');
                    $this->session->set_flashdata('success', $msgFlash);
                } else {
                    $msgFlash = $this->lang->line('label_alert_error');
                    $this->session->set_flashdata('error', $msgFlash);
                }
            }

            if (!empty($documentId)) {
                $this->generateDataToJSON($documentId, '', 'create');
            }
            redirect(base_url('redacteur'));

        } else {
            $msgFlash = $this->lang->line('label_alert_error');
            $this->session->set_flashdata('error', $msgFlash);
            redirect(base_url('redacteur'));
        }
    }

    /**
     * Action to save or generate final document
     */
    public function editDocumentAction()
    {
        $documentId = secureFields('document-id');
        $documentName = secureFields('document-name');
        $documentVersion = secureFields('document-version');
        $state = secureFields('document-state');
        if (isset($state) && !empty($state)) {
            if ($state == ENCOURS) {
                if (isset($this->nni) && !empty($this->nni)) {
                    $elements = array(
                        'DOC_NOM_DONNEE' => $documentName,
                        'DOC_USER_NNI' => $this->nni,
                        'DOC_ETAT_ID' => $state,
                        'DOC_NOM_ORIGINAL' => 'scrib_doc',
                        'DOC_VERSION' => (int)$documentVersion + 1,
                        'DOC_STATUS' => true
                    );
                    $this->documentModel->insertOrUpdateElement('DOCUMENT', 'DOC_ID', $elements, $documentId);
                    $msgFlash = $this->lang->line('label_alert_save');

                    $this->session->set_flashdata('success', $msgFlash);
                } else {
                    $msgFlash = $this->lang->line('label_alert_error');
                    $this->session->set_flashdata('error', $msgFlash);
                }
            }


            //Generer le document word avec son nom quan l'utiliisateur clique sur generer le document
            if ($state == TERMINEE) {
                if (isset($this->nni) && !empty($this->nni) && isset($documentName) && !empty($documentName)) {
                    $elements = array(
                        'DOC_NOM_DONNEE' => $documentName,
                        'DOC_USER_NNI' => $this->nni,
                        'DOC_ETAT_ID' => $state,
                        'DOC_NOM_ORIGINAL' => 'scrib_doc',
                        'DOC_VERSION' => (int)$documentVersion + 1,
                        'DOC_STATUS' => true
                    );
                    $this->documentModel->insertOrUpdateElement('DOCUMENT', 'DOC_ID', $elements, $documentId);
                    $msgFlash = $this->lang->line('label_alert_generate');
                    $this->session->set_flashdata('success', $msgFlash);
                } else {
                    $msgFlash = $this->lang->line('label_alert_error');
                    $this->session->set_flashdata('error', $msgFlash);
                }
            }
            if (!empty($documentId) && !empty($documentVersion)) {
                $version = (int)$documentVersion + 1;
                $this->generateDataToJSON($documentId, $version, null);
            }
            redirect(base_url('redacteur'));

        } else {
            $msgFlash = $this->lang->line('label_alert_error');
            $this->session->set_flashdata('error', $msgFlash);
            redirect(base_url('redacteur'));
        }

    }

    /**
     * Imprimer le document sous format PDF ou word
     */
    public function printDocument($documentId = null, $print = '')
    {
        //Get data in database
        $document = $this->documentModel->getElementById('DOCUMENT', 'DOC_ID', $documentId);
        $docVersion = $document->DOC_VERSION;
        //$docOutputName = isset($document->DOC_NOM_DONNEE) && !empty($document->DOC_NOM_DONNEE) ? $document->DOC_NOM_DONNEE : $document->DOC_NOM_ORIGINAL;

        ///Lire json file to get data and set value to document
        if (isset($documentId) && !empty($documentId) && isset($docVersion) && !empty($docVersion)) {
            $jsonFolder = ASSETSPATH . SEPARATOR . JSON_FOLDER;
            $jsonFilename = WORKSPACE_DOCUMENT . $docVersion . '.json';
            $jsonFilePath = $jsonFolder . SEPARATOR . $documentId . SEPARATOR . $jsonFilename;
            $jsonData = json_decode(file_get_contents($jsonFilePath), true);
        } else {
            $msgFlash = $this->lang->line('label_alert_error_verification');
            $this->session->set_flashdata('error', $msgFlash);
            redirect(base_url('redacteur'));
        }


        if (sizeof($jsonData['fields']) != 0) {
            $documentReferences = $jsonData['fields']['document-references'];
            if (sizeof($documentReferences) != 0) {
                for ($i = 0; $i < sizeof($documentReferences); $i++) {
                    $docTemplatePath = ASSETSPATH . REFERENCE_FOLDER . SEPARATOR . $jsonData['fields']['document-directory'] . SEPARATOR . $jsonData['fields']['document-type'] . SEPARATOR . $documentReferences[$i];
                    $documentTemplate = new \PhpOffice\PhpWord\TemplateProcessor($docTemplatePath);
                    foreach ($jsonData['fields'] as $key => $value) {
                        if (!is_array($value)) {
                            $documentTemplate->setValue("Scrib#Field#" . $key, $value);
                        }
                    }
                    ///Save data to other document
                    $outputFolder = ASSETSPATH . SEPARATOR . OUTPUT_FOLDER . SEPARATOR . $documentId;
                    if (!file_exists($outputFolder)) {
                        mkdir($outputFolder);
                    }
                    $documentTemplate->saveAs($outputFolder . SEPARATOR . $documentReferences[$i]);
                }
            }
            redirect(base_url('redacteur'));
        } else {
            $msgFlash = $this->lang->line('label_alert_error_verification');
            $this->session->set_flashdata('error', $msgFlash);
            redirect(base_url('redacteur'));
        }
    }

    /**
     * Generer le document de travail sous format json
     * @param $documentId
     * @param null $version
     * @return bool
     */
    public function generateDataToJSON($documentId, $version = null, $action = null)
    {
        if (!isset($version) || empty($version))
            $version = 1;
        try {
            $posts = array();
            $response = array();

            foreach ($_POST as $key => $value) {
                if ($value != 'save')
                    $posts[$key] = $this->input->post($key);
                if ($key == 'document-version') {
                    $posts[$key] = $version;
                }
            }

            if (isset($action) && !empty($action)) {
                $posts ['document-type'] = $this->session->userdata()['REFSELETED'];
                $posts ['document-perimeters'] = $this->session->userdata()['PERIMSELETED'];
                $posts ['document-directory'] = $this->session->userdata()['REF_DIRSELETED'];
                $posts ['document-references'] = $this->session->userdata()['REF_DOCSELETED'];
            }

            $jsonFolder = ASSETSPATH . SEPARATOR . JSON_FOLDER;
            $jsonFilename = WORKSPACE_DOCUMENT . $version . '.json';

            if (!file_exists($jsonFolder)) {
                mkdir($jsonFolder);
            }

            if (!file_exists($jsonFolder . SEPARATOR . $documentId)) {
                mkdir($jsonFolder . SEPARATOR . $documentId);
            }

            $jsonFilePath = $jsonFolder . SEPARATOR . $documentId . SEPARATOR . $jsonFilename;

            $response['fields'] = $posts;
            if (file_exists($jsonFilePath)) {
                $fp = fopen($jsonFilePath, 'w');
                fwrite($fp, json_pretty($response));
                fclose($fp);
            } else {
                file_put_contents($jsonFilePath, json_pretty($response), FILE_APPEND | LOCK_EX);
            }
            $this->clearSession();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Action to cancel document
     */
    public function cancelDocumentAction()
    {
        $documentId = secureFields('id');
        if (isset($documentId) && !empty($documentId)) {
            $elements = array(
                'DOC_STATUS' => false
            );
            $this->documentModel->insertOrUpdateElement('DOCUMENT', 'DOC_ID', $elements, $documentId);
            // Remove folder output and json_data ???????
            $this->removeFolder($documentId);
            echo 1;
        } else {
            echo 0;
        }
    }

    public function removeFolder($documentId)
    {
        $jsonFolder = ASSETSPATH . SEPARATOR . JSON_FOLDER;
        $outputFolder = ASSETSPATH . SEPARATOR . OUTPUT_FOLDER;
        deleteDirectory($jsonFolder . SEPARATOR . $documentId);
        deleteDirectory($outputFolder . SEPARATOR . $documentId);
    }


    public function clearSession()
    {
        $this->session->unset_userdata('REFSELETED');
        $this->session->unset_userdata('REF_DIRSELETED');
        $this->session->unset_userdata('PERIMSELETED');
        $this->session->unset_userdata('REF_DOCSELETED');

    }

    public function setSession($ref_selected, $perim_selected, $ref_dir_selected, $ref_doc_selected)
    {
        $this->session->set_userdata('REFSELETED', $ref_selected);
        $this->session->set_userdata('PERIMSELETED', $perim_selected);
        $this->session->set_userdata('REF_DIRSELETED', $ref_dir_selected);
        $this->session->set_userdata('REF_DOCSELETED', $ref_doc_selected);
    }
}

