<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mresources
 *
 * @author annesams
 */
class Mresources extends CI_Model
{
    //untuk mengambil data dari database

    /*nama tabel fis_rresources
     * input NULL
     * return ALL data files
     */
    function get_list_resources()
    {
        $query = $this->db->get('fis_rresources');
        return $query->result();
    }

    /*
     * input nama file pada data tabel fis_dservice_consult_files
     * return all data file berdasarkan scfile_name (nama barang)
     */
    function get_by_id($id)
    {
        $this->db->where('res_id', $id);
        $query = $this->db->get('fis_rresources');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }

    /**
     * menampilkan data resources pada tabel fis_rresources berdasarkan nama resources
     * dikembalikan dalam bentuk array
     * @param $email
     * @return mixed
     */
    function get_by_name($res_name)
    {
        $this->db->where('res_name', $res_name);
        $query = $this->db->get('fis_rresources');
        return $query->row();
    }

    /**
     * menampilkan data resources pada tabel fis_rresources berdasarkan kode resources
     * dikembalikan dalam bentuk array
     * @param $email
     * @return mixed
     */
    function get_by_code($res_code)
    {
        $this->db->where('res_code', $res_code);
        $query = $this->db->get('fis_rresources');
        return $query->row();
    }

    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel fis_rbarang
     * return TRUE/FALSE
     */
    function insert($data)
    {
        if ($this->db->insert('fis_rresources', $data)) {
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
        $this->db->where('res_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_rresources', $data)) { //proses untuk memasukan data yg baru
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
        if ($this->db->delete('fis_rresources', array('res_id' => $id))) {
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
    function check_resources($res_id)
    {
        $this->db->where('sccontr_res_fk', $res_id);
        $query = $this->db->get('fis_dservice_consult_contracts');
        return $query->row();
    }

    /*
     * menyimpan data baru/data edit pada data tabel fis_rbarang berdasarkan id_barang
     */
    public function saveData($data, $idResources = 0)
    {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        if ($idResources != 0) {

            $this->db->where('res_id', $idResources);

            if ($this->db->update('fis_rresources', $data)) {
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
            if ($this->db->insert('fis_rresources', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return FALSE;
            }
        }
    }
}
