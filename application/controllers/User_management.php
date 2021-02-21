<?php defined('BASEPATH') or exit('No direct script access allowed');

class User_management extends CI_Controller
{

	/**
	 * sebelum mengakses user_management, terlebih dahulu dicek apakah role yang akan mengakses valid atau tidak
	 * jika role nya sebagai developer (2) atau admin (3) maka diperbolehkan untuk mengakses user_management
	 * selain dua role diatas maka akan dilempar ke dashboard
	 * User_management constructor.
	 */
	public function __construct()
	{
		parent::__construct();

		$this->load->model('muser_account');
		$this->load->model('muser_profile');
		$this->load->model('muser_role');
		$this->load->model('mauth');
	}


	/**
	 * menampilkan tabel data
	 */
	public function index() {
		$data['users']		= $this->muser_account->get_users();
		$data['roles']		= $this->muser_role->get_roles();
		$data['user_role']  = $this->session->userdata('role');

		if ($data['user_role'] == 2 or $data['user_role'] == 3) {
			$data['js']			= 'user_management/vcustom_script_js';
			$data['css']		= 'user_management/vuser_management_css';
			$data['content']	= 'user_management/vuser_management';
			$data['breadcrumb']	= 'user_management/vuser_breadcrumb';
			$this->load->view('template/vtemplate', $data);
		} else {
			redirect('dashboard');
		}

	}


	/**
	 * manyimpan data pengguna baru ke database
	 * karena penambahan lewat admin, maka tidak mengirim email untuk aktivasi
	 * aktivasi dilakukan langsung oleh admin
	 */
	 public function insert() {
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$Tsalaryku = $this->convert_to_number($Tsalary);
		$Csalaryku = $this->convert_to_number($Csalary);
		$Tsalaryku = (int)$Tsalaryku/100;
		$Csalaryku = (int)$Csalaryku/100;

		
		if($role!=6){
			$Csalary='';
			$Tsalary='';
		}

		$email_exist	= empty($this->muser_account->get_by_email($email));
		$username_exist	= empty($this->muser_account->get_by_username($username));

		if (empty($email_exist) and empty($username_exist)) {
			$this->session->set_userdata('typeNotif', 'usernameAndEmailAlreadyExistOnUserManagement');
			redirect('user_management');
		} else if (empty($username_exist)) {
			$this->session->set_userdata('typeNotif', 'usernameAlreadyExistOnUserManagement');
			redirect('user_management');
		} else if (empty($email_exist)) {
			$this->session->set_userdata('typeNotif', 'emailAlreadyExistOnUserManagement');
			redirect('user_management');
		} else {
			$data_user = array(
				'uacc_email'	=> $email,
				'uacc_username'	=> $username,
				'uacc_password'	=> md5($password),
				'uacc_active'	=> 0,
				'uacc_urole_fk'	=> $role,
				'uacc_csalary'  => $Tsalaryku,
				'uacc_tsalary'  => $Csalaryku,
				'uacc_token'	=> $this->mauth->generate_token()
			);
			
			$this->muser_account->insert($data_user);
			redirect("user_management");
		}
	}


