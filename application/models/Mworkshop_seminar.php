<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Mworkshop_seminar extends CI_Model
{

	/**
	 * mendapatkan seluruh data workshop seminar dari tabel fis_dworkshopseminars
	 * @return mixed
	 */
	public function get_workshop_seminars()
	{
		$workshop_seminars = $this->db->get('fis_dworkshopseminars');
		return $workshop_seminars->result();
	}

	/**
	 * mendapatkan seluruh data workshop seminar dari tabel fis_dworkshopseminars
	 * @return mixed
	 */
	public function get_workshop_seminars_desc()
	{
		$workshop_seminars = $this->db->query('SELECT *  FROM fis_dworkshopseminars order BY ws_date_start DESC ');
		return $workshop_seminars->result();
	}

	/**
	 * mendapatkan seluruh data workshop dan seminar beserta pembicara dari tabel fis_dworkshopseminars berdasarkan id
	 * @return mixed
	 */
	public function get_worksem_active()
	{
		$query = $this->db->query("SELECT * FROM fis_dworkshopseminars WHERE ws_active = 'Y'");
		return $query->result();
	}

	/**
	 * mendapatkan seluruh data workshop dan seminar beserta pembicara dari tabel fis_dworkshopseminars berdasarkan id
	 * @param $id
	 * @return mixed
	 */
	public function get_with_speaker_by_id($id)
	{
		$this->db->select('*');
		$this->db->from('fis_dworkshopseminars fws');
		$this->db->join('fis_dworkshopseminar_speakers fwss', 'fws.ws_id = fwss.wsspeaker_ws_fk');
		$this->db->where('ws_id', $id);
		$workshop_seminar = $this->db->get();
		return $workshop_seminar->row();
	}


	/**
	 * mendapatkan seluruh dari workshop dan seminar dari tabel fis_dworkshopseminars berdasarkan id
	 * @param $id
	 * @return mixed
	 */
	public function get_ws_by_id($id)
	{
		$workshop_seminar = $this->db->get_where('fis_dworkshopseminars', array('ws_id' => $id));
		return $workshop_seminar->row();
	}


	/**
	 * menambahkan data pada tabel fis_drowkshopseminars
	 * @param $data
	 * @return mixed
	 */
	public function insert($data)
	{
		$this->db->insert('fis_dworkshopseminars', $data);
		$id = $this->db->insert_id();
		$this->session->set_userdata('typeNotif', 'successAddWorkshopSeminar');
		return $id;
	}


	/**
	 * memperbarui data pada tabel fis_dworkshopseminars
	 * @param $data
	 * @param $ws_id
	 * @return bool
	 */
	public function update($data, $ws_id)
	{
		$this->db->where('ws_id', $ws_id);
		if ($this->db->update('fis_dworkshopseminars', $data)) {
			$this->session->set_userdata('typeNotif', 'successEdited');
			return true;
		} else {
			$this->session->set_userdata('typeNotif', 'errorEdited');
			return false;
		}
	}
}
