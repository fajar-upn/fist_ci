<?php

class Registration extends CI_Controller
{

    //put your code here
    function __construct()
    {
        parent::__construct();

        $this->load->model('mregistration');
    }

    function index()
    {
        $data['data'] = $this->mregistration->get_list_data();
        $data['content'] = 'registration/vtable_registration.php';
        $this->load->view('template/vtemplate.php', $data);
    }


    function form($id = 0)
    {
        if ($this->input->post('submitForm')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($id_cabang)) {
                $idCabang = $id_cabang;
            }

            $dataItem = array(
                'nama_lengkap' => $nama_lengkap,
                'nama_cabang' => $nama_cabang,
                'alamat_cabang' => $alamat_cabang,
                'telp_cabang' => $telp_cabang,
            );

            if ($branchId = $this->save($dataItem, $idCabang)) {
                redirect("cabang");
            }
        } else {

            //insert into table
            $obj = new stdClass();
            $obj->nama_cabang = '';
            $obj->alamat_cabang = '';
            $obj->telp_cabang = '';

            // Ubah
            if ($id != 0) {

                $obj = $this->mcabang->get_by_id($id);
            }

            $data['data'] = $obj; //cabang

            //get list package available
            $data['package'] = $this->mregistration->get_list_package();

            //autocomplete

            // // //type ahead search university
            // $postData['search'] = $this->input->post();
            // $data1 = $this->mregistration->get_list_colleges($postData['search']);
            // echo json_encode($data1);

            $data['content'] = 'consultation/vform_registration.php';
            $data['js'] = 'consultation/vregistration_js.php';
            $this->load->view('template/vtemplate', $data);
        }
    }

    private function save($data, $idCabang = 0)
    {
        return $this->mcabang->saveData($data, $idCabang);
    }

    function delete($id)
    {
        if ($this->mcabang->delete($id)) {
            redirect('colleger');
        }
    }
}
