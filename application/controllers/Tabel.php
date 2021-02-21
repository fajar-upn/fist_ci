<?php
class Tabel extends CI_Controller{
	function __construct(){
	parent::__construct();
	}

	function index(){
		$data['content']='vtabel.php';
		$this->load->view('template/vtemplate', $data);
	}

}
?>