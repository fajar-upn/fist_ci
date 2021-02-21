<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template_b file, choose Tools | Templates
 * and open the template_b in the editor.
 */

/**
 * Description of Barang
 *
 * @author samektaadi
 */
class Package extends CI_Controller
{

    //autoload model
    function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('is_login') != TRUE) {
            $this->session->userdata('typeNotif', 'notLoggedIn');
            redirect('auth');
        }

        $this->load->model('mpackage');
    }

    function index($scperiod_id = 0)
    {
        $data['Aperiode'] = $this->mpackage->get_list_periode_available();
        $data['Apackage'] = $this->mpackage->get_list_data_available();
        $data['Pperiod'] = $this->mpackage->get_all_data_periode();
        $data['period'] = $scperiod_id;
        $data['user_role'] = $this->session->userdata('role');
        $data['content'] = 'package/vtable_available_package.php';
        $data['css'] = 'package/vpackage_css.php';
        $data['js'] = 'package/vpackage_js.php';
        $data['breadcrumb']    = 'package/vav_package_breadcrumb.php';
        $this->load->view('template/vtemplate.php', $data);
    }

    //to progress CRUD available package periode (lefter feature)----------------------------------------------------
    function form_active($scperiod_id = 0)
    {
        if ($this->input->post('submitActive')) {

            $scperiod_id = $this->input->post('period', TRUE);

            $dataItem = array(
                'scperiod_active' => 0
            );

            if ($this->saveActive($dataItem, 0)) {
                $dataItem = array(
                    'scperiod_active' => 1
                );
                if ($this->saveActive($dataItem, $scperiod_id)) {
                    $this->session->set_userdata('typeNotif', 'periodeActive');
                    redirect('package/index/' . $scperiod_id);
                }
            }
        } else {
            $data['user_role'] = $this->session->userdata('role');
            $data['Pperiode'] = $this->mpackage->get_all_data_periode();
            $this->load->view('template/vtemplate', $data);
        }
    }

    private function saveActive($data, $scperiod_id)
    {
        return $this->mpackage->updateActive($data, $scperiod_id);
    }

    //to progress CRUD available package (right)--------------------------------------------------------
    function form($scavailpkg_id = 0)
    {
        if ($this->input->post('submitAvailable')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($scavailpkg_id)) {
                $scavailpkg_id = $scavailpkg_id;
            }

            $package_exist = $this->mpackage->get_exist_available_package($package, $periode);
           
            if($scavailpkg_id != 0){

                $check_id_available = $this->mpackage->get_by_id($scavailpkg_id);

                $same_code = (strcmp($check_id_available->scavailpkg_scpack_fk,$scpack_code)==0);
                if(!$same_code){
                    if(!$package_exist){
                        $dataItem = array(
                            'scavailpkg_scperiod_fk' => $periode,
                            'scavailpkg_price' => $price
                        );
    
                        if($this->mpackage->update($dataItem, $scavailpkg_id)){
                            $this->session->set_userdata('typeNotif', 'packageAdded');
                            redirect('package/index');
                        }
                    }
                    else{
                        $dataItem = array(
                            'scavailpkg_scpack_fk' => $package,
                            'scavailpkg_scperiod_fk' => $periode,
                            'scavailpkg_price' => $price
                        );
                        
                        if($this->mpackage->update($dataItem, $scavailpkg_id)){
                            $this->session->set_userdata('typeNotif', 'packageAdded');
                            redirect('package/index');
                        }
                    }
                }
                else{
                    $this->session->set_userdata('typeNotif', 'packageAlreadyExist');
                    redirect('package/index');
                }
            }
            else{
                if($package_exist){
                    $this->session->set_userdata('typeNotif', 'packageAlreadyExist');
                    redirect('package/index');
                }
                else{
                    $dataItem = array(
                        'scavailpkg_scpack_fk' => $package,
                        'scavailpkg_scperiod_fk' => $periode,
                        'scavailpkg_price' => $price
                    );
                }
               
            }
            // if ($package_exist) {
            //     $this->session->set_userdata('typeNotif', 'packageAlreadyExist');
            //     redirect('package/form');
            // } else {
            //     $dataItem = array(
            //         'scavailpkg_scpack_fk' => $package,
            //         'scavailpkg_scperiod_fk' => $periode,
            //         'scavailpkg_price' => $price
            //     );
            // }

            if ($branchId = $this->save($dataItem, $scavailpkg_id)) {
                if ($scavailpkg_id != null) {
                } else {
                    $this->session->set_userdata('typeNotif', 'packageAdded');
                }
                redirect("package");
            }
        } else {
            $obj = new stdClass();
            $obj->scavailpkg_id = $scavailpkg_id;
            $obj->scavailpkg_scpack_fk = '';
            $obj->scavailpkg_scperiod_fk = '';
            $obj->scavailpkg_price = '';

            // edit package
            if ($scavailpkg_id != 0) {
                $obj = $this->mpackage->get_by_id($scavailpkg_id);
            }

            $data['data'] = $obj;
            $data['Apackage'] = $this->mpackage->get_list_package_available();
            $data['Aperiode'] = $this->mpackage->get_list_periode_available();
            $data['breadcrumb']    = 'package/vavp_form_breadcrumb.php';
            $data['css'] = 'package/vpackage_css.php';
            $data['js'] = 'package/vpackage_js.php';
            $data['content'] = 'package/vform_available_package.php';
            $data['user_role'] = $this->session->userdata('role');
            $this->load->view('template/vtemplate', $data);
        }
    }

    private function save($data, $scavailpkg_id = 0)
    {
        return $this->mpackage->saveData($data, $scavailpkg_id);
    }

    function delete($scavailpkg_id)
    {
        $availablePackage = $this->mpackage->checkedAvailabelPackage($scavailpkg_id);
        if ($availablePackage) {
            $this->session->set_userdata('typeNotif', 'packageUsed');
            redirect('package');
        } else {
            $this->mpackage->delete($scavailpkg_id);
            $this->session->set_userdata('typeNotif', 'deleteAvailable');
            redirect('package');
        }
    }   

    //to progress CRUD periode (left)----------------------------------------------------------------
    function index_periode()
    {
        $data['Pperiode'] = $this->mpackage->get_all_data_periode();
        $data['content'] = 'package/vtable_periode_package.php';
        $data['css'] = 'package/vpackage_css.php';
        $data['js'] = 'package/vpackage_js.php';
        $data['breadcrumb']    = 'package/vperiode_breadcrumb.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    function form_periode($scperiod_id = 0)
    {
        if ($this->input->post('submitPeriode')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($scperiod_id)) {
                $scperiod_id  = $scperiod_id;
            }

            //combine month and year
            if (isset($scperiod_desc1) && isset($scperiod_desc2) && isset($scperiod_year)) {
                $scperiod_desc1 = $scperiod_desc1;
                $scperiod_desc2 = $scperiod_desc2;
                $scperiod_year = $scperiod_year;

                $periode = $this->mpackage->get_exist_periode($scperiod_desc1, $scperiod_desc2, $scperiod_year, $scperiod_id);

                $scperiod_desc = $scperiod_desc1 . ' - ' . $scperiod_desc2;
            }

            if ($periode) {
                $this->session->set_userdata('typeNotif', 'periodeAlreadyExist');
                redirect('package/form_periode');
            } else {
                $dataItem = array(
                    'scperiod_desc' => $scperiod_desc,
                    'scperiod_year' => $scperiod_year,
                    'scperiod_active' => 0
                );
            }

            if ($branchId = $this->savePeriode($dataItem, $scperiod_id)) {
                $this->session->set_userdata('typeNotif', 'periodeAdded');
                redirect("package/index_periode");
            }
        } else {
            $obj = new stdClass();
            $obj->scperiod_id = $scperiod_id;
            $obj->scperiod_desc = '';
            $obj->scperiod_year = '';
            $obj->scperiod_active = '';
            $obj->scperiod_month1 = '';
            $obj->scperiod_month2 = '';

            // edit package
            if ($scperiod_id != 0) {
                $obj = $this->mpackage->get_by_id_periode($scperiod_id);

                $periode = $obj->scperiod_desc;
                $breaker = explode(" - ", $periode);
                $obj->scperiod_month1 = $breaker[0];
                $obj->scperiod_month2 = $breaker[1];
            }

            $month1 = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");

            $data['month1'] = $month1;
            $data['data'] = $obj;

            $data['user_role'] = $this->session->userdata('role');
            $data['css'] = 'package/vpackage_css.php';
            $data['js'] = 'package/vpackage_js.php';
            $data['breadcrumb']    = 'package/vperiode_form_breadcrumb.php';
            $data['content'] = 'package/vform_periode_package.php';
            $this->load->view('template/vtemplate', $data);
        }
    }

    private function savePeriode($data, $scperiod_id)
    {
        return $this->mpackage->saveDataPeriode($data, $scperiod_id);
    }

    function deletePeriode($scperiod_id)
    {
        $periode = $this->mpackage->checkedPeriode($scperiod_id);
        if ($periode) {
            $this->session->set_userdata('typeNotif', 'periodeUsed');
            redirect('package/index_periode');
        } else {
            $this->mpackage->deletePeriode($scperiod_id);
            redirect('package/index_periode');
        }
    }

    //to progress CRUD consultation package (middle)----------------------------------------------------------------------------
    function index_package()
    {
        $data['Cpackage'] = $this->mpackage->get_list_data_consult();
        $data['content'] = 'package/vtable_consult_package.php';
        $data['css'] = 'package/vpackage_css.php';
        $data['js'] = 'package/vpackage_js.php';
        $data['breadcrumb']    = 'package/vpackage_breadcrumb.php';
        $data['user_role'] = $this->session->userdata('role');
        $this->load->view('template/vtemplate.php', $data);
    }

    function form_package($scpack_id = 0)
    {
        if ($this->input->post('submitConsult')) {
            $input = $this->input->post(NULL, TRUE);

            extract($input);

            if (isset($scpack_id)) {
                $scpack_id = $scpack_id;
            }

            $package_exist = $this->mpackage->get_exist_consult_package($scpack_code);

            //check kode yang sama dari inputan
            //jika kode paket ada
            if($scpack_id != 0){
                
                //melakukan get id
                $check_id_available = $this->mpackage->get_by_id_package($scpack_id);       
                
                /*
                paket dengan kode yang bersangkutan dibandingkan dengan inputan form,  
                jika hasil keduanya sama maka bernilai 0
                */
                $same_code = (strcmp($check_id_available->$scpack_code,$scpack_code)==0); 

                /*
                ketika paket $samecode bernilai == 0 dan paket yang tersedia ada, maka tidak akan input
                */
                if(!$same_code || $package_exist){
                    /*
                    cek ketika paket yang tersedia di negasikan 
                    */
                    if(!$package_exist){
                        $dataItem = array(
                            'scpack_code' => $scpack_code,
                            'scpack_name' => $scpack_name,
                            'scpack_desc' => $scpack_desc
                        );
                        if ($this->mpackage->updatePackage($dataItem, $scpack_id)){
                            $this->session->set_userdata('typeNotif', 'packageAdded');
                            redirect("package/index_package");
                        } 
                    }else{
                            $dataItem = array(
                                'scpack_name' => $scpack_name,
                                'scpack_desc' => $scpack_desc
                            );
                            
                            if ($this->mpackage->updatePackage($dataItem, $scpack_id)){
                                $this->session->set_userdata('typeNotif', 'packageAdded');
                                redirect("package/index_package");
                            } 
                        }
                }else{
                    $this->session->set_userdata('typeNotif', 'packageAlreadyExist');
                    redirect("package/index_package");  
                }
            }
            //jika kode paket tidak ada, input
            else{
                //cek paket yang telah ada
                if($package_exist){
                    $this->session->set_userdata('typeNotif', 'packageAlreadyExist');
                    redirect("package/index_package");  
                }else{
                    $dataItem = array(
                        'scpack_code' => $scpack_code,
                        'scpack_name' => $scpack_name,
                        'scpack_desc' => $scpack_desc
                    );
                }    
            }

            // if ($package_exist) {
                // $this->session->set_userdata('typeNotif', 'packageAlreadyExist');
                // redirect('package/form_package');
            // } else {
                // $dataItem = array(
                //     'scpack_code' => $scpack_code,
                //     'scpack_name' => $scpack_name,
                //     'scpack_desc' => $scpack_desc
                // );
            // }

            if ($branchId = $this->savePackage($dataItem, $scpack_id)) {
                $this->session->set_userdata('typeNotif', 'packageAdded');
                redirect("package/index_package");
            }
        } else {
            $obj = new stdClass();
            $obj->scpack_id = $scpack_id;
            $obj->scpack_code = '';
            $obj->scpack_name = '';
            $obj->scpack_desc = '';

            // edit package
            if ($scpack_id != 0) {
                $obj = $this->mpackage->get_by_id_package($scpack_id);
            }

            $data['data'] = $obj;
            $data['user_role'] = $this->session->userdata('role');
            $data['css'] = 'package/vpackage_css.php';
            $data['js'] = 'package/vpackage_js.php';
            $data['breadcrumb']    = 'package/vpackage_form_breadcrumb.php';
            $data['content'] = 'package/vform_consult_package.php';
            $this->load->view('template/vtemplate', $data);
        }
    }

    private function savePackage($data, $scpack_id)
    {
        return $this->mpackage->saveDataPackage($data, $scpack_id);
    }

    function deletePackage($scpack_id)
    {
        $package = $this->mpackage->checked_package($scpack_id);

        if ($package) {
            $this->session->set_userdata('typeNotif', 'packageUsed');
            redirect('package/index_package');
        } else {
            $this->mpackage->deletePackage($scpack_id);
            redirect('package/index_package');
        }
    }
}
