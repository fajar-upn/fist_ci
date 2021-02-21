<?php

class Mauth extends CI_Model {

	public function __construct() {
		parent::__construct();
		$this->load->model('muser_account');
	}

	/**
	 * menambahkan atau mengedit data pada tabel fis_duser_accounts berdasarkan id_account
	 * flashdata digunakan sebagai notifikasi apakah proses penyimpanan berhasil atau tidak
	 * @param $data - data bervariasi bergantung pada field yang ingin ditambahkan
	 * @param int $id_account
	 * @return bool
	 */
	public function save_data($data, $id_account = 0) {
		/**
		 * jika $id_account != 0 maka akan dilakukan proses update pada fis_duser_accounts
		 * data yang diupdate bervariasi, bergantung pada isi dari array $data
		 */
		if ($id_account != 0) {
			$this->muser_account->update($data, $id_account);
		}
		else {
		/**
		 * selain itu maka dilakukan proses penambahan data pada table fis_duser_accounts
		 */
			if ($insert_id = $this->muser_account->insert($data)) {
				$this->session->set_userdata('typeNotif', 'successRegister');
				return $insert_id;
			} else {
				$this->session->set_userdata('typeNotif', 'errorRegister');
				return false;
			}
		}
	}


	/**
	 * digunakan untuk melakukan aktivasi akun yang telah mendapatkan email aktivasi
	 * pada prosesnya akan dilakukan pengecekan token, apabila sama maka aktivasi berhasil
	 * @param $id_account
	 * @param $token - token aktivasi
	 */
	public function activate($id_account, $token) {
		$user = $this->muser_account->get_by_id($id_account);

		if ($user->uacc_active == 0) {
			if ($user->uacc_token == $token) {  // pengecekan token
				$this->muser_account->activate($id_account);
				$this->session->set_userdata('typeNotif', 'successActivate');
			} else {
				$this->session->set_userdata('typeNotif', 'errorActivate');
			}
		} else {
			$this->session->set_userdata('typeNotif', 'hasActivate');
		}
	}


	/**
	 * digunakan untuk mengupdate password pada tabel fis_duser_accounts
	 * @param $id_account
	 * @param $data
	 * @return bool
	 */
	public function reset_password($id_account, $data) {
		$user = $this->muser_account->get_by_id($id_account);

		if ($user->uacc_token == $data['token']) {
			$new_data['uacc_password'] = $data['password'];
			$this->muser_account->update($new_data, $id_account);
			$this->session->set_userdata('typeNotif', 'successResetPassword');
			return true;
		} else {
			$this->session->set_userdata('typeNotif', 'errorResetPassword');
			return false;
		}
	}


	/**
	 * digunakan untuk melakukan autentikasi login, berhubungan dengan tabel fis_duser_accounts
	 * apakah usernya ada; apakah passwordnya benar atau salah; apakah sudah aktivasi; apakah akun tersuspend
	 * nilai kembali berupa boolean yang disertai dengan flashdata
	 * @param $account - username atau email
	 * @param $password - password
	 * @return bool
	 */
	public function check_login($identifier, $password){
		$user = $this->muser_account->get_by_username_or_email($identifier);

		if (!$user) {  // jika usernya tidak ada
			$this->session->set_userdata('typeNotif', 'userNotFound');
			return false;
		} else if ($user->uacc_active == 0) {  // jika usernya belum melakukan aktivasi
			$this->session->set_userdata('typeNotif', 'userNotActive');
			return false;
		} else if ($user->uacc_suspend == 1) {  // jika usernya sedang di suspend
			$this->session->set_userdata('typeNotif', 'userHasSuspend');
		}
		else {  // pengecekan login
			if ($user->uacc_password == md5($password) and $user->uacc_suspend == 0) {
				$data = array (
					'id' 		=> $user->uacc_id,
					'username' 	=> $user->uacc_username,
					'email' 	=> $user->uacc_email,
					'role' 		=> $user->uacc_urole_fk,
					'is_login' 	=> true
				);
				$this->session->set_userdata($data);
				return true;
			} else {
				$this->session->set_userdata('typeNotif', 'wrongPassword');
				return false;
			}
		}
		return false;
	}


	/**
	 * melakukan generate token, digunakan saat membuat akun atau melakukan reset password
	 * @return false|string
	 */
	public function generate_token() {
		$set	= '1234567890abcdefghijklmnopqrstuvwxyz';
		$token	= substr(str_shuffle($set), 0, 12);
		return $token;
	}
}
