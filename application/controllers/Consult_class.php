<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kontroler untuk menu daftar kelas konsultasi
 * @author nurhasanhilmi
 */
class Consult_class extends CI_Controller {

	/**
	 * Fungsi konstruktor
	 * Redirect ke halaman login jika belum login
	 * Redirect ke dashboard jika bukan admin
	 */
	public function __construct() {
		parent::__construct();
		$admin_role_id = 3;
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != $admin_role_id) { // ketika bukan admin
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('mconsult_class');
		$this->load->model('muser_account');
	}

	/**
	 * Fungsi yang akan dijalankan jika segmen kedua URI kosong
	 * @return mixed
	 */
	public function index() {
		$data['classes'] = $this->mconsult_class->get_all();
		$data['unassigned_classes'] = $this->mconsult_class->get_all_unassigned();
		$data['mentor'] = $this->muser_account->get_by_role_id(6);
		$data['breadcrumb'] = 'consult_class/vconsult_class_breadcrumb.php';
		$data['content'] = 'consult_class/vconsult_class.php';
		$data['css'] = 'consult_class/vconsult_class_css.php';
		$data['js'] = 'consult_class/vconsult_class_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data, FALSE);
	}

	/**
	 * Fungsi untuk menyimpan data (menerima data dari input method POST)
	 * baik menambahkan data kelas konsultasi baru ataupun mengubah data kelas konsultasi yang sudah ada
	 * @return mixed
	 */
	public function save() {
		$active_user = $this->session->userdata('id');
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$data = array(
			'scclass_sccontr_fk' => $contract_id,
			'scclass_mentor_fk' => $mentor_id
		);

		if (isset($class_id)) {
			// mengubah data
			$data['user_update'] = $active_user;
			if ($this->mconsult_class->update($data, $class_id)) {
				$this->session->set_userdata('typeNotif', 'successEditData');
				redirect('consult_class');
			}
			else {
				$this->session->set_userdata('typeNotif', 'errorEditData');
				redirect('consult_class');
			}
		}
		else {
			// menambah data
			$data['user_create'] = $active_user;
			if ($this->mconsult_class->insert($data)) {
				$this->session->set_userdata('typeNotif', 'successAddData');
				redirect('consult_class');
			}
			else {
				$this->session->set_userdata('typeNotif', 'errorAddData');
				redirect('consult_class');
			}
		}
	}

	/**
	 * Fungsi untuk menghapus data kelas konsultasi
	 * @param  int  $id  id kelas konsultasi pada database (scclass_id)
	 * @return mixed
	 */
	public function delete($id) {
		if ($this->mconsult_class->delete($id)) {
			$this->session->set_userdata('typeNotif', 'successDeleteData');
			redirect('consult_class');
		}
		else {
			$this->session->set_userdata('typeNotif', 'errorDeleteData');
			redirect('consult_class');
		}
	}
}

/* End of file Consult_class.php */
/* Location: ./application/controllers/Consult_class.php */
