<?php

class Consultation extends CI_Controller
{

    //put your code here
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) {
            $this->session->userdata('typeNotif', 'notLoggedIn');
            redirect('auth');
        }
        $role = $this->session->userdata("role");
        $uacc_id = $this->session->userdata("id");

        $this->load->model('mconsultation');
        $this->load->model('mavailable_packages');
        $this->load->model('muser_role');
        $this->load->model('muser_profile');
        $this->load->model('mcollege');
        $this->load->model('mstatus');
        $this->load->model('mpackage');
    }

    function index()
    {

        $role = $this->session->userdata("role");
        $uacc_id = $this->session->userdata("id");
        if ($role == '5') {
            $data['data'] = $this->mconsultation->get_list_by_user_id($uacc_id);
        } else if ($role == '4' || $role == '3' || $role == '6') {
            $data['data'] = $this->mconsultation->get_list_data_periode();
        } else {
            $data['data'] = $this->mconsultation->get_list_data();
        }

        $data['content'] = 'consultation/vtable_consultation.php';
        $data['css'] = 'consultation/vconsultation_css.php';
        $data['session'] = 'template/vtemplate_notif.php';
        $data['js'] = 'consultation/vconsultation_js.php';
        $data['breadcrumb']    = 'consultation/vconsultation_breadcrumb.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }


    //form
    function form($scons_id = 0)
    {
        $uacc_id = $this->session->userdata("id");
        $profile = $this->muser_profile->get_profile_by_id($uacc_id);
        if ($profile) {
            if ($this->input->post('submitConsultation')) {

                $countObject = $this->mconsultation->get_participant_counter()->row();
                $count = (array) $countObject;

                $this->mconsultation->get_list_data();


                // $uacc_id = $this->session->userdata("id");
                // $this->mconsultation->get_list_data_by_session_id($uacc_id);

                $input = $this->input->post(NULL, TRUE);
                extract($input);

                if (isset($scons_id)) {
                    $scons_id = $scons_id;
                }

                //autogenerate code------------------
                $kode = 'SK';
                $tahun = date('Y');
                
                $get_count = substr($count['scons_participant_code'], 3, 4);
                $get_count = (int) $get_count;
                $get_count++;

                $kode .= substr($tahun, 2);

                $kode .= sprintf("%02d", $get_count);
                //------------------------------------

                //get uacc_id from session
                $uacc_id = $this->session->userdata('id');

                //get period id from available package
                $period = $this->mpackage->get_active_period();
                $period_id = $period->scperiod_id;

                

                //input data array to database
                if ($scons_id != 0) {

                    $statuss = $this->mconsultation->get_by_id($scons_id);
                    $status = $statuss->sstatus_id;
                    
                    $dataItem = array(
                        'scons_participant_code' => $kode,
                        'scons_uacc_fk' => $uacc_id,
                        'scons_college_fk' => $university,
                        'scons_scpack_temp_fk' => $package,
                        'scons_scperiod_fk' => $period_id,
                        'scons_batch_year' => $batch_year,
                        'scons_thesis_title' => $thesis_title,
                        'scons_thesis_desc' => $thesis_decription,
                        'scons_supervisor' => $supervisor,
                        'scons_graduation_target' => $graduation_target,
                        'scons_proposal_target' =>  $proposal_target,
                        'scons_thesis_target' => $thesis_target,
                        'scons_status_fk' => $status
                    );
                } else {
                    $dataItem = array(
                        'scons_participant_code' => $kode,
                        'scons_uacc_fk' => $uacc_id,
                        'scons_college_fk' => $university,
                        'scons_scpack_temp_fk' => $package,
                        'scons_scperiod_fk' => $period_id,
                        'scons_batch_year' => $batch_year,
                        'scons_thesis_title' => $thesis_title,
                        'scons_thesis_desc' => $thesis_decription,
                        'scons_supervisor' => $supervisor,
                        'scons_graduation_target' => $graduation_target,
                        'scons_proposal_target' =>  $proposal_target,
                        'scons_thesis_target' => $thesis_target,
                        'scons_status_fk' => 6
                    );
                }

                if ($branchId = $this->save($dataItem, $scons_id)) {
                    redirect("consultation");
                }
            } else {

                $obj = new stdClass();
                $obj->scons_id = $scons_id;
                $obj->scons_participant_code = '';
                $obj->scons_uacc_fk = '';
                $obj->scons_college_fk = '';
                $obj->scons_scpack_temp_fk = '';
                $obj->scons_scperiod_fk = '';
                $obj->scons_batch_year = '';
                $obj->scons_thesis_title = '';
                $obj->scons_thesis_desc = '';
                $obj->scons_supervisor = '';
                $obj->scons_graduation_target = '';
                $obj->scons_proposal_target = '';
                $obj->scons_thesis_target = '';
                $obj->scons_status_fk = '';
                $obj->scons_note = '';
                $obj->scons_note_schedule = '';

                // edit data 
                if ($scons_id != 0) {
                    $obj = $this->mconsultation->get_by_id($scons_id);
                }

                //get list package available
                $data['data'] = $obj;

                $data['package'] = $this->mavailable_packages->get_list_package();
                $data['package1'] = $this->mpackage->get_list_data_available();
                $data['university'] = $this->mcollege->read();
                $data['status'] = $this->mstatus->get_status();

                $role = $this->session->userdata("role");
                //session role to public and client (input paper, edit, and upload file)
                if ($role == '5') {
                    $data['content'] = 'consultation/vform_consultation_client.php';
                }
                //session role to developer (all access) 
                else if ($role == '2') {
                    $data['content'] = 'consultation/vform_consultation_developer.php';
                }
                //session role to analyst (just read paper ,just read file, can download file and change status client) 
                else if ($role == '4') {
                    $data['content'] = 'consultation/vform_consultation_analyst.php';
                }
                //session role to admin (3), tentor (6), pimpinan (7). Just only read all
                else {
                    $data['content'] = 'consultation/vform_consultation_read_only.php';
                }

                $data['css'] = 'consultation/vconsultation_css.php';
                $data['js'] = 'consultation/vconsultation_js.php';
                $data['breadcrumb']    = 'consultation/vconsultation_add_breadcrumb.php';
                $data['user_role'] = $this->session->userdata('role');
                $this->load->view('template/vtemplate', $data);
            }
        } else {
            $url = "user_management/account_profile/0";
            $this->session->set_userdata('typeNotif', 'fulfillProfile');
            redirect($url);
        }
    }

    private function save($data, $scons_id = 0)
    {
        return $this->mconsultation->saveData($data, $scons_id);
    }

    function delete($scons_id)
    {
        if ($this->mconsultation->delete($scons_id))
            redirect('consultation');
    }

    //function to change consultation status for analyst
    public function status_change($scons_id)
    {
        //mengambil update status dan note 
        if ($this->input->post('submitConsultation')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);
            /*
             * dengan membawa id_barang beserta data yang telah di input
             */
            if (isset($scons_id)) {
                $idConsult = $scons_id;
            }

            $dataItem = array(
                'scons_status_fk' => $status,
                'scons_note' => $note,
            );
            $this->mconsultation->change_status_analys($idConsult, $dataItem);

            $cons = $this->mconsultation->get_by_id($scons_id);
            $email = $cons->uacc_email;
            $schedule = $cons->scons_note_schedule;

            if ($status == '3') {
                $this->send_email($email, $schedule,  $note, 'email-revision-consultation'); //email untuk revisi berkas    
                redirect("consultation");
            } elseif ($status == '4') {
                $this->schedule($scons_id); //beralih ke halaman penjadwalan bila penjadwalan diterima    
            } elseif ($status == '2') {
                $this->send_email($email,  $schedule, $note, 'email-canceled-consultation'); //email untuk pembatalan
                redirect("consultation");
            }
        }
    }


    // Management package------------------------------------------------------------
    function schedule($scons_id)
    {
        if ($this->input->post('submitSchedule')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($scons_id)) {
                $scons_id = $scons_id;
            }
            if ($scons_id != 0) {
                $dataItem = array(
                    'scons_consultation_date' => $schedule,
                    'scons_note_schedule' => $note_schedule
                );
            }

            $this->mconsultation->change_status_analys($scons_id, $dataItem);
            $cons = $this->mconsultation->get_by_id($scons_id);
            $email = $cons->uacc_email;

            $schedule    = $this->convert_date($schedule);

            $this->send_email($email, $schedule, $note_schedule, 'email-schedule-consultation'); //pengiriman tanggal penjadwalan berkas

            $this->saveSchedule($dataItem, $scons_id);
            redirect("consultation");
        } else {
            $obj = new stdClass();
            $obj->scons_id = $scons_id;
            $obj->scons_note_schedule = '';
            $obj->scons_consultation_date = '';

            // Ubah
            if ($scons_id != 0) {
                $obj = $this->mconsultation->get_by_id($scons_id);
            }

            $data['data'] = $obj;
            $data['content'] = 'consultation/vform_schedule.php';
            $data['user_role'] = $this->session->userdata('role');
            $data['css'] = 'consultation/vconsultation_css.php';
            $data['js'] = 'consultation/vconsultation_js.php';
            $data['breadcrumb']    = 'consultation/vcons_schedule_breadcrumb.php';
            $this->load->view('template/vtemplate', $data);
        }
    }

    private function saveSchedule($data, $scons_id = 0)
    {
        return $this->mconsultation->saveData($data, $scons_id);
    }

    function deleteSchedule($scons_id)
    {
        if ($this->mconsultation->delete($scons_id)) {
            redirect('consultation');
        }
    }

    /**
     * fungsi digunakan untuk mengirim email
     * penyesuaian pada config untuk smtp_host, smtp_port dan smtp_password
     * @param $email
     */
    function send_email($email, $schedule, $note, $for)
    {
        // load library email
        $this->load->library('email');

        // set up email
        $config = array(
            'protocol'        => 'smtp',
            'smtp_host'        => 'mail.fisteffect.com',
            'smtp_port'        => 465,
            'smtp_user'        => 'office@fisteffect.com',
            'smtp_pass'        => 'apahay0l0',
            'smtp_crypto'    => 'ssl',
            'mailtype'        => 'html',
            'charset'        => 'iso-8859-1',
            'wordwrap'        => TRUE
        );
        $this->email->initialize($config);

        //email revisi pengajuan
        if ($for == "email-revision-consultation") {
            $message = "
			<!doctype html>
			<html>
			  <head>
				<title>Revisi Pengajuan</title>
			  </head>
			  <body>
				<div>
                    <h2>Mohon Maaf, Pengajuan anda perlu direvisi !</h2>
                    <h4>Silahkan melakukan revisi pengajuan anda!</h4>
                    <p>Berikut beberapa hal yang perlu anda perhatikan dalam revisi pengajuan : </p>
                    <p>$note</p>
                    <h4>Revisi Pengajuan Maksimal 7 Hari Kerja !</h4>
                    <h4>Jika Lebih Maka Pengajuan Dianggap Batal !</h4>
				</div>
			  </body>
			</html>
		";
            $this->email->subject('Revisi Pengajuan');
        }
        //email pembatalan konsultasi
        else if ($for == "email-canceled-consultation") {
            $message = "
				<!doctype html>
				<html>
				  <head>
					<title>Pengajuan Dibatalkan</title>
				  </head>
				  <body>
					<div>
                        <h2>Mohon Maaf, Pengajuan anda dibatalkan !</h2>
                        <h4>Silahkan Periksa Kembali Pengajuan Anda !</h4>
                        <p>Berikut beberapa hal yang menjadi perhatian mengenai pembatalan pengajuan anda : </p>
                        <p>$note</p>
                        <h4>Terima kasih telah memilih Fist Effect untuk membantu skripsi anda.</h4>
                        <h4>Kami Tunggu Pengajuan Anda Selanjutnya.</h4>
					</div>
				  </body>
				</html>
			";
            $this->email->subject('Pengajuan Dibatalkan');
        }
        //email pengiriman penjadwalan berkas konsultasi
        else if ($for == "email-schedule-consultation") {
            $message = "
            <!doctype html>
            <html>
              <head>
                <title>Penjadwalan Berkas</title>
              </head>
              <body>
                <div>
                    <h2>Selamat Pengajuan Berkas telah telah diterima !</h2>
                    <h4>Berikut merupakan jadwal pengajuan berkas : </h4>
                    <p><b><i>$schedule</i></b></p>
                    <p>Berikut beberapa hal yang perlu di perhatikan mengenai penjadwalan berkas anda : </p>
                    <p>$note</p>
                    <h4>Terima kasih telah memilih Fist Effect untuk membantu skripsi anda.</h4>
                    <h4>Kami Tunggu Pengajuan Anda Selanjutnya.</h4>
                </div>
              </body>
            </html>
        ";
            $this->email->subject('Penjadwalan Berkas');
        }

        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user'], "Fist Effect");
        $this->email->to($email);
        $this->email->message($message);
        if ($this->email->send()) {
            $this->session->set_userdata('typeNotif', 'emailHasSent');
        } else {
            $this->session->set_userdata('typeNotif', 'emailFail');
        }
    }

    /**
     * mengubah format date yang semula YYYY-MM-DD menjadi DD MM YYYY
     * mengubah MM yang semula memiliki format angka menjadi format bulan dalam string
     * parameter masukan berupa date dengan forma YYYY-MM-DD
     * @param $date
     * @return string
     */
    private function convert_date($date)
    {
        $split_date            = explode("-", $date);
        $year                = $split_date[0];
        $month                = (int) $split_date[1];
        $day                = $split_date[2];

        if ($month == 1) {
            $month = "Januari";
        } else if ($month == 2) {
            $month = "Februari";
        } else if ($month == 3) {
            $month = "Maret";
        } else if ($month == 4) {
            $month = "April";
        } else if ($month == 5) {
            $month = "Mei";
        } else if ($month == 6) {
            $month = "Juni";
        } else if ($month == 7) {
            $month = "Juli";
        } else if ($month == 8) {
            $month = "Agustus";
        } else if ($month == 9) {
            $month = "September";
        } else if ($month == 10) {
            $month = "Oktober";
        } else if ($month == 11) {
            $month = "November";
        } else if ($month == 12) {
            $month = "Desember";
        }

        $final_convert = $day . " " . $month . " " . $year;
        return $final_convert;
    }
}
