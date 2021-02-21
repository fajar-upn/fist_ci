<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mworksem_participant extends CI_Model {

	/**
	 * mendapatkan seluruh data participant berdasarkan id
	 * @param $id
	 * @return mixed
	 */
	public function get_participant($id) {
        $participant = $this->db->get_where('fis_dworkshopseminar_participants', array('wspart_id' => $id));
        return $participant->row();
    }


	/**
	 * mendapatkan seluruh data participant berdasarkan id seminar workshop
	 * @param $ws_id
	 * @return mixed
	 */
	public function get_participants($ws_id) {
		$this->db->select(
			'wspart_id, wspart_name, 
			 wspart_paid_status, 
			 wspart_pay_date,
			 wspart_receipt_number, 
			 wspart_attendance'
		);
		$this->db->from('fis_dworkshopseminar_participants fdp');
		$this->db->join('fis_dworkshopseminar_registration_answers fdra', 'fdp.wspart_id = fdra.wsrans_wspart_fk');
		$this->db->join('fis_dworkshopseminar_registration_questions fdrq', 'fdra.wsrans_wsrque_fk = fdrq.wsrque_id');
		$this->db->join('fis_dworkshopseminars fd', 'fdrq.wsrque_ws_fk = fd.ws_id');
		$this->db->where('ws_id', $ws_id);
		$this->db->group_by('wspart_name');
		$participants = $this->db->get();
		return $participants->result();
	}


	/**
	 * menambahkan data participant baru ke tabel fis_dworkshopseminar_participants
	 * @param $data
	 * @return mixed
	 */
	public function insert($data) {
		$this->db->insert('fis_dworkshopseminar_participants', $data);
		$id = $this->db->insert_id();
		return $id;
	}


	/**
	 * memperbarui data participant pada tabel fis_dworkshopseminar_participant
	 * @param $data
	 * @param $id
	 * @return bool
	 */
	public function update($data, $id) {
    	$this->db->where('wspart_id', $id);
		if ($this->db->update('fis_dworkshopseminar_participants', $data)) {
			return true;
		} else {
			return false;
		}

    }
}
?>
