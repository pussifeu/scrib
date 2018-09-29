<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class SCRIB_Model extends CI_Model
{

    public function insertOrUpdateElement($table, $primary_key, $elements, $id = null)
    {
        try {
            if (!isset($id) || empty($id)) {
                $this->db->insert($table, $elements);
                $insert_id = $this->db->insert_id();
                return $insert_id;
            } else {
                $this->db->where($primary_key, $id);
                $this->db->update($table, $elements);
                return $id;
            }
        } catch (Exception $e) {
            return false;
        }
    }

    public function getElementById($table, $primary_key, $id)
    {
        try {
            $this->db->select('*');
            $this->db->from($table);
            $this->db->where($primary_key, $id);
            $query = $this->db->get();
            return $query->row();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getAllElements($table, $primary_key, $status = null, $order_by = null)
    {
        try {
            $this->db->select('*');
            $this->db->from($table);
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

    public function deleteElement($table, $primary_key, $id)
    {
        $this->db->where($primary_key, $id);
        $this->db->delete($table);
    }
}