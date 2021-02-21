<?php
class Kontrak extends CI_Controller{
	 function __construct(){
	 parent::__construct();
	 $this->load->model('Model_kontrak');
	 }

	function index(){

		
		$data['content']='vkontrak.php';
		$this->load->view('template/vtemplate', $data);
	}

	function insert(){
		$id=$this->session->userdata('id');
		$dcontr_appname=$this->input->post('dcontr_appname');
        $dcontr_date=$this->input->post('dcontr_date');
        $dcontr_price=$this->input->post('dcontr_price');
        $dcontr_duration=$this->input->post('dcontr_duration'); 
		$zip=$_FILES["zip"];
		$namafile = basename($zip["name"]);
		$newfile_name=str_replace(" ", "_", $namafile);

		$filepath="upload/".$newfile_name;
		move_uploaded_file($zip["tmp_name"], $filepath);
		$data = array(
			'dcontr_uacc_fk'=>$id,
			'dcontr_appname'=>$dcontr_appname,
            'dcontr_date'=>$dcontr_date,
            'dcontr_price'=>$dcontr_price,
            'dcontr_duration'=>$dcontr_duration,
			'dcontr_file_upload'=>$newfile_name
		);
		$this->Model_kontrak->insertdata($data);
		redirect("kontrak");
	}

	function cek_berkas(){
		$data['cek']=$this->Model_kontrak->get_list_berkas();
		$data['content']='vtabel_kontrak.php';
		$this->load->view('template/vtemplate', $data);
		
	}

	



}
?>