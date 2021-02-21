<?php 
	class Model_submit extends CI_Model{

		function insertdata_files($data){
			$this->db->insert('fis_ddevelop_files',$data);
			$id_notif=$this->db->insert_id();
			return $id_notif;
		}

		function insertdata_notif($notif){
			return $this->db->insert('fis_ddevelop_notifications',$notif);
		}

		function get_list_berkas(){
			$query = $this->db->query("SELECT * FROM fis_ddevelop_files df
        JOIN fis_ddevelop_notifications dn ON df.dfiles_id=dn.dnotif_files_fk
         order by dfiles_id");
        return $query->result();
		}

		function delete($id)
    {
        if ($this->db->delete('fis_ddevelop_files', array('dfiles_id' => $id))) {
            $this->session->set_userdata('typeNotif', 'successDelete');
            return TRUE;
        } else {
            $this->session->set_userdata('typeNotif', 'errorDelete');
            return FALSE;
        }
	}
	

	}
 ?>