<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mcabang
 *
 * @author annesams
 */
class Mconsultation extends CI_Model
{
    //untuk mengambil data dari database

    function get_list_data()
    {
        $query = $this->db->get('fis_vconsult_details');
        return $query->result();
    }

    function get_list_by_user_id($uacc_id)
    {
        $this->db->where('uacc_id', $uacc_id);
        $this->db->where('scperiod_active', 1);
        $query = $this->db->get('fis_vconsult_details');

        return $query->result();
    }

    //get data available periode
    function get_list_data_periode()
    {
        $this->db->where('scperiod_active', 1);
        $query = $this->db->get('fis_vconsult_details');
        return $query->result();
    }

    function get_participant_counter()
    {
        $query = "SELECT scons_participant_code FROM fis_dservice_consultations WHERE substring(scons_participant_code,3)=(SELECT MAX(CAST(SUBSTRING(scons_participant_code,3) AS SIGNED)) FROM fis_dservice_consultations)";
        $new_query = $this->db->query($query);
        // $this->db->like('date_create', '2020');
        // $this->db->select_max('scons_psarticipant_code');
        // $this->db->from('fis_dservice_consultations');
        // $query = $this->db->get();
        return $new_query;
    }

    //check complete profile
    function get_check_profile($uacc_id)
    {
        $this->db->where('uprof_uacc_fk', $uacc_id);
        $query = $this->db->get('fis_duser_profiles');
        return $query->result();
    }


    //insert data
    function insert($data)
    {
        if ($this->db->insert('fis_dservice_consultations', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //get scons_id from database
    function get_by_id($scons_id)
    {
        $this->db->where('scons_id', $scons_id);
        $query = $this->db->get('fis_vconsult_details');
        return $query->row();
    }

    function get_by_id_consultations($id)
    {
        $this->db->where('scons_id', $id);
        $query = $this->db->get('fis_dservice_consultations');

        return $query->row();
    }

    //get scons_id from database
    function get_by_id_cons($scons_id)
    {
        $this->db->where('scons_id', $scons_id);
        $query = $this->db->get('fis_vconsult_details');
        return $query->result();
    }

    //update data
    function update($data, $scons_id)
    {
        $this->db->where('scons_id', $scons_id);
        if ($this->db->update('fis_dservice_consultations', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    //update data and insert data
    public function saveData($data, $scons_id = 0)
    {
        // print_r($data);
        // die;
        if ($scons_id != 0) {

            $this->db->where('scons_id', $scons_id);

            if ($this->db->update('fis_dservice_consultations', $data)) {
                $this->session->set_userdata('tipeNotif', 'successEdit');
                return TRUE;
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        } else {

            if ($this->db->insert('fis_dservice_consultations', $data)) {
                $this->session->set_userdata('typeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'error');
                return FALSE;
            }
        }
    }

    //delete data
    public function delete($scons_id)
    {
        if ($this->db->delete('fis_dservice_consultations', array('scons_id' => $scons_id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'error');
            return FALSE;
        }
    }

    //change status------------------------------------------------------------------------------
    /**
     * digunakan untuk mengganti status dari pengisian berkas / revisi berkas menjadi pengajuan
     * pada prosesnya akan dilakukan penggantian scons_status_fk
     * @param $scons_id
     */
    public function change_status($scons_id)
    {
        $file = $this->mconsultation->get_by_id_consultations($scons_id);

        if ($file->scons_status_fk == '6' || $file->scons_status_fk == '3') {
            $data['scons_status_fk'] = 1;

            $this->db->where('fis_dservice_consultations.scons_id', $scons_id);
            $this->db->update('fis_dservice_consultations', $data);
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
        }
    }

    /**
     * digunakan untuk mengganti status bagi analys ketika melakukan pengecekan berkas
     * pada prosesnya akan dilakukan penggantian scons_status_fk
     * @param $scons_id
     */
    public function change_status_analys($scons_id, $dataItem)
    {
        $this->db->where('fis_dservice_consultations.scons_id', $scons_id);
        if ($this->db->update('fis_dservice_consultations', $dataItem)) {
            $this->session->set_userdata('tipeNotif', 'successEditData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
        }
    }
}
