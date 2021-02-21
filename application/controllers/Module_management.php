<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */


class Module_management extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) {
            $this->session->set_userdata('typeNotif', 'notLoggedIn');
            redirect('auth');
        } else {

            $this->load->model('Mmodule');
        }

        $this->load->helper(array('form', 'url'));
    }

    function index()
    {

        $role = $this->session->userdata("role");
        $uacc_id = $this->session->userdata("id");
        $data['modules']    = $this->Mmodule->read();
        $data['user_role']  = $this->session->userdata('role');

        $data['js']         = 'module_management/vcustom_script_js.php';
        $data['css']        = 'template/vdatatable_css.php';
        $data['breadcrumb'] = 'module_management/vmodule_user_breadcrumb.php';

        if ($role == '3'){
            $data['breadcrumb'] = 'module_management/vmodule_management_breadcrumb.php';
            $data['content']    = 'module_management/vmodule_management.php';
            $this->load->view('template/vtemplate.php', $data);
        } else if ($role == '5') {
            redirect('dashboard');
        } else {
            $data['content']    = 'module_management/vmodule_user.php';
            $this->load->view('template/vtemplate.php', $data);
        }

        // $data['js']         = 'module_management/vcustom_script_js.php';
        // $data['css']        = 'template/vdatatable_css.php';
        // $data['content']    = 'module_management/vmodule_management.php';
        // $data['modules']    = $this->Mmodule->read();
        // $this->load->view('template/vtemplate.php', $data);
    }

    function insert_module()
    {

 // || ($_FILES['file']['size'] > 30000)
        $nama    = $this->input->post('nama');
        $file    = $_FILES['file'];
        $penulis = $this->input->post('penulis');

            if(empty($file)){
                $this->session->set_flashdata('pesan','<div class="alert alert-danger"><i><b>Data Gagal Ditambah</b></i> : <br>Ukuran file terlalu besar</div>');
                redirect('module_management');
            }
                else{
                    $config['upload_path'] = './uploads/modules/';
                    $config['allowed_types'] = 'pdf|docx|doc';
                    $config['max_size'] = '3048';
                    

                    $this->load->library('upload',$config);
                    if(!$this->upload->do_upload('file')){
                        
                        // echo "Upload Gagal"; die();
                        $message = $this->upload->display_errors();
                        
                        $this->session->set_userdata('typeNotif', 'module-gagal-tambah1');
                            redirect('module_management');
                            // die();
                    }else{
                        $file = $this->upload->data('file_name');
                    }
                }


        $data = array(
            'tmodules_name' => $nama,
            'tmodules_files' => $file,
            'tmodules_author' => $penulis,
            'user_create' => $this->session->userdata('id'),
            'user_update' => $this->session->userdata('id')
        );

        $cek = $this->Mmodule->insert($data);
        if ($cek) {
            $this->session->set_userdata('typeNotif', 'module-berhasil-tambah');
        }else{
            $this->session->set_userdata('typeNotif', 'module-gagal-tambah1');
        }
        redirect('module_management');
        
    }

    function delete_module($id)
    {

        $module = $this->Mmodule->readById($id);
        $cek = $this->Mmodule->delete($id);

        if ($cek) {
            unlink('./uploads/modules/' . $module->tmodules_files);
            $this->session->set_userdata('typeNotif', 'module-berhasil-delete');
        }
        redirect('module_management');
    }

    function update_proses($id)
    {
        $nama = $this->input->post('nama');
        $author = $this->input->post('penulis');
        $module_id = $this->input->post('id');
        $data = array(
            'tmodules_name' => $nama,
            'tmodules_author' => $author,
            'user_update' => $this->session->userdata('id')
        );

        $upload = 1;
        $message = "";
        if (!empty($_FILES['file']['name'])) {

            $config['upload_path'] = './uploads/modules/';
            $config['allowed_types'] = 'pdf|docx|doc';
            $config['max_size'] = '2048';

            $module = $this->Mmodule->readById($id);
            $file = $module->tmodules_files;

            $this->load->library('upload', $config);

            if ($module->tmodules_files != '' || $module->tmodules_files != NULL) {
                if (file_exists('./uploads/modules/' . $module->tmodules_files)) {
                    unlink('./uploads/modules/' . $module->tmodules_files);
                }
            } 
          
            // die(var_dump($data));
            $cek = $this->Mmodule->update($id, $data);
            if($cek > 0 && $upload){
                $this->session->set_userdata('typeNotif', 'module-berhasil-update');
            } else {
                $this->session->set_userdata('typeNotif', 'module-gagal-update');
            }

            if ($this->upload->do_upload('file')) {
                $data['tmodules_files'] = $this->upload->data('file_name');;
            } else {
                $upload = 0;
                $message = $this->upload->display_errors();
            }
        }

        // die(var_dump($data));
        $cek = $this->Mmodule->update($id, $data);
        if ($cek > 0 && $upload) {
            $this->session->set_userdata('typeNotif', 'module-berhasil-update');
        } else {
            $this->session->set_userdata('typeNotif', 'module-gagal-update');
        }

        redirect('module_management');
    }
}