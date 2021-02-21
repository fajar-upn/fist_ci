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
class Mconsult_report extends CI_Model {
    function get_list_report() { 
        $now = date('Y-m-d');
        
        $this->db->select('e.scsched_date, b.uprof_full_name, cc.uacc_id,group_concat(dd.uprof_full_name SEPARATOR ",") as mahasiswa'
                         );
        $this->db->group_by('month(e.scsched_date), b.uprof_full_name');
        $this->db->where('e.scsched_date >=', $now);
        $this->db->from('fis_dservice_consult_schedules e');
        $this->db->join('fis_dservice_consult_classes d','d.scclass_id = e.scsched_scclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.scclass_mentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        
        $this->db->join('fis_dservice_consult_contracts aa','aa.sccontr_id = d.scclass_sccontr_fk');
        $this->db->join('fis_dservice_consultations bb','bb.scons_id = aa.sccontr_sconcs_fk');
        $this->db->join('fis_duser_accounts cc','cc.uacc_id = bb.scons_uacc_fk');
        $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');
        
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
    function get_jumlah_bulan(){
        $now = date('Y-m-d');
        $this->db->select('count(month(e.scsched_date)),scsched_date');
        $this->db->group_by('month(e.scsched_date)');
        
        $this->db->where('e.scsched_date >=', $now);
        $this->db->from('fis_dservice_consult_schedules e');
        $this->db->join('fis_dservice_consult_classes d','d.scclass_id = e.scsched_scclass_fk');
        $this->db->join('fis_duser_accounts c','c.uacc_id = d.scclass_mentor_fk');
        $this->db->join('fis_duser_profiles b','b.uprof_uacc_fk = c.uacc_id');
        
        $this->db->join('fis_dservice_consult_contracts aa','aa.sccontr_id = d.scclass_sccontr_fk');
        $this->db->join('fis_dservice_consultations bb','bb.scons_id = aa.sccontr_sconcs_fk');
        $this->db->join('fis_duser_accounts cc','cc.uacc_id = bb.scons_uacc_fk');
        $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');     
        
        $query = $this->db->get(); 
        return $query->result_array();   
    }
}
