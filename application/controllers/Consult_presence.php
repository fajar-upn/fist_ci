<?php

class consult_presence extends CI_Controller {

    //put your code here
    function __construct() {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
			$this->session->set_userdata('typeNotif', 'notLoggedIn');
			redirect('auth'); //redirect kehalaman login
		}
        
        $this->load->model('Mconsult_presence');
        $this->load->library('form_validation');
    }

    /*
 * return semua data barang 
 */
    function index() {
        
        $data['schedule'] = $this->Mconsult_presence->get_list_schedules();
        foreach ($data['schedule'] as $key => $val) {
			if (!empty($val->scattd_date)) {
				$data['schedule'][$key]->scattd_date	= $this->convert_date($val->scattd_date);
			}
		}
        $data['user_role'] = $this->session->userdata('role');
        // echo "<pre>"; print_r($data);exit;
        $data['breadcrumb'] = 'consult_presence/vpresence_breadcrumb';
        $data['content'] = 'consult_presence/vpresence.php';
        $data['js'] = 'training_presence/vPresence_js';
        $data['css'] = 'training_presence/vPresence_css';
        $this->load->view('template/vtemplate.php', $data);
    }

    /*
     *menyimpan data fis_rbarang berdasarkan id_barang
     */
    private function save($data, $idBarang = 0) {
        return $this->Mconsult_presence->saveData($data, $idBarang);
    }

    /*
     * menghapus data fis_rbarang berdasarkan id_barang
     */
  
    function form($id = 0) {
        /*
         * apabila id=0, ini menandakan akan menambah data
         */
        
        if ($this->input->post('submitPresence')) {
            $input = $this->input->post(NULL,TRUE);
            extract($input);
            /*
             * dengan membawa id_barang beserta data yang telah di input
             */
            if (isset($id_Presence)) {
                $idPresence = $id_Presence;
            }
            
            $dataItem = array(
                'scattd_date' => $date,
                'scattd_time_start' => $TimeStart,
                'scattd_time_end' => $TimeFinish,
                'scattd_status' => $status,
                'scattd_scclass_fk' => $name
            );
            //print_r($dataItem);die;
            if ($branchId = $this->saves($dataItem, $idPresence)) {
                redirect("consult_presence");
            }
        } else {
            

            $obj = new stdClass();
            $obj->scclass_id = '';
            $obj->tentor = '';
            $obj->mahasiswa = '';
            $obj->scattd_date = '';
            $obj->scattd_id =$id;
            $obj->scattd_time_start = '';
            $obj->scattd_time_end = '';
            $obj->scattd_status = '';
            
            // Ubah
            if ($id != 0) {
                $obj = $this->Mconsult_presence->get_by_ids($id);
    
            } 

                $data['kelas'] =$this->Mconsult_presence->get_list_kelas();
                $data['data'] = $obj; 
                //echo '<pre>'; print_r($data);die;
                $data['breadcrumb'] = 'consult_presence/vpresence_breadcrumb';
                $data['content'] = 'consult_presence/vform.php';
                $data['user_role'] = $this->session->userdata('role');
                $data['js'] = 'training_presence/vPresence_js';
                $data['css'] = 'training_presence/vPresence_css';
                $this->load->view('template/vtemplate', $data);
              
        }
    }


    private function saves($data, $idBarang = 0) {
        return $this->Mconsult_presence->saveData($data, $idBarang);
        $this->session->set_userdata('typeNotif', 'successAddPresenceConsult');
    }


    function delete($id) {
        if ($this->Mconsult_presence->delete($id)) {
            $this->session->set_userdata('typeNotif', 'successDeletePresenceConsult');
            redirect('consult_presence'); 
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

