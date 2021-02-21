<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mconsult_payment extends CI_Model {

	public function get_all() {
		$query = $this->db->get('fis_vconsult_payments');
		return $query->result();
	}

	public function get_by_id($id) {
		$query = $this->db->get_where('fis_vconsult_payments', array('payment_id' => $id), 1);
        return $query->row();
	}

	public function insert($data) {
		if ($result = $this->db->insert('fis_dservice_consult_payments', $data)) {
			$this->session->set_userdata('typeNotif', 'successAddData');
		} else {
			$this->session->set_userdata('typeNotif', 'errorAddData');
		}
		return $result;
	}

	public function update($data, $id) {
		if ($result = $this->db->update('fis_dservice_consult_payments', $data, array('scpymt_id' => $id))) {
			$this->session->set_userdata('typeNotif', 'successEditData');
		 } else {
		 	$this->session->set_userdata('typeNotif', 'errorEditData');
		 }
		 return $result;
	}

	public function delete($id) {
		return $this->db->delete('fis_dservice_consult_payments', array('scpymt_id' => $id));
	}
}

/* End of file Mconsult_payment.php */
/* Location: ./application/models/Mconsult_payment.php */