<?php
class Submit_Berkas extends CI_Controller{
	 function __construct(){
	 parent::__construct();
	 $this->load->model('Model_submit');
	 }

	function index(){

		
		$data['content']='vsubmitberkas.php';
		$this->load->view('template/vtemplate_auth', $data);
	}

	function insert(){
		$id=$this->session->userdata('id');
		$dfiles_appdesc=$this->input->post('dfiles_appdesc');
		$dfiles_agency=$this->input->post('dfiles_agency');
		$zip=$_FILES["zip"];
		$namafile = basename($zip["name"]);
		$newfile_name=str_replace(" ", "_", $namafile);

		$filepath="upload/".$newfile_name;
		move_uploaded_file($zip["tmp_name"], $filepath);
		$data = array(
			'dfiles_uacc_fk' => $id,
			'dfiles_appdesc' => $dfiles_appdesc,
			'dfiles_agency'  => $dfiles_agency,
			'dfiles_upload'  => $newfile_name
		);
		$id_notif=$this->Model_submit->insertdata_files($data);
		$notif = array(
			'dnotif_files_fk' =>$id_notif,
			'dnotif_desc'=>"sudah diisi gan",
			'dnotif_status'=>"unread"
		);

		$this->Model_submit->insertdata_notif($notif);
		redirect("submit_berkas");
	}

	function cek_berkas(){
		$data['cek']=$this->Model_submit->get_list_berkas();
		// print_r($data);
		// exit();
		$data['content']='vtabel.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate', $data);
	}

	function delete_files($id){
		$cek=$this->model_subit->delete($id);

		if($cek>0){
			redirect('Submit_Berkas/cek_berkas');
		}
	}

}
?>