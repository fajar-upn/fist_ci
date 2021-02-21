<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mb_application
 *
 * @author windows10
 */
class Mb_application extends CI_Model
{
    //put your code here
    //untuk mengambil data dari database

    /*nama tabel fis_dservice_consult_files
     * input NULL
     * return ALL data files
     */
    function get_list_application()
    {
        $query = $this->db->get('fis_rbase_applications');
        return $query->result();
    }

    /*
     * input nama file pada data tabel fis_dservice_consult_files
     * return all data file berdasarkan scfile_name (nama barang)
     */
    function get_by_id($id)
    {
        $this->db->where('baseapp_id', $id);
        $query = $this->db->get('fis_rbase_applications');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }



    /**
     * menampilkan data application pada tabel fis_rbase_applications berdasarkan nama
     * dikembalikan dalam bentuk array
     * @param $baseapp_name
     * @return mixed
     */
    function get_by_name($baseapp_name)
    {
        $this->db->where('baseapp_name', $baseapp_name);
        $query = $this->db->get('fis_rbase_applications');
        return $query->row();
    }

    /**
     * menampilkan data application pada tabel fis_rbase_applications berdasarkan code
     * dikembalikan dalam bentuk array
     * @param $baseapp_code
     * @return mixed
     */
    function get_by_code($baseapp_code)
    {
        $this->db->where('baseapp_code', $baseapp_code);
        $query = $this->db->get('fis_rbase_applications');
        return $query->row();
    }

    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel fis_rbarang
     * return TRUE/FALSE
     */
    function insert($data)
    {
        if ($this->db->insert('fis_rbase_applications', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update nama_barang, alamat_barang, telp_barang berdasarkan $id_barang pada data tabel fis_rbarang
     * return TRUE/FALSE
     */
    function update($data, $id)
    {
        $this->db->where('baseapp_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_rbase_applications', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * delete data tabel fis_rbarang berdasarkan id_barang
     */
    function delete($id)
    {
        if ($this->db->delete('fis_rbase_applications', array('baseapp_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteData');
            return FALSE;
        }
    }

    /**
     * menampilkan data resources pada tabel fis_dservice_consult_contracts berdasarkan id resources
     * dikembalikan dalam bentuk array
     * @param $email
     * @return mixed
     */
    function check_application($baseapp_id)
    {
        $this->db->where('sccontr_baseapp_fk', $baseapp_id);
        $query = $this->db->get('fis_dservice_consult_contracts');
        return $query->row();
    }

    /*
     * menyimpan data baru/data edit pada data tabel fis_rbarang berdasarkan id_barang
     */
    public function saveData($data, $Applicationid = 0)
    {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        if ($Applicationid != 0) {

            $this->db->where('baseapp_id', $Applicationid);

            if ($this->db->update('fis_rbase_applications', $data)) {
                $this->session->set_userdata('typeNotif', 'successEditData');
                return TRUE;
            } else {
                $this->session->set_userdata('typeNotif', 'errorEditData');
                return FALSE;
            }
        }
        /*
         * apabila form id membawa id =0 ini menandakan mengedit suatu data
         */ else {
            if ($this->db->insert('fis_rbase_applications', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return FALSE;
            }
        }
    }
}
