<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */

/**
 * Description of Resources
 *
 * @author annesams
 */
class Resources extends CI_Controller
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

        $this->load->model('mresources');
    }

    /*
 * return semua data barang 
 */
    function index()
    {
        $data['js'] = 'resources/vresources_js.php';
        $data['css'] = 'resources/vresources_css.php';
        $data['resources'] = $this->mresources->get_list_resources();
        $data['content'] = 'resources/vresources.php';
        $data['breadcrumb']    = 'resources/vresources_breadcrumb.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    /*
     * add &  edit berdasarkan id_barang
     */
    function form($res_id)
    {
        /*
         * apabila id=0, ini menandakan akan menambah data
         */
        if ($this->input->post('submitResources')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);
            /*
             * dengan membawa id_barang beserta data yang telah di input
             */
            if (isset($res_id)) {
                $Resourcesid = $res_id;
            }
            $name_exist    = empty($this->mresources->get_by_name($res_name));
            $code_exist    = empty($this->mresources->get_by_code($res_code));
            $name_search   = $this->mresources->get_by_name($res_name);
            $code_search   = $this->mresources->get_by_code($res_code);

            if (empty($name_exist) and empty($code_exist)) {
                $this->session->set_userdata('typeNotif', 'res_nameAndres_codeAlreadyExist');
                redirect('resources');
            } else if (empty($name_exist) and ($res_name != $name_search->res_name)) {
                $this->session->set_userdata('typeNotif', 'res_nameAlreadyExist');
                redirect('resources');
            } else if (empty($code_exist) and ($res_code != $code_search->res_code)) {
                $this->session->set_userdata('typeNotif', 'res_codeAlreadyExist');
                redirect('resources');
            } else {
                $dataItem = array(
                    'res_name' => $res_name,
                    'res_code' => $res_code
                );

                if ($branchId = $this->save($dataItem, $Resourcesid)) {
                    redirect("resources");
                }
            }
        } else {
            $obj = new stdClass();
            $obj->res_id = $res_id;
            $obj->res_name = '';
            $obj->res_code = '';

            // Ubah
            if ($id != 0) {
                $obj = $this->mresources->get_by_id($res_id);
            }

            $data['data'] = $obj; //resources
            $data['content'] = 'resources/vform.php';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    /*
     *menyimpan data fis_rresources berdasarkan id_resources
     */
    private function save($data, $idResources = 0)
    {
        return $this->mresources->saveData($data, $idResources);
    }

    /*
     * menghapus data fis_rresources berdasarkan id_resources
     */
    function delete($id)
    {
        $resources_exist = $this->mresources->check_resources($id);

        if ($resources_exist) {
            $this->session->set_userdata('typeNotif', 'resourcesUsed');
            redirect('resources');
        } else {
            $this->mresources->delete($id);
            redirect('resources');
        }
    }
}

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */
