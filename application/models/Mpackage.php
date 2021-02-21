<?php

class Mpackage extends CI_Model
{
    //activation period (lefter feature)----------------------------------------------
    function get_by_id_active($scperiod_id)
    {
        $this->db->where('scperiod_id', $scperiod_id);
        $query = $this->db->get('fis_rservice_consult_periods');

        return $query->row_object();
    }

    //update data
    function updateActive($data, $scperiod_id)
    {
        if ($scperiod_id != 0) {
            $this->db->where('scperiod_id', $scperiod_id);
        }

        if ($this->db->update('fis_rservice_consult_periods', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //periode package(left)-----------------------------------------------------------
    function get_all_data_periode()
    {
        $query = $this->db->get('fis_rservice_consult_periods');
        return $query->result();
    }


    function get_by_id_periode($scperiod_id)
    {
        $this->db->where('scperiod_id', $scperiod_id);
        $query = $this->db->get('fis_rservice_consult_periods');

        return $query->row_object();
    }


    //parameters to cheked month 
    function array_date($param)
    {
        $month = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        return array_search($param, $month);
    }

    function get_exist_periode($scperiod_desc1, $scperiode_desc2, $scperiod_year, $scperiod_id)
    {
        if ($scperiod_id != 0) {
            $this->db->where(['scperiod_year' => $scperiod_year, 'scperiod_id !=' => $scperiod_id]);
        } else {
            $this->db->where('scperiod_year', $scperiod_year);
        }
        $this->db->distinct();
        $query = $this->db->get('fis_rservice_consult_periods');

        foreach ($query->result() as $row) {
            $periode = $row->scperiod_desc;
            $data1 = explode(" - ", $periode);
            $periode_desc1 = $this->array_date($scperiod_desc1); //9 okt
            $periode_desc2 = $this->array_date($scperiode_desc2); //11 des
            $data2[0] = $this->array_date($data1[0]); //8 sep
            $data2[1] = $this->array_date($data1[1]); //10 nov
            if ($periode_desc1 == $periode_desc2) {
                $hasil = true;
                break;
            } else {
                if ($periode_desc1 >= min($data2[0], $data2[1]) && $periode_desc1 <= max($data2[0], $data2[1])) { //9>=8 & 9<=10
                    $hasil = true;
                    break;
                } else {
                    if ($periode_desc2 >= min($data2[0], $data2) && $periode_desc2 <= max($data2[0], $data2[1])) { //11>=8 & 11<=10
                        $hasil = true;
                        break;
                    } else {
                        $hasil = false;
                    }
                }
            }
        }

        return $hasil;
    }




    function get_cheked_periode($scperiod_desc1, $scperiode_desc2, $scperiod_id)
    {
        $this->db->distinct();
        $this->db->where('scperiod_id !=', $scperiod_id);
        $query = $this->db->get('fis_rservice_consult_periods');

        foreach ($query->result() as $row) {
            $periode = $row->scperiod_desc;
            $data1 = explode(" - ", $periode);
            $periode_desc1 = $this->array_date($scperiod_desc1); //3
            $periode_desc2 = $this->array_date($scperiode_desc2); //6
            $data2[0] = $this->array_date($data1[0]); //7
            $data2[1] = $this->array_date($data1[1]); //10

            if ($periode_desc1 >= min($data2[0], $data2[1]) && $periode_desc1 <= max($data2[0], $data2[1])) { //9>=8 & 9<=10
                $hasil = true;
                break;
            } else {
                if ($periode_desc2 >= min($data2[0], $data2) && $periode_desc2 <= max($data2[0], $data2[1])) { //11>=8 & 11<=10
                    $hasil = true;
                    break;
                } else {
                    $hasil = false;
                }
            }
        }

        return $hasil;
    }

    function get_exist_year($scperiod_year)
    {
        $this->db->where('scperiod_year', $scperiod_year);
        $query = $this->db->get('fis_rservice_consult_periods');
        return $query->result();
    }

    //insert data
    function insertPeriode($data)
    {
        if ($this->db->insert('fis_rservice_consult_periods', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //update data
    function updatePeriode($data, $scperiod_id)
    {
        $this->db->where('scperiod_id', $scperiod_id);

        if ($this->db->update('fis_rservice_consult_periods', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //delete data
    function deletePeriode($scperiod_id)
    {
        if ($this->db->delete('fis_rservice_consult_periods', array('scperiod_id' => $scperiod_id))) {
            $this->session->set_userdata('typeNotif', 'deleteAvailable');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'periodeUsed');
            return FALSE;
        }
    }

    //checked periode used on availble package
    function checkedPeriode($scperiod_id)
    {
        $this->db->where('scavailpkg_scperiod_fk', $scperiod_id);
        return $this->db->get('fis_rservice_consult_available_packages')->row();
    }

    //save update or insert data
    public function saveDataPeriode($data, $scperiod_id = 0)
    {
        if ($scperiod_id != 0) {

            $this->db->where('scperiod_id', $scperiod_id);

            if ($this->db->update('fis_rservice_consult_periods', $data)) {
                $this->session->set_userdata('typeNotif', 'successEdit');
                return TRUE;
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        } else {

            if ($this->db->insert('fis_rservice_consult_periods', $data)) {
                $this->session->set_userdata('typeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        }
    }


    //Available package(right)----------------------------------------------------------
    //get list Available package
    function get_list_data_available()
    {
        $query = $this->db->get('fis_vconsult_packages');
        return $query->result();
    }

    //get list package
    function get_list_package_available()
    {
        $query = $this->db->get('fis_rservice_consult_packages');
        return $query->result();
    }

    //get list periode
    function get_list_periode_available()
    {
        $query = $this->db->get('fis_rservice_consult_periods');
        return $query->result();
    }

    //get active period
    function get_active_period()
    {
        $this->db->where('scperiod_active', 1);
        $query = $this->db->get('fis_rservice_consult_periods');
        return $query->row();
    }

    //get available package and periode on available to check
    function get_exist_available_package($package, $periode)
    {
        $this->db->where('scavailpkg_scpack_fk', $package);
        $this->db->where('scavailpkg_scperiod_fk', $periode);
        $query = $this->db->get('fis_rservice_consult_available_packages');
        return $query->row();
    }

    //get by id
    function get_by_id($scavailpkg_id)
    {
        $this->db->where('scavailpkg_id', $scavailpkg_id);
        $query = $this->db->get('fis_rservice_consult_available_packages');
        return $query->row();
    }


    //insert data
    function insert($data)
    {
        if ($this->db->insert('fis_rservice_consult_available_packages', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //update data
    function update($data, $scavailpkg_id)
    {
        $this->db->where('scavailpkg_id', $scavailpkg_id);

        if ($this->db->update('fis_rservice_consult_available_packages', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //delete data
    function delete($scavailpkg_id)
    {
        if ($this->db->delete('fis_rservice_consult_available_packages', array('scavailpkg_id' => $scavailpkg_id))) {
            $this->session->set_userdata('tipeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('tipeNotif', 'error');
            return FALSE;
        }
    }

    //cheked in rservice_consultation
    function checkedAvailabelPackage($scavailpkg_id)
    {
        $this->db->where('sccontr_scavailpkg_fk', $scavailpkg_id);
        return $this->db->get('fis_dservice_consult_contracts')->row();
    }

    //save update or insert data
    public function saveData($data, $scavailpkg_id = 0)
    {
        if ($scavailpkg_id != 0) {

            $this->db->where('scavailpkg_id', $scavailpkg_id);

            if ($this->db->update('fis_rservice_consult_available_packages', $data)) {
                $this->session->set_userdata('typeNotif', 'packageAdded');
                return TRUE;
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        } else {

            if ($this->db->insert('fis_rservice_consult_available_packages', $data)) {
                $this->session->set_userdata('typeNotif', 'packageAdded');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        }
    }

    //Consultation package(middle)----------------------------------------------------------

    //get list consultation package 
    function get_list_data_consult()
    {
        $query = $this->db->get('fis_rservice_consult_packages');
        return $query->result();
    }

    function get_by_id_package($scpack_id)
    {
        $this->db->where('scpack_id', $scpack_id);
        $query = $this->db->get('fis_rservice_consult_packages');

        return $query->row();
    }

    function get_exist_consult_package($scpack_code)
    {
        $this->db->where('scpack_code', $scpack_code);
        $query = $this->db->get('fis_rservice_consult_packages');
        return $query->row();
    }

    //insert package
    function insertPackage($data)
    {
        if ($this->db->insert('fis_rservice_consult_packages', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //update package
    function updatePackage($data, $scpack_id)
    {
        $this->db->where('scpack_id', $scpack_id);
        if ($this->db->update('fis_rservice_consult_packages', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function saveDataPackage($data, $scpack_id = 0)
    {
        if ($scpack_id != 0) {

            $this->db->where('scpack_id', $scpack_id);

            if ($this->db->update('fis_rservice_consult_packages', $data)) {
                $this->session->set_userdata('typeNotif', 'successEdit');
                return TRUE;
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        } else {

            if ($this->db->insert('fis_rservice_consult_packages', $data)) {
                $this->session->set_userdata('typeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        }
    }

    //delete data
    public function deletePackage($scpack_id)
    {
        if ($this->db->delete('fis_rservice_consult_packages', array('scpack_id' => $scpack_id))) {
            $this->session->set_userdata('typeNotif', 'deleteAvailable');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'error');
            return FALSE;
        }
    }

    //cheking in available package
    function checked_package($scpack_id)
    {
        $this->db->where('scavailpkg_scpack_fk', $scpack_id);
        return $this->db->get('fis_rservice_consult_available_packages')->row();
    }
}
