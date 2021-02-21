<?php
class Kalkulator extends CI_Controller{
	function __construct(){
	parent::__construct();
	}

	function index(){
		$data['content']='vform_submit.php';
		$this->load->view('template/vtemplate', $data);
	}

}
?>