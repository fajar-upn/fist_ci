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
class Mconsult_payroll extends CI_Model {
    //put your code here
    function get_by_id_tentor($id,$bulan,$tahun) {
        $this->db->select('e.scattd_date, b.uprof_full_name as tentor,b.*, count(b.uprof_full_name) as nominal, c.uacc_csalary as salary');
        $this->db->where('scclass_mentor_fk', $id);
        $this->db->where('year(e.scattd_date)', $tahun);
        $this->db->where('month(e.scattd_date)', $bulan);
        
        $this->db->from('fis_dservice_consult_attendances e');
        $this->db->join('fis_dservice_consult_classes d','d.scclass_id = e.scattd_scclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.scclass_mentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        $query = $this->db->get(); 
        return $query->result_array();
    }
    
    function get_by_id_mhs($id,$bulan,$tahun) {
        $this->db->select('dd.uprof_full_name as mahasiswa, sum(TIMESTAMPDIFF(MINUTE,scattd_time_start,scattd_time_end)) as durasi',FALSE);
        $this->db->where('scclass_mentor_fk', $id);
        $this->db->where('year(e.scattd_date)', $tahun);
        $this->db->where('month(e.scattd_date)', $bulan);
        $this->db->group_by('mahasiswa');
        $this->db->from('fis_dservice_consult_attendances e');
        
        $this->db->join('fis_dservice_consult_classes d','d.scclass_id = e.scattd_scclass_fk');
        $this->db->join('fis_dservice_consult_contracts aa','aa.sccontr_id = d.scclass_sccontr_fk');
        $this->db->join('fis_dservice_consultations bb','bb.scons_id = aa.sccontr_sconcs_fk');
        $this->db->join('fis_duser_accounts cc','cc.uacc_id = bb.scons_uacc_fk');
        $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');  
        
        $query = $this->db->get();
        return $query->result_array();
            
    }
    
    function get_tahun() { 
        $this->db->select('e.scattd_date');
        $this->db->group_by('year(e.scattd_date)');
        $this->db->from('fis_dservice_consult_attendances e');
        $this->db->join('fis_dservice_consult_classes d','d.scclass_id = e.scattd_scclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.scclass_mentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }
    
    function get_by_tahun($tahun) {
        $this->db->select('e.scattd_date, b.uprof_full_name, c.uacc_csalary as gaji, c.uacc_id,count(b.uprof_full_name) as nominal, sum(TIMESTAMPDIFF(MINUTE,scattd_time_start,scattd_time_end)) as durasi, count(e.scattd_scclass_fk) as jpm, scattd_time_start, scattd_time_end', FALSE);
        $this->db->where('year(e.scattd_date)', $tahun);
        $this->db->group_by('month(e.scattd_date), b.uprof_full_name');
        $this->db->from('fis_dservice_consult_attendances e');
        $this->db->join('fis_dservice_consult_classes d','d.scclass_id = e.scattd_scclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.scclass_mentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        
        $this->db->join('fis_dservice_consult_contracts aa','aa.sccontr_id = d.scclass_sccontr_fk');
        $this->db->join('fis_dservice_consultations bb','bb.scons_id = aa.sccontr_sconcs_fk');
        $this->db->join('fis_duser_accounts cc','cc.uacc_id = bb.scons_uacc_fk');
        $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');
        
        $query = $this->db->get(); 
        
        return $query->result_array();
    }
        // echo ("<pre>");
        // echo print_r($query->result_array());
        // die; 
}
