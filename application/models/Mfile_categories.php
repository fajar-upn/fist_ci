<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mfile_categories
 *
 * @author windows10
 */
class Mfile_categories extends CI_Model
{
    //untuk mengambil data dari database

    /*nama tabel fis_dservice_consult_files
     * input NULL
     * return ALL data files
     */
    function get_list_categories()
    {
        $query = $this->db->get('fis_rfile_categories');
        return $query->result();
    }
}
