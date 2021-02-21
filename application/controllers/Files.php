<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Files
 *
 * @author samektaadi
 */
class Files extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) {
            $this->session->userdata('typeNotif', 'notLoggedIn');
            redirect('auth');
        }
        $role = $this->session->userdata("role");
        $uacc_id = $this->session->userdata("id");

        $this->load->model('mfiles');
        $this->load->model('mconsultation');
        $this->load->model('mfile_categories');
        $this->load->helper(array('form', 'url'));
    }

    /*
 * return semua data barang 
 */
    function index($id = 0)
    {
        $role = $this->session->userdata("role");
        $uacc_id = $this->session->userdata("id");

        $file = $this->mfiles->get_list_file_cons($id);
        if ($file) {
            $data['files'] = $this->mfiles->get_list_file_cons($id);
        }
        $users = $this->mconsultation->get_by_id($id);
        if ($users) {
            $data['user'] = $this->mconsultation->get_by_id($id);
        }
        // echo '<pre>';
        // print_r($data['files']);
        // echo '</pre>';
        $data['js'] = 'files/vfiles_js.php';
        $data['css'] = 'files/vfiles_css.php';
        $data['scons_id'] = $id;
        $data['content'] = 'files/vfiles.php';
        $data['breadcrumb']    = 'files/vfiles_breadcrumb.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    /*
     * add &  edit berdasarkan id_barang
     */
    function form($id = 0, $scons_id)
    {
        /*
         * apabila id=0, ini menandakan akan menambah data
         */
        if ($this->input->post('submitFiles')) {

            $input = $this->input->post(NULL, TRUE);

            extract($input);

            /*
             * dengan membawa id_barang beserta data yang telah di input
             */
            if (isset($scfile_id)) {
                $idFile = $scfile_id;
            }

            //get participant code
            $file = $this->mconsultation->get_by_id_consultations($scons_id);
            $participant_code = $file->scons_participant_code;

            //file rename code
            $image = $participant_code . '-' . time() . '-' . $_FILES["scfile_name"]['name'];
            //replace ' ' to '_' on file name
            $new_name = str_replace(' ', '_', $image);

            // echo '<pre>';
            // print_r($new_name);
            // die();

            //file upload code 
            //set file upload settings 
            $config['upload_path']          = './uploads/consult_files/';
            $config['allowed_types']        = 'pdf|jpg|png|jpeg|docx|doc|xls|xlsx'; //semua berkas file bisa dimasukin
            $config['max_size']             = 99999999;
            $config['file_name']            = $new_name;


            $this->load->library('upload', $config);

            //tambah error handling kalo misal file yang diupload gasesuai
            $this->upload->do_upload('scfile_name');

            if ($_FILES["scfile_name"]['name'] == '') {
                $dataItem = array(
                    'scfile_scons_fk' => $scons_id,
                    'scfile_fcategory_fk' => $fcategory_id,
                    'scfile_desc' => $scfile_desc
                );
                $this->mfiles->update2($dataItem, $idFile);
            } else {
                $dataItem = array(
                    'scfile_scons_fk' => $scons_id,
                    'scfile_fcategory_fk' => $fcategory_id,
                    'scfile_name' => $new_name,
                    'scfile_desc' => $scfile_desc
                );
            }
            if ($branchId = $this->save($dataItem, $idFile)) {
                $url = "files/index/$scons_id/$idFile";
                redirect($url);
            }
        } else {
            $obj = new stdClass();
            $obj->scfile_id = $id;
            $obj->scfile_scons_fk = '';
            $obj->scfile_fcategory_fk = '';
            $obj->scfile_name = '';
            $obj->scfile_desc = '';

            // Ubah
            if ($id != 0) {
                $obj = $this->mfiles->get_by_id($id);
            }

            $data['scons_id'] = $scons_id;
            $data['obj'] = $obj; //barang
            $data['categories'] = $this->mfile_categories->get_list_categories(); //list categories
            $data['content'] = 'files/vform.php';
            $data['breadcrumb']    = 'files/vfiles_add_breadcrumb.php';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    /*
     *menyimpan data fis_rbarang berdasarkan id_barang
     */
    private function save($data, $idFile = 0)
    {
        return $this->mfiles->saveData($data, $idFile);
    }

    /*
     * menghapus data fis_rbarang berdasarkan id_barang
     */
    function delete($id, $scons_id)
    {
        if ($this->mfiles->delete($id)) {
            $url = "files/index/$scons_id";
            redirect($url);
        }
    }

    /**
     * digunakan untuk mengirim email saat klik tombol submit dokumen
     */
    public function email_files($scfile_id, $scons_id)
    {
        $this->session->set_userdata('typeNotif', 'fileHasSent');
        $this->mconsultation->change_status($scons_id);
        $file = $this->mfiles->get_by_id_cons($scfile_id);
        $email = $file->uacc_email;

        //        echo '<pre>';
        //        print_r($email);
        //        die();

        $this->send_email($email, 'email-files');
        redirect("consultation");
    }

    /**
     * fungsi digunakan untuk mengirim email
     * penyesuaian pada config untuk smtp_host, smtp_port dan smtp_password
     * @param $email
     */
    function send_email($email, $for)
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

        //email content
        if ($for == "email-files") {
            $message = "
			<!doctype html>
			<html>
			  <head>
				<title>Berkas Telah Diterima</title>
			  </head>
			  <body>
				<div>
					<h2>Halo, terima kasih telah mendaftar Konsultasi dan mengirim berkas!</h2>
					<p>Waktu pengecekan berkas maksimal 7 hari kerja. Tetap pantau status pendaftaran den email ya!</p>
				</div>
			  </body>
			</html>
		";
            $this->email->subject('Email Penerimaan Berkas Pengajuan');
        }

        $this->email->set_newline("\r\n");
        $this->email->from($config['smtp_user'], "Fist Effect");
        $this->email->to($email);
        $this->email->message($message);
        $this->email->send();
    }

    public function download($scfile_id, $scons_id)
    {
        //get file name
        $file = $this->mfiles->get_by_id_cons($scfile_id);
        $file_name = $file->scfile_name;

        //memberikan direktori file download dan nama file
        $url = "./uploads/consult_files/" . $file_name;

        //load download helper
        $this->load->helper('download');

        //download file from $url
        force_download($url, null);

        // echo '<pre>';
        // print_r($url);
        // //print_r($_SERVER);
        // die();
        $this->session->set_userdata('typeNotif', 'fileDownloaded');
        $urlhome = "files/index/$scons_id";
        redirect($urlhome);
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */
