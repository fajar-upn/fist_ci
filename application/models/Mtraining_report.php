<?php
class Mtraining_report extends CI_Model {
    //put your code here
    function get_list_report() { 
        $now = date('Y-m-d');
        
        $this->db->select('e.tsched_date, dd.uprof_full_name, cc.uacc_id,group_concat(aa.tclass_name SEPARATOR ",") as kelas'
                         );
        $this->db->group_by('month(e.tsched_date), dd.uprof_full_name');
        
         $this->db->where('e.tsched_date >=', $now);
        
         $this->db->from('fis_dtraining_schedules e');
         $this->db->join('fis_dtraining_classes aa','aa.tclass_id = e.tsched_tclass_fk');
         $this->db->join('fis_duser_accounts cc','cc.uacc_id = aa.tclass_tentor_fk');
         $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');
        
        $query = $this->db->get(); 
            
        return $query->result_array();
        
    }
    function get_jumlah_bulan(){
        $now = date('Y-m-d');
        
        $this->db->select('count(month(e.tsched_date)),tsched_date');
        $this->db->group_by('month(e.tsched_date)');
        
         $this->db->from('fis_dtraining_schedules e');
         $this->db->join('fis_dtraining_classes aa','aa.tclass_id = e.tsched_tclass_fk');
         $this->db->join('fis_duser_accounts cc','cc.uacc_id = aa.tclass_tentor_fk');
         $this->db->join('fis_duser_profiles dd','dd.uprof_uacc_fk = cc.uacc_id');     
        
        $query = $this->db->get(); 
        return $query->result_array();   
    }
}
