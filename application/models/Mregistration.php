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
class Mregistration extends CI_Model
{
    //untuk mengambil data dari database


    function get_list_data()
    {
        $query = $this->db->get('fis_vconsult_details');
        return $query->result();
    }


    //get_database_package
    function get_list_package()
    {
        $query = $this->db->get('fis_rservice_consult_packages');
        return $query->result();
    }


    // get database college



    // function get_list_colleges($postData)
    // {
    //     $response = array();

    //     if ($postData['search']) {
    //         $this->db->select('*');
    //         $this->db->where('college_name like "%' . $postData['search'] . '%" ');
    //         $records = $this->db->get('fis_rcolleges')->result();

    //         foreach ($records as $row) {
    //             $response[] = array(
    //                 "college" => $row->college_name
    //             );
    //         }
    //         return $response;
    //     }
    // }

    /*
     * input id_cabang pada data tabel fis_rcabang
     * return all data cabang berdasarkan id_cabang
     */
    function get_by_id($id)
    {
        $this->db->where('scons_id', $id);
        $query = $this->db->get('fis_dservice_consultations');
            
        return $query->row();
    }
    

    /*
     * insert nama_cabang, alamat_cabang, telp_cabang pada data tabel fis_rcabang
     * return TRUE/FALSE
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dservice_consultations', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update nama_cabang, alamat_cabang, telp_cabang berdasarkan $id_cabang pada data tabel fis_rcabang
     * return TRUE/FALSE
     */
    function update($data, $id)
    {
        $this->db->where('scons_id', $id);

        if ($this->db->update('fis_dservice_consultations', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * delete data tabel fis_rcabang berdasarkan id_cabang
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dservice_consultations', array('scons_id' => $id))) {
            $this->session->set_userdata('tipeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('tipeNotif', 'error');
            return FALSE;
        }
    }

    /*
     * menyimpan data baru/data edit pada data tabel fis_rcabang berdasarkan id_cabang
     */
    public function saveData($data, $idCabang = 0)
    {
        if ($idCabang != 0) {

            $this->db->where('scons_id', $idCabang);

            if ($this->db->update('fis_dservice_consultations', $data)) {
                $this->session->set_userdata('tipeNotif', 'successEdit');
                return TRUE;
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        } else {

            if ($this->db->insert('fis_dservice_consultations', $data)) {
                $this->session->set_userdata('tipeNotif', 'successAdd');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        }
    }
}
