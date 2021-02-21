<?php

class Training_package extends CI_Controller
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
        } else if ($this->session->userdata('role') != 3 AND $this->session->userdata('role') != 2) { // ketika bukan admin (id role admin adalah 3, id role developer adalah 2)
            redirect('dashboard'); //redirect ke halaman dashboard pengguna
        }
        $this->load->model('Mtraining_package');
        $this->load->model('Mtraining_resource');
    }

    /**
     * load halaman daftar kelas
     */
    function index()
    {
        $data['packages'] = $this->Mtraining_package->get_package();

        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['content'] = 'training_package/vpackage_table';
        $data['breadcrumb'] = 'training_package/vpackage_table_breadcrumb';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate', $data);
    }

    /**
     * input data ke tabel fis_dtraining_classes dan fis_dtraining_students
     */
    function form_package($id = 0, $tpack_id = NULL)
    {
        //jika di klik tombol submit maka akan masuk ke if, jika tidak masuk ke else
        if ($this->input->post('submitPackage')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            //dicek apakah tclass_id itu kosong atau tidak
            if (isset($tptype_id)) {
                $tptype_id = $id;
            }

            $dataPack = array(
                'tpack_name' => $pack_name,
                'tpack_meeting' => $pack_meeting,
                'tpack_time' => $pack_time
            );

            //input data ke tabel fis_dtraining_packages
            if ($packId = $this->savePackage($dataPack, $tpack_id)) {

                // print_r($class_id);
                // exit;

                if ($id == 0) {

                    $dataPackDetail = array(
                        'tpdetail_tpack_fk' => $packId,
                    );

                    if ($packDetailId = $this->addPackDetail($dataPackDetail)) {

                        $dataPackType = array(
                            'tptype_tpack_fk' => $packId,
                            'tptype_name' => $type_name,
                            'tptype_price' => $type_price
                        );

                        if ($packTypeId = $this->savePackType($dataPackType, $tptype_id)) {
                            redirect('training_package');
                        }
                    }
                } else {

                    $dataPackType = array(
                        'tptype_name' => $type_name,
                        'tptype_price' => $type_price
                    );

                    if ($packTypeId = $this->savePackType($dataPackType, $id)) {
                        // print_r($id);
                        // exit;
                        redirect('training_package');
                    }
                }
            }
        } else {
            //deklarasi obj baru
            $obj = new stdClass();
            $obj->tptype_id = $id;
            $obj->tpack_id = '';
            $obj->tpack_name = '';
            $obj->tpack_meeting = '';
            $obj->tpack_time = '';
            $obj->tptype_id = '';
            $obj->tptype_price = '';

            // Ubah
            if ($id != 0) {
                //mengambil data berdasarkan id
                $obj = $this->Mtraining_package->get_by_id($id);
            }
            // echo "<pre>";
            // print_r($obj);
            // exit();
            $data['data'] = $obj;
            $data['content'] = 'training_package/vpackage_form.php';
            $data['breadcrumb'] = 'training_package/vpackage_form_breadcrumb';
            $data['css'] = 'training/vform_css.php';
            $data['js'] = 'training/vform_js.php';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate.php', $data);
        }
    }

    /**
     * load halaman daftar peserta yang tergabung dalam kelas yang dipilih
     * @param $tclass_id
     */
    function table_packresource($tpack_id)
    {
        $data['id'] = $tpack_id;
        $data['detail'] = $this->Mtraining_package->get_packDetail_by_id($tpack_id);
        $data['resources'] = $this->Mtraining_package->get_list_resource($tpack_id);
        // print_r($tpack_id);
        // exit;
        $data['content'] = 'training_package/vpack_resource_table';
        $data['breadcrumb'] = 'training_package/vpack_resource_table_breadcrumb';
        $data['css'] = 'template/vdatatable_css';
        $data['js'] = 'training/vtable_js';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    function form_packresource($packId = NULL, $tpdetailId = NULL, $id = 0)
    {
        if ($this->input->post('submitRes')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($tres_id)) {
                $ResourceId = $id;
            }
            if ($id == 0) {
                $cek = $this->Mtraining_package->get_packDetail_by_id($packId);

                if ($cek->tpdetail_tres_fk != NULL) {
                    $dataPackDetail = array(
                        'tpdetail_tres_fk' => $res_id,
                        'tpdetail_tpack_fk' => $packId
                    );

                    // echo "<pre>";
                    // print_r($packId);
                    // exit;

                    if ($ResId = $this->addPackDetail($dataPackDetail)) {
                        redirect("training_package/table_packresource/" . $packId);
                    }
                } else {
                    $dataPackDetail = array(
                        'tpdetail_tres_fk' => $res_id
                    );

                    if ($ResId = $this->insertPackDetail($dataPackDetail, $packId)) {
                        redirect("training_package/table_packresource/" . $packId);
                    }
                }
            }
            $dataPackDetail = array(
                'tpdetail_tres_fk' => $res_id
            );

            if ($ResId = $this->updatePackDetail($dataPackDetail, $tpdetailId)) {
                redirect("training_package/table_packresource/" . $packId);
            }
        } else {
            $obj = new stdClass();
            $obj->tres_id = $id;
            $obj->tpdetail_id = $tpdetailId;
            $obj->tres_name = '';

            // Ubah
            if ($id != 0) {

                $obj = $this->Mtraining_package->get_resource_by_id($id);
            }
            $obj->tpack_id = $packId;
            $data['res'] = $this->Mtraining_resource->get_All();
            $data['data'] = $obj; //resource
            $data['content'] = 'training_package/vpack_resource_form.php';
            $data['breadcrumb'] = 'training_package/vpack_resource_form_breadcrumb';
            $data['js'] = 'training/vform_js.php';
            $data['css'] = 'training/vform_css.php';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate.php', $data);
        }
    }

    /**
     * function untuk insert data ke tabel fis_dtraining_classes
     * @param $data
     * @param $tclass_id
     */
    private function savePackage($data, $tpack_id = 0)
    {
        return $this->Mtraining_package->saveData($data, $tpack_id);
    }

    private function insertPackDetail($data, $id)
    {
        return $this->Mtraining_package->insertPack_detail($data, $id);
    }

    private function updatePackDetail($data, $id)
    {
        return $this->Mtraining_package->updatePack_detail($data, $id);
    }

    private function addPackDetail($data)
    {
        return $this->Mtraining_package->addPack_detail($data);
    }

    private function savePackType($data, $id)
    {
        return $this->Mtraining_package->saveType($data, $id);
    }

    /**
     * melakukan penghapusan data resource yang terdaftar pada paket berdasarkan id
     * @param $id
     */
    public function deleteRes($id, $packId = NULL)
    {
        $this->Mtraining_package->deleteRes($id);
        redirect('training_package/table_packresource/' . $packId);
    }

    /**
     * melakukan penghapusan data resource yang terdaftar pada paket berdasarkan id
     * @param $id
     */
    public function deletePack($id)
    {
        $this->Mtraining_package->deletePack($id);
        redirect('training_package');
    }
}