	/**
	 * melakukan update data pengguna ke database berdasarkan id
	 * digunakan saat mengedit data pengguna
	 * @param $id
	 */
	public function update($update_for, $id)
	{
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$validate_user = $this->muser_account->get_by_id($id);

		$Tsalaryku = $this->convert_to_number($tsalary);
		$Csalaryku = $this->convert_to_number($csalary);
		$Tsalaryku = (int)$Tsalaryku/100;
		$Csalaryku = (int)$Csalaryku/100;


		/**
		 * digunakan untuk update account oleh admin
		 * dengan menggunakan fitur edit pada user_management
		 */
		if ($update_for == "account") {
			/**
			 * Cek apakah email dan username yang diisikan sama dengan email dan username lama atau tidak
			 * Jika email sama maka data yang perlu diupdate hanya role dan nama lengkap
			 * Selain itu akan dicek apakah email dan username sudah pernah digunakan atau belum
			 * Apabila minimal salah tau dari keduanya sudah digunakan, maka akan memunculkan notifikasi
			 * sesuai dengan kondisi yang dialami
			 */
			if ((strcmp($validate_user->uacc_email, $email) == 0) and
				 strcmp($validate_user->uacc_username, $username) == 0) {

				$data_account = array(
					'uacc_urole_fk'	=> $role,
					'uacc_csalary'	=> $Tsalaryku,
					'uacc_tsalary'	=> $Csalaryku,
				);

				$data_profile = array(
					'uprof_full_name'	=> $name
				);

				$this->muser_account->update($data_account, $id);
				$this->muser_profile->update($data_profile, $id);
			}
			else {
				/**
				 * Melakukan validasi jika username maupun email berbeda dengan yang sebelumnya
				 * maka akan diberikan notifikasi apabila penggunaan email atau username sudah digunakan
				 */
				$same_email		= strcmp($validate_user->uacc_email, $email) ? 0 : 1;
				$same_username	= strcmp($validate_user->uacc_username, $username) ? 0 : 1;
				$same_account	= $same_email or $same_username;

				$email_exist	= $this->muser_account->get_by_email($email);
				$username_exist	= $this->muser_account->get_by_username($username);

				if ($email_exist and $username_exist and !$same_account) {
					$this->session->set_userdata('typeNotif', 'usernameAndEmailAlreadyExistOnUserManagement');
				}
				else if ($email_exist and !$same_email) {
					$this->session->set_userdata('typeNotif', 'emailAlreadyExistOnUserManagement');
				}
				else if ($username_exist and !$same_username) {
					$this->session->set_userdata('typeNotif', 'usernameAlreadyExistOnUserManagement');
				}
				else {
					$data_account = array(
						'uacc_email'	=> $email,
						'uacc_username'	=> $username,
						'uacc_urole_fk'	=> $role
					);

					$data_profile = array(
						'uprof_full_name'	=> $name
					);

					$this->muser_account->update($data_account, $id);
					$this->muser_profile->update($data_profile, $id);
				}
			}

			redirect('user_management');
		}

		/**
		 * digunakan untuk update profil oleh masing-masing pemilik akun
		 * melalui menu profil saya
		 */
		else if ($update_for == "profile") {
			$data = array(
				'uprof_phone'		=> $phone,
				'uprof_gender'		=> $gender,
				'uprof_address'		=> $address,
				'uprof_full_name'	=> $name,
				'uprof_birth_date'	=> $birth_date,
				'uprof_birth_place'	=> $birth_place,
				'uprof_institution'	=> $institution
			);

			$this->muser_profile->update($data, $id);
			redirect("user_management/account_profile/$id");
		}

		/**
		 * digunakan untuk mengubah username oleh masing-masing pemilik akun
		 * melalui menu pengaturan akun
		 */
		else if ($update_for == "username") {
			$same_username = (strcmp($validate_user->uacc_email, $email) == 0);

			if (!$same_username) {
				$username_exist = $this->muser_account->get_by_username($username);
				if ($username_exist and !$same_username) {
					$this->session->set_userdata('typeNotif', 'usernameAlreadyExistOnUserManagement');
				} else {
					$data = array('uacc_username' => $username);

					if ($this->muser_account->update($data, $id)) {
						$this->session->set_userdata('username', $username);
					}
				}
			}

			redirect("user_management/account_setting/$id");
		}

		/**
		 * digunakan untuk mengubah email oleh masing-masing pemilik akun
		 * melalui menu pengaturan akun
		 */
		else if ($update_for == "email") {
			$same_email = (strcmp($validate_user->uacc_email, $email) == 0);

			if (!$same_email) {
				$email_exist = $this->muser_account->get_by_email($email);
				if ($email_exist and !$same_email) {
					$this->session->set_userdata('typeNotif', 'emailAlreadyExistOnUserManagement');
				} else {
					$data = array('uacc_email' => $email);

					if ($this->muser_account->update($data, $id)) {
						$this->session->set_userdata('email', $email);
					}
				}
			}

			redirect("user_management/account_setting/$id");
		}

		/**
		 * digunakan untuk mengubah password pengguna oleh admin
		 * melalui fitur ganti password yang terdapat pada user_management
		 */
		else if ($update_for == "user_password") {
			$data = array('uacc_password' => md5($password));

			$this->muser_account->update($data, $id);
			redirect('user_management');
		}

		/**
		 * digunakan untuk mengubah password oleh masing-masing pemilik akun
		 * melalui menu pengaturan akun
		 * sebelum mengganti password, pengguna diminta untuk memasukkan password lama kemudian memasukkan password baru
		 * jika sesuai maka proses pergantian password berhasil, begitu pula sebaliknya
		 * masing-masing akan diarahkan ke pengaturan akun setelah selesai menekan tombol ganti password dengan membawa notifikasi berhasil atau gagal
		 */
		else if ($update_for == "password") {
			$user = $this->muser_account->get_by_id($id);

			if (md5($recent_password) === $user->uacc_password) {
				$data = array('uacc_password' => md5($password));

				$this->muser_account->update($data, $id);
				$this->session->set_userdata('typeNotif', 'successChangePassword');
			} else {
				$this->session->set_userdata('typeNotif', 'wrongRecentPassword');
			}
			redirect("user_management/account_setting/$id");
		}
	}


	/**
	 * melakukan penghapusan data pengguna berdasarkan id
	 * hanya developer yang dapat mengakses
	 * @param $id
	 */
	public function delete($id) {
		$this->muser_account->delete($id);
		redirect('user_management');
	}


