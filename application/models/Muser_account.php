<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Muser_account extends CI_Model {

	/**
	 * mendapatkan seluruh data pengguna dari tabel fis_duser_accounts
	 * @return mixed
	 */
	public function get_users()
	{
		$user = $this->db->get('fis_vuser_accounts');
		return $user->result();
	}


	/**
	 * mendapatkan data pengguna dari tabel fis_duser_accounts berdasarkan id
	 * @param $id
	 * @return mixed
	 */
	public function get_by_id($id)
	{
		$this->db->where('uacc_id', $id);
		$user = $this->db->get('fis_duser_accounts');
		return $user->row();
	}


	/**
	 * menampilkan data user pada tabel fis_duser_accounts berdasarkan email
	 * dikembalikan dalam bentuk array
	 * @param $email
	 * @return mixed
	 */
	function get_by_email($email) {
		$this->db->where('uacc_email', $email);
		$query = $this->db->get('fis_duser_accounts');
		return $query->row();
	}


	/**
	 * menampilkan data user pada tabel fis_duser_accounts berdasarkan username
	 * dikembalikan dalam bentuk array
	 * @param $username
	 * @return mixed
	 */
	function get_by_username($username) {
		$this->db->where('uacc_username', $username);
		$query = $this->db->get('fis_duser_accounts');
		return $query->row();
	}


	/**
	 * mendapatkan data pengguna dari tabel fis_vuser_accounts berdasarkan role_id
	 * @param  int $role_id
	 * @return mixed
	 */
	public function get_by_role_id($role_id)
	{
		$query = $this->db->get_where('fis_vuser_accounts', array('urole_id' => $role_id));
		return $query->result();
	}


	public function get_by_username_or_email($identifier) {
		$this->db->from('fis_duser_accounts');
		$this->db->where('uacc_username',$identifier);
		$this->db->or_where('uacc_email',$identifier);
		$user = $this->db->get();
		return $user->row();
	}


	/**
	 * insert data pengguna
	 * @param $data
	 * @return bool
	 */
	public function insert($data)
	{
		if ($this->db->insert('fis_duser_accounts', $data)) {
			$this->session->set_userdata('typeNotif', 'successAddUser');
			return $this->db->insert_id();
		} else {
			$this->session->set_userdata('typeNotif', 'errorAddUser');
			return false;
		}
	}


	/**
	 * memperbarui data akun pengguna pada tabel fis_duser_accounts berdasarkan id
	 * @param $data
	 * @param $id
	 * @return bool
	 */
	public function update($data, $id) {
		$this->db->where('uacc_id', $id);

		if ($this->db->update('fis_duser_accounts', $data)) {
			$this->session->set_userdata('typeNotif', 'successEdited');
			return true;
		} else {
			$this->session->set_userdata('typeNotif', 'errorEdited');
			return false;
		}
	}


	/**
	 * menghapus data pengguna dari tabel fis_duser_accounts berdasarkan id
	 * @param $id
	 * @return bool
	 */
	public function delete($id)
	{
		if ($this->db->delete('fis_duser_accounts', array('uacc_id' => $id))) {
			$this->session->set_userdata('typeNotif', 'successDelete');
			return true;
		} else {
			$this->session->set_userdata('typeNotif', 'errorDelete');
			return false;
		}
	}


	/**
	 * mengubah uacc_active menjadi 1 pada tabel fis_duser_accounts berdasarkan id
	 * digunakan untuk mengaktifkan akun
	 * hanya admin dan developer yang dapat mengakses
	 * @param $id
	 * @return bool
	 */
	public function activate($id)
	{
		$data['uacc_active'] = 1;
		$this->db->where('uacc_id', $id);
		if ($this->update($data, $id)) {
			$this->session->set_userdata('typeNotif', 'adminSuccessActivate');
			return true;
		} else {
			$this->session->set_userdata('typeNotif', 'adminErrorActivate');
			return false;
		}
	}


	/**
	 * mengubah uacc_active menjadi 0 pada tabel fis_duser_accounts berdasarkan id
	 * hanya admin dan developer yang dapat mengakses
	 * digunakan untuk menonaktifkan akun
	 * @param $id
	 * @return bool
	 */
	public function nonactivate($id)
	{
		$data['uacc_active'] = 0;
		if ($this->update($data, $id)) {
			$this->session->set_userdata('typeNotif', 'adminSuccessNonactivate');
			return true;
		} else {
			$this->session->set_userdata('typeNotif', 'adminErrorNonactiavte');
			return false;
		}
	}


	/**
	 * mengubah status suspend dari 0 menjadi 1, sehingga user tidak dapat login
	 * hanya admin dan developer yang dapat mengakses
	 * @param $id
	 * @return bool
	 */
	public function suspend($id)
	{
		$data['uacc_suspend'] = 1;
		if ($this->update($data, $id)) {
			return true;
		} else {
			return false;
		}
	}


	/**
	 * mengubah status suspend dari 1 menjadi 0, sehingga user dapat login kembali
	 * hanya admin dan developer yang dapat mengakses
	 * @param $id
	 * @return bool
	 */
	public function unsuspend($id)
	{
		$data['uacc_suspend'] = 0;
		if ($this->update($data, $id)) {
			return true;
		} else {
			return false;
		}
	}
}
?>
