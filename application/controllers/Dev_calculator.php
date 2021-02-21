<?php
class Dev_calculator extends CI_Controller{
	function __construct(){
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != 3) { // ketika bukan admin (id role admin adalah 3)
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('mdev_calculator');
		$this->load->model('mdev_contract');
        $this->load->helper(array('form', 'url'));
	}

	function index(){
		$data['dev_files'] = $this->mdev_calculator->get_dev_files();
		$data['dificulties'] = $this->mdev_calculator->get_difficulties();
		$data['breadcrumb']= 'develop/vform_calculator_breadcrumb.php';
		$data['js']= 'develop/vform_calculator_js.php';
		$data['content']='develop/vform_calculator.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate', $data);
	}

	public function get_json_dificulties()
	{
		$dificulties =  $this->mdev_calculator->get_difficulties();
		$json = json_encode($dificulties);
		echo $json;
	}

	function insert(){
		$id=$this->session->userdata('id');
		$input = $this->input->post(NULL, TRUE);
		extract($input);
		
		$zip = $_FILES["zip"];
		$namafile = basename($zip["name"]);
		$newfile_name = str_replace(" ", "_", $namafile);

		$filepath = "uploads/files/" . $newfile_name;
		move_uploaded_file($zip["tmp_name"], $filepath);
		
		$data = array(
			'dcontr_files_fk'=>$dcontr_files_fk,
			'dcontr_appname'=>$dcontr_appname,
            'dcontr_date'=>$dcontr_date,
            'dcontr_price'=>$dcontr_price,
            'dcontr_duration'=>$dcontr_duration,
			'dcontr_file_upload'=>$newfile_name,
			'user_create'=>$id
		);
		
		echo ($this->mdev_contract->insertdata($data));
	}

	public function insertFitur(){
		if(isset($_POST)){
			if(isset($_POST['data'])){
			$data = $_POST['data'];
			$this->mdev_contract->insertFitur($data);
			print_r($data);
		}}
	}

	public function InsertMonitoring(){
		$id=$this->session->userdata('id');
	}

	public function delete($id)
	{
		if ($this->mdev_calculator->delete($id)) {
				redirect('dev_calculator');
		}
	}

	public function deleteall()
	{
		if ($this->mdev_calculator->deleteall()) {
				redirect('Dev_calculator');
		}
	}
}
?>