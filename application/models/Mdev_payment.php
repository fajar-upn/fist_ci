<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mdev_payment extends CI_Model {
    
    public function get_all() {
        $this->db->select('*');
        $this->db->from('fis_ddevelop_payments p');
        $this->db->join('fis_ddevelop_contracts c','c.dcontr_id=p.dpymt_dcontr_fk');
        $this->db->join('fis_ddevelop_files f','c.dcontr_files_fk=f.dfiles_id');
		$query = $this->db->get();
		return $query->result();
    }
    
    public function get_by_id($id) {
        $this->db->select('*');
        $this->db->where('dpymt_id',$id);
        $this->db->from('fis_ddevelop_payments');
		$query = $this->db->get();
        return $query->row();
    }
    
    function getAllDataContract(){
        $this->db->select('*');
        $this->db->from('fis_ddevelop_contracts c');
        $this->db->join('fis_duser_accounts acc','acc.uacc_id=c.dcontr_uacc_fk');
        $query=$this->db->get();
        return $query->result();
    }
    
    function insertPayment($data){
		return $this->db->insert('fis_ddevelop_payments', $data);
	}

	function updatePayment($data, $id){
		return $this->db->update('fis_ddevelop_payments', $data, array('dpymt_id' => $id));
	}

	function deletePayment($id){
		return $this->db->delete('fis_ddevelop_payments', array('dpymt_id' => $id));
	}

    public function get_develop_files()
    {
        $this->db->select('*');
        $this->db->from('fis_ddevelop_payments');
        $this->db->join('fis_ddevelop_contracts', 'fis_ddevelop_contracts.dcontr_id = fis_ddevelop_payments.dpymt_dcontr_fk', 'left');
        $this->db->join('fis_ddevelop_files', 'fis_ddevelop_files.dfiles_id = fis_ddevelop_contracts.dcontr_files_fk', 'left');
        $query = $this->db->get();
        return $query->row();
    }
}

?>