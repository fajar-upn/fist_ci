<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mbarang
 *
 * @author samektaadi
 */
class Mtraining_payroll extends CI_Model {
    //put your code here
    function get_by_id_kelas($id,$bulan,$tahun) {
        $this->db->select('d.tclass_name as nama_kelas, sum(TIMESTAMPDIFF(MINUTE,tattd_timestart,tattd_timefinish)) as durasi',FALSE);
        $this->db->where('d.tclass_tentor_fk', $id);
        $this->db->where('year(e.tattd_date)', $tahun);
        $this->db->where('month(e.tattd_date)', $bulan);

        $this->db->from('fis_dtraining_attendances e');
        $this->db->join('fis_dtraining_contracts aa','aa.tcontr_id = e.tattd_tcontr_fk');
        
        $this->db->join('fis_dtraining_students f','f.tstudt_tcontr_fk = aa.tcontr_id');
        
        $this->db->join('fis_dtraining_classes d','d.tclass_id = f.tstudt_tclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.tclass_tentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        $this->db->join('fis_rtraining_package_types g','g.tptype_id = d.tclass_tptype_fk');
        $this->db->join('fis_rtraining_packages h','h.tpack_id = g.tptype_tpack_fk');
        
        $query = $this->db->get(); 
        //  echo ("<pre>");
        //  echo print_r($query->result_array());
        //  die;
        return $query->result_array();
            
    }
    
    function get_by_id_tentor($id,$bulan,$tahun) {

        $this->db->select('e.tattd_date, b.uprof_full_name as tentor,b.*, count(b.uprof_full_name) as nominal');
         $this->db->where('uacc_id', $id);
         $this->db->where('year(e.tattd_date)', $tahun);
         $this->db->where('month(e.tattd_date)', $bulan);
        
        $this->db->from('fis_dtraining_attendances e');
        $this->db->join('fis_dtraining_contracts d','d.tcontr_id = e.tattd_tcontr_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.tcontr_uacc_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');        
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
     function get_tahun() {
        $this->db->select('e.tattd_date');
        $this->db->group_by('year(e.tattd_date)');
        $this->db->from('fis_dtraining_attendances e');
        $this->db->join('fis_dtraining_contracts aa','aa.tcontr_id = e.tattd_tcontr_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = aa.tcontr_uacc_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    function get_by_tahun($tahun) {
        $this->db->select('e.tattd_date, b.uprof_full_name, c.uacc_id,c.uacc_tsalary as gaji, tattd_timestart, count(f.tstudt_tclass_fk) as jpm,tattd_timefinish, sum(TIMESTAMPDIFF(MINUTE,tattd_timestart,tattd_timefinish)) as durasi',FALSE);
        $this->db->group_by('month(e.tattd_date), b.uprof_full_name');
        $this->db->from('fis_dtraining_attendances e');
        $this->db->join('fis_dtraining_contracts aa','aa.tcontr_id = e.tattd_tcontr_fk');
        $this->db->join('fis_duser_accounts cc','cc.uacc_id = aa.tcontr_uacc_fk');
        $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');
        
        $this->db->join('fis_dtraining_students f','f.tstudt_tcontr_fk = aa.tcontr_id');
        
        $this->db->join('fis_dtraining_classes d','d.tclass_id = f.tstudt_tclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.tclass_tentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        $this->db->join('fis_rtraining_package_types g','g.tptype_id = d.tclass_tptype_fk');
        $this->db->join('fis_rtraining_packages h','h.tpack_id = g.tptype_tpack_fk');

        $query = $this->db->get(); 
        return $query->result_array();
            
    }
}
