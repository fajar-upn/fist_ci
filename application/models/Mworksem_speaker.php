<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mworksem_speaker extends CI_Model {

	/**
	 * mendapatkan data pembicara berdasarkan id seminar workshop
	 * @param $ws_id
	 * @return mixed
	 */
	public function get_by_ws_id($ws_id) {
		$speaker = $this->db->get_where('fis_dworkshopseminar_speakers', array('wsspeaker_ws_fk' => $ws_id));
		return $speaker->row();
	}


	/**
	 * menambahkan data ke tabel fis_dworkshopseminar_speakers
	 * @param $data
	 * @return mixed
	 */
	public function insert($data) {
		$this->db->insert('fis_dworkshopseminar_speakers', $data);
		$id = $this->db->insert_id();
		return $id;
	}


	/**
	 * memperbarui data pembicara yang terdapat pada tabel fis_dworkshopseminar_speakers
	 * @param $data
	 * @param $speaker_id
	 * @return bool
	 */
	public function update($data, $speaker_id) {
		$this->db->where('wsspeaker_id', $speaker_id);
		if ($this->db->update('fis_dworkshopseminar_speakers', $data)) {
			return true;
		} else {
			return false;
		}
	}
}
?>
