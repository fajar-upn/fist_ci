<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dev_payment extends CI_Controller {
    public function __construct() {
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != 3) { // ketika bukan admin (id role admin adalah 2)
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('mdev_payment');
		$this->load->model('mdev_contract');
	}

	public function index() {
		$data['payments'] = $this->mdev_payment->get_all();
		$data['file'] = $this->mdev_payment->get_develop_files();

		$data['breadcrumb'] = 'dev_payment/vdev_payment_breadcrumb.php';
		$data['content'] = 'dev_payment/vdev_payment.php';
		$data['css'] = 'dev_payment/vdev_payment_css.php';
		$data['js'] = 'dev_payment/vdev_payment_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data, FALSE);
    }
    
    public function form($id = 0) {
		if ($this->input->post('simpan_data')) {
			$input = $this->input->post(NULL, TRUE);
			extract($input);
			
			$data = array(
				'dpymt_dcontr_fk' => $id_contract,
				'dpymt_receipt' => $receipt,
				'dpymt_date' => $date,
				'dpymt_amt' => $fee
			);
			
			if ($payment_id != 0) {
				$id = $payment_id;
			}

			if ($this->save($data, $id)) {
				redirect('dev_payment');
			}
		}
		else {
			$obj = new stdClass();
		
			$obj->dpymt_id = $id;
			$obj->dpymt_dcontr_fk = '';
			$obj->dpymt_receipt = '';
			$obj->dpymt_date = '';
			$obj->dpymt_amt = '';

			if ($id != 0) {
				$obj = $this->mdev_payment->get_by_id($id);
			}

			$data['data'] = $obj;
			$data['contract'] = $this->mdev_contract->get_develop_files2();
			$data['breadcrumb'] = 'dev_payment/vdev_payment_form_breadcrumb.php';
			$data['content'] = 'dev_payment/vdev_payment_form.php';
			$data['css'] = 'dev_payment/vdev_payment_form_css.php';
			$data['js'] = 'dev_payment/vdev_payment_form_js.php';
			$data['user_role'] = $this->session->userdata('role');
			$this->load->view('template/vtemplate.php', $data, FALSE);
		}
	}

	public function save($data, $id)
	{
		$active_user = $this->session->userdata('id');
		if ($id == 0) {
			$data['user_create'] = $active_user;
			return $this->mdev_payment->insertPayment($data);
		}
		else {
			$data['user_update'] = $active_user;
			return $this->mdev_payment->updatePayment($data, $id);
		}
	}

	public function delete($id) {
		$this->mdev_payment->deletePayment($id);
		redirect('dev_payment');
	}
}

?>
