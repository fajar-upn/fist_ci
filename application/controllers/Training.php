<?php

class Training extends CI_Controller
{
    /**
     * load model Muser, Mtraining_class, dan Mtraining_student
     * Training constructor.
     */
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) { // ketika belum login
            $this->session->set_userdata('typeNotif', 'notLoggedIn');
            redirect('auth'); //redirect kehalaman login
        } else if ($this->session->userdata('role') != 3 and $this->session->userdata('role') != 2 and $this->session->userdata('role') != 6) { // ketika bukan admin (id role admin adalah 3, id role developer adalah 2)
            redirect('dashboard'); //redirect ke halaman dashboard pengguna
        }
        $this->load->model('Mtraining_schedule');
        $this->load->model('Mtraining_payment');
        $this->load->model('Muser_role');
        $this->load->model('Muser_account');
        $this->load->model('Muser_profile');
        $this->load->model('Mtraining_class');
        $this->load->model('Mtraining_student');
        $this->load->model('Mtraining_package');
        $this->load->model('Mtraining_contract');
    }

    /**
     * load halaman daftar kelas
     */
    function index()
    {
        $data['class'] = $this->Mtraining_class->get_list_class();
        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['content'] = 'training/vtable_class';
        $data['breadcrumb'] = 'training/vtable_class_breadcrumb';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    /**
     * input data ke tabel fis_dtraining_classes dan fis_dtraining_students
     */
    function form_class($id = 0)
    {
        //jika di klik tombol submit maka akan masuk ke if, jika tidak masuk ke else
        if ($this->input->post('submitClass')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            //dicek apakah tclass_id itu kosong atau tidak
            if (isset($tclass_id)) {
                $class_id = $tclass_id;
            }

            $dataClass = array(
                'tclass_name' => $class_name,
                'tclass_tentor_fk' => $tentor_id,
                'tclass_tptype_fk' => $packtype_id,
                'tclass_status' => $status
            );

            //input data ke tabel fis_dtraining_classes
            if ($classId = $this->saveClass($dataClass, $class_id)) {

                if ($class_id == 0) {
                    $dataStudent = array(
                        'tstudt_tclass_fk' => $classId
                    );

                    if ($branchId = $this->saveStudent($dataStudent, $classId)) {
                        redirect("training/table_participant/" . $classId);
                    }
                }
                redirect("training");
            }
        } else {
            //deklarasi obj baru
            $obj = new stdClass();
            $obj->tclass_id = $id;
            $obj->tclass_name = '';
            $obj->tclass_tptype_fk = '';
            $obj->tclass_mentor_fk = '';
            $obj->tclass_status = '';

            // Ubah
            if ($id != 0) {
                //mengambil data berdasarkan id
                $obj = $this->Mtraining_class->get_by_id($id);
            }
            $data['data'] = $obj;


            $statuses = array(
                array(
                    'value' => 1,
                    'desc' => 'Belum Berlangsung'
                ),
                array(
                    'value' => 2,
                    'desc' => 'Sedang Berlangsung'
                ),
                array(
                    'value' => 3,
                    'desc' => 'Sudah Selesai'
                )
            );

            $data['status'] = $statuses;
            $data['class'] = $this->Mtraining_package->get_package();
            $data['users'] = $this->Muser_account->get_by_role_id(6);
            $data['content'] = 'training/vform_class.php';
            $data['breadcrumb'] = 'training/vform_class_breadcrumb';
            $data['css'] = 'training/vform_css';
            $data['js'] = 'training/vform_js';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate.php', $data);
        }
    }

    /**
     * load halaman daftar peserta yang tergabung dalam kelas yang dipilih
     * @param $tclass_id
     */
    function table_participant($tclass_id)
    {
        $data['id'] = $tclass_id;
        $data['participant'] = $this->Mtraining_class->get_id($tclass_id);
        // extract($data['participant']);
        $data['details'] = $this->Mtraining_class->get_by_id($tclass_id);
        // echo "<pre>";
        // print_r($data['participant']);
        // exit;
        // $data['payment'] = $this->Mtraining_payment->get_total_payment($tcontr_id);
        $data['content'] = 'training/vtable_participant.php';
        $data['breadcrumb'] = 'training/vtable_participant_breadcrumb';
        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    /**
     * registrasi peserta dan memasukkannya ke tabel fis_duser_accounts dan fis_duser_profiles
     */
    function form_participant($classId = null, $id = 0)
    {
        $this->load->model('mauth');
        $this->load->helper(array('form', 'url'));
        if ($this->input->post('submitTraining')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($uacc_id)) {
                $uaccId = $id;
            }

            // echo "<pre>";
            // print_r($uaccId);
            // exit;

            $token = $this->mauth->generate_token();
            $dataAccount = array(
                'uacc_urole_fk' => '5',
                'uacc_email' => $email,
                'uacc_username' => $nik,
                'uacc_password' => md5('12345678'),
                'uacc_active' => '1',
                'uacc_suspend' => '1',
                'uacc_token' => $token
            );
            if ($uaccId == 0) {
                if ($AccountId = $this->saveAccount($dataAccount, $uaccId)) {
                    $dataProfile = array(
                        'uprof_uacc_fk' => $AccountId,
                        'uprof_full_name' => $name,
                        'uprof_gender' => $gender,
                        'uprof_birth_date' => $birth_date,
                        'uprof_birth_place' => $birth_place,
                        'uprof_phone' => $phone,
                        'uprof_address' => $address,
                        'uprof_sosmed' => $sosmed,
                        'uprof_institution' => $institution
                    );

                    if ($ProfileId = $this->saveProfile($dataProfile, $AccountId)) {

                        //file rename code
                        $image = time() . '-' . $_FILES['tfile_name']['name'];
                        //replace ' ' to '_' on file name
                        $new_name = str_replace(' ', '_', $image);
                        //file upload code 
                        //set file upload settings 

                        $config['upload_path']          = '../uploads/files/';
                        $config['allowed_types']        = 'pdf|jpg|png|jpeg|docx|doc|xls|xlsx';
                        $config['overwrite']            = true;
                        $config['max_size']             = 3072; //3MB
                        $config['file_name']            = $new_name;

                        $this->load->library('upload', $config);
                        $this->upload->do_upload('tfile_name');

                        $dataContract = array(
                            'tcontr_uacc_fk' => $AccountId,
                            'tcontr_date' => $contr_date,
                            'tcontr_discount' => $discount,
                            'tcontr_file_name' => $new_name
                        );

                        if ($contractId = $this->saveContract($dataContract)) {

                            $dataStudent = array(
                                'tstudt_tcontr_fk' => $contractId,
                                'tstudt_tclass_fk' => $class_id
                            );

                            if ($branchId = $this->saveStudent($dataStudent)) {
                                redirect("training/table_participant/" . $class_id);
                            }
                        }
                    }
                }
            } else {
                if ($AccountId = $this->updateAccount($dataAccount, $uaccId)) {
                    $dataProfile = array(
                        'uprof_full_name' => $name,
                        'uprof_gender' => $gender,
                        'uprof_birth_date' => $birth_date,
                        'uprof_birth_place' => $birth_place,
                        'uprof_phone' => $phone,
                        'uprof_address' => $address,
                        'uprof_sosmed' => $sosmed,
                        'uprof_institution' => $institution
                    );

                    if ($ProfileId = $this->saveProfile($dataProfile, $uaccId)) {
                        $dataContract = array(
                            // 'tcontr_uacc_fk' => $AccountId,
                            'tcontr_date' => $contr_date,
                            'tcontr_discount' => $discount,
                        );

                        if ($contractId = $this->saveContract($dataContract, $uaccId)) {
                            redirect("training/table_participant/" . $class_id);
                        }
                    }
                }
            }
        } else {
            $obj = new stdClass();
            $obj->uacc_id = $id;
            $obj->uprof_full_name = '';
            $obj->uprof_gender = '';
            $obj->uprof_birth_date = '';
            $obj->uprof_birth_place = '';
            $obj->uprof_phone = '';
            $obj->uprof_sosmed = '';
            $obj->uprof_address = '';
            $obj->uprof_institution = '';
            $obj->uacc_email = '';
            $obj->uacc_username = '';
            $obj->tcontr_discount = '';
            $obj->tcontr_date = '';

            // echo "<pre>";
            // print_r($obj->tclass_id);
            // exit;

            // Ubah
            if ($id != 0) {

                $obj = $this->Mtraining_contract->get_by_uacc_id($id);
            }
            $obj->tclass_id = $classId;
            $data['data'] = $obj;
            $data['content'] = 'training/vform_participant.php';
            $data['breadcrumb'] = 'training/vform_participant_breadcrumb';
            $data['css'] = 'training/vform_css';
            $data['js'] = 'training/vform_js';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate.php', $data);
        }
    }

    private function saveProfile($data, $uacc_id)
    {
        return $this->Muser_profile->update($data, $uacc_id);
    }

    private function saveAccount($data, $uacc_id = 0)
    {
        return $this->Muser_account->insert($data);
    }

    private function updateAccount($data, $uacc_id = 0)
    {
        return $this->Muser_account->update($data, $uacc_id);
    }

    private function saveContract($data, $uacc_id = 0)
    {
        if ($uacc_id == 0) {

            return $this->Mtraining_contract->insert($data);
        } else {
            return $this->Mtraining_contract->update($data, $uacc_id);
        }
    }

    function table_payment($classId = null, $tcontr_id)
    {
        $data['pymt'] = $this->Mtraining_payment->get_total_payment($tcontr_id);
        $data['classId'] = $classId;
        $data['pymts'] = $this->Mtraining_payment->get_by_contr_id($tcontr_id);
        foreach ($data['pymts'] as $key => $val) {
			if (!empty($val->tpymt_date)) {
				$data['pymts'][$key]->tpymt_date = $this->convert_date($val->tpymt_date);
			}
		}
        $data['detail'] = $this->Mtraining_student->get_by_contr_id($tcontr_id);
        // echo "<pre>";
        // print_r($data['pymts']);
        // exit();
        $data['id'] =  $tcontr_id;
        $data['content'] = 'training/vtable_payment.php';
        $data['breadcrumb'] = 'training/vtable_payment_breadcrumb';
        $data['css'] = 'template/vdatatable_css.php';
        $data['js'] = 'training/vtable_js';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }


    /**
     * function untuk insert data ke tabel fis_dtraining_classes
     * @param $data
     * @param $tclass_id
     */
    private function saveClass($data, $tclass_id = 0)
    {
        return $this->Mtraining_class->saveData($data, $tclass_id);
    }

    private function saveStudent($data)
    {
        return $this->Mtraining_student->insert($data);
    }

    /**
     * melakukan penghapusan data kelas berdasarkan id
     * @param $id
     */
    public function deleteClass($id)
    {
        $this->Mtraining_class->delete($id);
        redirect('training');
    }


    function table_contract($classId = null, $id)
    {
        $data['contracts'] = $this->Mtraining_contract->get_by_id($id);
        $data['contracts']->tcontr_date = $this->convert_date($data['contracts']->tcontr_date);
        $data['classId'] = $classId;
        // echo "<pre>";
        // print_r($data['contracts']);
        // exit();
        $data['content'] = 'training/vtable_contract.php';
        $data['breadcrumb'] = 'training/vtable_contract_breadcrumb';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    private function savePayment($data, $tpymt_id)
    {
        return $this->Mtraining_payment->saveData($data, $tpymt_id);
    }

    public function deletePayment($classId = null, $tcontr_id = null, $id = 0)
    {
        $this->Mtraining_payment->delete($id);
        redirect('Training/table_payment/' . $classId . '/' . $tcontr_id);
    }

    function form_payment($classId = null, $tcontr_id = null, $id = 0)
    {

        //jika di klik tombol submit maka akan masuk ke if, jika tidak masuk ke else
        if ($this->input->post('submitPayment')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            //dicek apakah tclass_id itu kosong atau tidak
            if (isset($tpymt_id)) {
                $pymt_id = $tpymt_id;
            }
            // print_r($pymt_id);
            // exit;

            $dataPayment = array(
                'tpymt_tcontr_fk' => $tcontr_id,
                'tpymt_date' => $pymt_date,
                'tpymt_receipt' => $pymt_receipt,
                'tpymt_detail' => $pymt_detail,
                'tpymt_amt' => $pymt_amount,
                'tpymt_admin' => $pymt_admin
            );

            //input data ke tabel fis_dtraining_classes
            if ($branchId = $this->savePayment($dataPayment, $pymt_id)) {
                redirect('Training/table_payment/' . $classId . '/' . $tcontr_id);
            }
        } else {
            //deklarasi obj baru
            $obj = new stdClass();
            $obj->tpymt_id = $id;
            $obj->tpymt_tcontr_fk = $tcontr_id;
            $obj->tpymt_date = '';
            $obj->tpymt_receipt = '';
            $obj->tpymt_detail = '';
            $obj->tpymt_amt = '';
            $obj->tpymt_admin = '';


            // Ubah
            if ($id != 0) {
                //mengambil data berdasarkan id
                $obj = $this->Mtraining_payment->get_by_id($id);
            }

            $data['id'] = $tcontr_id;
            $data['classId'] = $classId;
            $data['data'] = $obj;
            $data['content'] = 'training/vform_payment.php';
            $data['breadcrumb'] = 'training/vform_payment_breadcrumb';
            $data['css'] = 'training/vform_css';
            $data['js'] = 'training/vform_js';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate.php', $data);
        }
    }


    function table_schedule($tclass_id)
    {
        $data['id'] = $tclass_id;
        $data['scheds'] = $this->Mtraining_schedule->get_by_class($tclass_id);
        foreach ($data['scheds'] as $key => $val) {
			if (!empty($val->tsched_date)) {
				$data['scheds'][$key]->tsched_date = $this->convert_date($val->tsched_date);
			}
		}
        $data['detail'] = $this->Mtraining_class->get_by_id($tclass_id);
        $data['content'] = 'training/vtable_schedule.php';
        $data['breadcrumb'] = 'training/vtable_schedule_breadcrumb';
        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    function table_schedule_mentor()
    {
        $role = $this->session->userdata("role");
        $uacc_id = $this->session->userdata("id");
        $data['scheds'] = $this->Mtraining_schedule->get_list_schedule_mentor($uacc_id);
        $data['content'] = 'training/vtable_schedule_mentor.php';
        $data['breadcrumb'] = 'training/vtable_schedule_mentor_breadcrumb';
        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    private function saveSchedule($data, $tsched_id = 0)
    {
        return $this->Mtraining_schedule->saveData($data, $tsched_id);
    }

    public function deleteSchedule($id, $class_id)
    {
        $this->Mtraining_schedule->delete($id);
        redirect('training/table_schedule' . '/' . $class_id);
    }

    function form_schedule($classId = null, $id = 0)
    {

        //jika di klik tombol submit maka akan masuk ke if, jika tidak masuk ke else
        if ($this->input->post('submitSchedule')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            //dicek apakah tclass_id itu kosong atau tidak
            if (isset($id)) {
                $sched_id = $id;
            }

            // echo "<pre>";
            // print_r($classId);
            // exit;

            $dataSchedule = array(
                'tsched_tclass_fk' => $classId,
                'tsched_date' => $class_date,
                'tsched_time_start' => $time_start,
                'tsched_time_finish' => $time_finish
            );

            //input data ke tabel fis_dtraining_classes
            if ($SchedId = $this->saveSchedule($dataSchedule, $sched_id)) {
                redirect('training/table_schedule/' . $classId);
            }
        } else {
            //deklarasi obj baru
            $obj = new stdClass();
            $obj->tsched_id = $id;
            $obj->tsched_tclass_fk = $classId;
            $obj->tsched_date = '';
            $obj->tsched_time_start = '';
            $obj->tsched_time_finish = '';


            // Ubah
            if ($id != 0) {
                //mengambil data berdasarkan id
                $obj = $this->Mtraining_schedule->get_by_id($id);
            }
            $data['data'] = $obj;
            $data['content'] = 'training/vform_schedule.php';
            $data['breadcrumb'] = 'training/vform_schedule_breadcrumb';
            $data['user_role'] = $this->session->userdata('role');
            $data['css'] = 'training/vform_css';
            $data['js'] = 'training/vform_js';
            $this->load->view('template/vtemplate.php', $data);
        }
    }

    public function download($classId = null, $tcontr_id)
    {
        //get file name
        $file = $this->Mtraining_contract->get_by_id($tcontr_id);
        $file_name = $file->tcontr_file_name;
        // echo "<pre>";
        // print_r($file_name);
        // exit;

        //memberikan direktori file download dan nama file
        $url = '../uploads/files/' . $file_name;
        // echo "<pre>";
        // print_r($url);
        // exit;

        //load download helper
        $this->load->helper('download');

        //download file from $url
        force_download($url, null);

        // echo '<pre>';
        // print_r($url);
        // //print_r($_SERVER);
        // die();
        $this->session->set_userdata('typeNotif', 'fileDownloaded');
        redirect('training/table_participant/' . $classId);
    }

    /**
	 * mengubah format date yang semula YYYY-MM-DD menjadi DD MM YYYY
	 * mengubah MM yang semula memiliki format angka menjadi format bulan dalam string
	 * parameter masukan berupa date dengan forma YYYY-MM-DD
	 * @param $date
	 * @return string
	 */
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
