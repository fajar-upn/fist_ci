<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Kontroler untuk menu pembayaran konsultasi
 * @author nurhasanhilmi dan ninisaa
 */
class Consult_payment extends CI_Controller {

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
		$this->load->model('mconsult_payment');
		$this->load->model('mconsult_contract');
	}

	public function index() {
		$data['payments'] = $this->mconsult_payment->get_all();
		$data['breadcrumb'] = 'consult_payment/vconsult_payment_breadcrumb.php';
		$data['content'] = 'consult_payment/vconsult_payment.php';
		$data['css'] = 'consult_payment/vconsult_payment_css.php';
		$data['js'] = 'consult_payment/vconsult_payment_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	public function form($id = 0) {
		if ($this->input->post('simpan_data')) {
			$input = $this->input->post(NULL, TRUE);
			extract($input);
			
			$data = array(
				'scpymt_sccontr_fk' => $id_contract,
				'scpymt_receipt' => $receipt,
				'scpymt_date' => $date,
				'scpymt_amt' => $fee,
				'scpymt_ket' => $keterangan
			);
			
			if ($payment_id != 0) {
				$id = $payment_id;
			}

			if ($this->save($data, $id)) {
				redirect('consult_payment');
			}
		}
		else {
			$obj = new stdClass();
			$obj->payment_id = $id;
			$obj->contract_id = '';
			$obj->user_code = '';
			$obj->payment_receipt = '';
			$obj->payment_date = '';
			$obj->payment_amount = '';
			$obj->payment_keterangan = '';

			if ($id != 0) {
				$obj = $this->mconsult_payment->get_by_id($id);
			}

			$data['data'] = $obj;
			$data['contract'] = $this->mconsult_contract->get_active_contract();
			$data['breadcrumb'] = 'consult_payment/vconsult_payment_form_breadcrumb.php';
			$data['content'] = 'consult_payment/vconsult_payment_form.php';
			$data['css'] = 'consult_payment/vconsult_payment_form_css.php';
			$data['js'] = 'consult_payment/vconsult_payment_form_js.php';
			$data['user_role'] = $this->session->userdata('role');
			$this->load->view('template/vtemplate.php', $data);
		}
	}

	private function save($data, $id) {
		$active_user = $this->session->userdata('id');
		if ($id == 0) {
			$data['user_create'] = $active_user;
			return $this->mconsult_payment->insert($data);
		}
		else {
			$data['user_update'] = $active_user;
			return $this->mconsult_payment->update($data, $id);
		}
	}

	public function delete($id) {
		if ($this->mconsult_payment->delete($id)) {
			$this->session->set_userdata('typeNotif', 'successDeleteData');
			redirect('consult_payment');
		}
		else {
			$this->session->set_userdata('typeNotif', 'errorDeleteData');
			redirect('consult_payment');
		}
	}
}

/* End of file Consult_payment.php */
/* Location: ./application/controllers/Consult_payment.php */