	/**
	 * melakukan aktivasi akun melalui admin berdasarkan id
	 * @param $id
	 */
	public function activate($id) {
		$this->muser_account->activate($id);
		redirect('user_management');
	}


	/**
	 * melakukan deaktivasi akun (menonaktifkan pengguna) melalui admin berdasakan id
	 * @param $id
	 */
	public function nonactivate($id) {
		$this->muser_account->nonactivate($id);
		redirect('user_management');
	}


	/**
	 * menampilkan form untuk data profil berdasarkan id pengguna
	 * digunakan untuk memperbatui informasi profil; seperti nama, alamat, no telepon, dll
	 * @param $id
	 */
	public function account_profile($id) {
		$user = $this->muser_profile->get_profile_by_id($id);

		if ($user) {
			$data['user'] = $user;
		} else {
			$user = new stdClass();
			$user->uprof_uacc_fk		= $id;
			$user->uprof_full_name		= null;
			$user->uprof_birth_place	= null;
			$user->uprof_birth_date		= date("Y-m-d");
			$user->uprof_institution	= null;
			$user->uprof_phone			= null;
			$user->uprof_address		= null;

			$data['user'] = $user;
		}

		$data['gender'] = array("Laki-laki", "Perempuan");
		$data['user_role']	= $this->session->userdata('role');
		$data['js']			= 'user_management/vcustom_profile_js';
		$data['css']		= 'template/vmaterial_datepicker_css';
		$data['content']	= 'user_management/vuser_profile';
		$this->load->view('template/vtemplate', $data);
	}


	/**
	 * menyimpan data profil berdasarkan id pengguna
	 * jika data profil suatu akun belum ada maka data akan disimpan baru
	 * jika data profil suatu akun sudah ada maka data hanya akan diupdate
	 * @param $id
	 */
	public function save_profile($id)
	{
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$data = array(
			'uprof_phone'		=> $phone,
			'uprof_gender'		=> $gender,
			'uprof_address'		=> $address,
			'uprof_full_name'	=> $name,
			'uprof_birth_date'	=> $birth_date,
			'uprof_birth_place'	=> $birth_place,
		);

		$user = $this->muser_profile->save_profile($data, $id);
		redirect("user_management/account_profile/$id");
	}


	/**
	 * menampilkan form untuk data akun
	 * digunakan untuk memperbarui informasi akun; seperti ganti password, email, dll
	 * @param $id
	 */
	public function account_setting($id) {
		$data['user']		= $this->muser_account->get_by_id($id);
		$data['user_role']	= $this->session->userdata('role');

		$data['js']			= 'user_management/vcustom_setting_js';
		$data['content']	= 'user_management/vuser_setting';
		$this->load->view('template/vtemplate', $data);
	}


	/**
	 * mengubah status suspend
	 * parameter is_suspend digunakan untuk mengetahui apakah itu digunakan untuk melakukan suspend atau digunakan untuk unsuspend
	 * is_suspend = true (menandakan untuk suspend)
	 * is_suspend = false (menandakan untuk unsuspend)
	 *
	 * parameter from user digunakan untuk mengetahui apakah yang melakukan edit adalah user pemilik akun atau bukan
	 * from_user = 1 (menandakan dari pengguna dan jika proses sudah selesai akan diarahkan ke auth dengan posisi logout)
	 * from_user = 0 (menandakan dari admin dan jika proses sudah selesai akan diarahkan ke user_management)
	 *
	 * @param $id
	 * @param bool $is_suspend
	 * @param int $from_user
	 */
	public function suspend($id, $from_user = 1, $is_suspend = 1)
	{
		if ($is_suspend) {
			$this->muser_account->suspend($id);
		} else {
			$this->muser_account->unsuspend($id);
		}

		/**
		 * memberikan flashdata berupa notifikasi
		 */
		if ($from_user) {  // jika user yang melakukan suspend
			if ($is_suspend) {
				// jika suspend berhasil
				$this->session->set_userdata('typeNotif', 'successSuspend');
			}
			// user tidak memiliki fitur untuk unsuspend
		} else {  // jika admin atau developer yang melakukan suspend
			if ($is_suspend) {
				// jika suspend berhasil
				$this->session->set_userdata('typeNotif', 'successSuspendFromAdmin');
			} else {
				// jika unsuspend berhasil
				$this->session->set_userdata('typeNotif', 'successUnsuspendFromAdmin');
			}
		}

		if ($from_user == 1) {
			redirect('auth');
		} else {
			redirect('user_management');
		}
	}

	public function convert_to_number($rupiah)
	{
		return preg_replace("/[^0-9]/","", $rupiah);
	}
	public function convert_to_rupiah($number)
	{
		return number_format($number,2,",",".");
	}
}
