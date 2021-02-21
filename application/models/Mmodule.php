<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Mmodule extends CI_Model {

        function __construct(){
            parent:: __construct();
        }

        function insert($data){
            return $this->db->insert('fis_rtraining_modules',$data);
        }

        function readById($id) {
            $this->db->select('*');
            $this->db->from('fis_rtraining_modules');
            $this->db->where('tmodules_id',$id);
            return $this->db->get()->row_object();
        }

        function read(){
            $this->db->select('*');
            $this->db->from('fis_rtraining_modules');
            return $this->db->get()->result();
        }
 
        function delete($id){
            $this->db->where('tmodules_id',$id);
            return $this->db->delete('fis_rtraining_modules');
        }

        function update($id, $data){
            return $this->db->update('fis_rtraining_modules', $data, ['tmodules_id' => $id]);
        }

}
