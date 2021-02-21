<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Barang
 *
 * @author annesams
 */
class Training_Presence extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
        $this->load->model('Mtraining_presence');
        $this->load->library('form_validation');
    }

    /*
 * return semua data barang 
 */
    function index() {
        
        $data['schedule'] = $this->Mtraining_presence->get_list_schedules();
        $data['user_role'] = $this->session->userdata('role');
        $data['content'] = 'training_presence/vPresence.php';
        $data['js'] = 'training_presence/vPresence_js';
        $data['css'] = 'training_presence/vPresence_css';
        
        $this->load->view('template/vtemplate.php', $data);
    } 

    /*
     * add &  edit berdasarkan id_barang
     */
    function get($id){
        $obj = $this->Mtraining_presence->getData($id);        
        $data['data'] = $obj; 
        $data['schedule'] = $this->Mtraining_presence->cari($id);
        foreach ($data['schedule'] as $key => $val) {
			if (!empty($val->tattd_date)) {
				$data['schedule'][$key]->tattd_date	= $this->convert_date($val->tattd_date);
			}
		}
        $data['user_role'] = $this->session->userdata('role');
        $data['breadcrumb'] = 'training_presence/vpresence_breadcrumb';
        $data['content'] = 'training_presence/vPresence.php';
        $data['js'] = 'training_presence/vPresence_js';
        $data['css'] = 'training_presence/vPresence_css';
        $data['css'] = 'template/vdatatable_css';
        
        $this->load->view('template/vtemplate.php', $data);

    }
    /*
     *menyimpan data fis_rbarang berdasarkan id_barang
     */
    private function save($data, $idBarang = 0) {
        return $this->Mtraining_presence->saveData($data, $idBarang);
    }

    /*
     * menghapus data fis_rbarang berdasarkan id_barang
     */
    function delete($id) {
        if ($this->Mtraining_presence->delete($id)) {
            redirect('Training_Presence'); 
        }
    }

    function schedules() {
        $data['schedule'] = $this->Mtraining_presence->get_list_schedules();
        $data['user_role'] = $this->session->userdata('role');
        $data['content'] = 'training_presence/vPresence.php';
        $data['js'] = 'training_presence/vPresence_js.php';
        $data['css'] = 'training_presence/vPresence_css.php';
        $this->load->view('template/vtemplate.php', $data);
    }

    function formschedules($idClass=0,$id=0) {
        
        /*
         * apabila id=0, ini menandakan akan menambah data
         */
                //print_r($id);exit;
                // $obj = $this->Mtraining_presence->getData($id);
                // $meet = $this->Mtraining_presence->getMeeting($id);
                // // print_r($meet);exit;
                // $data['meet'] = $meet;
                // $data['data'] = $obj; 
                // $data['content'] = 'training_presence/vform.php'; 
                // $data['user_role'] = $this->session->userdata('role');
                // $data['js'] = 'training_presence/vPresence_js';
                // $data['css'] = 'training_presence/vPresence_css';
                // $this->load->view('template/vtemplate', $data);        
        if ($this->input->post('submitPresence')) {
            
            $input = $this->input->post(NULL,TRUE);
            extract($input);
            // echo "<pre>"; print_r($input);exit;
            /*
             * dengan membawa id_barang beserta data yang telah di input
             */
            
            if (isset($id_Presence)) {
                $idPresence = $id_Presence;
            }if (isset($id_Class)) {
                $idClass = $id_Class;
            }
            
            
            $dataItem = array(
                'tattd_date' => $date,
                'tattd_timestart' => $TimeStart,
                'tattd_timefinish' => $TimeFinish,
                'tattd_status' => $status,
                'tattd_tcontr_fk' => $name
            );
            // echo "<pre>"; print_r($dataItem);exit;
            // if ($this->form_validation->run() == FALSE)
            // {
            //         $this->load->view('myform');
            // }
            // else
            // {
            //         $this->load->view('formsuccess');
            // }
            
            if ($branchId = $this->saves($dataItem, $idPresence)) {
                redirect("Training_Presence/get/$idClass");
            }
        } else {
            

            $obj = new stdClass();
            $obj->tcontr_id = null;
            $obj->tclass_id = $idClass;
            $obj->mahasiswa = '';
            $obj->tattd_date = '';
            $obj->tattd_id =$id;
            $obj->tattd_timestart = '';
            $obj->tattd_timefinish = '';
            $obj->tattd_status = '';
            // Ubah
            if ($id != 0) {
                $obj = $this->Mtraining_presence->editData($id);
                // print_r($obj);exit;
    
            } 
                
                $data['kelas'] =$this->Mtraining_presence->get_by_ids($idClass);
                $data['data'] = $obj; 
                $data['content'] = 'training_presence/vform.php'; 
                $data['user_role'] = $this->session->userdata('role');
                $data['js'] = 'training_presence/vPresence_js';
                $data['breadcrumb'] = 'training_presence/vpresence_breadcrumb';
                $data['css'] = 'training_presence/vPresence_css.php';
                $this->load->view('template/vtemplate', $data);
              
        }
    }

    function searchid(){
        
        $idClass=$_GET['idClass'];
        $data =$this->Mtraining_presence->cari($idClass)->result();
        echo json_encode($data);

        
    }
    private function saves($data, $idBarang = 0) {
        return $this->Mtraining_presence->saveData($data, $idBarang);
    }


    function deleteschedule($idClass,$id) {
        // print_r($idClass);exit;
        if ($this->Mtraining_presence->deleteSchedule($id)) {
            $this->session->set_userdata('typeNotif', 'successDeletePresenceTraining');
            redirect("Training_Presence/get/$idClass"); 
        }
    }

    private function convert_date($date) {
		$split_date			= explode("-", $date);
		$year				= $split_date[0];
		$month				= (int) $split_date[1];
		$day				= $split_date[2];

		if		($month == 1)	{ $month = "Januari"; }
		else if ($month == 2)	{ $month = "Februari"; }
		else if ($month == 3)	{ $month = "Maret"; }
		else if ($month == 4)	{ $month = "April"; }
		else if ($month == 5)	{ $month = "Mei"; }
		else if ($month == 6)	{ $month = "Juni"; }
		else if ($month == 7)	{ $month = "Juli"; }
		else if ($month == 8)	{ $month = "Agustus"; }
		else if ($month == 9)	{ $month = "September"; }
		else if ($month == 10)	{ $month = "Oktober"; }
		else if ($month == 11)	{ $month = "November"; }
		else if ($month == 12)	{ $month = "Desember"; }

		$final_convert = $day . " " . $month . " " . $year;
		return $final_convert;
	}

}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

