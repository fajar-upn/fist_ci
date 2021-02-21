<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Mbarang
 *
 * @author annesams
 */
class Mtraining_presence extends CI_Model {
    //untuk mengambil data dari database
    
    public function getData($id){
        $this->db->select('presence.*,
                         t_prof.uprof_full_name as tentor
                         ');
        $this->db->from('fis_dtraining_classes presence');
        // $this->db->join('fis_dtraining_contracts s_contract','s_contract.tcontr_id = presence.tclass_id');
        // $this->db->join('fis_duser_accounts s_acc','s_acc.uacc_id = s_contract.tcontr_uacc_fk');    
        // $this->db->join('fis_duser_profiles s_prof','s_prof.uprof_uacc_fk = s_acc.uacc_id');

        // $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = presence.tclass_id');
        // $this->db->join('fis_dtraining_students students','students.tstudt_tcontr_fk = t_contract.tcontr_id');
        //$this->db->join('fis_dtraining_classes class','class.tclass_id = students.tstudt_tclass_fk');
        $this->db->join('fis_duser_accounts t_acc','t_acc.uacc_id = presence.tclass_tentor_fk');
        $this->db->join('fis_duser_profiles t_prof','t_prof.uprof_uacc_fk = t_acc.uacc_id');

        // $this->db->join('fis_dtraining_students students','students.tstudt_tclass_fk = presence.tclass_id');
        // $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = students.tstudt_tcontr_fk');
        //  $this->db->join('fis_dtraining_attendances t_att','t_att.tattd_tcontr_fk = t_contract.tcontr_id');
        $this->db->where('presence.tclass_id',$id);
                
        $query = $this->db->get()->row();
        
        return $query;
    }

    public function getMeeting($id){
        
        $this->db->select('t_att.tattd_id as meeting');
        $this->db->from('fis_dtraining_classes presence');
        $this->db->join('fis_dtraining_students students','students.tstudt_tclass_fk = presence.tclass_id');
        $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = students.tstudt_tcontr_fk');
        $this->db->join('fis_dtraining_attendances t_att','t_att.tattd_tcontr_fk = t_contract.tcontr_id');
        $this->db->where('presence.tclass_id',$id);
                
        $query = $this->db->get()->row();
        if($query){
            return $query;
        }else{
            
            $obj = new stdClass();
            $obj->meeting = 0;
            return $obj;
        }
        
        
    }
  
    
     /*
     * menyimpan data baru/data edit pada data tabel fis_rbarang berdasarkan id_barang
     */
    public function saveData($data, $idPresence = 0) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        // echo "<pre>"; print_r($_POST['name']);exit;
        if ($idPresence != 0) {
            
            $this->db->where('tattd_id', $idPresence);
            if ($this->db->update('fis_dtraining_attendances', $data)) {
                $this->session->set_userdata('typeNotif', 'successUpdatePresenceTraining');
                return TRUE;
            } else {
                $this->session->set_userdata('tipeNotif', 'error');
                return FALSE;
            }
        } else {
        
            
                $result = array();
                $no = 0;                
                foreach ($data['tattd_tcontr_fk'] as $dat ){
                    $result[] = array(
                        'tattd_tcontr_fk' => $_POST['name'][$no],
                        'tattd_date' => $data['tattd_date'],
                        'tattd_timestart' => $data['tattd_timestart'],
                        'tattd_timefinish' => $data['tattd_timefinish'],
                        'tattd_status' => $data['tattd_status']
                    );
                    $no = $no+1;
                }
                if ($this->db->insert_batch('fis_dtraining_attendances', $result)) {
                    $this->session->set_userdata('typeNotif', 'successAddPresenceTraining');
                    return $this->db->insert_id();
                } else {
                    $this->session->set_userdata('tipeNotif', 'error');
                    return FALSE;
                }
            
        }
 
       
    }
    // untuk mengambil dari tabel schedules
    function get_list_schedules() {
        // $this->db->select('hadir.*,
        //                 t_profil.uprof_full_name as tentor,
        //                 m_profil.uprof_full_name as mahasiswa
        //                 ');
        // $this->db->from('fis_dservice_consult_attendances hadir');
        //  $this->db->join('fis_dservice_consult_classes t_kelas','t_kelas.scclass_id = hadir.scattd_scclass_fk');
        //  $this->db->join('fis_duser_accounts t_akun','t_akun.uacc_id = t_kelas.scclass_mentor_fk');    
        //  $this->db->join('fis_duser_profiles t_profil','t_profil.uprof_uacc_fk = t_akun.uacc_id');

        //  $this->db->join('fis_dservice_consult_classes m_kelas','m_kelas.scclass_id = hadir.scattd_scclass_fk');  
        //  $this->db->join('fis_dservice_consult_contracts m_kontrak','m_kontrak.sccontr_id = m_kelas.scclass_sccontr_fk');
        //  $this->db->join('fis_dservice_consultations m_konsul','m_konsul.scons_id = m_kontrak.sccontr_sconcs_fk'); 
        //  $this->db->join('fis_duser_accounts m_akun','m_akun.uacc_id = m_konsul.scons_uacc_fk');
        //  $this->db->join('fis_duser_profiles m_profil','m_profil.uprof_uacc_fk =  m_akun.uacc_id');

        $this->db->select('presence.*,
                         t_prof.uprof_full_name as tentor,
                         s_prof.uprof_full_name as mahasiswa');
        $this->db->from('fis_dtraining_attendances presence');
        $this->db->join('fis_dtraining_contracts s_contract','s_contract.tcontr_id = presence.tattd_tcontr_fk');
        $this->db->join('fis_duser_accounts s_acc','s_acc.uacc_id = s_contract.tcontr_uacc_fk');    
        $this->db->join('fis_duser_profiles s_prof','s_prof.uprof_uacc_fk = s_acc.uacc_id');

        $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = presence.tattd_tcontr_fk');
        $this->db->join('fis_dtraining_students students','students.tstudt_tcontr_fk = t_contract.tcontr_id');
        $this->db->join('fis_dtraining_classes class','class.tclass_id = students.tstudt_tclass_fk');
        $this->db->join('fis_duser_accounts t_acc','t_acc.uacc_id = class.tclass_tentor_fk');
        $this->db->join('fis_duser_profiles t_prof','t_prof.uprof_uacc_fk = t_acc.uacc_id');

                        
        $query = $this->db->get()->result();
        //print_r($query);die;
        return $query;
    }


    function get_list_kelas() {
        // $this->db->select('t_kelas.*,
        //                 t_profil.uprof_full_name as tentor,
        //                 m_profil.uprof_full_name as mahasiswa
        //                 ');
        // $this->db->from('fis_dservice_consult_classes t_kelas');
        //  $this->db->join('fis_duser_accounts t_akun','t_akun.uacc_id = t_kelas.scclass_mentor_fk');    
        //  $this->db->join('fis_duser_profiles t_profil','t_profil.uprof_uacc_fk = t_akun.uacc_id');
 
        //  $this->db->join('fis_dservice_consult_contracts m_kontrak','m_kontrak.sccontr_id = t_kelas.scclass_sccontr_fk');
        //  $this->db->join('fis_dservice_consultations m_konsul','m_konsul.scons_id = m_kontrak.sccontr_sconcs_fk'); 
        //  $this->db->join('fis_duser_accounts m_akun','m_akun.uacc_id = m_konsul.scons_uacc_fk');
        //  $this->db->join('fis_duser_profiles m_profil','m_profil.uprof_uacc_fk =  m_akun.uacc_id');
        $this->db->select('contract.*,
                         t_prof.uprof_full_name as tentor,
                         s_prof.uprof_full_name as mahasiswa');

        $this->db->from('fis_dtraining_contracts contract');
        $this->db->join('fis_duser_accounts s_acc','s_acc.uacc_id = contract.tcontr_uacc_fk');    
        $this->db->join('fis_duser_profiles s_prof','s_prof.uprof_uacc_fk = s_acc.uacc_id');

        $this->db->join('fis_dtraining_students students','students.tstudt_tcontr_fk = contract.tcontr_id');
        $this->db->join('fis_dtraining_classes class','class.tclass_id = students.tstudt_tclass_fk');
        $this->db->join('fis_duser_accounts t_acc','t_acc.uacc_id = class.tclass_tentor_fk');
        $this->db->join('fis_duser_profiles t_prof','t_prof.uprof_uacc_fk = t_acc.uacc_id');

                        
        $query = $this->db->get()->result();
        //echo '<pre>';print_r($query);die;
        return $query;
    }



    function get_class(){
        $this->db->select('fis_dservice_consult_classes.*,
                            fis_dservice_consult_contracts.sccontr_id,
                            fis_dservice_consultations.scons_id,
                            fis_dservice_consultations.scons_uacc_fk,
                            fis_duser_accounts.uacc_id,
                            fis_duser_accounts.uacc_urole_fk,
                            fis_duser_profiles.uprof_uacc_fk,
                            fis_duser_profiles.uprof_full_name as mahasiswa');
        $this->db->from('fis_dservice_consult_classes');
  
        $this->db->join('fis_dservice_consult_contracts','fis_dservice_consult_contracts.sccontr_id = 
                        fis_dservice_consult_classes.scclass_sccontr_fk');
        $this->db->join('fis_dservice_consultations','fis_dservice_consultations.scons_id = 
                        fis_dservice_consult_contracts.sccontr_sconcs_fk');
        $this->db->join('fis_duser_accounts','fis_duser_accounts.uacc_id = 
                        fis_dservice_consultations.scons_uacc_fk');
        $this->db->join('fis_duser_profiles','fis_duser_profiles.uprof_uacc_fk = 
                        fis_duser_accounts.uacc_id');                                                
                         
        $query = $this->db->get()->result();                                             
        return $query;
    }

    function get_mentor(){
        $this->db->select('fis_dservice_consult_classes.*,
                            fis_duser_accounts.uacc_id,
                            fis_duser_accounts.uacc_urole_fk,
                            fis_duser_profiles.uprof_uacc_fk,
                            fis_duser_profiles.uprof_full_name as tentor');
        $this->db->from('fis_dservice_consult_classes');
        $this->db->join('fis_duser_accounts','fis_duser_accounts.uacc_id = 
                        fis_dservice_consult_classes.scclass_mentor_fk');
        $this->db->join('fis_duser_profiles','fis_duser_profiles.uprof_uacc_fk = 
                        fis_duser_accounts.uacc_id');
        $query = $this->db->get()->result();                                             
                        return $query;                        
    }


    

    function deleteSchedule($id){
        
        if ($this->db->delete('fis_dtraining_attendances', array('tattd_id' => $id))) {
            $this->session->set_flashdata('notif','Dihapus') ;
            return TRUE;
        } else {
            
            return FALSE;
        }  
    }

    function get_list_ss() {
        $query = $this->db->get('fis_dservice_consult_schedules');
        return $query->result();
    }

    function get_by_ids($id) {
        $this->db->select('t_contract.*,s_prof.uprof_full_name as mahasiswa');
        $this->db->from('fis_dtraining_classes presence');
        $this->db->join('fis_dtraining_students students','students.tstudt_tclass_fk = presence.tclass_id');
        $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = students.tstudt_tcontr_fk');
        $this->db->join('fis_duser_accounts s_acc','s_acc.uacc_id = t_contract.tcontr_uacc_fk');    
        $this->db->join('fis_duser_profiles s_prof','s_prof.uprof_uacc_fk = s_acc.uacc_id');
        $this->db->where('presence.tclass_id',$id);

        $query = $this->db->get()->result();
        return $query;
    }

    function cari($id){
        
        $this->db->select('t_att.*,
                    s_prof.uprof_full_name as mahasiswa');
        $this->db->from('fis_dtraining_classes presence');
        $this->db->join('fis_dtraining_students students','students.tstudt_tclass_fk = presence.tclass_id');
        $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = students.tstudt_tcontr_fk');
        $this->db->join('fis_dtraining_attendances t_att','t_att.tattd_tcontr_fk = t_contract.tcontr_id');

        $this->db->join('fis_dtraining_contracts s_contract','s_contract.tcontr_id = t_att.tattd_tcontr_fk');
        $this->db->join('fis_duser_accounts s_acc','s_acc.uacc_id = s_contract.tcontr_uacc_fk');    
        $this->db->join('fis_duser_profiles s_prof','s_prof.uprof_uacc_fk = s_acc.uacc_id');

        $this->db->where('presence.tclass_id',$id);
        $this->db->order_by('t_att.tattd_date', 'asc');
        $this->db->order_by('t_att.tattd_timestart', 'asc');
        $query = $this->db->get()->result();
        // print_r($query);exit;
        return $query;
    }
    function editData($id){
        
        $this->db->select('presence.*,class.*,s_contract.tcontr_id,
                        s_prof.uprof_full_name as mahasiswa');
        $this->db->from('fis_dtraining_attendances presence');
        $this->db->join('fis_dtraining_contracts s_contract','s_contract.tcontr_id = presence.tattd_tcontr_fk');
        $this->db->join('fis_dtraining_students students','students.tstudt_tcontr_fk = s_contract.tcontr_id');
        $this->db->join('fis_dtraining_classes class','class.tclass_id = students.tstudt_tclass_fk');


        $this->db->join('fis_duser_accounts s_acc','s_acc.uacc_id = s_contract.tcontr_uacc_fk');    
        $this->db->join('fis_duser_profiles s_prof','s_prof.uprof_uacc_fk = s_acc.uacc_id');
        $this->db->where('presence.tattd_id',$id);

        // $this->db->join('fis_dtraining_contracts t_contract','t_contract.tcontr_id = presence.tattd_tcontr_fk');
        // $this->db->join('fis_dtraining_students students','students.tstudt_tcontr_fk = t_contract.tcontr_id');
        // $this->db->join('fis_dtraining_classes class','class.tclass_id = students.tstudt_tclass_fk');
        // $this->db->join('fis_duser_accounts t_acc','t_acc.uacc_id = class.tclass_tentor_fk');
        // $this->db->join('fis_duser_profiles t_prof','t_prof.uprof_uacc_fk = t_acc.uacc_id');
        $query = $this->db->get()->row();
        // echo "<pre>";print_r($query);exit;
        return $query;
    }

}
