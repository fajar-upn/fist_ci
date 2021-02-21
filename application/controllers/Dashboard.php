<?php

class Dashboard extends CI_Controller {

	//put your code here
	function __construct() {
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) {
			redirect('auth');
		}
	}

	function index() {
		$data['content'] = 'dashboard/vdashboard.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}
}
