<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dev_module extends CI_Controller {
	
    public function __construct() {
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != 3) { // ketika bukan admin (id role admin adalah 2)
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('mdev_module');
    }
    
    public function index() {
		$data['cek']=$this->mdev_module->get_list_berkas();
		$data['breadcrumb'] = 'dev_module/vdev_module_breadcrumb.php';
		$data['content'] = 'dev_module/vdev_module.php';
		$data['css'] = 'dev_module/vdev_module_css.php';
		$data['js'] = 'dev_module/vdev_module_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data, FALSE);
	}

	public function form($id = 0) {
		if ($this->input->post('simpan_data')) {
			$input = $this->input->post(NULL, TRUE);
			extract($input);
			
			$data = array(
				'dmodules_id'=>$dmodules_id,
				'dmodules_difficulties' => $dmodules_difficulties,
				'dmodules_lowest_price' =>$dmodules_lowest_price,
				'dmodules_highest_price' =>$dmodules_highest_price,
				'dmodules_shortestdur' =>$dmodules_shortestdur,
				'dmodules_longestdur' =>$dmodules_longestdur
			);
			
		
			if ($dmodules_id != 0) {
				$id = $dmodules_id;
			}

			if ($this->save($data, $id)) {
				redirect('dev_module');
			}
		}
		else {
			$obj = new stdClass();
			$obj->dmodules_id = $id;
			$obj->dmodules_difficulties = '';
			$obj->dmodules_lowest_price = '';
			$obj->dmodules_highest_price = '';
			$obj->dmodules_shortestdur = '';
			$obj->dmodules_longestdur = '';

			if ($id != 0) {
				$obj = $this->mdev_module->get_by_id($id);
			}
			
			$data['module'] = $obj;
			$data['breadcrumb'] = 'dev_module/vdev_module_form_breadcrumb.php';
			$data['content'] = 'dev_module/vdev_module_form.php';
			$data['css'] = 'dev_module/vdev_module_css.php';
		 	$data['js'] = 'dev_module/vdev_module_js.php';
			$data['user_role'] = $this->session->userdata('role');
			$this->load->view('template/vtemplate.php', $data, FALSE);
		}
	}

	public function save($data, $id)
	{
		$active_user = $this->session->userdata('id');
		if ($id == 0) {
			$data['user_create'] = $active_user;
			return $this->mdev_module->insertModule($data);
		}
		else {
			$data['user_update'] = $active_user;
			return $this->mdev_module->updateModule($data, $id);
		}
	}

	public function delete($id) {		
		if ($this->mdev_module->deleteModule($id)) {
			$this->session->set_userdata('typeNotif', 'successDeleteData');
			redirect('dev_module');
		}
		else {
			$this->session->set_userdata('typeNotif', 'errorDeleteData');
			redirect('dev_module');
		}
	}

	
}
