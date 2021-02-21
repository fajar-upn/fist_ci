<?php

class Training_resource extends CI_Controller
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
        } else if ($this->session->userdata('role') != 3 and $this->session->userdata('role') != 2) { // ketika bukan admin (id role admin adalah 3, id role developer adalah 2)
            redirect('dashboard'); //redirect ke halaman dashboard pengguna
        }
        $this->load->model('Mtraining_resource');
    }

    /**
     * load halaman daftar kelas
     */
    function index()
    {
        $data['resources'] = $this->Mtraining_resource->get_All();
        // print_r($data);
        // exit;
        $data['content'] = 'training_resource/vresource_table';
        $data['breadcrumb'] = 'training_resource/vresource_table_breadcrumb';
        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    function form_resource($id = 0)
    {
        if ($this->input->post('submitRes')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($id)) {
                $ResourceId = $id;
            }

            // echo "<pre>";
            // print_r($ResourceId);
            // exit;

            $dataResource = array(
                'tres_name' => $resource_name,
            );

            if ($ResId = $this->saveResource($dataResource, $ResourceId)) {
                redirect("training_resource");
            }
        } else {
            $obj = new stdClass();
            $obj->tres_id = $id;
            $obj->tres_name = '';

            // Ubah
            if ($id != 0) {

                $obj = $this->Mtraining_resource->get_by_id($id);
            }

            $data['data'] = $obj; //resource
            $data['content'] = 'training_resource/vresource_form.php';
            $data['breadcrumb'] = 'training_resource/vresource_form_breadcrumb';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate.php', $data);
        }
    }

    /**
     * function untuk insert data ke tabel fis_rtraining_resources
     * @param $data
     * @param $tres_id
     */

    private function saveResource($data, $tres_id = 0)
    {
        return $this->Mtraining_resource->SaveRes($data, $tres_id);
    }

    public function delete($id)
    {
        $this->Mtraining_resource->delete($id);
        redirect('training_resource');
    }
}
