<?php
/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 30/05/2018
 * Time: 15:51
 */
class MatricesModel extends SCRIB_Model
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
            $this->db->join('L_SS_REFERENCE', 'L_SS_REFERENCE.SS_REFERENCE_ID = '.$table.'.SS_REFERENCE_ID', 'LEFT');
            if(isset($status))
                $this->db->where($status, true);
            if(isset($order_by) && !empty($order_by)) {
                $this->db->order_by($order_by, 'ASC ');
            } else {
                $this->db->order_by($primary_key, 'DESC ');
            }
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            return null;
        }
    }

    /**
     * @param $table
     * @param $primary_key
     * @param $id
     * @return null
     */
    public function getElementById($table, $primary_key, $id)
    {
        try {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->join('L_REFERENCE', 'L_REFERENCE.REFERENCE_ID = '.$table.'.REFERENCE_ID', 'LEFT');
            $this->db->join('L_SS_REFERENCE', 'L_SS_REFERENCE.SS_REFERENCE_ID = '.$table.'.SS_REFERENCE_ID', 'LEFT');
            $this->db->where($primary_key, $id);
            $query = $this->db->get();
            return $query->row();
        } catch (Exception $e) {
            return null;
        }
    }
}