<?php

/**
 * Created by PhpStorm.
 * User: hr49ea7n
 * Date: 27/03/2018
 * Time: 16:38
 */
class DocumentModel extends SCRIB_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $user
     * @return null
     */
    public function getAllDocumentByUser($user)
    {
        try {
            $this->db->select('*');
            $this->db->from('DOCUMENT');
            $this->db->join('L_ETAT', 'L_ETAT.ETAT_ID = DOCUMENT.DOC_ETAT_ID', 'LEFT');
            $this->db->where('DOC_USER_NNI', $user);
            $this->db->where('DOC_STATUS', true);
            $this->db->order_by('DOC_NUMERO', 'ASC ');
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            return null;
        }
    }

    public function getDocumentLastRow($user)
    {
        try {
            $this->db->select('*');
            $this->db->from('DOCUMENT');
            $this->db->where('DOC_USER_NNI', $user);
            $this->db->order_by('DOC_ID', 'DESC ');
            $this->db->limit(1);
            $query = $this->db->get();
            return $query->result();
        } catch (Exception $e) {
            return null;
        }
    }
}