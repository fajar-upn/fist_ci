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
class Mconsult_presence extends CI_Model {
    //untuk mengambil data dari database
    

    /*
     * insert nama_barang, alamat_barang, telp_barang pada data tabel fis_rbarang
     * return TRUE/FALSE
     */
    function insert($data) {
        if ($this->db->insert('fis_dservice_consult_attendances', $data)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * update nama_barang, alamat_barang, telp_barang berdasarkan $id_barang pada data tabel fis_rbarang
     * return TRUE/FALSE
     */
    function update($data, $id) {        
        $this->db->where('scattd_id', $id); //memasukkan berdasarkan id yg telah ada
        if ($this->db->update('fis_dservice_consult_attendances', $data)) { //proses untuk memasukan data yg baru
            return TRUE;
        } else {
            return FALSE;
        }
    }

    /*
     * delete data tabel fis_rbarang berdasarkan id_barang
     */
    
     /*
     * menyimpan data baru/data edit pada data tabel fis_rbarang berdasarkan id_barang
     */
    public function saveData($data, $idPresence = 0) {
        /*
         * apabila form id membawa id !=0 ini menandakan suatu data baru (Input data baru) 
         */
        
        if ($idPresence != 0) {
            
            $this->db->where('scattd_id', $idPresence);
            if ($this->db->update('fis_dservice_consult_attendances', $data)) {
                $this->session->set_userdata('typeNotif', 'successUpdatePresenceConsult');
                return TRUE;
            } else {
                $this->session->set_flashdata('notif','error') ;
                return FALSE;
            }
        } else {
        
            if ($this->db->insert('fis_dservice_consult_attendances', $data)) {
                $this->session->set_userdata('typeNotif', 'successAddPresenceConsult');
                return $this->db->insert_id();
            } else {
                $this->session->set_flashdata('notif','Error') ;
                return FALSE;
            }
        }
 
       
    }
    // untuk mengambil dari tabel schedules
    function get_list_schedules() {
        $this->db->select('hadir.*,
                        t_profil.uprof_full_name as tentor,
                        m_profil.uprof_full_name as mahasiswa
                        ');
        $this->db->from('fis_dservice_consult_attendances hadir');
         $this->db->join('fis_dservice_consult_classes t_kelas','t_kelas.scclass_id = hadir.scattd_scclass_fk');
         $this->db->join('fis_duser_accounts t_akun','t_akun.uacc_id = t_kelas.scclass_mentor_fk');    
         $this->db->join('fis_duser_profiles t_profil','t_profil.uprof_uacc_fk = t_akun.uacc_id');

         $this->db->join('fis_dservice_consult_classes m_kelas','m_kelas.scclass_id = hadir.scattd_scclass_fk');  
         $this->db->join('fis_dservice_consult_contracts m_kontrak','m_kontrak.sccontr_id = m_kelas.scclass_sccontr_fk');
         $this->db->join('fis_dservice_consultations m_konsul','m_konsul.scons_id = m_kontrak.sccontr_sconcs_fk'); 
         $this->db->join('fis_duser_accounts m_akun','m_akun.uacc_id = m_konsul.scons_uacc_fk');
         $this->db->join('fis_duser_profiles m_profil','m_profil.uprof_uacc_fk =  m_akun.uacc_id');
         $this->db->order_by('hadir.scattd_date', 'asc');
         $this->db->order_by('hadir.scattd_time_start', 'asc');

                        
        $query = $this->db->get()->result();
        return $query;
    }


    function get_list_kelas() {
        $this->db->select('t_kelas.*,
                        t_profil.uprof_full_name as tentor,
                        m_profil.uprof_full_name as mahasiswa
                        ');
        $this->db->from('fis_dservice_consult_classes t_kelas');
         $this->db->join('fis_duser_accounts t_akun','t_akun.uacc_id = t_kelas.scclass_mentor_fk');    
         $this->db->join('fis_duser_profiles t_profil','t_profil.uprof_uacc_fk = t_akun.uacc_id');
 
         $this->db->join('fis_dservice_consult_contracts m_kontrak','m_kontrak.sccontr_id = t_kelas.scclass_sccontr_fk');
         $this->db->join('fis_dservice_consultations m_konsul','m_konsul.scons_id = m_kontrak.sccontr_sconcs_fk'); 
         $this->db->join('fis_duser_accounts m_akun','m_akun.uacc_id = m_konsul.scons_uacc_fk');
         $this->db->join('fis_duser_profiles m_profil','m_profil.uprof_uacc_fk =  m_akun.uacc_id');

                        
        $query = $this->db->get()->result();
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


    function get_schedules_by_id($id) {
     
        $this->db->select('fis_dservice_consult_attendances.*,fis_dservice_consult_classes.scclass_id,
                        fis_dservice_consult_classes.scclass_mentor_fk,
                        fis_dservice_consult_classes.scclass_sccontr_fk,
                        fis_dservice_consult_contracts.sccontr_id,
                        fis_dservice_consult_contracts.sccontr_res_fk,
                        fis_rresources.res_id,
                        fis_rresources.res_name,
                        fis_duser_accounts.uacc_id,
                        fis_duser_profiles.uprof_uacc_fk,
                        fis_duser_profiles.uprof_full_name');
        $this->db->from('fis_dservice_consult_attendances');
        $this->db->join('fis_dservice_consult_classes','fis_dservice_consult_classes.scclass_id = 
                        fis_dservice_consult_attendances.scattd_scclass_fk');
        $this->db->join('fis_duser_accounts','fis_duser_accounts.uacc_id = 
                        fis_dservice_consult_classes.scclass_mentor_fk');    
        $this->db->join('fis_duser_profiles','fis_duser_profiles.uprof_uacc_fk = 
                        fis_duser_accounts.uacc_id');                        
        $this->db->join('fis_dservice_consult_contracts','fis_dservice_consult_contracts.sccontr_id = 
                        fis_dservice_consult_classes.scclass_sccontr_fk');                   
        $this->db->join('fis_rresources','fis_rresources.res_id = 
                        fis_dservice_consult_contracts.sccontr_res_fk');  
        $this->db->where('fis_dservice_consult_attendances.scattd_id',$id);
        
        return $this->db->get()->row();
      
    }

    function delete($id){
        
        if ($this->db->delete('fis_dservice_consult_attendances', array('scattd_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDeletePresenceConsult');
            return TRUE;
        } else {
            $this->session->set_flashdata('notif','Error') ;
            return FALSE;
        }  
    }

    function get_list_ss() {
        $query = $this->db->get('fis_dservice_consult_schedules');
        return $query->result();
    }

    function get_by_ids($id) {
        $this->db->select('t_kelas.*,
                            fis_dservice_consult_attendances.*,
                            t_profil.uprof_full_name as tentor,
                            m_profil.uprof_full_name as mahasiswa
                            ');
        $this->db->from('fis_dservice_consult_attendances');
        $this->db->join('fis_dservice_consult_classes t_kelas','t_kelas.scclass_id = 
                        fis_dservice_consult_attendances.scattd_scclass_fk');
        $this->db->join('fis_duser_accounts t_akun','t_akun.uacc_id = t_kelas.scclass_mentor_fk');    
        $this->db->join('fis_duser_profiles t_profil','t_profil.uprof_uacc_fk = t_akun.uacc_id');
        $this->db->join('fis_dservice_consult_contracts m_kontrak','m_kontrak.sccontr_id = t_kelas.scclass_sccontr_fk');
        $this->db->join('fis_dservice_consultations m_konsul','m_konsul.scons_id = m_kontrak.sccontr_sconcs_fk'); 
        $this->db->join('fis_duser_accounts m_akun','m_akun.uacc_id = m_konsul.scons_uacc_fk');
        $this->db->join('fis_duser_profiles m_profil','m_profil.uprof_uacc_fk =  m_akun.uacc_id');
        $this->db->where('fis_dservice_consult_attendances.scattd_id',$id);
                
        $query = $this->db->get()->row();
        return $query;
    }

    function cari($id){
        $query= $this->db->get_where('fis_dservice_consult_schedules',array('scsched_id'=>$id));
        return $query;
    }

}
