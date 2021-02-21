<?php 
class Consult_contract extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
		else if ($this->session->userdata('role') != 3) { // ketika bukan admin (id role admin adalah 3)
			redirect('dashboard'); //redirect ke halaman dashboard pengguna
		}
		$this->load->model('mconsult_contract');
        $this->load->model('mconsultation');
		$this->load->helper(array('url', 'form'));
		$active_user = $this->session->userdata('id');

	}

	function index() {
		$data['content'] = 'consult_contract/vconsult_contract_content.php';
		$data['breadcrumb'] = 'consult_contract/vconsult_contract_breadcrumb.php';
		$data['js'] = 'consult_contract/vconsult_contract_js.php';
		$data['css']= 'template/vdatatable_css.php';
		$data['contract'] = $this->mconsult_contract->getDataContract();
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function submit($id_consult){
		$data['id'] = $id_consult;
		$data['consult'] = $this->mconsult_contract->findDataConsult($id_consult);
		$data['pack'] = $this->mconsult_contract->getDataPack();
		$data['res'] = $this->mconsult_contract->getDataRes();
		$data['base_app'] = $this->mconsult_contract->getDataBaseApp();
		//$data['categories'] = $this->mconsult_contract->getDataCategories();
		$data['content'] = 'consult_contract/vconsult_contract_form.php';
		$data['js'] = 'consult_contract/vconsult_contract_js.php';
		$data['css'] = 'consult_contract/vconsult_contract_css.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function edit($contract_id){
		$data['id'] = $contract_id;
		$data['form'] = $this->mconsult_contract->findContract($contract_id);
		$data['content'] = 'consult_contract/vconsult_contract_edit_form.php';
		$data['js'] = 'template/vdatatable_js.php';
		$data['css'] = 'template/vdatatable_css.php';
		$data['pack'] = $this->mconsult_contract->getDataPack();
		$data['res'] = $this->mconsult_contract->getDataRes();
		$data['base_app'] = $this->mconsult_contract->getDataBaseApp();
		$data['discount'] = $this->mconsult_contract->getDataDiscount($contract_id);
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function insert(){
		$contract_id = $this->input->post('id');
		if ($this->input->post('id')) {
			$input = $this->input->post(NULL, TRUE);
			extract($input);
			$data = array(
				'sccontr_scavailpkg_fk' => $package,
				'sccontr_res_fk' => $resource,
				'sccontr_baseapp_fk' => $base_app,
				'sccontr_discount' => $discount,
			);
			$data['user_update'] = $this->session->userdata('id');
			if($this->mconsult_contract->updateContract($data, $id)){
				$this->session->set_userdata('typeNotif', 'successEditData');
				$url = "consult_contract/detail/$contract_id";
				redirect($url);
			}
		}
	}

	function detail($contract_id){
		$data['id'] = $contract_id;
		$data['contract'] = $this->mconsult_contract->findDataContract($contract_id);
		$data['fee'] = $this->mconsult_contract->findAddFee($contract_id);
		if($data['contract']->contract_end == 1){
			$this->detailEnd($data);
		}
		else{
			if($data['contract']->contract_cancel == 1){
				$this->detailDibatalkan($data);
			}
			else{
				if($data['contract']->total_attendances >= 1){
					$this->detailBerjalan($data);
				}
				else{
					$data['content'] = 'consult_contract/vconsult_contract_detail.php';
					$data['js'] = 'consult_contract/vconsult_contract_js.php';
					$data['css'] = 'consult_contract/vconsult_contract_css.php';
					$data['user_role'] = $this->session->userdata('role');
					$this->load->view('template/vtemplate.php', $data);
				}
			}
		}	
	}

	function detailEnd($data){
		$data['content'] = 'consult_contract/vconsult_contract_detail_end.php';
		$data['js'] = 'consult_contract/vconsult_contract_js.php';
		$data['css'] = 'consult_contract/vconsult_contract_css.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function detailDibatalkan($data){
		$data['content'] = 'consult_contract/vconsult_contract_detail_dibatalkan.php';
		$data['js'] = 'consult_contract/vconsult_contract_js.php';
		$data['css'] = 'consult_contract/vconsult_contract_css.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function detailBerjalan($data){
		$data['content'] = 'consult_contract/vconsult_contract_detail_berjalan.php';
		$data['js'] = 'consult_contract/vconsult_contract_js.php';
		$data['css'] = 'consult_contract/vconsult_contract_css.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function end($contract_id){
		$this->mconsult_contract->endContract($contract_id);
		redirect('Consult_contract');
	}

	function addFee($contract_id){
		$data['id'] = $contract_id;
		$data['content'] = 'consult_contract/vconsult_contract_add_fee.php';
		$data['js'] = 'consult_contract/vconsult_contract_js.php';
		$data['css'] = 'consult_contract/vconsult_contract_css.php';
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);	
	}

	function contract($consultation_id){
		$data = array(
			'sccontr_sconcs_fk' => $consultation_id,
			'sccontr_scavailpkg_fk' => $this->input->post('package'),
			'sccontr_res_fk' => $this->input->post('resource'),
			'sccontr_baseapp_fk' => $this->input->post('base_app'),
			'sccontr_discount' => $this->input->post('diskon'),
			'sccontr_end' => 0
			);
		
		$consultation = $this->mconsultation->get_by_id_consultations($consultation_id);
		$participant_code = $consultation->scons_participant_code;
		$image = $participant_code.'-'. time() .'-'.$_FILES['scfile_name']['name'];
		$new_name = str_replace(' ', '_', $image);

        //file upload code 
        //set file upload settings 
        $config['upload_path']          = './uploads/files/';
        $config['allowed_types']        = 'jpg|jpeg|png';
        $config['max_size']             = 99999999;
        $config['file_name']            = $new_name;
        $this->load->library('upload', $config);
		$this->upload->do_upload("scfile_name");

        $dataItem = array(
                'scfile_scons_fk' => $consultation_id,
                'scfile_fcategory_fk' => $this->input->post('categories'),
                'scfile_name' => $new_name
            );  
        $file_id = $this->input->post('categories');
        $dataItem['user_create'] = $this->session->userdata('id');
        $this->save($dataItem);
        $data['user_create'] = $this->session->userdata('id');
		if($this->mconsult_contract->insertContract($data)){
		$active_user = $this->session->userdata('id');
		$this->mconsult_contract->updateStatus($consultation_id, $active_user);
		$this->session->set_userdata('typeNotif', 'successAddData');
		redirect('consult_contract'); }
		else{
			$this->session->set_userdata('typeNotif', 'errorAddData');
			redirect('consult_contract');
		}
		
	}

	function save($dataItem) {
        return $this->mconsult_contract->saveData($dataItem);
    }

	function submitAddFee(){
		$input = $this->input->post(NULL, TRUE);
		extract($input);

		$data = array(
			'scadd_fee_scccontr_fk' => $contract_id,
			'scadd_fee_add_attd' => $add_attd,
			'scadd_fee_desc' => $desc,
			'scadd_fee_amt'  => $fee
			);
		$data['user_create'] = $this->session->userdata('id');
		if($this->mconsult_contract->insertAddFee($data)){
			$this->session->set_userdata('typeNotif', 'successAddData');
			redirect('consult_contract/detail/'.$contract_id);}
		else{
			$this->session->set_userdata('typeNotif', 'errorAddData');
			redirect('consult_contract/detail/'.$contract_id);
		}
	}

	function editFee($id_fee){
		$data['id'] = $id_fee;
		$data['content'] = 'consult_contract/vconsult_contract_edit_fee.php';
		$data['js'] = 'template/vdatatable_js.php';
		$data['css'] = 'template/vdatatable_css.php';
		$data['fee'] = $this->mconsult_contract->getDataFee($id_fee);
		$data['user_role'] = $this->session->userdata('role');
		$this->load->view('template/vtemplate.php', $data);
	}

	function submitEditedAddFee(){
		$data = array(
			'scadd_fee_amt' =>  $this->input->post('fee_amt'),
			'scadd_fee_desc' =>  $this->input->post('desc'),
			'scadd_fee_add_attd' =>  $this->input->post('attd'),
			'user_update' => $this->session->userdata('id')
		);
		$id =  $this->input->post('id');
		
		$fee = $this->mconsult_contract->findAddFeeById($id);
		$redirect = "consult_contract/detail/$fee->scadd_fee_scccontr_fk";
		if($this->mconsult_contract->updateAddFee($data, $id)) {
			$this->session->set_userdata('typeNotif', 'successEditData');
			redirect($redirect);
			}
		else{
			$this->session->set_userdata('typeNotif', 'errorAddData');
			redirect($redirect);
		}
	}

	function deleteFee($id){
		$fee = $this->mconsult_contract->findAddFeeById($id);
		$redirect = "consult_contract/detail/$fee->scadd_fee_scccontr_fk";

		if($this->mconsult_contract->deleteAddFee($id)){
			$this->session->set_userdata('typeNotif', 'successDeleteData');
			redirect($redirect);
		}
		else{
			$this->session->set_userdata('typeNotif', 'errorDeleteData');
			redirect($redirect);
		}
	}

	function batalKontrak($id){
		if($this->mconsult_contract->batalKontrak($id)){
			$this->session->set_userdata('typeNotif', 'successEditData');
			redirect('consult_contract'); }
		else{
			$this->session->set_userdata('typeNotif', 'errorEditData');
			redirect('consult_contract');
		}
	}

	function pulihkanKontrak($id){
		if($this->mconsult_contract->pulihkanKontrak($id)){
			$this->session->set_userdata('typeNotif', 'successEditData');
			redirect('consult_contract'); 
		}
		else{
			$this->session->set_userdata('typeNotif', 'errorEditData');
			redirect('consult_contract');
		}
	}

	function lanjutkanKontrak($id){
		if($this->mconsult_contract->lanjutkanKontrak($id)){
			$this->session->set_userdata('typeNotif', 'successEditData');
			redirect('consult_contract'); 
		}
		else{
			$this->session->set_userdata('typeNotif', 'errorEditData');
			redirect('consult_contract');
		}
	}
	
}
?>