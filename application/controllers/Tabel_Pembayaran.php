<?php
class Tabel_Pembayaran extends CI_Controller{
	function __construct(){
	parent::__construct();
	}

	function index(){
		$data['content']='vtabelpembayaran.php';
		$this->load->view('template/vtemplate', $data);
	}

}
?>