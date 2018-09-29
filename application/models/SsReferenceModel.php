<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 16/04/2018
 * Time: 17:32
 */
class SsReferenceModel extends SCRIB_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $table
     * @param $primary_key
     * @param null $status
     * @param null $order_by
     * @return null
     */
    public function getAllElements($table, $primary_key, $status = null, $order_by = null)
    {
        try {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('L_REFERENCE', 'L_REFERENCE.REFERENCE_ID = '.$table.'.REFERENCE_ID', 'LEFT');
            if(isset($status))
                $this->db->where($status, true);
            if(isset($order_by) && !empty($order_by)) {
                $this->db->order_by($order_by, 'ASC ');
            } else {
                $this->db->order_by($primary_key, 'ASC ');
            }
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getSousReferenceByIdReference ($table, $referenceID = null) {
        try {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where('SS_REFERENCE_STATUS', true);
            if(isset($referenceID))
                $this->db->where("REFERENCE_ID", $referenceID);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            return null;
        }
    }
}