<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mworksem_registration_question extends CI_Model {


	/**
	 * mendapatkan seluruh pertanyaan berdasarkan id workshop pada tabel fis_dworkshopseminar_registration_question
	 * @param $ws_id
	 * @return mixed
	 */
	public function get_by_ws_id($ws_id) {
		$this->db->from('fis_dworkshopseminar_registration_questions');
		$this->db->where('wsrque_ws_fk', $ws_id);
		$this->db->order_by('wsrque_page ASC');
		$question = $this->db->get();
//		$question = $this->db->get_where('fis_dworkshopseminar_registration_questions', array('wsrque_ws_fk' => $ws_id));
//		$question->order_by('wsrque_page ASC');
		return $question->result();
	}

	public function get_question_type($question_id) {
		$this->db->select('wsrque_type');
		$this->db->from('fis_dworkshopseminar_registration_questions');
		$result = $this->db->get();

		return $result->row();
	}

	/**
	 * menambahkan data ke tabel fis_dworkshopseminar_registration_question
	 * @param $data
	 * @return mixed
	 */
	public function insert($data) {
		$this->db->insert('fis_dworkshopseminar_registration_questions', $data);
		$id = $this->db->insert_id();
		return $id;
	}


	/**
	 * memperbarudi data pertanyaan pada tabel fis_dworkshopseminar_registration_question berdasarkan id
	 * @param $data
	 * @param $question_id
	 * @return bool
	 */
	public function update($data, $question_id) {
		$this->db->where('wsrque_id', $question_id);
		if ($this->db->update('fis_dworkshopseminar_registration_questions', $data)) {
			return true;
		} else {
			return false;
		}
	}


	/**
	 * menghapus pertanyaan pada tabel fis_dworkshop_registration_question berdasarkan id
	 * @param $id_question
	 * @return bool
	 */
	public function delete($id_question) {
		if ($this->db->delete('fis_dworkshopseminar_registration_questions', array('wsrque_id' => $id_question))) {
			return true;
		} else {
			return false;
		}
	}
}
?>
