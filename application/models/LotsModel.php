<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 16/04/2018
 * Time: 17:32
 */
class LotsModel extends SCRIB_Model
{
    var $tables_lots = 'L_LOTS';

    public function __construct()
    {
        parent::__construct();
    }

    public function getLotByPerimeterId($perimeterId)
    {
        try {
            $this->db->select('*');
            $this->db->from($this->tables_lots);
            $this->db->where('LOT_PER_ID', $perimeterId);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            return null;
        }
    }
}