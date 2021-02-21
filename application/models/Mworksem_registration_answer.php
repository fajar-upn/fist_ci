<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mworksem_registration_answer extends CI_Model {

	/**
	 * menambahkan data jawaban dari pertanyaan ke tabel fis_dworkshopseminar_registration_answers
	 * @param $data
	 * @return mixed
	 */
	public function insert($data) {
		$this->db->insert('fis_dworkshopseminar_registration_answers', $data);
		$id = $this->db->insert_id();
		return $id;
	}
}
?>
