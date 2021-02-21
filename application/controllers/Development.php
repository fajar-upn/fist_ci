<?php
class Development extends CI_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('Mdevelopment_submitfile');
	}

	function index()
	{
		$role = $this->session->userdata('role');
		$data['breadcrumb'] = 'development/vdev_files_form_breadcrumb.php';
		$data['css'] = 'development/vdev_files_form_css.php';
		$data['js'] = 'development/vdev_files_form_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$data['content'] = 'development/vform_submitfile.php';

		if ($role == '3') {
			$this->load->view('template/vtemplate', $data);
		} else if ($role == '4') {
			$this->load->view('development/vread_file_analyst');
		}
	}

	function insert_data()
	{

		$uprof_full_name = $this->input->post('uprof_full_name');
		$uacc_email = $this->input->post('uacc_email');

		$uprof_phone = $this->input->post('uprof_phone');

		$data_akun = array(
			'uacc_username' => $uprof_full_name,
			'uacc_email' => $uacc_email,
			'uacc_urole_fk' => 5,
			'uacc_password' => '25d55ad283aa400af464c76d713c07ad',
			'uacc_active' => 1,
			'uacc_suspend' => 1
		);

		$this->Mdevelopment_submitfile->insert_account($data_akun);
		$client = $this->Mdevelopment_submitfile->get_account($uacc_email);
		$client_id = $client->uacc_id;

		$data_profile = array(
			'uprof_uacc_fk' => $client_id,
			'uprof_full_name' => $uprof_full_name,
			'uprof_phone' => $uprof_phone,
		);

		$this->Mdevelopment_submitfile->insertprofile($data_profile);

		$dfiles_appdesc = $this->input->post('dfiles_appdesc');
		$dfiles_agency = $this->input->post('dfiles_agency');
		$zip = $_FILES["zip"];
		$namafile = basename($zip["name"]);
		$newfile_name = str_replace(" ", "_", $namafile);

		$filepath = "uploads/" . $newfile_name;
		move_uploaded_file($zip["tmp_name"], $filepath);

		$datafile = array(
			'dfiles_upload'  => $newfile_name,
			'dfiles_agency' => $dfiles_agency,
			'dfiles_appdesc' => $dfiles_appdesc,
			'dfiles_uacc_fk' => $client_id,
			'dfiles_status' => 't',
		);

		$this->Mdevelopment_submitfile->insertfile($datafile);

		redirect("development/readData");
	}

	function readData()
	{
		$file = $this->Mdevelopment_submitfile->read();
		$data['files'] = $file;
		$data['breadcrumb'] = 'development/vdev_files_breadcrumb.php';
		$data['css'] = 'development/vdev_files_css.php';
		$data['js'] = 'development/vdev_files_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$data['content'] = 'development/vread_file.php';
		$this->load->view('template/vtemplate', $data);
	}

	function readDataAnalyst()
	{
		$file = $this->Mdevelopment_submitfile->read();
		$data['files'] = $file;
		$data['breadcrumb'] = 'development/vdev_files_breadcrumb.php';
		$data['css'] = 'development/vdev_files_css.php';
		$data['js'] = 'development/vdev_files_js.php';
		$data['user_role'] = $this->session->userdata('role');
		$data['content'] = 'development/vread_file_analyst.php';
		$this->load->view('template/vtemplate', $data);
	}

	function check($id)
	{
		$data = array(
			'dfiles_status' => 'y'
		);
		$this->Mdevelopment_submitfile->update($data, $id);
		redirect("development/readDataAnalyst/");
	}

	function uncheck($id)
	{
		$data = array(
			'dfiles_status' => 't'
		);
		$this->Mdevelopment_submitfile->update($data, $id);
		redirect("development/readDataAnalyst/");
	}

	function send_email($email, $for)
	{
		// set up email
		$config = array(
			'protocol'    => 'smtp',
			'smtp_host'    => 'smtp.elasticemail.com',
			'smtp_port'    => 2525,
			'smtp_user'    => 'sanchez26refa@gmail.com',
			'smtp_pass'    => '7DA37CA659CFEE9B0AF1EBC29561138305A6',
			'mailtype'    => 'html',
			'charset'    => 'iso-8859-1',
			'wordwrap'    => TRUE
		);

		$this->load->library('email', $config);  // load library email
		if ($for == "email-files") {
			$message = "
			<!doctype html>
			<html>
			  <head>
				<title>Berkas Telah Diterima</title>
			  </head>
			  <body>
				<div>
					<h2>Halo, terima kasih telah mengirim berkas development!</h2>
				</div>
			  </body>
			</html>
		";
			$this->email->subject('Email Penerimaan Berkas');
		}

		$this->email->set_newline("\r\n");
		$this->email->from($config['smtp_user']);
		$this->email->to($email);
		$this->email->message($message);
		$this->email->send();
	}

	public function download($dfiles_id)
	{
		//get file name
		$file = $this->Mdevelopment_submitfile->get_by_id($dfiles_id);
		$file_name = $file->dfiles_upload;

		//memberikan direktori file download dan nama file
		$url = "localhost/uploads/" . $file_name;

		//load download helper
		$this->load->helper('download');

		//download file from $url
		force_download($file_name, $url);

		// echo '<pre>';
		// print_r($url);
		// //print_r($_SERVER);
		// die();
		$this->session->set_userdata('typeNotif', 'fileDownloaded');
		$urlhome = "development/readData";
		redirect($urlhome);
	}
}
