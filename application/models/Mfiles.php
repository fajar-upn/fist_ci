<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mfile
 *
 * @author annesams
 */
class Mfiles extends CI_Model
{
    //untuk mengambil data dari database

    /*nama tabel fis_dservice_consult_files
     * input NULL
     * return ALL data files
     */
    function get_list_files()
    {
        $query = $this->db->get('fis_vconsult_files');
        return $query->result();
    }

    /*
     * input nama file pada data tabel fis_dservice_consult_files
     * return all data file berdasarkan scfile_id (id barang)
     */
    function get_by_id($id)
    {
        $this->db->where('scfile_id', $id);
        $query = $this->db->get('fis_dservice_consult_files');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }

    /*
     * input nama file pada data tabel fis_dservice_consult_files
     * return all data file berdasarkan scfile_id (id barang)
     */
    function get_by_id_cons($id)
    {
        $this->db->where('scfile_id', $id);
        $query = $this->db->get('fis_vconsult_files');
        return $query->row(); //untuk memastikan baris dari query  tersebut ada
    }

    function get_list_file_cons($id)
    {
        $this->db->where('scfile_scons_fk', $id);
        $query = $this->db->get('fis_vconsult_files');
        return $query->result(); //untuk memastikan baris dari query  tersebut ada
    }

    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel fis_rbarang
     * return TRUE/FALSE
     */
    function insert($data)
    {
        if ($this->db->insert('fis_dservice_consult_files', $data)) {
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
        $this->db->where('scfile_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dservice_consult_files', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function update2($dataItem, $idFile)
    {
        $this->db->where('scfile_id', $idFile);
        if ($this->db->update('fis_dservice_consult_files', $dataItem)) {
            $this->session->set_userdata('typeNotif', 'successEditData');
        } else {
            $this->session->set_userdata('typeNotif', 'errorEditData');
        }
    }

    /*
     * delete data tabel fis_rbarang berdasarkan id_barang
     */
    function delete($id)
    {
        if ($this->db->delete('fis_dservice_consult_files', array('scfile_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeleteData');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDeleteData');
            return FALSE;
        }
    }

    /*
     * menyimpan data baru/data edit pada data tabel fis_rbarang berdasarkan id_barang
     */
    public function saveData($data, $idFile = 0)
    {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        if ($idFile != 0) {

            $this->db->where('scfile_id', $idFile);

            if ($this->db->update('fis_dservice_consult_files', $data)) {
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
            if ($this->db->insert('fis_dservice_consult_files', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddData');
                return $this->db->insert_id();
            } else {
                $this->session->set_userdata('typeNotif', 'errorAddData');
                return FALSE;
            }
        }
    }
}
