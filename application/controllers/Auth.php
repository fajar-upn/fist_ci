<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

	/**
	 * load model mauth
	 * Auth constructor.
	 */
	public function __construct() {
		parent::__construct();

		$this->load->model('mauth');
		$this->load->model('muser_account');
	}


	/**
	 * menampilkan halaman login, apabila user sudah login maka dapat langsung mengakses dashboard
	 */
	public function index() {
		$is_login = $this->session->userdata('is_login');

		if ($is_login == true) {
			redirect('dashboard');
		} else {
			$data['js'] = 'template/vtemplate_notif';
			$data['content'] = 'auth/vlogin';
			$this->load->view('template/vtemplate_auth', $data);
		}
	}


	/**
	 * melakukan update data pengguna
	 * @param $data
	 * @param $id
	 * @return mixed
	 */
	public function update($data, $id) {
		return $this->muser_account->update($data, $id);
	}


	/**
	 * menyimpan data pengguna baru ke database
	 * @param $data
	 * @param int $id_account
	 * @return mixed
	 */
	private function save($data, $id_account = 0) {
		return $this->mauth->save_data($data, $id_account);
	}


	/**
	 * menghapus data pengguna pada fis_duser_account berdasarkan id
	 * @param $id
	 */
	public function delete($id) {
		if ($this->muser_account->delete($id)) {
			redirect('auth');
		}
	}


	/**
	 * menampilkan form untuk registrasi
	 */
	public function register() {
		$data['js'] = 'template/vtemplate_notif';
		$data['content'] = 'auth/vregister';
		$this->load->view('template/vtemplate_auth', $data);
	}


	/**
	 * digunakan untuk proses registrasi, input berupa data pengguna
	 * selanjutnya akan digenerate token yang digunakan nuntuk verifikasi email
	 * seluruh data tersimpan dalam array data_user
	 * kemudian sistem mengirimkan email untuk aktivasi
	 * sebelum mengirim email akan dicek terlebih dahulu apakah email maupun usernamenya digunakan pada akun yang terdaftar atau tidak
	 */
	function register_account() {
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$email_exist	= empty($this->muser_account->get_by_email($email));
		$username_exist	= empty($this->muser_account->get_by_username($username));

		if (empty($email_exist) and empty($username_exist)) {
			$this->session->set_userdata('typeNotif', 'usernameAndEmailAlreadyExist');
			redirect('auth/register');
		} else if (empty($username_exist)) {
			$this->session->set_userdata('typeNotif', 'usernameAlreadyExist');
			redirect('auth/register');
		} else if (empty($email_exist)) {
			$this->session->set_userdata('typeNotif', 'emailAlreadyExist');
			redirect('auth/register');
		} else {
			// generate kode untuk aktivasi akun
			$token = $this->mauth->generate_token();

			$data_user = array(
				'uacc_email'	=> $email,
				'uacc_username'	=> $username,
				'uacc_password'	=> md5($password),
				'uacc_active'	=> 0,
				'uacc_urole_fk'	=> 5,
				'uacc_token'	=> $token
			);

			if ($id = $this->save($data_user)) {
				$this->send_email($email, $id, $token, 'register');
				$this->session->set_userdata('typeNotif', 'successEmailActivate');
				redirect("auth");
			}
		}

	}


	/**
	 * untuk aktivasi akun
	 * @param $id_account
	 * @param $token
	 */
	public function activate($id_account, $token) {
		$this->mauth->activate($id_account, $token);

		redirect('auth');
	}


	/**
	 * digunakan untuk mengirim email saat reset password
	 */
	public function email_set_password() {
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$user	= $this->muser_account->get_by_email($email);

		if (!$user) {
			$this->session->set_userdata('typeNotif', 'userNotFound');
			redirect("auth");
		}
		else {
			$token	= $this->mauth->generate_token();  // generate kode untuk aktivasi akun
			$id 	= $user->uacc_id;
			$data_user = array(
				'uacc_token'	=> $token,
			);

			$this->update($data_user, $id);
			$this->send_email($email, $id, $token, 'reset-password');
			$this->session->set_userdata('typeNotif', 'resetHasSend');
			redirect("auth");
		}
	}


	/**
	 * fungsi digunakan untuk mengirim email
	 * penyesuaian pada config untuk smtp_host, smtp_port dan smtp_password
	 * @param $email
	 * @param $id_account
	 * @param $token
	 */
	public function send_email($email, $id_account, $token, $for) {
		// set up email
		$this->load->library('email');

		$config = array(
			'protocol'		=> 'smtp',
			'smtp_host'		=> 'mail.fisteffect.com',
			'smtp_port'		=> 465,
			'smtp_user'		=> 'office@fisteffect.com',
			'smtp_pass'		=> 'apahay0l0',
			'smtp_crypto'	=> 'ssl',
			'mailtype'		=> 'html',
			'charset'		=> 'iso-8859-1',
			'wordwrap'		=> TRUE
		);
		$this->email->initialize($config);

		if ($for == "register") {
			$message = "
				<!doctype html>
				<html>
				  <head>
					<title>Aktivasi Akun</title>
				  </head>
				  <body>
					<div>
						<h2>Halo, terima kasih telah mendaftar!</h2>
						<p>Tinggal satu step lagi agar akun milikmu bisa digunakan, klik link dibawah ya!</p>
						<a href='". base_url() ."auth/activate/".$id_account."/".$token."'>Activate My Account</a>
					</div>
				  </body>
				</html>
			";
			$this->email->subject('Email Aktivasi Akun');

		} else if ($for == "reset-password") {
			$message = "
				<!doctype html>
				<html>
				  <head>
					<title>Reset Password</title>
				  </head>
				  <body>
					<div>
						<h2>Reset password dengan mudah</h2>
						<p>Lakukan reset password dalam kurun waktu kurang dari 1 jam setelah email ini dikirim. Reset password dilakukan dengan cara menekan link dibawah ini</p>
						<a href='". base_url() ."auth/set_password/".$id_account."/".$token."'>Reset password</a>
					</div>
				  </body>
				</html>
			";
			$this->email->subject('Reset Password');
		}

		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user'], "Fist Effect");
		$this->email->to($email);
		$this->email->message($message);
		$this->email->send();
	}


	/**
	 * menampilkan form untuk melakukan reset password
	 * @param $id_account
	 * @param $token
	 */
	public function set_password($id_account, $token = null) {
		date_default_timezone_set('Asia/Jakarta');

		$user = $this->muser_account->get_by_id($id_account);

		if ($token == $user->uacc_token) {
			// menentukan batas akhir untuk reset password
			$timestamp				= $user->uacc_token_create;
			$split_timestamp		= explode(" ", $timestamp);
			$date 					= $split_timestamp[0];
			$time 					= $split_timestamp[1];
			$limit_reset_password 	= 60;  // minutes
			$end_time 				= strtotime($time) + ($limit_reset_password * 60);

			// mendapatkan datetime saat ini
			$time_now		= date('Y-m-d H:i:s', time());
			$split_time_now	= explode(" ", $time_now);
			$date_now		= $split_time_now[0];
			$time_now		= strtotime($split_time_now[1]);

			if (($date == $date_now) and ($time_now < $end_time)) {
				$this->session->set_userdata('typeNotif', 'tokenValid');
			} else {
				$this->session->set_userdata('typeNotif', 'tokenExpired');
			}
		} else {
			$this->session->set_userdata('typeNotif', 'tokenExpired');
		}

		$data['id_account']	= $id_account;
		$data['token']		= $token;
		$data['content'] 	= 'auth/vreset_password';
		$data['js'] 		= 'template/vtemplate_notif';
		$this->load->view('template/vtemplate_auth', $data);
	}


	/**
	 * melakukan reset password berdasarkan id pengguna
	 * jika token sama maka dilakukan proses reset password
	 * @param $id_account
	 * @param $token
	 */
	public function reset_password($id_account, $token) {
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$data['token']		= $token;
		$data['password']	= md5($password);

		$reset_success = $this->mauth->reset_password($id_account, $data);

		if ($reset_success) {
			$token = $this->mauth->generate_token();
			$data = array('uacc_token' => $token);
			$this->muser_account->update($data, $id_account);
			$this->session->set_userdata('typeNotif', 'successResetPassword');
		}

		redirect('auth');
	}


	/**
	 * digunakan untuk proses login, proses dilakukan pada mauth
	 */
	public function login(){
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$cek = $this->mauth->check_login($account,$password);

		if ($cek) {
			redirect('dashboard');
		} else {
			redirect('auth');
		}
	}


	/**
	 * digunakan untuk logout, menghapus session
	 */
	public function logout(){
		$data = array (
			'id', 'username', 'email', 'role', 'is_login'
		);

		$this->session->unset_userdata($data);
		redirect('auth');
	}
}

