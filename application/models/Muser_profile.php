<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Muser_profile extends CI_Model {

	/**
	 * menampilkan profil user pada tabel fis_duser_profiles berdasarkan id
	 * dikebalikan dalam bentuk array
	 * @param $id
	 * @return mixed
	 */
	public function get_profile_by_id($id) {
		$profile = $this->db->get_where('fis_duser_profiles', array('uprof_uacc_fk' => $id));
		return $profile->row();
	}


	/**
	 * memperbarui data akun pengguna pada tabel fis_duser_profiles berdasakan id
	 * @param $data
	 * @param $id
	 * @return bool
	 */
	public function update($data, $id) {
		$profile = $this->get_profile_by_id($id);

		if ($profile) {  // pengecekan apakah profil pengguna sudah ada atau belum, jika ada maka profil diupdate
			$this->db->where('uprof_uacc_fk', $id);
			if ($this->db->update('fis_duser_profiles', $data)) {
				$this->session->set_userdata('typeNotif', 'successEdited');
				return true;
			} else {
				$this->session->set_userdata('typeNotif', 'errorEdited');
				return false;
			}

		} else {  // jika profil tidak ditemukan maka profil akan ditambahkan
			$data['uprof_uacc_fk'] = $id;
			if ($this->db->insert('fis_duser_profiles', $data)) {
				$this->session->set_userdata('typeNotif', 'successEditedProfile');
				return true;
			} else {
				$this->session->set_userdata('typeNotif', 'errorEditedProfile');
				return false;
			}
		}
	}
}
?>
