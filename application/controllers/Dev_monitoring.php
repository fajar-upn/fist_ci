<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dev_monitoring extends CI_Controller {

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
		$this->load->model('mdev_contract');
	}

    
    public function contract($id)
    {
		$data['contract'] = $this->mdev_contract->getContractById($id);
        $data['features'] = $this->mdev_contract->getFeatureByContractId($id);
		$data['breadcrumb'] = 'dev_monitoring/vdev_monitoring_breadcrumb.php';
		$data['content'] = 'dev_monitoring/vdev_monitoring.php';
		// $data['css'] = '';
		// $data['js'] = '';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data, FALSE);
    }

	public function changeFeatureStatus($contract_id, $fitur_id) {
        if ($this->mdev_contract->changeFeatureStatus($fitur_id)){
            $url = 'dev_monitoring/contract/'.$contract_id;
            redirect($url);
        }
        
    }
    

	public function delete($id) {
	}
}
