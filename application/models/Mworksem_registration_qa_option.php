<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mworksem_registration_qa_option extends CI_Model {

	public function get_by_question_id($question_id) {
		$option = $this->db->get_where('fis_dworkshopseminar_registration_selections', array('wsrselect_wsrque_fk' => $question_id));
		return $option->result();
	}

	/**
	 * menambahkan data pilihan jawaban pada tabel fis_dworkshopseminar_registration_selections
	 * @param $data
	 * @return mixed
	 */
	public function insert($data) {
		$this->db->insert('fis_dworkshopseminar_registration_selections', $data);
		$id = $this->db->insert_id();
		return $id;
	}


	/**
	 * memperbarui data pilihan jawaban pada tabel fis_dworkshopseminar_registration_selections
	 * @param $data
	 * @param $option_id
	 * @return bool
	 */
	public function update($data, $option_id) {
		$this->db->where('wsrselect_id', $option_id);
		if ($this->db->update('fis_dworkshopseminar_registration_selections', $data)) {
			return true;
		} else {
			return false;
		}
	}


	/**
	 * menghapus opsi jawaban yang berada pada tabel fis_dworkshopseminar_registration_selections berdasarkan id
	 * @param $id_question
	 * @return bool
	 */
	public function delete_by_question_id($id_question) {
		if ($this->db->delete('fis_dworkshopseminar_registration_selections', array('wsrselect_wsrque_fk' => $id_question))) {
			return true;
		} else {
			return false;
		}
	}
}
?>
