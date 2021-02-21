<?php
class Dev_contract extends CI_Controller{
    public function __construct() {
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != 3) { // ketika bukan admin (id role admin adalah 2)
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('mdev_contract');
	}
     
     function index(){
		$data['cek']=$this->mdev_contract->get_list_contract();
		$data['breadcrumb'] = 'dev_contract/vdev_contract_breadcrumb.php';
		$data['content'] = 'dev_contract/vdev_contract.php';
		$data['css'] = 'dev_contract/vdev_contract_css.php';
		$data['js'] = 'dev_contract/vdev_contract_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data, FALSE);
		
	}

	public function form($id = 0) {
		if ($this->input->post('simpan_data')) {
			$input = $this->input->post(NULL, TRUE);
			extract($input);
		
			if ($dcontr_id != 0) {
				$zip=$_FILES["zip"];
				$namafile = basename($zip["name"]);
				$newfile_name=str_replace(" ", "_", $namafile);
				$id = $dcontr_id;
				$data = array(
					'dcontr_appname'=>$dcontr_appname,
					'dcontr_files_fk'=>$dcontr_files_fk,
					'dcontr_appname' =>$dcontr_appname,
					'dcontr_date' =>$dcontr_date,
					'dcontr_price' =>$dcontr_price,
					'dcontr_duration' =>$dcontr_duration
				);
			}
			else {
				$zip=$_FILES["zip"];
				$namafile = basename($zip["name"]);
				$newfile_name=str_replace(" ", "_", $namafile);

				$filepath="upload/".$newfile_name;
				move_uploaded_file($zip["tmp_name"], $filepath);
				$data = array(
					
					'dcontr_appname' =>$dcontr_appname,
					'dcontr_files_fk'=>$dcontr_files_fk,
					'dcontr_date' =>$dcontr_date,
					'dcontr_price' =>$dcontr_price,
					'dcontr_duration' =>$dcontr_duration,
					'dcontr_file_upload'=>$newfile_name
				);
			}

			if ($this->save($data, $id)) {
				redirect('dev_contract');
			}
		}
		else {
			$obj = new stdClass();
			$obj->dcontr_id = $id;
			$obj->dfiles_agency = '';
			$obj->dcontr_appname = '';
			$obj->dcontr_date = '';
			$obj->dcontr_price = '';
			$obj->dcontr_duration = '';

			if ($id != 0) {
				$obj = $this->mdev_contract->get_by_id($id);
			}
			
			$data['contract'] = $obj;
			$data['file'] = $this->mdev_contract->get_develop_files();
			$data['breadcrumb'] = 'dev_contract/vdev_contract_breadcrumb.php';
			$data['content'] = 'dev_contract/vdev_contract_form.php';
			$data['css'] = 'dev_contract/vdev_contract_css.php';
		 	$data['js'] = 'dev_contract/vdev_contract_js.php';
			$data['user_role'] = $this->session->userdata('role');
			$this->load->view('template/vtemplate.php', $data, FALSE);
		}
	}

	public function save($data, $id)
	{
		$active_user = $this->session->userdata('id');
		if ($id == 0) {
			$data['user_create'] = $active_user;
			return $this->mdev_contract->insertData($data);
		}
		else {
			$data['user_update'] = $active_user;
			return $this->mdev_contract->updateContract($data, $id);
		}
	}

	function insert(){
		$id=$this->session->userdata('id');
		$dcontr_appname=$this->input->post('dcontr_appname');
		$dcontr_files_fk=$this->input->post('file_id');
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
			'dcontr_files_fk'=>$dcontr_files_fk,
            'dcontr_date'=>$dcontr_date,
            'dcontr_price'=>$dcontr_price,
            'dcontr_duration'=>$dcontr_duration,
			'dcontr_file_upload'=>$newfile_name
		);
		$this->mdev_contract->insertdata($data);
		redirect("Dev_contract");
	}

	public function delete($id) {
		$this->mdev_contract->deleteContract($id);
		redirect('dev_contract');
	}
	


}
?>