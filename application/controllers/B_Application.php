<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of B_Application
 *
 * @author windows10
 */
class B_Application extends CI_Controller
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

        $this->load->model('mb_application');
    }

    /*
 * return semua data barang 
 */
    function index()
    {
        $data['js'] = 'b_application/vb_application_js.php';
        $data['css'] = 'b_application/vb_application_css.php';
        $data['application'] = $this->mb_application->get_list_application();
        $data['content'] = 'b_application/vb_application.php';
        $data['breadcrumb']    = 'b_application/vb_application_breadcrumb.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    /*
     * add &  edit berdasarkan id_barang
     */
    function form($baseapp_id)
    {
        /*
         * apabila id=0, ini menandakan akan menambah data
         */
        if ($this->input->post('submitApplication')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);
            /*
             * dengan membawa id_barang beserta data yang telah di input
             */
            if (isset($baseapp_id)) {
                $Applicationid = $baseapp_id;
            }

            $name_exist    = empty($this->mb_application->get_by_name($baseapp_name));
            $code_exist    = empty($this->mb_application->get_by_code($baseapp_code));
            $name_search   = $this->mb_application->get_by_name($baseapp_name);
            $code_search   = $this->mb_application->get_by_code($baseapp_code);

            if (empty($name_exist) and empty($code_exist)) {
                $this->session->set_userdata('typeNotif', 'ba_nameAndba_codeAlreadyExist');
                redirect('b_application');
            } else if (empty($name_exist) and ($baseapp_name != $name_search->baseapp_name)) {
                $this->session->set_userdata('typeNotif', 'ba_nameAlreadyExist');
                redirect('b_application');
            } else if (empty($code_exist) and ($baseapp_code != $code_search->baseapp_code)) {
                $this->session->set_userdata('typeNotif', 'ba_codeAlreadyExist');
                redirect('b_application');
            } else {
                $dataItem = array(
                    'baseapp_name' => $baseapp_name,
                    'baseapp_code' => $baseapp_code
                );

                if ($branchId = $this->save($dataItem, $Applicationid)) {
                    redirect("b_application");
                }
            }
        } else {
            $obj = new stdClass();
            $obj->baseapp_id = $baseapp_id;
            $obj->baseapp_name = '';
            $obj->baseapp_code = '';

            // Ubah
            if ($baseapp_id != 0) {
                $obj = $this->mb_application->get_by_id($baseapp_id);
            }

            $data['data'] = $obj; //resources
            $data['content'] = 'b_application/vform.php';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    /*
     *menyimpan data fis_rbarang berdasarkan id_barang
     */
    private function save($data, $Applicationid = 0)
    {
        return $this->mb_application->saveData($data, $Applicationid);
    }

    /*
     * menghapus data fis_rbarang berdasarkan id_barang
     */
    function delete($id)
    {
        $application_exist = $this->mb_application->check_application($id);

        if ($application_exist) {
            $this->session->set_userdata('typeNotif', 'applicationUsed');
            redirect('b_application');
        } else {
            $this->mb_application->delete($id);
            redirect('b_application');
        }
    }
}
