<?php

/**
 * Created by PhpStorm.
 * User: HR49EA7N
 * Date: 19/03/2018
 * Time: 16:40
 */
class Lots extends SCRIB_Controller
{

    var $tables = 'L_LOTS';
    var $key = 'LOT_ID';
    var $tables_perimeter = 'L_PERIMETER';
    var $key_perimeter = 'PER_ID';

    public function __construct()
    {
        parent::__construct();
        $this->load->model('lotsModel');
        $this->load->model('perimetersModel');
    }

    public function index()
    {
        $param['lots'] = $this->lotsModel->getAllElements($this->tables, $this->key, 'LOT_STATUS', 'LOT_PER_ID');
        $param['perimeters_array'] = $this->formatPerimeter($this->perimetersModel->getAllElements($this->tables_perimeter, $this->key_perimeter, 'PER_STATUS'));
        $param['perimeters_json'] = $this->formatPerimeterToJson($this->perimetersModel->getAllElements($this->tables_perimeter, $this->key_perimeter, 'PER_STATUS'));
        $param ['content'] = 'pages/connaisseur/lots/vw_index';
        $this->load->view('template', $param);
    }

    public function add()
    {
        $perimeter = secureFields('lot-perimeter');
        $name = secureFields('lot-nom');
        $description = secureFields('lot-desc');
        if (isset($name) && !empty($name)) {
            $elements = array(
                'LOT_PER_ID' => $perimeter,
                'LOT_LIBELLE' => $name,
                'LOT_DESCRIPTION' => $description
            );
            $this->lotsModel->insertOrUpdateElement($this->tables, $this->key, $elements);
            $msgFlash = $this->lang->line('label_lots_save');
            $this->session->set_flashdata('success', $msgFlash);
        } else {
            $msgFlash = $this->lang->line('label_lots_error');
            $this->session->set_flashdata('error', $msgFlash);
        }

        redirect(base_url('connaisseur/lots'));
    }

    public function delete($id)
    {
        $this->lotsModel->deleteElement($this->tables, $this->key, $id);
        $msgFlash = $this->lang->line('label_lots_delete');
        $this->session->set_flashdata('success', $msgFlash);
        redirect(base_url('connaisseur/lots'));
    }

    public function update($id)
    {
        $value = $this->input->post('value');
        $pk = $this->input->post('pk');
        $elements = array($pk => $value);
        if (empty($value) && $pk == 'LOT_LIBELLE') {
            echo 1;
        } else $this->lotsModel->insertOrUpdateElement($this->tables, $this->key, $elements, $id);
    }

    public function getLotByPerimeterId()
    {
        $perimeter_id = $this->input->post('perimeter_id');
        $arrayLots = array();
        if(sizeof($perimeter_id) > 0) {
            for ($i = 0; $i < sizeof($perimeter_id); $i++) {
                $lots = $this->lotsModel->getLotByPerimeterId($perimeter_id[$i]);
                array_push($arrayLots, $lots);
            }
        }
        $oneDimensionalLotsArray = call_user_func_array('array_merge', $arrayLots);
        echo json_encode($oneDimensionalLotsArray);
    }

    public function formatPerimeter($perimeters)
    {
        $arrayTypePerimeters = [];
        $array['0'] = $this->lang->line('label_lots_perimeter_select');
        foreach ($perimeters as $perimeter) {
            $array[$perimeter->PER_ID] = $perimeter->PER_LIBELLE;
        }
        array_push($arrayTypePerimeters, $array);
        return $arrayTypePerimeters;
    }

    public function formatPerimeterToJson($perimeters)
    {
        $arrayTypePerimeters = [];
        foreach ($perimeters as $perimeter) {
            $array['value'] = $perimeter->PER_ID;
            $array['text'] = html_entity_decode($perimeter->PER_LIBELLE);
            array_push($arrayTypePerimeters, $array);
        }
        return json_encode($arrayTypePerimeters);
    }
}